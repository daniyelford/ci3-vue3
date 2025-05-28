<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login_handler
{
    private $CI;
    public function __construct(){
		$this->CI =& get_instance();
        $this->CI->load->model('Users_model');
        $this->CI->load->library('Tools/Security_handler');
	}
    public function register($arr){
        $security= new Security_handler();
        if(!empty($arr) && !empty($arr['mobile_id']) && 
        $security->string_secutory_week_check($arr['family']) &&
        $security->string_secutory_week_check($arr['name']) && 
        intval($arr['mobile_id']) > 0 && !empty($arr['name']) &&
        !empty($arr['family'])
        ){
            $id=$this->CI->Users_model->add_return_id(['name'=>$arr['name'],'family'=>$arr['family']]);
            $this->CI->session->set_userdata('id',$id);
            $account_id=$this->CI->Users_model->add_account_return_id(['user_mobile_id'=>$arr['mobile_id']]);
            $this->CI->session->set_userdata('account_id',$account_id);
            echo json_encode(['status' => 'success','account_id'=>$account_id,'id' => $id]);
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
    			$result=['status' => 'success','mobile_id'=>$mobile_id,'account_id'=>$account_id,'id' => intval(end($a)['user_id'])];
            }else{
    			$result=['status' => 'success','mobile_id'=>$mobile_id,'register'=>true];
            }
        }else{
            $mobile_id=$this->CI->Users_model->add_mobile_return_id(['phone'=>$str]);
    		if(!(!empty($mobile_id) && intval($mobile_id)>0)){
                die(json_encode(['status'=>'error','message'=>'add to db has error mobile']));
            }
            $result=['status' => 'success','mobile_id'=>$mobile_id,'register'=>true];
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
        if(!empty($data) && $security->validate_mobile_number($data)){
            $this->CI->session->set_userdata('login_code',['code'=>rand(100000,1000000),'phone'=>$data]);
            if($this->send_sms_action($this->CI->session->userdata('login_code')['code'],$data))
                echo json_encode([
                    'status' => 'success',
                    'code'=>$this->CI->session->userdata('login_code')['code']
                ]);
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
}