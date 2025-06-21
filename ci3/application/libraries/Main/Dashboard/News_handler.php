<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class News_handler
{
    // sessions[,'category_id','rule','user_info','id','account_id','mobile_id'
    private $CI;
    private $category=[];
    private $media=[];
    private $address=[];
    private $news=[];
    private $result=[];
    public function __construct(){
		$this->CI =& get_instance();
        $this->CI->load->model('News_model');
        $this->CI->load->model('Users_model');
        $this->CI->load->model('Media_model');
        $this->CI->load->model('Category_model');
	}
    private function has_category_id(){
        return ($this->CI->session->has_userdata('category_id') && !empty($this->CI->session->userdata('category_id')) && intval($this->CI->session->userdata('category_id'))>0);
    }
    private function get_all_category_active(){
        $this->category = $this->CI->Category_model->select_category_where_active();
    }
    private function get_all_media_used_news(){
        $this->media = $this->CI->Media_model->select_where_news_used();
    }
    private function get_all_address_news(){
        $this->address = $this->CI->Users_model->select_address_where_news();
    }
    private function get_data(){
        $this->get_all_category_active();
        $this->get_all_media_used_news();
        $this->get_all_address_news();
        if($this->has_category_id())
            $this->news = $this->CI->News_model->select_news_where_category_id_status_checking_private(intval($this->CI->session->userdata('category_id')));
        $this->news = $this->CI->News_model->select_news_where_public_status_checking();
    }
    private function search_array($data,$key,$value){
        $result=[];
        if(!empty($data) && !empty($key) && !empty($value))
            foreach ($data as $a) {
                if(!empty($a) && !empty($a[$key]) && in_array($a[$key],$value)) $result[]=$a;
            }
        return $result;
    }
    private function search($data,$id){
        return (!empty($data) && !empty($id)?json_encode($this->search_array($data,'id',json_decode($id,true))):'');
    }
    private function set_data(){
        foreach ($this->news as $a) {
            if(!empty($a) && !empty($a['id'])){
                $arr=[];
                $arr['id']=$a['id']??'';
                $arr['created_at']=$a['created_at']??'';
                $arr['type']=$a['type']??'';
                $arr['description']=$a['description']??'';
                $arr['category']=$this->search($this->category,$a['category_id']??'');
                $arr['location']=$this->search($this->address,$a['user_address_id']??'');
                $arr['media']=$this->search($this->media,$a['media_id']??'');
                $this->result[]=$arr;
            }
        }
    }
    public function get_news(){
        $this->get_data();
        $this->set_data();
        return ['status'=>'success','data'=>array_reverse($this->result)];
    }
}