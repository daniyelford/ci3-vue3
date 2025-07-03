<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Wallet_handler
{
    private $CI;
    private $user;
    private $security;
    public function __construct(){
		$this->CI =& get_instance();
        $this->CI->load->model('News_model');
        $this->CI->load->model('Notification_model');
        $this->CI->load->model('Report_model');
        $this->CI->load->model('Users_model');
        $this->CI->load->model('Media_model');
        $this->CI->load->model('Category_model');
        $this->CI->load->library('Tools/Security_handler');
        $this->CI->load->library('Main/Dashboard/User_handler');
        $this->user=new User_handler();
        $this->security=new Security_handler();
	}
}