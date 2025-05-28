<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Security_handler
{
    private $CI;
    public function __construct(){
		$this->CI =& get_instance();
	}
    public function check_user_login(){
        if (!$this->CI->session->has_userdata('id') || empty($this->CI->session->userdata('id'))){
			http_response_code(403);
			die(json_encode(['status' => 'error', 'message' => 'دسترسی غیر مجاز']));
		}
        return true;
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