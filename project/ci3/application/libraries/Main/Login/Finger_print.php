<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use lbuchs\WebAuthn\WebAuthn;
use lbuchs\WebAuthn\Binary\ByteBuffer;
class finger_Print{
    private $webauthn;
    public function __construct(){
        $CI =& get_instance();
        $config = $CI->config->item('webauthn');
        $rpName = $config['rp_name'];
        $rpID = $config['rp_id'];
        $origin = $config['origin'];
        $requireResidentKey = false;
        $attestation = $config['attestation'];
        $this->webauthn = new WebAuthn($rpName, $rpID, $origin, $requireResidentKey, null, $attestation);
    }
    public function base64url_to_base64($input) {
        return base64_encode($this->decodeBase64Url($input));
    }
    public function decodeBase64Url($input) {
        return ByteBuffer::fromBase64Url($input)->getBinaryString();
    }
    public function getInstance(){
        return $this->webauthn;
    }
    public function generateRegistrationOptions($userID, $userName){
        return $this->webauthn->getCreateArgs($userID, $userName, $userName);
    }
    public function validateRegistration($clientDataJSON, $attestationObject, $challenge, $requireResidentKey = false){
        return $this->webauthn->processCreate($clientDataJSON, $attestationObject, $challenge, $requireResidentKey);
    }
    public function generateLoginOptions($credentials){
        return $this->webauthn->getGetArgs($credentials);
    }
    public function validateLogin($clientDataJSON, $authenticatorData, $signature, $credentialPublicKey, $challenge, $count){
        return $this->webauthn->processGet(
            $clientDataJSON,
            $authenticatorData,
            $signature,
            $credentialPublicKey,
            $challenge,
            $count,
            false,
            true
        );
    }
    public function set_credential($data,$challenge,$mobile_id){
        if(!empty($data) && !empty($data['attestationObject']) && !empty($data['clientDataJSON']) && !empty($challenge) && !empty($mobile_id)){
            $data = $this->validateRegistration($this->decodeBase64Url($data['clientDataJSON']),$this->decodeBase64Url($data['attestationObject']),$challenge);
            return [
                'user_mobile_id'       => $mobile_id,
                'credential_id'        => base64_encode($data->credentialId),
                'public_key'           => base64_encode($data->credentialPublicKey),
                'counter'              => $data->signatureCounter ?? 0,
                'aaguid'               => $data->AAGUID ?? null,
                'user_verified'        => $data->userVerified ? 1 : 0,
                'user_present'         => $data->userPresent ? 1 : 0,
                'attestation_format'   => $data->attestationFormat ?? null,
                'certificate'          => $data->certificate ?? null,
                'certificate_issuer'   => $data->certificateIssuer ?? null,
                'certificate_subject'  => $data->certificateSubject ?? null,
            ];
        }
        return [];
    }
}