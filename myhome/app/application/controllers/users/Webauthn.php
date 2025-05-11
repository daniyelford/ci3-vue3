<?php

use Webauthn\PublicKeyCredentialCreationOptions;
use Webauthn\PublicKeyCredentialRequestOptions;
use Webauthn\AuthenticatorAttestationResponseValidator;
use Webauthn\AuthenticatorAssertionResponseValidator;
use Cose\Algorithm\Manager as CoseManager;
use Webauthn\PublicKeyCredentialUserEntity;
use Webauthn\PublicKeyCredential;
use Webauthn\PublicKeyCredentialSource;
use Webauthn\TrustPath\EmptyTrustPath;
use Webauthn\AuthenticatorAssertionResponse;

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

    public function registerOptions()
    {
        $challenge = random_bytes(32);
        $this->session->set_userdata('register_challenge', base64_encode($challenge));
        $userHandle = bin2hex(random_bytes(16)); 
        $this->session->set_userdata('register_user_handle', $userHandle);
        $userEntity = new PublicKeyCredentialUserEntity(
            'user@example.com', // name
            $userHandle,        // user handle (unique id)
            'Example User',     // display name
            null
        );
        $options = new PublicKeyCredentialCreationOptions(
            $this->configWebauthn['rp_id'],
            $this->configWebauthn['rp_name'],
            $challenge,
            $userEntity,
            [
                ['type' => 'public-key', 'alg' => -7],
                ['type' => 'public-key', 'alg' => -257],
            ],
            null,
            [
                'authenticatorSelection' => [
                    'residentKey' => 'required', // 👈 این مهمه! یعنی حتماً Resident Key باشه
                    'userVerification' => 'required' // 👈 یعنی باید اثرانگشت/چهره تأیید کنه
                ]
            ]
        );
        header('Content-Type: application/json');
        echo json_encode($options);
    }
    

    public function verifyRegister()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        $validator = new AuthenticatorAttestationResponseValidator(
            $this->credentialRepository,
            new CoseManager()
        );

        $challenge = base64_decode($this->session->userdata('register_challenge'));
        $rpId = $this->configWebauthn['rp_id'];
        $origin = $this->configWebauthn['origin'];

        $publicKeyCredentialSource = $validator->check(
            $data,
            $challenge,
            $rpId,
            $origin,
            null
        );

        // 👇 save credential
        $this->credentialRepository->saveCredential($publicKeyCredentialSource);

        header('Content-Type: application/json');
        echo json_encode(['status' => 'ok']);
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
    
}
