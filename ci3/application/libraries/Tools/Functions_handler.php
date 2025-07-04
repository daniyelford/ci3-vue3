<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Functions_handler
{
    private $CI;
    private $user;
    public $category=[];
    public $category_news=[];
    public $media=[];
    public $report_media=[];
    public $product_media=[];
    public $address=[];
    public $news=[];
    public $all_news=[];
    public $report=[];
    public $cartables=[];
    public $news_manager=[];
    public $news_seen=[];
    public $result=[];
    public $result_manager=[];
    public $result_report=[];
    public $result_cartables=[];
    public function __construct(){
		$this->CI =& get_instance();
        $this->CI->load->model('News_model');
        $this->CI->load->model('Notification_model');
        $this->CI->load->model('Users_model');
        $this->CI->load->model('Media_model');
        $this->CI->load->model('Category_model');
        $this->CI->load->model('Wallet_model');
        $this->CI->load->library('Main/Dashboard/User_handler');
        $this->user=new User_handler();
	}
    public function has_category_id(){
        return (!empty($this->user->get_user_category_id()) && intval($this->user->get_user_category_id())>0);
    }
    public function get_all_category_active(){
        $this->category = $this->CI->Category_model->select_category_where_active();
    }
    public function get_all_media_used_news(){
        $this->media = $this->CI->Media_model->select_where_news_used();
    }
    public function get_all_media_used_report(){
        $this->report_media = $this->CI->Media_model->select_where_report_used();
    }
    public function get_all_media_used_product(){
        $this->product_media = $this->CI->Media_model->select_where_product_used();
    }
    public function get_all_category_news_relation(){
        $this->category_news=$this->CI->Category_model->select_all_relation();
    }
    public function get_all_address_news(){
        $this->address = $this->CI->Users_model->select_address_where_news();
    }
    public function get_all_my_news(){
        $this->news_manager=$this->CI->News_model->select_news_where_user_account_id($this->user->get_user_account_id());
    }
    public function get_all_news(){
        $this->all_news=$this->CI->News_model->select_news();
    }
    public function get_all_news_seen(){
        $this->news_seen=$this->CI->News_model->select_news_where_status_seen();
    }
    public function get_all_category_array_where_news_id($id) {
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
    public function get_all_report_where_news_id($id){
        return (!empty($id) && intval($id)>0 && ($a=$this->CI->News_model->select_report_where_news_id(intval($id)))!==false && !empty($a)?$a:null);
    }
    public function get_all_my_report(){
        $this->get_all_my_news();
        $my_seenIds = array_column(array_filter($this->news_manager, function($item) {
            return isset($item['status']) && $item['status'] === 'seen';
        }), 'id');
        if(!empty($my_seenIds))
            $this->report=$this->CI->News_model->get_reports_by_account_or_news_ids($this->user->get_user_account_id(),$my_seenIds);
        else
            $this->report=$this->CI->News_model->select_report_where_user_account_id($this->user->get_user_account_id());
    }
    public function get_data(){
        $this->get_all_category_active();
        $this->get_all_category_news_relation();
        $this->get_all_media_used_news();
        $this->get_all_address_news();
        if($this->has_category_id())
            $this->news = $this->CI->News_model->select_news_where_category_id_status_checking_private(intval($this->user->get_user_category_id()));
        else
            $this->news = $this->CI->News_model->select_news_where_public_status_checking();
    }
    public function search_array($data,$key,$value){
        $result=[];
        if(!empty($data) && !empty($key) && !empty($value)){
            $result=$data[array_search($value, array_column($data, $key))];
        }
        return $result;
    }
    public function search_id_return_value_in_key($data,$id,$key,$key_array){
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
    public function search_ids_return_value_in_key($data,$ids,$key,$key_wanted){
        $ids=(!empty($ids)?explode(',',$ids):[]);
        return $this->search_ids_array_return_value_in_key($data,$ids,$key,$key_wanted);
    }
    public function search_ids_array_return_value_in_key($data,$ids,$key,$key_wanted){
        $result=[];
        if(!empty($data) && !empty($ids) && !empty($key) && !empty($key_wanted))
            foreach ($ids as $id) {
                if(!empty($id) && intval($id)>0) $result[]=$this->search_id_return_value_in_key($data,intval($id),$key,$key_wanted);
            }
        return (!empty($key_wanted) && is_string($key_wanted)?implode(',',$result):$result);
    }
    public function set_data(){
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
    public function haversine_distance($lat1, $lon1, $lat2, $lon2) {
        $earth_radius = 6371;
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
        $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon/2) * sin($dLon/2);
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        return $earth_radius * $c;
    }
    public function set_data_user_location(){
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
    public function get_cartables_data(){
        $this->get_all_category_active();
        $this->get_all_category_news_relation();
        $this->get_all_media_used_news();
        $this->get_all_media_used_report();
        $this->get_all_address_news();
        $this->get_all_news();
        $this->get_all_my_news();
        $my_seenIds = array_column($this->news_manager, 'id');
        if(!empty($my_seenIds))
            $this->cartables=$this->CI->News_model->get_reports_by_account_or_news_ids($this->user->get_user_account_id(),$my_seenIds);
        else
            $this->cartables=$this->CI->News_model->select_report_where_user_account_id($this->user->get_user_account_id());
    }
    public function set_cartables_data(){
        if(!empty($this->cartables))
            foreach($this->cartables as $a){
                if(!empty($a) && !empty($a['id']) && intval($a['id'])>0 && !empty($a['news_id']) && intval($a['news_id'])>0 && !empty($a['user_account_id']) && intval($a['user_account_id'])>0){
                    $news=$this->search_array($this->all_news,'id',intval($a['news_id']));
                    if(!empty($news) && !empty($news['user_account_id']) && intval($news['user_account_id'])>0){
                        $arr=[];
                        $arr['id']=intval($a['id']);
                        if($this->has_category_id() && intval($a['user_account_id'])===intval($this->user->get_user_account_id())){
                            $arr['user']=$this->user->get_user_info_where_user_account(intval($news['user_account_id']));
                            $arr['has_rule']=true;
                        }else{
                            $arr['user']=$this->user->get_user_info_where_user_account(intval($a['user_account_id']));
                            $arr['has_rule']=false;
                        }
                        $report_result=$news_result=[];
                        $news_result['id']=$news['id']??'';
                        $news_result['description']=$news['description']??'';
                        $news_result['media']=$this->search_ids_return_value_in_key($this->media,$news['media_id']??'','id',['url','type']);
                        $news_result['address']=$this->search_id_return_value_in_key($this->address,$news['user_address_id']??0,'id',['id','city','lat','lon','address']);
                        $report_result['description']=$a['description']??'';
                        $report_result['media']=$this->search_ids_return_value_in_key($this->report_media,$a['media_id']??'','id',['url','type']);
                        $report_result['run_time']=$a['run_time']??'';
                        $report_result['created_at']=$a['created_at']??'';
                        $arr['report']=$report_result;
                        $arr['news']=$news_result;
                        $this->result_cartables[]=$arr;
                    }
                }
            }
    }
    public function get_manager_data(){
        $this->get_all_category_active();
        $this->get_all_category_news_relation();
        $this->get_all_media_used_news();
        $this->get_all_address_news();
        $this->get_all_my_news();
    }
    public function set_manager_data(){
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
                    $arr['reportList']=(!empty($a)?$a:[]);
                    $this->result_manager[]=$arr;
                }
            }
    }
    public function set_all_my_report(){
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
                    $news=$this->search_id_return_value_in_key($this->all_news,$a['news_id']??'','id',['id','user_account_id','user_address_id','media_id','description']);
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
    public function send_add_news_notification($category){
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
                            'url'=>base_url()
                        ];
                }
            $arr[]=[
                'user_account_id'=>$this->user->get_user_account_id(),
                'title'=>'ثبت گرازش',
                'body'=>'گزارش شما برای سازمان مورد نظر ارسال شد',
                'url'=>base_url('manage-news')
            ];
            $this->CI->Notification_model->insert_batch($arr);
        }
    }
    public function find_order($ids){
        $result=[];
        if(!empty($ids) && is_string($ids) && ($a=explode(',',$ids))!==false &&
        !empty($a) && ($b=$this->CI->Wallet_model->select_orders_where_in_order_ids($a))!==false && !empty($b))
            foreach ($b as $c) {
                if(!empty($c) && !empty($c['product_id']) && intval($c['product_id'])>0){
                $arr=[];  
                $arr['total_price']=$c['amount']??0;
                $arr['product_count']=$c['product_count']??1;
                $arr['created_at']=$c['created_at']??'';
                $arr['updated_at']=$c['updated_at']??'';
                $arr['report']=$this->find_report_info($c['report_list_id']??0);
                $arr['product_info']=$this->find_product_info(intval($c['product_id']));
                $result[]=$arr;
                }
            }
        return $result;
    }
    public function find_product_info($id){
        $result=[];
        if(!empty($id) && intval($id)>0 && 
        ($a=$this->CI->Wallet_model->select_product_where_id(intval($id)))!==false &&
        !empty($a) && !empty(end($a))){
            $result=end($a);
            $result['media']=$this->search_ids_return_value_in_key($this->product_media,end($a)['media_id']??'','id',['url','type']);
        }
        return $result;
    }
    public function find_report_info($id){
        return (!empty($id) && intval($id)>0?$this->search_array($this->result_cartables,'id',intval($id)):[]);
    }
}