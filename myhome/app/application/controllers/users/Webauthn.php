<?php

use Webauthn\{
    PublicKeyCredentialCreationOptions,
    PublicKeyCredentialRequestOptions,
    PublicKeyCredentialUserEntity,
    PublicKeyCredentialRpEntity,
    PublicKeyCredentialParameters,
    PublicKeyCredential,
    AuthenticatorAttestationResponse,
    AuthenticatorAssertionResponse,
    AuthenticatorAttestationResponseValidator,
    AuthenticatorAssertionResponseValidator,
    CeremonyStep\CeremonyStepManagerFactory,
    AuthenticatorSelectionCriteria,
    PublicKeyCredentialDescriptor
};

class Webauthn extends CI_Controller
{
    private $credentialRepository;
    private $configWebauthn;

    public function __construct() {
        parent::__construct();
        $this->load->model('Webauthn_model');
        $this->credentialRepository = $this->Webauthn_model;
        $this->configWebauthn = $this->config->item('webauthn');
        require_once APPPATH . 'third_party/vendor/autoload.php';
    }

    private function jsonResponse($data, $statusCode = 200) {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        die(json_encode($data));
    }

    private function jsonOk() { 
        return $this->jsonResponse(['status' => 'ok']); 
    }

    private function jsonError($msg) { 
        return $this->jsonResponse(['error' => $msg], 400); 
    }

    private function jsonData($arr) { 
        return $this->jsonResponse($arr); 
    }

    private function getChallenge($key) {
        $encoded = $this->session->userdata($key);
        if (!$encoded) $this->jsonError('challenge missing');
        $challenge = base64_decode($encoded, true);
        if ($challenge === false) $this->jsonError('challenge not valid');
        return $challenge;
    }

    private function getLoggedInUserId() {
        $userId = $this->session->userdata('id');
        if (!$userId) $this->jsonError('user is not login');
        return $userId;
    }

    public function loginOptions() {
        $challenge = random_bytes(32);
        $this->session->set_userdata('login_challenge', base64_encode($challenge));
        $credentials = $this->credentialRepository->findAll();
        if (empty($credentials)) return $this->jsonError('No credentials found');
        $allowCredentials = array_map(function ($cred) {
            return new PublicKeyCredentialDescriptor(
                'public-key',
                base64_decode($cred->id),
                $cred['transports'] ?? []
            );
        }, $credentials);
        $options = new PublicKeyCredentialRequestOptions($challenge, $this->configWebauthn['rp_id'], $allowCredentials, 'required', 60000);
        return $this->jsonData([
            'extensions' => $options->extensions->extensions,
            'challenge' => base64_encode($options->challenge),
            'timeout' => $options->timeout,
            'rpId' => $options->rpId,
            'allowCredentials' => $allowCredentials,
            'userVerification' => $options->userVerification
        ]);
    }

    public function verifyLogin() {
        $data = json_decode(file_get_contents('php://input'), true);
        if (!$data) return $this->jsonError('data not valid');
        $challenge = $this->getChallenge('login_challenge');
        $publicKeyCredential = new PublicKeyCredential($data['id'], $data['rawId'], $data['response'], $data['type'], $data['clientExtensionResults'] ?? []);
        $authenticatorAssertionResponse = new AuthenticatorAssertionResponse($data['response']['clientDataJSON'],$data['response']['authenticatorData'],$data['response']['signature'],$data['response']['userHandle'] ?? null);
        $publicKeyCredentialSource = $this->credentialRepository->findOneByCredentialId($publicKeyCredential->rawId);
        if ($publicKeyCredentialSource === null) return $this->jsonError('public Key Credential Not Found');
        $options = new PublicKeyCredentialRequestOptions($challenge,$this->configWebauthn['rp_id'],[$publicKeyCredentialSource->publicKeyCredentialId],'required',60000);
        $csmFactory = new CeremonyStepManagerFactory();
        $validator = AuthenticatorAssertionResponseValidator::create($csmFactory->requestCeremony());
        try {
            $publicKeyCredentialSource = $validator->check(
                $publicKeyCredentialSource, 
                $authenticatorAssertionResponse, 
                $options,
                $this->configWebauthn['rp_id'], 
                $authenticatorAssertionResponse->userHandle,
                $this->configWebauthn['origin']);
        } catch (\Throwable $e) {
            return $this->jsonError('error in ' . $e->getMessage());
        }
        $user = $this->credentialRepository->findUserByUserHandle($publicKeyCredentialSource->userHandle);
        if (!$user) return $this->jsonError('user not found');
        $this->session->set_userdata('user_id', $user->id);
        return $this->jsonOk();
    }

    public function registerOptions() {
        $userId = $this->getLoggedInUserId();
        $userEntity = new PublicKeyCredentialUserEntity('user' . $userId, $userId, 'User name ' . $userId);
        $challenge = random_bytes(32);
        $this->session->set_userdata('register_challenge', base64_encode($challenge));
        $rpEntity = new PublicKeyCredentialRpEntity($this->configWebauthn['rp_name'], $this->configWebauthn['rp_id']);
        $authenticatorSelection = new AuthenticatorSelectionCriteria(authenticatorAttachment: null, userVerification: 'required');
        $credentials = $this->credentialRepository->findAllByUserId($userId);
        $excludeCredentials = array_map(function ($cred) {return new PublicKeyCredentialDescriptor('public-key',base64_decode($cred->publicKeyCredentialId),$cred->transports ?? []);}, $credentials);
        $options = new PublicKeyCredentialCreationOptions($rpEntity, $userEntity, $challenge, [PublicKeyCredentialParameters::createPk(-7),PublicKeyCredentialParameters::createPk(-257)], $authenticatorSelection, null, $excludeCredentials , 60000);
        $this->session->set_userdata('publicKeyCredentialCreationOptions', $options);
        return $this->jsonData([
            'rp' => ['name' => $this->configWebauthn['rp_name'], 'id' => $this->configWebauthn['rp_id']],
            'user' => [
                'id' => base64_encode($userEntity->id),
                'name' => $userEntity->name,
                'displayName' => $userEntity->displayName
            ],
            'challenge' => base64_encode($options->challenge),
            'pubKeyCredParams' => [
                ['type' => 'public-key', 'alg' => -7],
                ['type' => 'public-key', 'alg' => -257]
            ],
            'timeout' => $options->timeout,
            'attestation' => $this->configWebauthn['attestation'] ?? 'none',
            'userVerification' => 'required'
        ]);
    }

    public function verifyRegister() {
        $this->getLoggedInUserId();
        $data = json_decode(file_get_contents('php://input'), true);
        if (!$data) return $this->jsonError('data not valid');
        $attestationResponse = new AuthenticatorAttestationResponse($data['response']['clientDataJSON'],$data['response']['attestationObject']);
        $options = $this->session->userdata('publicKeyCredentialCreationOptions');
        $csmFactory = new CeremonyStepManagerFactory();
        $validator = AuthenticatorAttestationResponseValidator::create($csmFactory->creationCeremony());
        try {
            $publicKeyCredentialSource = $validator->check($attestationResponse, $options, $this->configWebauthn['origin']);
        } catch (\Throwable $e) {
            return $this->jsonError('error in ' . $e->getMessage());
        }
        $this->credentialRepository->saveCredential($publicKeyCredentialSource,$this->getLoggedInUserId());
        return $this->jsonOk();
    }
}