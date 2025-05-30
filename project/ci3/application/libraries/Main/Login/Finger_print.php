<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use lbuchs\WebAuthn\WebAuthn;
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

    public function validateLogin($clientDataJSON, $authenticatorData, $signature, $credentialPublicKey, $challenge, $userHandle){
        return $this->webauthn->processGet(
            $clientDataJSON,
            $authenticatorData,
            $signature,
            $credentialPublicKey,
            $challenge,
            $userHandle
        );
    }
}