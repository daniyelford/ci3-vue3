<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Api_handler{
    private $CI;

    public function __construct(){
		$this->CI =& get_instance();
        $this->CI->load->library('Tools/Upload_handler');
        $this->CI->load->library('Tools/Security_handler');
        $this->CI->load->library('Tools/Table_data_handler');
        $this->CI->load->library('Main/Login/Login_handler');
	}
    public function handler($data){
        $upload=new Upload_handler();
        $security= new Security_handler();
        $login=new Login_handler();
        $table=new Table_data_handler();
        if(!empty($data))
            if(!empty($data['action']))
                switch ($data['action']) {
                    case 'show_data':
                        if(!empty($data['data']))
                            if($security->check_user_login()){
                                $table->data=[];
                                $table->table='';
                                $table->return_json=true;
                                $table->return_table=false;
                                $table->pagination=false;
                                $table->handler();
                            }
                        else
                            echo json_encode(['status' => 'error', 'message' => 'invalid request']);
                        break;
                    case 'logout':
                        $this->CI->session->sess_destroy();
                        echo json_encode(['status'=>'success']);
                        break;
                    case 'check_mobile_has_finger_print':
                        $login->check_mobile_has_finger_print();
                        break;
                    case 'register_webauthn_request':
                        if($security->check_has_mobile_id())
                            $login->finger_register();
                        break;
                    case 'register_webauthn_response':
                        if(!empty($data['data']))
                            if($security->check_has_mobile_id())
                                $login->finger_register_check($data['data']);
                        else
                            echo json_encode(['status' => 'error', 'message' => 'invalid request']);
                        break;
                    case 'login_webauthn_response':
                        if(!empty($data['data']))
                            $login->finger_login_check($data['data']);
                        else
                            echo json_encode(['status' => 'error', 'message' => 'invalid request']);
                        break;
                    case 'login_webauthn_request':
                        $login->finger_login();
                        break;
                    case 'check_auth':
                        if($security->check_user_login())
                            echo json_encode(['status'=>'success']);
                        break;
                    case 'check_mobile_info':
                        if($security->check_has_mobile_id())
                            echo json_encode(['status'=>'success']);
                        break;
                    case 'save_phone':
                        if(!empty($data['data']))
                            $login->set_mobile_number($data['data']);
                        else
                            echo json_encode(['status'=>'error','message'=>'invalid phone number']);
                        break;
                    case 'delete_phone':
                        $this->CI->session->unset_userdata('phone_number');
                        echo json_encode(['status'=>'success']);
                        break;
                    case 'upload_single_image':
                        if(!empty($data['data']))
                            if($security->check_user_sing()) $upload->upload_single_image($data['data'],(!empty($data['url'])?$security->string_security_check($data['url']):''),(!empty($data['toAction']) ? $security->string_security_check($data['toAction']) : ''));
                        else
                            echo json_encode(['status'=>'error','message'=>'invalid request']);
                        break;
                    case 'upload_many_images':
                        if(!empty($data['data']))
                            if($security->check_user_sing()) $upload->upload_many_images($data['data'],(!empty($data['url'])?$security->string_security_check($data['url']):''),(!empty($data['toAction']) ? $security->string_security_check($data['toAction']) : ''));
                        else
                            echo json_encode(['status'=>'error','message'=>'invalid request']);
                        break;
                    case 'upload_single_video':
                        if(!empty($data['data']))
                            if($security->check_user_sing()) $upload->upload_single_video($data['data'],(!empty($data['url'])?$security->string_security_check($data['url']):''),(!empty($data['toAction']) ? $security->string_security_check($data['toAction']) : ''));
                        else
                            echo json_encode(['status'=>'error','message'=>'invalid request']);
                        break;
                    case 'upload_many_videos':
                        if(!empty($data['data']))
                            if($security->check_user_sing()) $upload->upload_many_videos($data['data'],(!empty($data['url'])?$security->string_security_check($data['url']):''),(!empty($data['toAction']) ? $security->string_security_check($data['toAction']) : ''));
                        else
                            echo json_encode(['status'=>'error','message'=>'invalid request']);
                        break;
                    case 'upload_single_pdf':
                        if(!empty($data['data']))
                            if($security->check_user_sing()) $upload->upload_single_pdf($data['data'],(!empty($data['url'])?$security->string_security_check($data['url']):''),(!empty($data['toAction']) ? $security->string_security_check($data['toAction']) : ''));
                        else
                            echo json_encode(['status'=>'error','message'=>'invalid request']);
                        break;
                    case 'upload_many_pdfs':
                        if(!empty($data['data']))
                            if($security->check_user_sing()) $upload->upload_many_pdfs($data['data'],(!empty($data['url'])?$security->string_security_check($data['url']):''),(!empty($data['toAction']) ? $security->string_security_check($data['toAction']) : ''));
                        else
                            echo json_encode(['status'=>'error','message'=>'invalid request']);
                        break;
                    case 'send_phone_login':
                        if(!empty($data['data']))
                            $login->send_sms_login($data['data']);
                        else
                            echo json_encode(['status' => 'error', 'message' => 'شماره نامعتبر است']);
                        break;
                    case 'verify_sms_code':
                        if(!empty($data['data']))
                            $login->sms_login_code_check($data['data']);
                        else
                            echo json_encode(['status' => 'error', 'message' => 'شماره نامعتبر است']);
                        break;
                    case 'register_user':
                        if(!empty($data['data']))
                            $login->register($data['data']);
                        else
                            echo json_encode(['status' => 'error', 'message' => 'نام و نام خانوادگی نامعتبر است']);
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