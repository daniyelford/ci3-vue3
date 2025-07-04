<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class News_handler
{
    private $CI;
    private $user;
    private $security;
    private $function;
    public function __construct(){
		$this->CI =& get_instance();
        $this->CI->load->model('News_model');
        $this->CI->load->model('Notification_model');
        $this->CI->load->model('Users_model');
        $this->CI->load->model('Media_model');
        $this->CI->load->model('Category_model');
        $this->CI->load->library('Tools/Functions_handler');
        $this->CI->load->library('Tools/Security_handler');
        $this->CI->load->library('Main/Dashboard/User_handler');
        $this->user=new User_handler();
        $this->security=new Security_handler();
        $this->function= new Functions_handler();
	}
    public function get_news(){
        if(!empty($this->user->get_user_account_id()) && intval($this->user->get_user_account_id())>0){
            $this->function->get_data();
            $this->function->set_data();
            $this->function->set_data_user_location();
            return ['status'=>'success','data'=>array_reverse($this->function->result),'rule'=>$this->function->has_category_id()];
        }
        return ['status'=>'error'];
    }
    public function add_news_to_list($data){
        if(!empty($data) &&
        !empty($data['news_id']) && intval($data['news_id'])>0 &&
        ($a=$this->CI->News_model->select_news_where_id(intval($data['news_id'])))!==false &&
        !empty($a) && !empty(end($a)) && 
        $this->function->has_category_id() && 
        intval($this->user->get_user_account_id())>0 &&
        ($id=$this->CI->News_model->add_report_return_id([
            'news_id'=>intval($data['news_id']),
            'user_account_id'=>intval($this->user->get_user_account_id()),
            'run_time'=>$data['run_time']??null,
        ]))!==false && !empty($id) && intval($id)>0 && $this->CI->News_model->seen_weher_id(intval($data['news_id']))){
            $notif=[];
            if(!empty(end($a)['user_account_id']) && intval(end($a)['user_account_id'])>0)
                $notif[]=[
                    'user_account_id'=>intval(end($a)['user_account_id']),
                    'title'=>'بررسی خبر',
                    'body'=>'خبری که شما در سیستم قرار دادید در حال بررسی می باشد',
                    'url'=>base_url('show-cartable/'.intval($id)),

                ];
            $notif[]=[
                'user_account_id'=>intval($this->user->get_user_account_id()),
                'title'=>'بررسی جدید',
                'body'=>'شما یک خبر جدید را به لیست خود اضافه کردید',
                'url'=>base_url('show-cartable/'.intval($id)),
            ];
            $this->CI->Notification_model->insert_batch($notif);
            return ['status'=>'success'];
        }
        return ['status'=>'error' ];    
    }
    public function add_data(){
        $this->function->get_all_category_active();
        if($this->user->get_user_account_id()){
            return [
                'status'=>'success',
                'rule'=>($this->function->has_category_id()?true:false),
                'address'=>$this->user->get_user_location(),
                'coordinate'=>$this->user->get_user_cordinates(),
                'category'=>($this->function->has_category_id()?$this->function->search_id_return_value_in_key($this->function->category,intval($this->user->get_user_category_id()),'id',['id','title']):$this->function->category),
            ];
        }
        return ['status'=>'error'];
    }
    public function add_news($data){
        if(!empty($data) && $this->user->get_user_account_id() && 
        !empty($data['category_id']) && 
        !empty($data['description']) && 
        !empty($data['media_id']) && 
        !empty($data['user_address']) && 
        !empty($data['user_address']['type'])){
            if($data['user_address']['type']==='location' && !empty($data['user_address']['value']) && !empty($data['user_address']['value']['total'])){
                if(!(($address_id=$this->CI->Users_model->add_address_return_id([
                    'user_account_id'=>$this->user->get_user_account_id(),
                    'address'=> $this->security->string_secutory_week_check($data['user_address']['value']['total']['display_name']??''),
                    'code_posti'=>$data['user_address']['value']['total']['address']['postcode']??'',
                    'country'=>$data['user_address']['value']['total']['address']['country']??'',
                    'region'=>$data['user_address']['value']['total']['address']['province']??'',
                    'city'=>$data['user_address']['value']['total']['address']['city']??'',
                    'lat'=>$data['user_address']['value']['total']['lat']??'',
                    'lon'=>$data['user_address']['value']['total']['lon']??'',
                    'status'=>'news'
                ]))!==false && 
                !empty($address_id) && intval($address_id)>0)) return ['status'=>'error'];
            }else{
                if(!(
                    ($address_id=$this->user->get_user_address_id())!==false && 
                    !empty($address_id) && intval($address_id)>0 && 
                    $this->CI->Users_model->change_address_to_news_where_id(intval($address_id)))){
                        return ['status'=>'error','msg'=>'2','id'=>$address_id];
                }
            }
            $category = array_map('intval', $data['category_id']);
            if($this->CI->Media_model->change_used_status_where_array_ids($data['media_id']) &&
            ($news_id=$this->CI->News_model->add_return_id([
                'user_account_id'=>$this->user->get_user_account_id(),
                'user_address_id'=>intval($address_id),
                'privacy' => ($this->user->get_user_category_id()?'public':'private'),
                'media_id'=>	implode(',',$data['media_id']),
                'description'=>$this->security->string_secutory_week_check($data['description'])
            ]))!==false && !empty($news_id) && intval($news_id)>0){
                $arr = [];
                foreach ($category as $cat) {
                    if(!empty($cat) && intval($cat)>0)
                        $arr[]=['news_id' => $news_id,'category_id' => intval($cat)];
                }
                $this->CI->Category_model->insert_relation_batch($arr);
                $this->function->send_add_news_notification($category);
                return ['status'=>'success'];
            }
        }
        return ['status'=>'error','msg'=>'3'];
    }
    public function user_news(){
        if(!empty($this->user->get_user_account_id()) && intval($this->user->get_user_account_id())>0){
            $this->function->get_manager_data();
            $this->function->set_manager_data();
            return ['status'=>'success','data'=>array_reverse($this->function->result_manager)];
        }
        return ['status'=>'error'];
    }
    public function get_news_for_month(){
        $this->function->get_all_media_used_news();
        $this->function->get_all_address_news();
        $this->function->get_all_news();
        $this->function->get_all_my_report();
        $this->function->set_all_my_report();
        return ['status'=>'success','data'=>$this->function->result_report];
    }
    public function delete_news($data){
        if(!empty($data) && !empty($data['id']) && intval($data['id'])>0 && ($a=$this->user->get_user_account_id())!==false && !empty($a) && intval($a)>0 && $this->CI->News_model->seen_weher_id_and_user_account_id(intval($data['id']),intval($a)))
            return ['status'=>'success'];
        return ['status'=>'error'];
    }
    public function restore_news($data){
        if(!empty($data) && !empty($data['id']) && intval($data['id'])>0 && ($a=$this->user->get_user_account_id())!==false && !empty($a) && intval($a)>0 && $this->CI->News_model->checking_weher_id_and_user_account_id(intval($data['id']),intval($a)))
            return ['status'=>'success'];
        return ['status'=>'error'];
    }
    public function get_cartables(){
        if(!empty($this->user->get_user_account_id()) && intval($this->user->get_user_account_id())>0){
            $this->function->get_cartables_data();
            $this->function->set_cartables_data();
            return ['status'=>'success','data'=>array_reverse($this->function->result_cartables),'rule'=>(!empty($this->function->has_category_id()))];
        }
        return ['status'=>'error'];
    }
    public function edit_report($data){
        return (!empty($data) && !empty($data['id']) && intval($data['id'])>0 &&$this->CI->News_model->edit_report_weher_id(['media_id'=>$data['media_id']??'','description'=>$data['description']??''],intval($data['id']))?['status'=>'success','data'=>$data]:['status'=>'error']);
    }
}