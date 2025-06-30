<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_handler
{
    private $CI;
    private $security;
    public function __construct(){
		$this->CI =& get_instance();
        $this->CI->load->model('Users_model');
        $this->CI->load->library('Tools/Security_handler');
        $this->CI->load->model('Media_model');
        $this->CI->load->model('Notification_model');
        $this->security=new Security_handler();
	}
    public function reset_user_info_session(){
        if(($id=$this->get_user_id())!==false && !empty($id) && intval($id)>0 &&
        ($user_info=$this->CI->Users_model->select_where_id(intval($id)))!==false &&
        !empty($user_info) && !empty(end($user_info))){
            $this->CI->session->set_userdata('user_info',end($user_info));
        }
    }
    public function get_user_cordinates(){
        return ($this->CI->session->has_userdata('user_cordinates') && 
        !empty($this->CI->session->userdata('user_cordinates'))?
            $this->CI->session->userdata('user_cordinates'):
            null);
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
    public function get_user_id(){
        return ($this->CI->session->has_userdata('id') && 
        !empty($this->CI->session->userdata('id')) &&
        intval($this->CI->session->userdata('id'))>0?
            intval($this->CI->session->userdata('id')):
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
        $this->get_user_mobile_id() && 
        !empty($this->get_user_mobile_id()) && 
        intval($this->get_user_mobile_id())>0 &&
        ($a=$this->get_user_account())!==false && !empty($a)){
            $has_finger=$this->CI->Users_model->credential_where_user_mobile_id($this->get_user_mobile_id());
            $name=($this->CI->session->userdata('user_info')['name']?$this->CI->session->userdata('user_info')['name']:'').' '.($this->CI->session->userdata('user_info')['family']?$this->CI->session->userdata('user_info')['family']:'');
            return [
                'status'=>'success',
                'finger'=>(!empty($has_finger) && !empty(end($has_finger))),
                'fullName'=>$name,
                'wallet'=>(!empty($a['balance']) && intval($a['balance'])>0?intval($a['balance']):0),
                'name'=>($this->CI->session->userdata('user_info')['name']?$this->CI->session->userdata('user_info')['name']:''),
                'family'=>($this->CI->session->userdata('user_info')['family']?$this->CI->session->userdata('user_info')['family']:''),
                'mobile'=>$this->get_user_mobile()['phone'],
                'rule'=>(!empty($this->get_user_category_id())),
                'image'=>$this->get_user_image()];
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
    public function get_all_user_address(){
        return ($this->get_user_account_id()?$this->CI->Users_model->select_address_where_user_account_id($this->get_user_account_id()):null);
    }
    public function get_user_info_where_user_account($id){
        if(!empty($id) && intval($id)>0 && 
        ($a=$this->CI->Users_model->select_account_where_id(intval($id)))!==false && 
        !empty($a) && !empty(end($a)) && 
        !empty(end($a)['id']) && intval(end($a)['id'])>0 && 
        !empty(end($a)['user_mobile_id']) && intval(end($a)['user_mobile_id'])>0 &&
        ($b=$this->CI->Users_model->select_mobile_where_id(intval(end($a)['user_mobile_id'])))!==false &&
        !empty($b) && !empty(end($b)) && 
        !empty(end($b)['id']) && intval(end($b)['id'])>0 && 
        !empty(end($b)['user_id']) && intval(end($b)['user_id'])>0 && 
        ($c=$this->CI->Users_model->select_where_id(intval(end($b)['user_id'])))!==false &&
        !empty($c) && !empty(end($c)) && 
        !empty(end($c)['id']) && intval(end($c)['id'])>0){
            $image=$this->CI->Media_model->select_where_id(end($b)['image_id']??'');
            return [
                'image'=>(!empty($image) && !empty(end($image)) && !empty(end($image)['url'])?end($image)['url']:''),
                'name'=>end($c)['name']??'',
                'family'=>end($c)['family']??'',
                'phone'=>end($b)['phone']??'',
            ];
        }
        return [];
    }
    public function edit_user($data){
        if(!empty($data) && !empty($data['name']) && !empty($data['family']) &&
        ($id=$this->get_user_id())!==false && !empty($id) && intval($id)>0 &&
        ($mobile=$this->get_user_mobile())!==false && !empty($mobile) && 
        !empty($mobile['id']) && intval($mobile['id'])>0 &&
        $this->CI->Users_model->edit_weher_id(['name'=>$this->security->string_secutory_week_check($data['name']),'family'=>$this->security->string_secutory_week_check($data['family'])],intval($id))){
            $this->reset_user_info_session();
            if(!empty($data['image_id']) && intval($data['image_id'])>0 &&
            $this->CI->Users_model->edit_mobile_weher_id(['image_id'=>intval($data['image_id'])],intval($mobile['id']))){
                if(!empty($mobile['image_id']) && intval($mobile['image_id'])>0 &&    
                ($image=$this->CI->Media_model->select_where_id(intval($mobile['image_id'])))!==false && 
                !empty($image) && !empty(end($image)) && !empty(end($image)['id']) && intval(end($image)['id'])>0 && !empty(end($image)['url'])){
                    $this->CI->Media_model->remove_where_id(intval(end($image)['id']));
                    $this->CI->Media_model->remove_file(end($image)['url']);
                }
            }
            return ['status'=>'success'];
        }
        return ['status'=>'error'];
    }
}