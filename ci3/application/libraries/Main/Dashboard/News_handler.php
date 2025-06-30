<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class News_handler
{
    private $CI;
    private $user;
    private $security;
    private $category=[];
    private $category_news=[];
    private $media=[];
    private $address=[];
    private $news=[];
    private $report=[];
    private $news_manager=[];
    private $news_seen=[];
    private $result=[];
    private $result_manager=[];
    private $result_report=[];
    public function __construct(){
		$this->CI =& get_instance();
        $this->CI->load->model('News_model');
        $this->CI->load->model('Notification_model');
        $this->CI->load->model('Report_model');
        $this->CI->load->model('Users_model');
        $this->CI->load->model('Media_model');
        $this->CI->load->model('Category_model');
        $this->CI->load->library('Tools/Security_handler');
        $this->CI->load->library('Main/Dashboard/User_handler');
        $this->user=new User_handler();
        $this->security=new Security_handler();
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
    private function get_all_category_news_relation(){
        $this->category_news=$this->CI->Category_model->select_all_relation();
    }
    private function get_all_address_news(){
        $this->address = $this->CI->Users_model->select_address_where_news();
    }
    private function get_all_my_news(){
        $this->news_manager=$this->CI->News_model->select_news_where_user_account_id($this->user->get_user_account_id());
    }
    private function get_all_news_seen(){
        $this->news_seen=$this->CI->News_model->select_news_where_status_seen();
    }
    private function get_all_category_array_where_news_id($id) {
        $id = (int) $id;
        if (empty($this->category_news) || $id <= 0) return [];
        return array_values(array_map(
            fn($a) => (int) $a['category_id'],
            array_filter($this->category_news, function ($a) use ($id) {
                return !empty($a['category_id']) && !empty($a['news_id']) &&
                    (int) $a['news_id'] === $id && (int) $a['category_id'] > 0;
            })
        ));
    }
    private function get_all_report_where_news_id($id){
        return (!empty($id) && intval($id)>0 && ($a=$this->CI->News_model->select_report_where_news_id(intval($id)))!==false && !empty($a)?$a:null);
    }
    private function get_all_my_report(){
        $this->get_all_my_news();
        $my_seenIds = array_column(array_filter($this->news_manager, function($item) {
            return isset($item['status']) && $item['status'] === 'seen';
        }), 'id');
        if(!empty($my_seenIds))
            $this->report=$this->CI->News_model->get_reports_by_account_or_news_ids($this->user->get_user_account_id(),$my_seenIds);
        else
            $this->report=$this->CI->News_model->select_report_where_user_account_id($this->user->get_user_account_id());
    }
    private function get_data(){
        $this->get_all_category_active();
        $this->get_all_category_news_relation();
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
    private function search_id_return_value_in_key($data,$id,$key,$key_array){
        $a = (!empty($data) && !empty($id) && !empty($key)?$this->search_array($data,$key,$id):'');
        if(!empty($key_array) && !empty($a)){
            if(is_string($key_array) && !empty($a[$key_array])) return $a[$key_array];
            $res=[];
            if(is_array($key_array))
                foreach($key_array as $k){
                    if(!empty($k) && !empty($a[$k]))
                        $res[$k]=$a[$k];
                }
            if(!empty($res)) return $res;
        }
        return '';
    }
    private function search_ids_return_value_in_key($data,$ids,$key,$key_wanted){
        $ids=(!empty($ids)?explode(',',$ids):[]);
        return $this->search_ids_array_return_value_in_key($data,$ids,$key,$key_wanted);
    }
    private function search_ids_array_return_value_in_key($data,$ids,$key,$key_wanted){
        $result=[];
        if(!empty($data) && !empty($ids) && !empty($key) && !empty($key_wanted))
            foreach ($ids as $id) {
                if(!empty($id) && intval($id)>0) $result[]=$this->search_id_return_value_in_key($data,intval($id),$key,$key_wanted);
            }
        return (!empty($key_wanted) && is_string($key_wanted)?implode(',',$result):$result);
    }
    private function set_data(){
        if(!empty($this->news))
            foreach ($this->news as $a) {
                if(!empty($a) && !empty($a['id']) && intval($a['id'])>0 && 
                !empty($a['user_account_id']) && intval($a['user_account_id'])>0 && 
                intval($a['user_account_id'])!==intval($this->user->get_user_account_id())){
                    $location=$this->search_id_return_value_in_key($this->address,$a['user_address_id']??0,'id',['city','lat','lon']);
                    $arr=[];
                    $arr['id']=$a['id']??'';
                    $arr['created_at']=$a['created_at']??'';
                    $arr['description']=$a['description']??'';
                    $arr['media']=$this->search_ids_return_value_in_key($this->media,$a['media_id']??'','id',['id','url','type']);
                    $arr['category']=$this->search_ids_array_return_value_in_key($this->category,$this->get_all_category_array_where_news_id(intval($a['id'])),'id','title');
                    $arr['location']=$location['city']??'';
                    $user=$this->user->get_user_info_where_user_account(intval($a['user_account_id']));
                    array_pop($user);
                    $arr['user']=$user;
                    $arr['total_location']=$location??[];
                    $this->result[]=$arr;
                }
            }
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
        if(($userLocation = $this->user->get_user_location()) !== false && $userLocation && 
        ($userCoordinate = $this->user->get_user_cordinates())!==false && $userCoordinate &&
        !empty($this->result)){
            $user_lat = $userCoordinate['lat'];
            $user_lon = $userCoordinate['lon'];
            usort($this->result, function($a, $b) use ($userLocation, $user_lat, $user_lon) {
                $a_city = $a['total_location']['city'] ?? '';
                $b_city = $b['total_location']['city'] ?? '';
                $a_lat = $a['total_location']['lat'] ?? 0;
                $a_lon = $a['total_location']['lon'] ?? 0;
                $b_lat = $b['total_location']['lat'] ?? 0;
                $b_lon = $b['total_location']['lon'] ?? 0;
                $aMatch = ($a_city === $userLocation) ? 0 : 1;
                $bMatch = ($b_city === $userLocation) ? 0 : 1;
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
            $notif=[];
            if(!empty(end($a)['user_account_id']) && intval(end($a)['user_account_id'])>0)
                $notif[]=[
                    'user_account_id'=>intval(end($a)['user_account_id']),
                    'title'=>'بررسی خبر',
                    'body'=>'خبری که شما در سیستم قرار دادید در حال بررسی می باشد',
                    'type'=>'add_news_to_list',
                ];
            $notif[]=[
                'user_account_id'=>intval($this->user->get_user_account_id()),
                'title'=>'بررسی جدید',
                'body'=>'شما یک خبر جدید را به لیست خود اضافه کردید',
                'type'=>'add_news_to_list',
            ];
            $this->CI->Notification_model->insert_batch($notif);
            return ['status'=>'success'];
        }
        return ['status'=>'error' ];    
    }
    public function add_data(){
        $this->get_all_category_active();
        if($this->user->get_user_account_id()){
            return [
                'status'=>'success',
                'rule'=>($this->has_category_id()?true:false),
                'address'=>$this->user->get_user_location(),
                'coordinate'=>$this->user->get_user_cordinates(),
                'category'=>($this->has_category_id()?$this->search_id_return_value_in_key($this->category,intval($this->user->get_user_category_id()),'id',['id','title']):$this->category),
            ];
        }
        return ['status'=>'error'];
    }
    private function send_add_news_notification($category){
        if(!empty($category) && is_array($category)){
            $arr=[];
            $a=$this->CI->Users_model->select_account_where_category_ids_array($category);
            if(!empty($a))
                foreach ($a as $b) {
                    if(!empty($b) && !empty($b['id']) && intval($b['id'])>0)
                        $arr[]=[
                            'user_account_id'=>intval($b['id']),
                            'title'=>'گزارش کاربران',
                            'body'=>'یک خبر جدید برای سازمان شما توسط کاربران ثبت شده است',
                            'type'=>'add_news'
                        ];
                }
            $arr[]=[
                'user_account_id'=>$this->user->get_user_account_id(),
                'title'=>'ثبت گرازش',
                'body'=>'گزارش شما برای سازمان مورد نظر ارسال شد',
                'type'=>'add_news'
            ];
            $this->CI->Notification_model->insert_batch($arr);
        }
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
                $this->send_add_news_notification($category);
                return ['status'=>'success'];
            }
        }
        return ['status'=>'error','msg'=>'3'];
    }
    private function get_manager_data(){
        $this->get_all_category_active();
        $this->get_all_category_news_relation();
        $this->get_all_media_used_news();
        $this->get_all_address_news();
        $this->get_all_my_news();
    }
    private function set_manager_data(){
        if(!empty($this->news_manager))
            foreach ($this->news_manager as $a) {
                if(!empty($a) && !empty($a['id']) && intval($a['id'])>0){
                    $arr=[];
                    $arr['id']=intval($a['id']);
                    $arr['address']=$this->search_id_return_value_in_key($this->address,$a['user_address_id']??0,'id',['id','city','lat','lon','address']);
                    $arr['category']=$this->search_ids_array_return_value_in_key($this->category,$this->get_all_category_array_where_news_id(intval($a['id'])),'id',['id','title']);
                    $arr['media']=$this->search_ids_return_value_in_key($this->media,$a['media_id']??'','id',['id','url','type']);
                    $arr['description']=$a['description']??'';
                    $arr['status']=$a['status']??'';
                    $a=$this->get_all_report_where_news_id(intval($a['id']));
                    $arr['report']=(!empty($a));
                    $this->result_manager[]=$arr;
                }
            }
    }
    public function user_news(){
        if(!empty($this->user->get_user_account_id()) && intval($this->user->get_user_account_id())>0){
            $this->get_manager_data();
            $this->set_manager_data();
            return ['status'=>'success','data'=>array_reverse($this->result_manager)];
        }
        return ['status'=>'error'];
    }
    private function set_all_my_report(){
        if(!empty($this->report))
            foreach ($this->report as $a) {
                if(!empty($a) && !empty($a['id']) && intval($a['id'])>0 && !empty($a['user_account_id']) && intval($a['user_account_id'])>0){
                    $arr=[];
                    $status=$a['status']??'';
                    $start = new DateTime($a['run_time'] ?? date('Y-m-d H:i:s'));
                    $arr['start'] = $start->format(DateTime::ATOM);
                    if ($status === 'done') {
                        $arr['end'] = (new DateTime($a['updated_at'] ?? date('Y-m-d H:i:s')))->format(DateTime::ATOM);
                    } else {
                        $now = new DateTime();
                        $arr['end'] = ($start > $now)
                            ? (clone $start)->modify('+2 hours')->format(DateTime::ATOM)
                            : $now->format(DateTime::ATOM);
                    }
                    $arr['me']=(intval($a['user_account_id'])!==intval($this->user->get_user_account_id()));
                    $news_result=[];
                    $news=$this->search_id_return_value_in_key($this->news_seen,$a['news_id']??'','id',['id','user_account_id','user_address_id','media_id','description']);
                    if(!empty($news) && !empty($news['id']) && intval($news['id'])>0){
                        $news_result['id']=$news['id'];
                        $news_result['description']=$news['description']??'';
                        $news_result['media']=$this->search_ids_return_value_in_key($this->media,$news['media_id']??'','id',['url','type']);
                        $news_result['address']=$this->search_id_return_value_in_key($this->address,$news['user_address_id']??0,'id',['id','city','lat','lon','address']);
                        if(!empty($news['user_account_id']) && intval($news['user_account_id'])>0){
                            $news_result['user']=$this->user->get_user_info_where_user_account(intval($news['user_account_id']));
                        }
                    }
                    $arr['news']=$news_result;
                    $this->result_report[]=$arr;
                }
            }
    }
    public function get_news_for_month(){
        $this->get_all_media_used_news();
        $this->get_all_address_news();
        $this->get_all_news_seen();
        $this->get_all_my_report();
        $this->set_all_my_report();
        return ['status'=>'success','data'=>$this->result_report];
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
        return ['status'=>'success','data'=>[]];
    }
}