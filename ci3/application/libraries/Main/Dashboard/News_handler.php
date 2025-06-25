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
    private function category_finder($data){
        $category=[];
        $category_ids=(!empty($data)?explode(',',$data):[]);
        if(!empty($category_ids))
            foreach ($category_ids as $category_id) {
                if(!empty($category_id) && intval($category_id)>0) $category[]=$this->search_id_return_value_in_key($this->category,intval($category_id),'title');
            }
        return implode(',',$category);
    }
    private function set_data(){
        if(!empty($this->news))
            foreach ($this->news as $a) {
                if(!empty($a) && !empty($a['id']) && 
                !empty($a['user_account_id']) && intval($a['user_account_id'])>0 && 
                intval($a['user_account_id'])!==intval($this->user->get_user_account_id())){
                    $location=$this->search_id_return_value_in_key($this->address,$a['user_address_id']??0,['city','lat','lon']);
                    $arr=[];
                    $arr['id']=$a['id']??'';
                    $arr['created_at']=$a['created_at']??'';
                    $arr['description']=$a['description']??'';
                    $arr['media']=$this->medias_finder($a['media_id']??'');
                    $arr['category']=$this->category_finder($a['category_id']??'');
                    $arr['location']=$location['city']??'';
                    $arr['total_location']=$location??[];
                    $this->result[]=$arr;
                }
            }
        else
            log_message('error', 'No news found for public.');
    }
    private static function haversine_distance($lat1, $lon1, $lat2, $lon2) {
        $earth_radius = 6371;
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
        $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon/2) * sin($dLon/2);
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        return $earth_radius * $c;
    }
    private function set_data_user_location(){
        if(($userLocation = $this->user->get_user_location()) !== false && $userLocation && !empty($this->result)){
            $user_city = $userLocation['city'];
            $user_lat = $userLocation['lat'];
            $user_lon = $userLocation['lon'];
            usort($this->result, function($a, $b) use ($user_city, $user_lat, $user_lon) {
                $a_city = $a['total_location']['city'] ?? '';
                $b_city = $b['total_location']['city'] ?? '';
                $a_lat = $a['total_location']['lat'] ?? 0;
                $a_lon = $a['total_location']['lon'] ?? 0;
                $b_lat = $b['total_location']['lat'] ?? 0;
                $b_lon = $b['total_location']['lon'] ?? 0;
                $aMatch = ($a_city === $user_city) ? 0 : 1;
                $bMatch = ($b_city === $user_city) ? 0 : 1;
                if ($aMatch !== $bMatch) return $aMatch - $bMatch;
                $distanceA = $this->haversine_distance($user_lat, $user_lon, $a_lat, $a_lon);
                $distanceB = $this->haversine_distance($user_lat, $user_lon, $b_lat, $b_lon);
                return $distanceA <=> $distanceB;
            });
        }
    }
    public function get_news(){
        if(!empty($this->user->get_user_account_id()) && intval($this->user->get_user_account_id())>0){
            $this->get_data();
            $this->set_data();
            $this->set_data_user_location();
            return ['status'=>'success','data'=>array_reverse($this->result),'rule'=>$this->has_category_id()];
        }
        return ['status'=>'error'];
    }
    public function add_news_to_list($data){
        if(!empty($data) &&
        !empty($data['news_id']) && intval($data['news_id'])>0 &&
        ($a=$this->CI->News_model->select_news_where_id(intval($data['news_id'])))!==false &&
        !empty($a) && !empty(end($a)) && 
        $this->has_category_id() && 
        intval($this->user->get_user_account_id())>0 &&
        $this->CI->Report_model->add_report([
            'news_id'=>intval($data['news_id']),
            'user_account_id'=>intval($this->user->get_user_account_id()),
            'run_time'=>$data['run_time']??null,
        ]) && $this->CI->News_model->seen_weher_id(intval($data['news_id']))){
            if(!empty(end($a)['user_account_id']) && intval(end($a)['user_account_id'])>0){
                $this->user->add_notification(
                    intval(end($a)['user_account_id']),
                    'بررسی خبر',
                    'خبری که شما در سیستم قرار دادید در حال بررسی می باشد',
                    'news'
                );
            }
            $this->user->add_notification(
                intval($this->user->get_user_account_id()),
                'بررسی جدید',
                'شما یک خبر جدید را به لیست خود اضافه کردید',
                'news'
            );
            return ['status'=>'success'];
        }
        return ['status'=>'error'];    
    }
    public function add_data(){
        $this->get_all_category_active();
        if($this->user->get_user_account_id()){
            return [
                'status'=>'success',
                'rule'=>($this->has_category_id()?true:false),
                'address'=>$this->user->get_user_location(),
                'category'=>($this->has_category_id()?$this->search_id_return_value_in_key($this->category,intval($this->user->get_user_category_id()),['id','title']):$this->category),
            ];
        }
        return ['status'=>'error'];
    }
    public function add_news($data){
        if(!empty($data) && $this->user->get_user_account_id() && !empty($data['category_id']) && 
        !empty($data['description']) && !empty($data['media_id']) && 
        !empty($data['user_address']) && !empty($data['user_address']['type'])){
            if($data['user_address']['type']==='location' && !empty($data['user_address']['value']) && !empty($data['user_address']['value']['total'])){
                if(!(($address_id=$this->CI->Users_model->add_address_return_id([
                    'user_account_id'=>$this->user->get_user_account_id(),
                    'address'=> $data['user_address']['value']['total']['display_name']??'',
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
            $this->CI->News_model->add(
                ['user_account_id'=>$this->user->get_user_account_id(),
                'category_id'=>implode(',',$category),
                'user_address_id'=>intval($address_id),
                'privacy' => ($this->user->get_user_category_id()?'public':'private'),
                'media_id'=>	implode(',',$data['media_id']),
                'description'=>$data['description']
            ]))
                return ['status'=>'success'];
        }
        return ['status'=>'error','msg'=>'3'];
    }
}