<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Api_handler{
    private $CI;
    public function __construct(){
		$this->CI =& get_instance();
		$this->CI->load->helper('url');
        $this->CI->load->library('session');
        $this->CI->config->item('base_url');
	}
    public function handler($data){
        echo json_encode($data);
    }
}