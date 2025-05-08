<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use WebAuthn\PublicKeyCredentialUserEntity;
use WebAuthn\PublicKeyCredentialCreationOptions;
use WebAuthn\Server;
use WebAuthn\AuthenticatorSelectionCriteria;
use WebAuthn\AttestationConveyancePreference;

class Webauthn extends CI_Controller {

    private $server;

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('User_model'); // فرض می‌کنیم که مدل کاربری دارید
    }

    // 1. ایجاد گزینه‌های WebAuthn (Challenge)
    public function options() {
        $user = $this->User_model->getUser($this->session->user_id); // دریافت اطلاعات کاربر از دیتابیس

        // ساخت PublicKeyCredentialUserEntity برای کاربر
        $userEntity = new PublicKeyCredentialUserEntity(
            $user['id'], // شناسه کاربر
            $user['email'], // ایمیل یا شناسه کاربر
            $user['name']   // نام کاربر
        );

        // تنظیمات WebAuthn برای تولید گزینه‌ها
        $authenticatorSelection = new AuthenticatorSelectionCriteria(
            true, // انتخاب دستگاه‌های قابل اطمینان
            'cross-platform' // نوع انتخاب احراز هویت
        );

        $attestationPreference = AttestationConveyancePreference::DIRECT();

        // ساخت WebAuthn Server
        $this->server = new Server(
            $this->config->item('webauthn')['rp_name'], // نام RP
            $this->config->item('webauthn')['rp_id'],   // شناسه RP
            $this->config->item('webauthn')['origin'],   // URL مبدا
            $this->config->item('webauthn')['origin'],   // همان URL مبدا برای attestation
            $authenticatorSelection,
            $attestationPreference
        );

        // تولید گزینه‌های WebAuthn
        $options = $this->server->generatePublicKeyCredentialCreationOptions($userEntity);

        // ذخیره چالش در سشن
        $this->session->set_userdata('challenge', $options->getChallenge());

        // ارسال گزینه‌ها به کلاینت
        echo json_encode($options);
    }

    // 2. تایید پاسخ WebAuthn (WebAuthn Assertion)
    public function login() {
        $assertionResponse = $this->input->raw_input_stream; // دریافت پاسخ WebAuthn از کلاینت

        // پردازش پاسخ احراز هویت
        $assertionResponse = json_decode($assertionResponse);
        $response = $assertionResponse->response;

        // اعتبارسنجی پاسخ WebAuthn
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
