<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_handler
{
    private $CI;
    public function __construct(){
		$this->CI =& get_instance();
        $this->CI->load->model('Users_model');
        $this->CI->load->model('Media_model');
        $this->CI->load->model('Notification_model');
	}
    
    public function get_user_location(){
        return ($this->CI->session->has_userdata('user_city') && 
        !empty($this->CI->session->userdata('user_city'))?
            $this->CI->session->userdata('user_city'):
            null);
    }
    public function get_user_address_id(){
        return ($this->CI->session->has_userdata('user_address_id') && 
        !empty($this->CI->session->userdata('user_address_id')) && 
        intval($this->CI->session->userdata('user_address_id'))>0?
            intval($this->CI->session->userdata('user_address_id')): 
            null);
    }
    public function get_user_category_id(){
        return ($this->CI->session->has_userdata('category_id') && 
        !empty($this->CI->session->userdata('category_id')) && 
        intval($this->CI->session->userdata('category_id'))>0?
            intval($this->CI->session->userdata('category_id')): 
            null);
    }
    public function get_user_account_id(){
        return ($this->CI->session->has_userdata('account_id') && 
        !empty($this->CI->session->userdata('account_id')) &&
        intval($this->CI->session->userdata('account_id'))>0?
            intval($this->CI->session->userdata('account_id')):
            null);
    }
    public function get_user_mobile_id(){
        return ($this->CI->session->has_userdata('mobile_id') && 
        !empty($this->CI->session->userdata('mobile_id')) &&
        intval($this->CI->session->userdata('mobile_id'))>0?
            intval($this->CI->session->userdata('mobile_id')):
            null);
    }
    private function get_user_account(){
        if(($a=$this->get_user_account_id())!==false && !empty($a) && intval($a)>0 &&
        ($b=$this->CI->Users_model->select_account_where_id(intval($this->CI->session->userdata('account_id'))))!==false && 
        !empty($b) && !empty(end($b)))
            return end($b);
        return null;
    }
    private function get_user_mobile(){
        if(($a=$this->get_user_mobile_id())!==false && !empty($a) && intval($a)>0 &&
        ($b=$this->CI->Users_model->select_mobile_where_id(intval($a)))!==false && !empty($b) && !empty(end($b)))
            return end($b);
        return null;
    }
    private function get_user_image(){
        $a=$this->get_user_mobile();
        if(!empty($a['image_id']) && intval($a['image_id'])>0 &&
        ($b=$this->CI->Media_model->select_where_id(intval($a['image_id'])))!==false &&
        !empty($b) && !empty(end($b)) && !empty(end($b)['url']))
            return end($b)['url'];
        return '';
    }
    public function get_user_info(){
        if($this->CI->session->has_userdata('user_info') && 
        !empty($this->CI->session->userdata('user_info')) &&
        ($a=$this->get_user_account())!==false && !empty($a)){
            $name=($this->CI->session->userdata('user_info')['name']?$this->CI->session->userdata('user_info')['name']:'').' '.($this->CI->session->userdata('user_info')['family']?$this->CI->session->userdata('user_info')['family']:'');
            return ['status'=>'success','name'=>$name,'wallet'=>(!empty($a['balance']) && intval($a['balance'])>0?intval($a['balance']):0),'image'=>$this->get_user_image()];
        }
        return ['status'=>'error',];
    }
    public function get_notifications(){
        if($this->get_user_account_id() && ($a=$this->CI->Notification_model->get_unread_by_user_account_id($this->get_user_account_id()))!==false)
            return ['status'=>'success','data'=>(!empty($a)?$a:[]),'counts'=>count($a)];
        return ['status'=>'error'];
    }
    public function read_notifications($id){
        if(!empty($id) && intval($id)>0 && ($a=$this->get_user_account_id())!==false && !empty($a) && intval($a)>0)
            return ['status'=>'success','data'=>$this->CI->Notification_model->mark_as_read(intval($id),intval($a))];
        return ['status'=>'error'];
    }
    public function add_notification($user_account_id,$title,$body,$type){
        return (!empty($user_account_id) && intval($user_account_id)>0 && 
        !empty($title) && !empty($body) && !empty($type) && 
        $this->CI->Notification_model->insert([
            'user_account_id' => $user_account_id,
            'title' => $title,
            'body'  => $body,
            'type'  => $type,
        ]));
    }
    public function get_all_user_address(){
        return ($this->get_user_account_id()?$this->CI->Users_model->select_address_where_user_account_id($this->get_user_account_id()):null);
    }
}