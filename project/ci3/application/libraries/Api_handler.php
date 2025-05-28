<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Api_handler{
    private $CI;

    public function __construct(){
		$this->CI =& get_instance();
        $this->CI->load->library('Tools/Upload_handler');
	}
    private function check_user_login(){
        if (!$this->CI->session->has_userdata('id') || empty($this->CI->session->userdata('id'))){
			http_response_code(403);
			die(json_encode(['status' => 'error', 'message' => 'دسترسی غیر مجاز']));
		}
        return true;
    }
    private function string_security_check($str){
        $str = preg_replace('/[^a-zA-Z0-9\/]/', '', $str);
        $str = trim($str);
        return $str;
    }
    public function handler($data){
        $upload=new Upload_handler();
        if(!empty($data))
            if(!empty($data['action']))
                switch ($data['action']) {
                    case 'upload_single_image':
                        if($this->check_user_login()) $upload->upload_single_image($data['data'],(!empty($data['url'])?$this->string_security_check($data['url']):''),(!empty($data['toAction']) ? $this->string_security_check($data['toAction']) : ''));
                        break;
                    case 'upload_many_images':
                        if($this->check_user_login()) $upload->upload_many_images($data['data'],(!empty($data['url'])?$this->string_security_check($data['url']):''),(!empty($data['toAction']) ? $this->string_security_check($data['toAction']) : ''));
                        break;
                    case 'upload_single_video':
                        if($this->check_user_login()) $upload->upload_single_video($data['data'],(!empty($data['url'])?$this->string_security_check($data['url']):''),(!empty($data['toAction']) ? $this->string_security_check($data['toAction']) : ''));
                        break;
                    case 'upload_many_videos':
                        if($this->check_user_login()) $upload->upload_many_videos($data['data'],(!empty($data['url'])?$this->string_security_check($data['url']):''),(!empty($data['toAction']) ? $this->string_security_check($data['toAction']) : ''));
                        break;
                    case 'upload_single_pdf':
                        if($this->check_user_login()) $upload->upload_single_pdf($data['data'],(!empty($data['url'])?$this->string_security_check($data['url']):''),(!empty($data['toAction']) ? $this->string_security_check($data['toAction']) : ''));
                        break;
                    case 'upload_many_pdfs':
                        if($this->check_user_login()) $upload->upload_many_pdfs($data['data'],(!empty($data['url'])?$this->string_security_check($data['url']):''),(!empty($data['toAction']) ? $this->string_security_check($data['toAction']) : ''));
                        break;
                    default:
                        echo json_encode($data);
                        break;
                }
            else
                echo json_encode($data);
        else
			echo json_encode(['status' => 'error', 'message' => 'توکن نامعتبر است']);
    }
}