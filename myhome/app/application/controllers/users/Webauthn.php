<?php

use Webauthn\PublicKeyCredentialCreationOptions;
use Webauthn\PublicKeyCredentialRequestOptions;
use Webauthn\AuthenticatorAttestationResponseValidator;
use Webauthn\AuthenticatorAssertionResponseValidator;
use Cose\Algorithm\Manager as CoseManager;
use Webauthn\PublicKeyCredentialUserEntity;

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
    
        // ⬇️ اینجا دیگه allowCredentials نمیفرستیم، یعنی مرورگر خودش انتخاب میکنه
        $options = new PublicKeyCredentialRequestOptions($challenge,60000,$this->configWebauthn['rp_id'],null,'required',null,null);
        // 👈 یعنی Discoverable (Resident) Login
             // 👈 فقط اگر user verification (مثلا اثرانگشت) انجام شد
    
        header('Content-Type: application/json');
        echo json_encode($options);
    }

    public function verifyLogin()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        $validator = new AuthenticatorAssertionResponseValidator(
            $this->credentialRepository,
            new CoseManager()
        );

        $challenge = base64_decode($this->session->userdata('login_challenge'));
        $rpId = $this->configWebauthn['rp_id'];
        $origin = $this->configWebauthn['origin'];

        $publicKeyCredentialSource = $validator->check(
            $data,
            $challenge,
            $rpId,
            $origin,
            null
        );

        // 👇 user login شد!
        $this->session->set_userdata('user_id', $publicKeyCredentialSource->userHandle);

        header('Content-Type: application/json');
        echo json_encode(['status' => 'ok']);
    }
}
