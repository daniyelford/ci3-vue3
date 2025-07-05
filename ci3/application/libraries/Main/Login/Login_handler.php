<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login_handler
{
    private $CI;
    private Send_handler $send;
    private Security_handler $security;
    private Finger_print $finger;
    private Users_model $users_model;
    private Media_model $media_model;

    private bool $fack_ip_used = true;
    private bool $send_sms_code_in_login = true;
    private bool $send_sms_example = true;
    public function __construct(
        Send_handler $send, 
        Security_handler $security, 
        Finger_print $finger,
        Users_model $users_model,
        Media_model $media_model
        )
    {
        $this->CI =& get_instance();
        $this->send = $send;
        $this->security = $security;
        $this->finger = $finger;
        $this->users_model = $users_model;
        $this->send->send_sms_example = $this->send_sms_example;
        $this->send->fack_ip_used = $this->fack_ip_used;
        $this->media_model = $media_model;
    }
    private function check_user_address($account_id){
        if(!empty($account_id)&&intval($account_id)>0){
            $a=$this->send->ip_handler();
            $this->CI->session->set_userdata('user_city',$a['city']??'');
            $this->CI->session->set_userdata('user_cordinates',['lat'=>$a['lat']??'','lon'=>$a['lon']??'']);
            $b=$this->users_model->add_address_return_id([
                'user_account_id'=>intval($account_id),
                'country'=>$a['country']??'',
                'region'=>$a['regionName']??'',
                'city'=>$a['city']??'',
                'lat'=>$a['lat']??'',
                'lon'=>$a['lon']??'',
                'currency' => $a['currency'] ?? '',
                'mobile' => (!empty($a['mobile']) && $a['mobile'] ?1:0),
                'proxy' => (!empty($a['proxy']) && $a['proxy'] ?1:0),
                'address'=> $a['address'] ?? '',
            ]);
            if(!empty($b) && intval($b)>0) $this->CI->session->set_userdata('user_address_id',$b);
        }
    }
    private function check_user_rule($account_id){
        if(!empty($account_id)&&intval($account_id)>0){
            $a=$this->users_model->select_account_where_id(intval($account_id));
            if(!empty($a) && !empty(end($a))){
                if(!empty(end($a)['category_id']) && intval(end($a)['category_id'])>0) $this->CI->session->set_userdata('category_id',intval(end($a)['category_id']));
                if(!empty(end($a)['rule'])) $this->CI->session->set_userdata('rule',end($a)['rule']);
            }
        }
    }
    private function check_user($str){
        $mobile_id=0;
        $result=[];
        $a=$this->users_model->select_mobile($str);
        if(!empty($a) && !empty(end($a)) && 
        !empty(end($a)['id']) && 
        intval(end($a)['id']) > 0){
            $mobile_id=intval(end($a)['id']);
            if(!empty(end($a)['user_id']) &&
            intval(end($a)['user_id']) > 0){
                $user_info=$this->users_model->select_where_id(intval(end($a)['user_id']));
                if(!empty($user_info) && !empty(end($user_info))){
                    $this->CI->session->set_userdata('user_info',end($user_info));    
                    $this->CI->session->set_userdata('id',intval(end($a)['user_id']));
                    $b=$this->users_model->select_account_where_mobile_id(intval(end($a)['id']));
                    $account_id=0;
                    if(!empty($b) && !empty(end($b)) && 
                    !empty(end($b)['id']) && 
                    intval(end($b)['id']) > 0){
                        $account_id=intval(end($b)['id']);
                    }else{
                        $account_id=$this->users_model->add_account_return_id(['user_mobile_id'=>intval(end($a)['id'])]);
                        if(!(!empty($account_id) && intval($account_id)>0)) return ['status'=>'error','message'=>'add to db has error account'];
                    }
                    $this->CI->session->set_userdata('account_id',$account_id);
                    $this->check_user_address($account_id);
                    $this->check_user_rule($account_id);
                    $result=['status' => 'success','url'=>'dashboard'];
                }else{
                    return ['status'=>'error','message'=>'user info has error'];
                }
            }else{
    			$result=['status' => 'success','url'=>'register'];
            }
        }else{
            $mobile_id=$this->users_model->add_mobile_return_id(['phone'=>$str]);
    		if(!(!empty($mobile_id) && intval($mobile_id)>0)){
                return ['status'=>'error','message'=>'add to db has error mobile'];
            }
            $result=['status' => 'success','url'=>'register'];
        }
        $this->CI->session->set_userdata('mobile_id',$mobile_id);
    	return $result;
    }
    public function register_user($arr){
        $mobile_info=[];
        if(!empty($arr) && $this->CI->session->has_userdata('mobile_id') && 
        !empty($this->CI->session->userdata('mobile_id')) &&
        $this->security->string_secutory_week_check($arr['family']) &&
        $this->security->string_secutory_week_check($arr['name']) && 
        intval($this->CI->session->userdata('mobile_id')) > 0 && 
        !empty($arr['name']) && !empty($arr['family'])){
            $id=$this->users_model->add_return_id(['name'=>$arr['name'],'family'=>$arr['family']]);
            $user_info=$this->users_model->select_where_id(intval($id));
            if(!empty($user_info) && !empty(end($user_info))){
                $this->CI->session->set_userdata('user_info',end($user_info));    
                if(!(!empty($id) && intval($id)>0)) return ['status' => 'error', 'message' => 'database error'];
                $this->CI->session->set_userdata('id',intval($id));
                $image_id=(!empty($arr['image_id']) && intval($arr['image_id'])>0?$arr['image_id']:0);
                $mobile_info['user_id'] = intval($id);
                if($image_id>0){
                    $mobile_info['image_id']=intval($image_id);
                    if(!$this->media_model->edit_weher_id(['used_status'=>'used'],intval($image_id))) return ['status' => 'error', 'message' => 'database error'];
                }
                if(!$this->users_model->edit_mobile_weher_id($mobile_info,intval($this->CI->session->userdata('mobile_id')))) return ['status' => 'error', 'message' => 'database error'];
                $account_id=$this->users_model->add_account_return_id(['user_mobile_id'=>intval($this->CI->session->userdata('mobile_id'))]);
                if (!(!empty($account_id) && intval($account_id)>0)) return ['status' => 'error', 'message' => 'database error'];
                $this->CI->session->set_userdata('account_id',$account_id);
                $this->check_user_address($account_id);
                $this->check_user_rule($account_id);
                return ['status' => 'success'];
            }else{
                return ['status' => 'error', 'message' =>'user info has error'];
            }
        }else{
            return ['status' => 'error', 'message' => 'نام و نام خانوادگی نامعتبر است'];
        }
    }
    public function verify_sms_code($data){
        if(!empty($data) && !empty($data['phone']) && $this->security->validate_mobile_number($data['phone']) && !empty($data['code']) && intval($data['code']) > 0 && $this->CI->session->has_userdata('login_code') && !empty($this->CI->session->userdata('login_code')) && !empty($this->CI->session->userdata('login_code')['phone']) && !empty($this->CI->session->userdata('login_code')['code']) && $this->CI->session->userdata('login_code')['code'] === intval($data['code']) && $this->CI->session->userdata('login_code')['phone'] === $data['phone'])
            return $this->check_user($data['phone']);
        else
			return ['status' => 'error', 'message' => 'کد نامعتبر است'];
    }
    public function send_phone_login($data){
        if(!empty($data) && $this->security->validate_mobile_number($data) && $this->CI->session->has_userdata('phone_number') && !empty($this->CI->session->userdata('phone_number')) && $data===$this->CI->session->userdata('phone_number')){
            $this->CI->session->set_userdata('login_code',['code'=>rand(100000,1000000),'phone'=>$data]);
            if($this->send->send_sms_action($this->CI->session->userdata('login_code')['code'],$data))
                return ($this->send_sms_code_in_login?['status' => 'success','code'=>$this->CI->session->userdata('login_code')['code']]:['status' => 'success']);
            else
                return ['status' => 'error','message'=>'پیامک ارسال نشد'];
        }else{
            return ['status' => 'error','message'=>'شماره همراه معتبر نیست'];
        }
    }
    public function save_phone($str){
        if(!empty($str) && $this->security->validate_mobile_number($str)){
            $this->CI->session->set_userdata('phone_number',$str);
            return ['status' => 'success'];
        }
        return ['status' => 'error','message'=>'شماره همراه معتبر نیست'];
    }
    public function login_webauthn_request(){
        if($this->CI->session->has_userdata('phone_number') && !empty($this->CI->session->userdata('phone_number'))){
            $a=$this->users_model->select_mobile($this->CI->session->userdata('phone_number'));
            if(!empty($a) && !empty(end($a)) && 
            !empty(end($a)['id']) && 
            intval(end($a)['id']) > 0){
                $b=$this->users_model->credential_where_user_mobile_id(intval(end($a)['id']));
                if(!empty($b) && !empty(end($b)) && !empty(end($b)['credential_id'])) {
                    $webauthn = $this->finger->getInstance();
                    $options = $webauthn->getGetArgs([base64_decode(end($b)['credential_id'],true)],20,true,true,true,true,true);
                    $this->CI->session->set_userdata('finger_login_challenge',$options->publicKey->challenge);
                    return $options;
                } else {
                    return ['status'=>'error','message'=>'اثر انگشت قبلا ثبت نشده است'];
                }
            }else{
                return ['status'=>'error','message'=>'با این شماره ثبت نام انجام نشده است'];
            }
        }else{
            return ['status'=>'error','message'=>'invalid request'];
        }
    }
    public function login_webauthn_response($data) {
        if(!(!empty($data) && !empty($data['id']) && $this->CI->session->has_userdata('phone_number') && !empty($this->CI->session->userdata('phone_number')))) return ['status' => 'error', 'message' => 'Challenge not found'];
        $clientDataJSON = $data['response']['clientDataJSON']??'';
        $authenticatorData = $data['response']['authenticatorData']??'';
        $signature = $data['response']['signature']??'';
        if (!$this->CI->session->has_userdata('finger_login_challenge') || empty($this->CI->session->userdata('finger_login_challenge'))) return ['status' => 'error', 'message' => 'Challenge not found'];
        $credential = $this->users_model->credential_where_credential_id($this->finger->base64url_to_base64($data['id']));
        if (!(!empty($credential) && !empty(end($credential)))) return ['status' => 'error', 'message' => 'Credential not found'];
        try {
            $data = $this->finger->validateLogin($this->finger->decodeBase64Url($clientDataJSON),$this->finger->decodeBase64Url($authenticatorData),$this->finger->decodeBase64Url($signature),base64_decode(end($credential)['public_key'],true),$this->CI->session->userdata('finger_login_challenge'),end($credential)['counter']);
            if($data) return $this->check_user($this->CI->session->userdata('phone_number'));
            return ['status' => 'error','message'=>'webauthen dont be run'];
        } catch (Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }
    public function register_webauthn_response($arr) {
        if (!empty($arr) && !empty($arr['response']) &&
        isset($arr['response']['clientDataJSON']) && is_string($arr['response']['clientDataJSON']) &&
        isset($arr['response']['attestationObject']) && is_string($arr['response']['attestationObject']) &&
        $this->CI->session->has_userdata('finger_register_challenge') &&
        !empty($this->CI->session->userdata('finger_register_challenge'))) {
            $check=$this->security->check_mobile_info();
            if(is_null($check)){
                try {
                    $clientDataJSON = base64_decode($arr['response']['clientDataJSON'], true);
                    if ($clientDataJSON === false || empty($clientDataJSON)) {
                        return ['status'=>'error','message'=>throw new Exception('Invalid base64 clientDataJSON')];
                    }
                    $clientDataArr = json_decode($clientDataJSON, true);
                    if (json_last_error() !== JSON_ERROR_NONE) {
                        return ['status'=>'error','message'=>throw new Exception('clientDataJSON is not valid JSON')];
                    }
                    if (!isset($clientDataArr['type']) || $clientDataArr['type'] !== 'webauthn.create') {
                        return ['status'=>'error','message'=>throw new Exception('Invalid client data type')];
                    }
                    $check=$this->users_model->credential_where_user_mobile_id($this->CI->session->userdata('mobile_id'));
                    if(!empty($check) && !empty(end($check)) && !empty(end($check)['id']) && intval(end($check)['id'])>0)
                        $this->users_model->edit_credential_where_id($this->finger->set_credential($arr['response'],$this->CI->session->userdata('finger_register_challenge'),$this->CI->session->userdata('mobile_id')),intval(end($check)['id']));
                    else
                        $this->users_model->add_credential($this->finger->set_credential($arr['response'],$this->CI->session->userdata('finger_register_challenge'),$this->CI->session->userdata('mobile_id')));
                    return ['status' => 'success'];
                } catch (Exception $e) {
                    return ['status' => 'error', 'message' => $e->getMessage()];
                }
            }else{
                return $check;
            }
        } else {
            return ['status' => 'error', 'message' => 'invalid request lib'];
        }
    }
    public function register_webauthn_request() {
        $check=$this->security->check_mobile_info();
        if(is_null($check)){
            $options = $this->finger->generateRegistrationOptions($this->CI->session->userdata('mobile_id'),'user' . $this->CI->session->userdata('mobile_id'));
            $this->CI->session->set_userdata('finger_register_challenge', $options->publicKey->challenge);
            return $options;
        }else{
            return $check;
        }
    }
    public function check_mobile_has_finger_print(){
        if($this->CI->session->has_userdata('phone_number') && !empty($this->CI->session->userdata('phone_number'))){
            $a=$this->users_model->select_mobile($this->CI->session->userdata('phone_number'));
            if(!empty($a) && !empty(end($a)) && 
            !empty(end($a)['id']) && 
            intval(end($a)['id']) > 0){
                $b=$this->users_model->credential_where_user_mobile_id(intval(end($a)['id']));
                if(!empty($b) && !empty(end($b)))
                    return ['status'=>'success'];
            }
        }
        return ['status'=>'error'];
    }
}