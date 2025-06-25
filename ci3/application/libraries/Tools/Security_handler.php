<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Security_handler
{
    private $CI;
    private $session_list=[
        'user_info',
        'id',
        'account_id',
        'mobile_id',
        'phone_number',
        'finger_register_challenge',
        'finger_login_challenge',
        'login_code'=>['code','phone'],
        'category_id',
        'user_city',
        'user_cordinates',
        'user_address_id',
        'rule'
    ];
    public function __construct(){
		$this->CI =& get_instance();
	}
    public function delete_phone(){
        $this->CI->session->unset_userdata('phone_number');
        return ['status'=>'success'];
    }
    public function logout(){
        foreach ($this->session_list as $key) {
            $this->CI->session->unset_userdata($key);
        }
        return ['status'=>'success'];
    }
    public function check_has_mobile(){
        $a=$this->check_mobile_info();
        if(is_null($a)) return ['status'=>'success'];
        return $a;
    }
    public function check_mobile_info(){
        if (!$this->CI->session->has_userdata('mobile_id') || empty($this->CI->session->userdata('mobile_id'))){
			return ['status' => 'error', 'message' => 'دسترسی غیر مجاز'];
		}
        return null;
    }
    public function check_auth(){
        if (!$this->CI->session->has_userdata('id') || empty($this->CI->session->userdata('id'))){
			return ['status' => 'error', 'message' => 'دسترسی غیر مجاز'];
		}
        return ['status'=>'success'];
    }
    public function check_user_sing(){
        if (!($this->CI->session->has_userdata('id') && !empty($this->CI->session->userdata('id'))) && 
        !($this->CI->session->has_userdata('mobile_id') && !empty($this->CI->session->userdata('mobile_id'))) &&
        !($this->CI->session->has_userdata('account_id') && !empty($this->CI->session->userdata('account_id')))){
			return ['status' => 'error', 'message' => 'دسترسی غیر مجاز'];
		}
        return null;
    }
    public function string_security_check($str){
        $str = preg_replace('/[^a-zA-Z0-9\/]/', '', $str);
        $str = trim($str);
        return $str;
    }
    public function string_secutory_week_check($str){
        $str = preg_replace('/[^\p{Arabic}a-zA-Z0-9]/u', '', $str);
        $str = trim($str);
        return $str;
    }
    public function validate_mobile_number($mobile) {
		$mobile = trim($mobile);	
		if (preg_match('/^09\d{9}$/', $mobile))
			return true;
		return false;
	}


}