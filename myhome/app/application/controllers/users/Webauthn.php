<?php

use Webauthn\PublicKeyCredentialCreationOptions;
use Webauthn\PublicKeyCredentialRequestOptions;
use Webauthn\AuthenticatorAttestationResponseValidator;
use Webauthn\AuthenticatorAssertionResponseValidator;
use Cose\Algorithm\Manager as CoseManager;
use Webauthn\PublicKeyCredentialUserEntity;
use Webauthn\PublicKeyCredential;
use Webauthn\AuthenticatorAssertionResponse;
use Webauthn\PublicKeyCredentialRpEntity;
use Webauthn\PublicKeyCredentialParameters;
use Webauthn\AuthenticatorAttestationResponse;
use Webauthn\AuthenticatorSelectionCriteria;
use Webauthn\CeremonyStep\CeremonyStepManagerFactory;

class Webauthn extends CI_Controller
{
    private $credentialRepository;
    private $configWebauthn;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Webauthn_model');
        $this->credentialRepository = $this->Webauthn_model;
        $this->configWebauthn = $this->config->item('webauthn');
        require_once APPPATH. 'third_party/vendor/autoload.php';
    }

    public function loginOptions()
    {
        $challenge = random_bytes(32);
        $this->session->set_userdata('login_challenge', base64_encode($challenge));
        $credentials = $this->credentialRepository->findAll();
        if (empty($credentials)) {
            header('Content-Type: application/json');
            echo json_encode(['error' => 'No credentials found']);
            return;
        }
        $allowCredentials = array_map(function($cred) {
            return [
                'type' => 'public-key',
                'id'   => base64_encode($cred->publicKeyCredentialId),
                'transports' => $cred->transports ?? []
            ];
        }, $credentials);
        $options = new PublicKeyCredentialRequestOptions($challenge,$this->configWebauthn['rp_id'],$allowCredentials,'required',(int)60000,null,null);
        if(!empty($options)){
            $optionsArray = [
                'extensions' => $options->extensions->extensions, // extensions
                'challenge' => base64_encode($options->challenge), // challenge (base64 encoding)
                'timeout' => $options->timeout,
                'rpId' => $options->rpId,
                'allowCredentials' => array_map(function($cred) {
                    return [
                        'type' => $cred['type'],
                        'id' => $cred['id'],
                        'transports' => $cred['transports']
                    ];
                }, $options->allowCredentials),
                'userVerification' => $options->userVerification
            ];
            
            header('Content-Type: application/json');
            echo json_encode($optionsArray);
        }else{
            header('Content-Type: application/json');
            echo json_encode(['error' => 'No credentials found']);
        }
        return;
    }

    public function verifyLogin()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        if (!$data) {
            show_error('داده‌های نامعتبر دریافت شد', 400);
        }    
        $challenge = base64_decode($this->session->userdata('login_challenge'));    
        if ($challenge === false) {
            show_error('چالش نامعتبر است', 400);
        }
        $publicKeyCredential = new PublicKeyCredential(
            $data['id'],
            $data['rawId'],
            $data['response'],
            $data['type'],
            $data['clientExtensionResults'] ?? []
        );
        $authenticatorAssertionResponse = new AuthenticatorAssertionResponse(
            $data['response']['clientDataJSON'],
            $data['response']['authenticatorData'],
            $data['response']['signature'],
            $data['response']['userHandle'] ?? null
        );
        $publicKeyCredentialSource = $this->credentialRepository->findOneByCredentialId(
            $publicKeyCredential->rawId
        );
        if ($publicKeyCredentialSource === null) {
            show_error('اعتبارنامه یافت نشد', 401);
        }
        $publicKeyCredentialRequestOptions = new PublicKeyCredentialRequestOptions(
            $challenge,
            $this->configWebauthn['rp_id'],
            $this->configWebauthn['origin']
        );    
        $validator = new AuthenticatorAssertionResponseValidator(
            $this->credentialRepository,
            new CoseManager()
        );    
        try {
            $publicKeyCredentialSource = $validator->check(
                $publicKeyCredentialSource,
                $authenticatorAssertionResponse,
                $publicKeyCredentialRequestOptions,
                $this->configWebauthn['rp_id'],
                $authenticatorAssertionResponse->userHandle
            );
        } catch (\Throwable $e) {
            show_error('خطا در تایید اعتبار: ' . $e->getMessage(), 400);
        }
        $userHandle = $publicKeyCredentialSource->userHandle;    
        $user = $this->credentialRepository->findUserByUserHandle($userHandle);
        if (!$user) {
            show_error('کاربر پیدا نشد', 401);
        }    
        $this->session->set_userdata('user_id', $user->id);    
        header('Content-Type: application/json');
        echo json_encode(['status' => 'ok']);
    }

    public function registerOptions()
    {
        if (empty($_SESSION['id'])) {
            show_error('کاربر لاگین نیست', 401);
            return;
        }
        $userId = $_SESSION['id'];
        $userEntity = new PublicKeyCredentialUserEntity('user' . $userId, $userId, 'User name ' . $userId, null);
        $challenge = random_bytes(32);
        $_SESSION['register_challenge'] = base64_encode($challenge);
        $rpEntity = new PublicKeyCredentialRpEntity($this->configWebauthn['rp_name'], $this->configWebauthn['rp_id'], null);
        $authenticatorSelection = new AuthenticatorSelectionCriteria('required', 'cross-platform');
        $options = new PublicKeyCredentialCreationOptions($rpEntity, $userEntity, $challenge, [PublicKeyCredentialParameters::createPk(-7), PublicKeyCredentialParameters::createPk(-257)], $authenticatorSelection, null, [], 60000);
        $_SESSION['publicKeyCredentialCreationOptions'] = $options; // ذخیره‌سازی تنظیمات در session
        header('Content-Type: application/json');
        echo json_encode([
            'rp' => ['name' => $this->configWebauthn['rp_name'], 'id' => $this->configWebauthn['rp_id']],
            'user' => [
                'id' => base64_encode($userEntity->id),
                'name' => $userEntity->name,
                'displayName' => $userEntity->displayName,
            ],
            'challenge' => base64_encode($options->challenge),
            'pubKeyCredParams' => [
                ['type' => 'public-key', 'alg' => -7],
            ],
            'timeout' => $options->timeout,
            'attestation' => 'none',
            'userVerification' => 'required',
        ]);
    }

    public function verifyRegister()
    {
        if (empty($_SESSION['id'])) {
            show_error('کاربر لاگین نیست', 401);
            return;
        }
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        if (!$data) {
            show_error('داده‌های نامعتبر', 400);
            return;
        }
        $challenge = base64_decode($_SESSION['register_challenge']);
        if ($challenge === false) {
            show_error('چالش نامعتبر', 400);
            return;
        }
        $publicKeyCredential = new PublicKeyCredential($data['id'],$data['rawId'],$data['response'],$data['type'],$data['clientExtensionResults'] ?? []);
        $attestationResponse = new AuthenticatorAttestationResponse($data['response']['clientDataJSON'],$data['response']['attestationObject']);
        $publicKeyCredentialCreationOptions = $_SESSION['publicKeyCredentialCreationOptions'];
        $csmFactory = new CeremonyStepManagerFactory();
        $creationCSM = $csmFactory->creationCeremony();
        $validator = AuthenticatorAttestationResponseValidator::create($creationCSM);
        try {
            $publicKeyCredentialSource = $validator->check(
                $attestationResponse,
                $publicKeyCredentialCreationOptions,
                $this->configWebauthn['origin']
            );
        } catch (\Throwable $e) {
            show_error('خطا در تایید: ' . $e->getMessage(), 400);
        }
        $this->credentialRepository->saveCredential($publicKeyCredentialSource);
        header('Content-Type: application/json');
        echo json_encode(['status' => 'ok']);
    }
    
}
