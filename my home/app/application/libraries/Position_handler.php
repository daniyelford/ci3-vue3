<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Position_handler{
    private $CI;
    public function __construct(){
		$this->CI =& get_instance();
		$this->CI->load->helper('url');
        $this->CI->load->library('session');
        $this->CI->config->item('base_url');
	}
    public $my_position=[];
    public $calendar=[];
    public function calender_calcolate($time,$timer){
        $b=0;
        if(!empty($time)){
            if(!empty($timer) && $timer!=='00:00:00' && $timer!==0){
                $a=explode(':',$timer);
                if(!empty($a) && is_array($a)){
                    $b=(!empty($a['0']) && intval($a['0'])>0?intval($a['0']*3600):0);
                    $b+=(!empty($a['1']) && intval($a['1'])>0?intval($a['1']*60):0);
                    $b+=(!empty($a['2']) && intval($a['2'])>0?intval($a['2']):0);
                }
            }
        }
        return ($b>0?$time+$b:0);
    }
    public function position_product_list($p_id){
        $arr=[];
        if(!empty($p_id) && intval($p_id)>0 && 
        ($a=$this->CI->Position_model->select_company_where_position_id(intval($p_id)))!==false && !empty($a))
            foreach($a as $b){
                if(!empty($b) && !empty($b['product_id']) && intval($b['product_id'])>0)
                    $arr[]=intval($b['product_id']);
            }
        return $arr;
    }
    private $main;
    public function show_my_position_valex($id){
        $this->main=new Main_exploder();
        $my_calendar=[];
        if(!empty($id) && intval($id)>0 && ($a=$this->CI->Position_model->select_user_where_id($id))!==false){
            if(!empty($a))
                foreach ($a as $b) {
                    $ret=[];
                    if(!empty($b["id"]) && intval($b["id"])>0){
                        if(!empty($b["position_id"]) && intval($b["position_id"])>0){
                            if(($c=$this->CI->Position_model->select_where_id(intval($b["position_id"])))!==false && 
                            !empty($c) && !empty($c['0']) &&
                            ($d=$this->CI->Position_model->select_company_where_position_id(intval($b["position_id"])))!==false &&
                            !empty($d) && !empty(end($d)) && ($e=end($d))!==false && 
                            !empty($e['company_id']) && intval($e['company_id'])>0 &&
                            ($f=$this->CI->Company_model->select_company_where_id(intval($e['company_id'])))!==false &&
                            !empty($f) && !empty($f['0'])){
                                $ret=[
                                    'company_other_product'=>$this->company_other_product_handler(intval($e['company_id']),intval($b["position_id"])),
                                    'company_info'=>$f['0'],
                                    'position_id'=>intval($b["position_id"]),
                                    'info'=> $c['0'],
                                    'position_form'=>$this->CI->Position_model->position_form_info_where_position_id_and_position_user_id(intval($b["position_id"]),intval($b["id"])),
                                    'position_calendar'=>$this->main->valex_position_reserve_time(intval($b["position_id"]))
                                ];
                            }
                        }else{
                            $c=$this->order_product_return_company_id(intval($b["id"]));
                            if(!empty($c) && intval($c)>0 && ($f=$this->CI->Company_model->select_company_where_id(intval($c)))!==false &&
                            !empty($f) && !empty($f['0']))
                                $ret=[
                                    'company_other_product'=>$this->company_other_product_handler($c,0),
                                    'company_info'=>$f['0'],
                                ];
                        }
                        if(!empty($ret)){
                            $hand=$this->calender_calcolate((!empty($b["date_reserve"])?strtotime($b["date_reserve"]):0),(!empty($b["time_reserve"]) && $b["time_reserve"]!=='00:00:00'?$b["time_reserve"]:0));
                            $this->my_position[]=array_merge($ret,[
                                'factor'=>(!empty($b["factor"])?$b["factor"]:''),
                                'wallet'=>(!empty($_SESSION['my_wallet'])?$_SESSION['my_wallet']:[]),
                                'user_position_id'=>intval($b['id']),
                                'company_user_id'=>intval($id),
                                'product_order'=>$this->order_handler(intval($b['id'])),
                                'time_reserve'=>$b["time_reserve"],
                                'status'=>intval($b["status"]),
                                'order_time'=>$this->CI->load->view('includes/timer',[
                                    'next_years'=>'true',
                                    'time'=>(!empty($b["date_reserve"])?strtotime($b["date_reserve"]):time()),
                                    // 'req_time'=>,
                                    'dont_use_id'=>'true',
                                    'want_hour'=>true,
                                ],true),
                                'order_time_end'=>$this->CI->load->view('includes/timer',[
                                    'next_years'=>'true',
                                    'time'=>(!empty($hand) && intval($hand)>0?$hand:time()),
                                    'dont_use_id'=>'true',
                                    'want_hour'=>true,
                                ],true),
                                'time'=>(!empty($b["time"])?strtotime($b["time"]):''),
                                'exiting_time'=>$this->calender_calcolate((!empty($b["date_reserve"])?strtotime($b["date_reserve"]):0),(!empty($b["time_reserve"]) && $b["time_reserve"]!=='00:00:00'?$b["time_reserve"]:0)),
                                'date_reserve'=>(!empty($b["date_reserve"])?strtotime($b["date_reserve"]):0),
                            ]);
                            if(!empty($ret['info']))
                            $my_calendar[]=[
                                'background_color'=>rand(111111,999999),
                                'info'=>[
                                    'status'=>intval($b["status"]),
                                    'company_info'=>$ret['company_info'],
                                    'position_info'=>$ret['info']
                                ],
                                'position_user_id'=>intval($b['id']),
                                'exiting_time'=>$this->calender_calcolate(
                                    (!empty($b["date_reserve"])?strtotime($b["date_reserve"]):0),(!empty($b["time_reserve"]) && $b["time_reserve"]!=='00:00:00'?$b["time_reserve"]:0)),
                                'date_reserve'=>(!empty($b["date_reserve"])?strtotime($b["date_reserve"]):0),
                                'time_reserve'=>(!empty($b["time_reserve"]) && $b["time_reserve"]!=='00:00:00'?$b["time_reserve"]:0),
                            ];
                        } 
                    }
                    
                }
        }
        if(!empty($my_calendar)){ 
            usort($my_calendar, function ($b, $c) {
                return strtotime($b['date_reserve']) - strtotime($c['date_reserve']);
            });
            $this->calendar=$my_calendar;
        }
    }
    private function order_product_return_company_id($id){
        if(!empty($id) && intval($id)>0 && 
        ($a=$this->CI->Position_model->select_order_where_position_user_id(intval($id)))!==false && !empty($a))
            foreach ($a as $b) {
                if(!empty($b["id"]) && intval($b["id"])>0 &&
                !empty($b["product_id"]) && intval($b["product_id"])>0 &&
                ($c=$this->CI->Product_model->select_product_where_id(intval($b['product_id'])))!==false && 
                !empty($c) && !empty($c['0']) &&
                ($d=$this->CI->Product_model->select_category_where_product_id(intval($b['product_id'])))!==false && 
                !empty($d)){
                    foreach($d as $e){
                        if(!empty($e) && !empty($e['company_id']) && intval($e['company_id'])>0)
                            return intval($e['company_id']);
                    }
                }
            }
        return 0;
    }
    private function order_handler($id){
        $arr=[];
        if(!empty($id) && intval($id)>0 && 
        ($a=$this->CI->Position_model->select_order_where_position_user_id(intval($id)))!==false && !empty($a))
            foreach ($a as $b) {
                if(!empty($b["id"]) && intval($b["id"])>0 &&
                !empty($b["product_id"]) && intval($b["product_id"])>0 &&
                ($c=$this->CI->Product_model->select_product_where_id(intval($b['product_id'])))!==false && 
                !empty($c) && !empty($c['0']))
                    $arr[]=[
                        'id'=>intval($b["id"]),
                        'product_info'=>$c['0'],
                        'price'=>$c['0']["price"],
                        'count'=>(!empty($b["count"]) && intval($b["count"])>1?intval($b["count"]):1),
                        'status'=>$b["status"],
                        'time'=>$b['time']
                    ];
            }
        return $arr;
    }
    private function company_other_product_handler($id,$pos_id){
        $ret=$d=[];
        if(!empty($id) && intval($id)>0)$d['company_id']=intval($id);
        if(!empty($pos_id) && intval($pos_id)>0)$d['position_id']=intval($pos_id);
        if(!empty($d) && ($a=$this->CI->Position_model->select_company_where_arr($d))!==false && !empty($a))
            foreach ($a as $b) {
                if(!empty($b['product_id']) && intval($b['product_id'])>0 && 
                ($c=$this->CI->Product_model->select_product_where_id(intval($b['product_id'])))!=false &&
                !empty($c) && !empty($c['0']))
                    $ret[]=$this->main->valex_product_info(intval($b['product_id']));
            }
        return $ret;
    }
    public function show_valex(){
        $ret=$company=[];
        // $a=$this->CI->Position_model->select_all_where_status();
        // if(!empty($a))
        //     foreach($a as $b){
        //         if(!empty($b) && !empty($b['id']) && intval($b['id'])>0 &&
        //         !empty($b['company_id']) && intval($b['company_id'])>0){
        //             if(!array_key_exists(intval($b['company_id']),$company) &&
        //             ($company[intval($b['company_id'])]=$this->CI->Company_model->select_company_where_id(intval($b['company_id'])))!==false &&
        //             !empty($c) && !empty($c['0']))
        //                 $company[intval($b['company_id'])]=$c['0'];
                

        //             $d=$this->CI->Position_model->select_map_where_company_position_id(intval($b['id']));
        //             $e=
        //             $ret[]=['company_info'=>$company[intval($b['company_id'])],'position_info'=>$b,'map'=>(!empty($d)?$d:[]),
        //             'product'=>];

                    
        //         }
                    
        //     }
        
        return $ret;
    }
}