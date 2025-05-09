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

        // Load config
        $this->configWebauthn = $this->config->item('webauthn');

        // Example repository (You will implement this)
        // $this->load->model('YourCredentialRepository');
        // $this->credentialRepository = new YourCredentialRepository();
    }

    public function test()
    {
        die('hi');
    }

    public function registerOptions()
    {
        $challenge = random_bytes(32);
        $this->session->set_userdata('register_challenge', base64_encode($challenge));

        $userEntity = new PublicKeyCredentialUserEntity(
            'user@example.com',         // user name
            random_bytes(16),           // user id (binary)
            'Example User',             // display name
            null                        // icon (optional)
        );

        $options = new PublicKeyCredentialCreationOptions(
            $this->configWebauthn['rp_id'],          // Relying Party ID
            $this->configWebauthn['rp_name'],        // Relying Party name
            $challenge,
            $userEntity,
            [
                [
                    'type' => 'public-key',
                    'alg' => -7 // ES256
                ]
            ],
            null
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
            null // tokenBinding (optional)
        );

        $this->credentialRepository->saveCredential($publicKeyCredentialSource);

        header('Content-Type: application/json');
        echo json_encode(['status' => 'ok']);
    }

    public function loginOptions()
    {
        $challenge = random_bytes(32);
        $this->session->set_userdata('login_challenge', base64_encode($challenge));

        $options = new PublicKeyCredentialRequestOptions(
            $challenge,
            60000,                                // timeout
            $this->configWebauthn['rp_id'],       // rpId
            null,                                 // allowCredentials
            null,                                 // userVerification
            null,                                 // extensions
            null                                  // mediation
        );

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

        $this->session->set_userdata('user_id', $publicKeyCredentialSource->getUserHandle());

        header('Content-Type: application/json');
        echo json_encode(['status' => 'ok']);
    }
}
