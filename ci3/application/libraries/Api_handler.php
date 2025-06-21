<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Api_handler{
    private $CI;
    private $handler;
    public function __construct(){
		$this->CI =& get_instance();
        $this->CI->load->library('Tools/Upload_handler');
        $this->CI->load->library('Tools/Security_handler');
        $this->CI->load->library('Tools/Table_data_handler');
        $this->CI->load->library('Main/Login/Login_handler');
        $this->CI->load->library('Main/Dashboard/User_handler');
        $this->CI->load->library('Main/Dashboard/News_handler');
	}
    public function handler($data){
        if(!empty($data)){
            if(!empty($data['control']))
                switch ($data['control']) {
                    case 'login':
                        $this->handler=new Login_handler();
                        break;

                    case 'security':
                        $this->handler=new Security_handler();
                        break;

                    case 'upload':
                        $this->handler=new Upload_handler();
                        break;

                    case 'user':
                        $this->handler=new User_handler();
                        break;

                    case 'news':
                        $this->handler=new News_handler();
                        break;

                    case 'table':
                        $this->handler=new Table_data_handler();
                        break;
                    
                    default:
                        die(json_encode($data));
                        break;
                }
                if(!empty($data['action'])){
                    if(!empty($data['data']))
                        $result=$this->handler->{$data['action']}($data['data']);
                    else
                        $result=$this->handler->{$data['action']}();
                die(json_encode($result));
            }
            echo json_encode($data);
        }else{
			echo json_encode(['status' => 'error', 'message' => 'توکن نامعتبر است']);
        }
    }
}