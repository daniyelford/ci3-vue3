<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_handler
{
    private $CI;
    public function __construct(){
		$this->CI =& get_instance();
        $this->CI->load->model('Users_model');
        $this->CI->load->model('Media_model');
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
}