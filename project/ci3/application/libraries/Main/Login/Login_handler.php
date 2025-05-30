<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login_handler
{
    private $CI;
    private $send_sms_code_in_login=true;
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
                if(!empty($b) && !empty(end($b)) && !empty(end($b)['credential_id'])){
                    $webauthnlib=new Finger_print();
                    $webauthn = $webauthnlib->getInstance();
                    $options = $webauthn->getGetArgs([base64_decode(end($b)['credential_id'],true)],20,true,true,true,true,true);
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
        if(!(!empty($data) && !empty($data['id']))){
            echo json_encode(['status' => 'error', 'message' => 'Challenge not found']);
            return;
        }
        $clientDataJSON = $data['response']['clientDataJSON']??'';
        $authenticatorData = $data['response']['authenticatorData']??'';
        $signature = $data['response']['signature']??'';
        if (!$this->CI->session->has_userdata('finger_login_challenge') || empty($this->CI->session->userdata('finger_login_challenge'))) {
            echo json_encode(['status' => 'error', 'message' => 'Challenge not found']);
            return;
        }
        $webauthnlib = new Finger_print();
        $credential = $this->CI->Users_model->credential_where_credential_id($webauthnlib->base64url_to_base64($data['id']));
        if (!(!empty($credential) && !empty(end($credential)))) {
            echo json_encode(['status' => 'error', 'message' => 'Credential not found']);
            return;
        }
        try {
            $data = $webauthnlib->validateLogin($webauthnlib->decodeBase64Url($clientDataJSON),$webauthnlib->decodeBase64Url($authenticatorData),$webauthnlib->decodeBase64Url($signature),base64_decode(end($credential)['public_key'],true),$this->CI->session->userdata('finger_login_challenge'),end($credential)['counter']);
            $this->check_user($this->CI->session->userdata('phone_number'));
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
                $check=$this->CI->Users_model->credential_where_user_mobile_id($this->CI->session->userdata('mobile_id'));
                $webauthnlib = new Finger_print();
                if(!empty($check) && !empty(end($check)) && !empty(end($check)['id']) && intval(end($check)['id'])>0)
                    $this->CI->Users_model->edit_credential_where_id($webauthnlib->set_credential($arr['response'],$this->CI->session->userdata('finger_register_challenge'),$this->CI->session->userdata('mobile_id')),intval(end($check)['id']));
                else
                    $this->CI->Users_model->add_credential($webauthnlib->set_credential($arr['response'],$this->CI->session->userdata('finger_register_challenge'),$this->CI->session->userdata('mobile_id')));
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
            $user_info=$this->CI->Users_model->select_where_id(intval($id));
            if(!empty($user_info) && !empty(end($user_info))){
                $this->CI->session->set_userdata('user_info',end($user_info));    
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
                echo json_encode(['status' => 'error', 'message' =>'user info has error']);
            }
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
                $user_info=$this->CI->Users_model->select_where_id(intval(end($a)['user_id']));
                if(!empty($user_info) && !empty(end($user_info))){
                    $this->CI->session->set_userdata('user_info',end($user_info));    
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
                    die(json_encode(['status'=>'error','message'=>'user info has error']));
                }
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
                echo ($this->send_sms_code_in_login?json_encode(['status' => 'success','code'=>$this->CI->session->userdata('login_code')['code']]):json_encode(['status' => 'success']));
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
    public function check_mobile_has_finger_print(){
        if($this->CI->session->has_userdata('phone_number') && !empty($this->CI->session->userdata('phone_number'))){
            $a=$this->CI->Users_model->select_mobile($this->CI->session->userdata('phone_number'));
            if(!empty($a) && !empty(end($a)) && 
            !empty(end($a)['id']) && 
            intval(end($a)['id']) > 0){
                $b=$this->CI->Users_model->credential_where_user_mobile_id(intval(end($a)['id']));
                if(!empty($b) && !empty(end($b)))
                    die(json_encode(['status'=>'success']));
            }
        }
        echo json_encode(['status'=>'error']);
    }
}