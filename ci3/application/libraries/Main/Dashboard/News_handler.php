<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class News_handler
{
    private $CI;
    private $user;
    private $category=[];
    private $media=[];
    private $address=[];
    private $news=[];
    private $result=[];
    public function __construct(){
		$this->CI =& get_instance();
        $this->CI->load->model('News_model');
        $this->CI->load->model('Report_model');
        $this->CI->load->model('Users_model');
        $this->CI->load->model('Media_model');
        $this->CI->load->model('Category_model');
        $this->CI->load->library('Main/Dashboard/User_handler');
        $this->user=new User_handler();
	}
    private function has_category_id(){
        return (!empty($this->user->get_user_category_id()) && intval($this->user->get_user_category_id())>0);
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
            $this->news = $this->CI->News_model->select_news_where_category_id_status_checking_private(intval($this->user->get_user_category_id()));
        else
            $this->news = $this->CI->News_model->select_news_where_public_status_checking();
    }
    private function search_array($data,$key,$value){
        $result=[];
        if(!empty($data) && !empty($key) && !empty($value)){
            $result=$data[array_search($value, array_column($data, $key))];
        }
        return $result;
    }
    private function search_id_return_value_in_key($data,$id,$key){
        $a = (!empty($data) && !empty($id)?$this->search_array($data,'id',$id):'');
        if(!empty($key) && !empty($a)){
            if(is_string($key) && !empty($a[$key])) return $a[$key];
            $res=[];
            if(is_array($key))
                foreach($key as $k){
                    if(!empty($k) && !empty($a[$k]))
                        $res[$k]=$a[$k];
                }
            if(!empty($res)) return $res;
        }
        return '';
    }
    private function medias_finder($data){
        $media=[];
        $media_ids=(!empty($data)?explode(',',$data):[]);
        if(!empty($media_ids))
            foreach ($media_ids as $media_id) {
                if(!empty($media_id) && intval($media_id)>0) $media[]=$this->search_id_return_value_in_key($this->media,intval($media_id),['id','url','type']);
            }
        return array_reverse($media);
    }
    private function set_data(){
        if(!empty($this->news))
            foreach ($this->news as $a) {
                if(!empty($a) && !empty($a['id'])){
                    $arr=[];
                    $arr['id']=$a['id']??'';
                    $arr['created_at']=$a['created_at']??'';
                    $arr['type']=$a['type']??'';
                    $arr['description']=$a['description']??'';
                    $arr['category']=$this->search_id_return_value_in_key($this->category,$a['category_id']??0,'title');
                    $arr['location']=$this->search_id_return_value_in_key($this->address,$a['user_address_id']??0,'city');
                    $arr['media']=$this->medias_finder($a['media_id']??'');
                    $this->result[]=$arr;
                }
            }
        else
            log_message('error', 'No news found for public.');
    }
    public function get_news(){
        $this->get_data();
        $this->set_data();
        return ['status'=>'success','data'=>array_reverse($this->result),'rule'=>$this->has_category_id()];
    }
    public function add_news_to_list($data){
        if(!empty($data) && !empty($data['type']) &&
        !empty($data['news_id']) && intval($data['news_id'])>0 &&
        $this->has_category_id() && 
        intval($this->user->get_user_account_id())>0 )
        //  &&
        // $this->CI->Report_model->add_report([
        //     'news_id'=>intval($data['news_id']),
        //     'user_account_id'=>intval($this->user->get_user_account_id()),
        //     'type'=>$data['type'],
        //     'run_time'=>$data['run_time']??null,
        // ])
        //  && $this->CI->News_model->seen_weher_id(intval($data['news_id'])))
            return ['status'=>'success','data'=>[
            'news_id'=>intval($data['news_id']),
            'user_account_id'=>intval($this->user->get_user_account_id()),
            'type'=>$data['type'],
            'run_time'=>$data['run_time']??null,
        ]];    
        return ['status'=>'error'];
    }
}