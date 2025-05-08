<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use WebAuthn\PublicKeyCredentialSource;
use WebAuthn\PublicKeyCredentialUserEntity;
use WebAuthn\Server;
use WebAuthn\AuthenticatorSelectionCriteria;
use WebAuthn\AttestationConveyancePreference;
use WebAuthn\Extensions\ExtensionInterface;
use WebAuthn\AuthenticatorAttestationResponse;
use WebAuthn\CredentialRepository;

class Webauthn extends CI_Controller {

    private $server;

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        // Load WebAuthn library or autoloader
        require_once APPPATH . 'third_party/WebAuthn/vendor/autoload.php';
        $this->load->model('User_model'); // فرض می‌کنیم که مدل کاربری دارید
    }

    // 1. ایجاد گزینه‌های WebAuthn (Challenge)
    public function options() {
        $user = $this->User_model->getUser($this->session->user_id); // گرفتن کاربر از دیتابیس
        
        $userEntity = new PublicKeyCredentialUserEntity(
            $user['id'],  // ID کاربر
            $user['email'], // ایمیل یا شناسه کاربر
            $user['name']   // نام کاربر
        );
        
        $authenticatorSelection = new AuthenticatorSelectionCriteria(
            true, // باید از دستگاه‌های قابل اطمینان استفاده کند
            'cross-platform' // نوع انتخاب احراز هویت
        );

        $attestationPreference = AttestationConveyancePreference::DIRECT();

        $this->server = new Server(
            $this->config->item('webauthn')['rp_name'],
            $this->config->item('webauthn')['rp_id'],
            $this->config->item('webauthn')['origin'],
            $this->config->item('webauthn')['origin'],
            $authenticatorSelection,
            $attestationPreference
        );

        $options = $this->server->generatePublicKeyCredentialCreationOptions($userEntity);

        $this->session->set_userdata('challenge', $options->getChallenge());

        echo json_encode($options);
    }

    // 2. تایید پاسخ WebAuthn (WebAuthn Assertion)
    public function login() {
        $assertionResponse = $this->input->raw_input_stream; // دریافت پاسخ WebAuthn از کلاینت

        // پردازش پاسخ احراز هویت
        $assertionResponse = json_decode($assertionResponse);
        $response = $assertionResponse->response;
        $credential = $this->server->loadAndCheckAssertionResponse(
            $response->authenticatorData,
            $response->clientDataJSON,
            $response->signature
        );

        if ($credential) {
            // اگر اعتبارسنجی موفق بود، ورود را انجام دهید
            $this->session->set_userdata('user_id', $credential->getUserEntity()->getId());
            redirect('dashboard');
        } else {
            echo "Login failed!";
        }
    }
}
