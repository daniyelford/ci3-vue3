<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_handler
{
    private $CI;
    public function __construct(){
		$this->CI =& get_instance();
        $this->CI->load->model('Users_model');
        $this->CI->load->library('Tools/Security_handler');
        $this->CI->load->library('Main/Login/Finger_print');
	}
    public function finger_login(){
        if($this->CI->session->has_userdata('phone_number') && !empty($this->CI->session->userdata('phone_number'))){
            $a=$this->CI->Users_model->select_mobile($this->CI->session->userdata('phone_number'));
            if(!empty($a) && !empty(end($a)) && 
            !empty(end($a)['id']) && 
            intval(end($a)['id']) > 0){
                $b=$this->CI->Users_model->credential_where_user_mobile_id(intval(end($a)['id']));
                if(!empty($b) && !empty(end($b))){
                    $webauthnlib=new Finger_print();
                    $webauthn = $webauthnlib->getInstance();
                    $options = $webauthn->getGetArgs(end($b));
                    $this->CI->session->set_userdata('finger_login_challenge',$options->publicKey->challenge);
                    echo json_encode($options);
                }else{
                    echo json_encode(['status'=>'error','message'=>'اثر انگشت قبلا ثبت نشده است']);                    
                }
            }else{
                echo json_encode(['status'=>'error','message'=>'با این شماره ثبت نام انجام نشده است']);                
            }
        }else{
            echo json_encode(['status'=>'error','message'=>'invalid request']);            
        }
    }
    public function finger_login_check($data) {
        $credentialId = $data['credentialId']??'';
        $clientDataJSON = $data['clientDataJSON']??'';
        $authenticatorData = $data['authenticatorData']??'';
        $signature = $data['signature']??'';
        $userHandle = $data['userHandle']??'';
        $challenge = $this->CI->session->userdata('finger_login_challenge');
        if (!$challenge) {
            echo json_encode(['status' => 'error', 'message' => 'Challenge not found']);
            return;
        }
        $credential = $this->CI->Users_model->credential_where_credential_id($credentialId);
        if (!$credential) {
            echo json_encode(['status' => 'error', 'message' => 'Credential not found']);
            return;
        }
        try {
            $webauthnlib = new Finger_print();
            $data = $webauthnlib->validateLogin(
                $clientDataJSON,
                $authenticatorData,
                $signature,
                $credentialId,
                base64_decode($credential->public_key,true),
                $credential->counter,
                $challenge
            );
            $this->CI->Users_model->edit_credential_where_credential_id($data,$credentialId);
            $this->check_user($this->CI->session->userdata('phone_number'));
            // $this->CI->session->set_userdata('user_mobile_id', $credential->user_mobile_id);
            echo json_encode(['status' => 'success']);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
    public function finger_register() {
        $webauthnlib = new Finger_print();
        $options = $webauthnlib->generateRegistrationOptions($this->CI->session->userdata('mobile_id'),'user' . $this->CI->session->userdata('mobile_id'));
        $this->CI->session->set_userdata('finger_register_challenge', $options->publicKey->challenge);
        echo json_encode($options);
    }
    public function finger_register_check($arr) {
        if (!empty($arr) && !empty($arr['response']) &&
        isset($arr['response']['clientDataJSON']) && is_string($arr['response']['clientDataJSON']) &&
        isset($arr['response']['attestationObject']) && is_string($arr['response']['attestationObject']) &&
        $this->CI->session->has_userdata('finger_register_challenge') &&
        !empty($this->CI->session->userdata('finger_register_challenge'))) {            
            try {
                $clientDataJSON = base64_decode($arr['response']['clientDataJSON'], true);
                if ($clientDataJSON === false || empty($clientDataJSON)) {
                    throw new Exception('Invalid base64 clientDataJSON');
                }
                $clientDataArr = json_decode($clientDataJSON, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    throw new Exception('clientDataJSON is not valid JSON');
                }
                if (!isset($clientDataArr['type']) || $clientDataArr['type'] !== 'webauthn.create') {
                    throw new Exception('Invalid client data type');
                }
                $webauthnlib = new Finger_print();
                $data = $webauthnlib->validateRegistration(
                    base64_decode(strtr($arr['response']['clientDataJSON'], '-_', '+/'),true),
                    base64_decode(strtr($arr['response']['attestationObject'], '-_', '+/'),true),
                    base64_decode(strtr($this->CI->session->userdata('finger_register_challenge'), '-_', '+/'),true)
                );
                $credential = [
                    'user_mobile_id'       => $this->CI->session->userdata('mobile_id'),
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
                $this->CI->Users_model->add_credential($credential);
                echo json_encode(['status' => 'success']);
            } catch (Exception $e) {
                echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'invalid request lib']);
        }
    }
    public function register($arr){
        $security= new Security_handler();
        if(!empty($arr) && $this->CI->session->has_userdata('mobile_id') && 
        !empty($this->CI->session->userdata('mobile_id')) &&
        $security->string_secutory_week_check($arr['family']) &&
        $security->string_secutory_week_check($arr['name']) && 
        intval($this->CI->session->userdata('mobile_id')) > 0 && 
        !empty($arr['name']) && !empty($arr['family'])){
            $id=$this->CI->Users_model->add_return_id(['name'=>$arr['name'],'family'=>$arr['family']]);
            if(!(!empty($id) && intval($id)>0))
                die(json_encode(['status' => 'error', 'message' => 'database error']));
            $this->CI->session->set_userdata('id',intval($id));
            if(!$this->CI->Users_model->edit_mobile_weher_id(['user_id'=>intval($id)],intval($this->CI->session->userdata('mobile_id'))))
                die(json_encode(['status' => 'error', 'message' => 'database error']));
            $account_id=$this->CI->Users_model->add_account_return_id(['user_mobile_id'=>intval($this->CI->session->userdata('mobile_id'))]);
            if (!(!empty($account_id) && intval($account_id)>0))
                die(json_encode(['status' => 'error', 'message' => 'database error']));
            $this->CI->session->set_userdata('account_id',$account_id);
            echo json_encode(['status' => 'success']);
        }else{
            echo json_encode(['status' => 'error', 'message' => 'نام و نام خانوادگی نامعتبر است']);
        }
    }
    private function check_user($str){
        $mobile_id=0;
        $result=[];
        $a=$this->CI->Users_model->select_mobile($str);
        if(!empty($a) && !empty(end($a)) && 
        !empty(end($a)['id']) && 
        intval(end($a)['id']) > 0){
            $mobile_id=intval(end($a)['id']);
            if(!empty(end($a)['user_id']) &&
            intval(end($a)['user_id']) > 0){
                $this->CI->session->set_userdata('id',intval(end($a)['user_id']));
                $b=$this->CI->Users_model->select_account_where_mobile_id(intval(end($a)['id']));
                $account_id=0;
                if(!empty($b) && !empty(end($b)) && 
                !empty(end($b)['id']) && 
                intval(end($b)['id']) > 0){
                    $account_id=intval(end($b)['id']);
                }else{
                    $account_id=$this->CI->Users_model->add_account_return_id(['user_mobile_id'=>intval(end($a)['id'])]);
                    if(!(!empty($account_id) && intval($account_id)>0)){
                        die(json_encode(['status'=>'error','message'=>'add to db has error account']));
                    }
                }
                $this->CI->session->set_userdata('account_id',$account_id);
    			$result=['status' => 'success','url'=>'dashboard'];
            }else{
    			$result=['status' => 'success','url'=>'register'];
            }
        }else{
            $mobile_id=$this->CI->Users_model->add_mobile_return_id(['phone'=>$str]);
    		if(!(!empty($mobile_id) && intval($mobile_id)>0)){
                die(json_encode(['status'=>'error','message'=>'add to db has error mobile']));
            }
            $result=['status' => 'success','url'=>'register'];
        }
        $this->CI->session->set_userdata('mobile_id',$mobile_id);
    	echo json_encode($result);
    }
    public function sms_login_code_check($data){
        $security= new Security_handler();
        if(!empty($data) && !empty($data['phone']) && $security->validate_mobile_number($data['phone']) && !empty($data['code']) && intval($data['code']) > 0 && $this->CI->session->has_userdata('login_code') && !empty($this->CI->session->userdata('login_code')) && !empty($this->CI->session->userdata('login_code')['phone']) && !empty($this->CI->session->userdata('login_code')['code']) && $this->CI->session->userdata('login_code')['code'] === intval($data['code']) && $this->CI->session->userdata('login_code')['phone'] === $data['phone'])
            $this->check_user($data['phone']);
        else
			echo json_encode(['status' => 'error', 'message' => 'کد نامعتبر است']);
    }
    public function send_sms_login($data){
        $security= new Security_handler();
        if(!empty($data) && $security->validate_mobile_number($data) && $this->CI->session->has_userdata('phone_number') && !empty($this->CI->session->userdata('phone_number')) && $data===$this->CI->session->userdata('phone_number')){
            $this->CI->session->set_userdata('login_code',['code'=>rand(100000,1000000),'phone'=>$data]);
            if($this->send_sms_action($this->CI->session->userdata('login_code')['code'],$data))
                echo json_encode(['status' => 'success','code'=>$this->CI->session->userdata('login_code')['code']]);
            else
                echo json_encode(['status' => 'error','message'=>'پیامک ارسال نشد']);
        }else{
            echo json_encode(['status' => 'error','message'=>'شماره همراه معتبر نیست']);
        }
    }
    private function send_sms_action($str,$to){
        return true;
        if(!empty($str) && (is_string($str)||is_numeric($str)) && !empty($to) && is_string($to)){
            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://api.sms.ir/v1/send/verify',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS =>'{
                    "mobile": "'.$to.'",
                    "templateId": '.SMSIRTEMPID.',
                    "parameters": [
                        {
                            "name": "CODE",
                            "value": "'.$str.'"
                        }
                    ]
                }',
                CURLOPT_HTTPHEADER => [
                    'Content-Type: application/json',
                    'Accept: text/plain',
                    'x-api-key: '.SMSIRKEY
                ]
            ]);
            $response = curl_exec($curl);
            curl_close($curl);
            $response=json_decode($response,true);
            if(!empty($response) && !empty($response['status']) && intval($response['status'])===1) return true;
        }
        return false;
    }
    public function set_mobile_number($str){
        $security= new Security_handler();
        if(!empty($str) && $security->validate_mobile_number($str)){
            $this->CI->session->set_userdata('phone_number',$str);
            echo json_encode(['status' => 'success']);
        }else{
            echo json_encode(['status' => 'error','message'=>'شماره همراه معتبر نیست']);
        }
    }
}