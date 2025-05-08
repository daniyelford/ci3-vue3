<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Main_exploder{
    private $CI;
    public function __construct(){
		$this->CI =& get_instance();
		$this->CI->load->helper('url');
        $this->CI->load->library('session');
        $this->CI->config->item('base_url');
	}
	public $date;
    public $valex_user_id=0;
    public $valex_lt=0;
    public $valex_ln=0;
    public $valex_type='user';
    public $valex_add_map=false;
    private $valex_category_id=0;
    public $company_id_map=0;
    public $position_id_map=0;
    private $valex_category_child_list=[];
    private $valex_company_map_icon='';
    private $valex_company_map_url='';
    private $valex_product_map_icon='';
    private $valex_position_map_icon='';
    // products
    // seen fixer controll to error duplicate with $valex_show_product_without_company_position_in_category
    public $valex_show_product_without_company_in_category_without_position=[];
    // seen fixer controll to error duplicate with $valex_show_product_without_company_position_in_category
    // seen fixer controll to (decide) discouse about useful for us or delete
    public $valex_show_product_with_position_without_company_in_category=[];
    // seen fixer controll to (decide) discouse about useful for us or delete
    // persenal brand that have a online shop for self and we cannot working together
    public $valex_show_product_company_without_position_in_category=[];
    // persenal brand that have a online shop for self and we cannot working together
    // seen fixer controll to error duplicate with $valex_show_product_without_company_position_in_category
    public $valex_show_product_without_position_in_category_without_company=[];
    // seen fixer controll to error duplicate with $valex_show_product_without_company_position_in_category
    // seen fixer controll to error duplicate with $valex_show_product_with_position_without_company_in_category
    public $valex_show_product_in_category_without_company=[];
    // seen fixer controll to error duplicate with $valex_show_product_with_position_without_company_in_category
    // seen fixer controll to error duplicate with $valex_show_product_company_without_position_in_category
    public $valex_show_product_in_category_without_position =[];
    // seen fixer controll to error duplicate with $valex_show_product_company_without_position_in_category
    // seen fixer controll to error duplicate with $valex_show_product_without_company_position_in_category
    public $valex_show_product_in_category_without_company_position =[];
    // seen fixer controll to error duplicate with $valex_show_product_without_company_position_in_category
    // only product
    public $valex_show_product_without_company_position_in_category=[];
    // only product
    // has positions and company
    public $valex_show_product_in_category=[]; 
    // has positions and company
    // product
    // position
    // has company and product
    public $valex_show_position_in_category=[];
    // has company and product
    // seen fixer controll to delete{this var must be empty and if !empty sistem has bug}
    public $valex_show_only_position=[];
    // seen fixer controll to delete{this var must be empty and if !empty sistem has bug}
    // seen fixer controll to error duplicate with $valex_show_position_without_product_in_category
    public $valex_show_position_in_category_without_product_with_company=[];
    // seen fixer controll to error duplicate with $valex_show_position_without_product_in_category
    // seen fixer controll to (decide) discouse about useful for us or delete
    public $valex_show_position_in_category_without_comapny_with_product=[];
    // seen fixer controll to (decide) discouse about useful for us or delete
    // seen fixer controll to delete{this var must be empty and if !empty sistem has bug}
    public $valex_show_position_in_category_without_comapny_product=[];
    // seen fixer controll to delete{this var must be empty and if !empty sistem has bug}
    // has company without product
    public $valex_show_position_with_company_without_product_in_category=[];
    // has company without product
    // seen fixer controll to error duplicate with $valex_show_only_position
    public $valex_show_position_without_product_in_category_without_company=[];
    // seen fixer controll to error duplicate with $valex_show_only_position
    // seen fixer controll to (decide) discouse about useful for us or delete
    public $valex_show_position_without_company_in_category_with_product=[];
    // seen fixer controll to (decide) discouse about useful for us or delete
    // seen fixer controll to error duplicate with $valex_show_only_position
    public $valex_show_position_without_company_in_category_without_product=[];
    // seen fixer controll to error duplicate with $valex_show_only_position
    // position
    // company
    public $valex_show_all_company_in_category=[];
    public $valex_show_company_in_category=[];
    public $valex_show_company_in_category_without_product_with_position=[];
    public $valex_show_company_in_category_without_position_with_product=[];
    public $valex_show_company_in_category_without_position_product=[];
    public $valex_show_company_without_product_in_category_with_position=[];
    public $valex_show_company_without_product_in_category_without_position=[];
    public $valex_show_company_without_position_in_category_with_product=[];
    public $valex_show_company_without_position_in_category_without_product=[];
    public $valex_show_comapny_in_category_without_position_product=[];
    // company
    
    // tools
    // info where id
    public function valex_company_info($id){
        $arr=[];
        if(!empty($id) && intval($id)>0 && ($a=$this->CI->Company_model->select_company_where_id_and_status(intval($id)))!==false &&
        !empty($a) && !empty($a['0'])){
            $this->valex_company_map_icon_finder($a['0']);
            $arr=[
                'id'=>intval($id),
                'info'=>$a['0'],
                'map'=>$this->valex_company_map(intval($id),$a['0'])
                
            ];
        }
        return $arr;
    }
    public function valex_product_info_manager($id){
        $arr=[];
        $this->date=new JDF();
        if(!empty($id) && intval($id)>0){
            $a=($this->valex_type=='user'?$this->CI->Product_model->select_product_where_id_and_status(intval($id)):$this->CI->Product_model->select_product_where_id(intval($id)));
            if(!empty($a) && !empty($a['0']) && $this->valex_product_map_icon_finder($a['0']))
                $arr=[
                    'id'=>intval($id),
                    'info'=>$a['0'],
                    'map'=>$this->valex_product_map(intval($id),$a['0']),
                    'tel'=>$this->valex_product_tel(intval($id),$a['0']),
                    'chart'=>$this->valex_product_chart(intval($id),(!empty($a['0']['title'])?$a['0']['title']:(!empty($a['0']['key'])?$a['0']['key']:''))),
                    'key_value'=>$this->valex_product_key_value(intval($id)),
                    'chat'=>$this->valex_product_chat(intval($id),$a['0']),
                    'image'=>$this->valex_product_image(intval($id)),
                    'video'=>$this->valex_product_video(intval($id)),
                    'reserve'=>$this->valex_product_reserve(intval($id)),
                ];
        }
        return $arr;
    }
    public function valex_product_info($id){
        $arr=[];
        $this->date=new JDF();
        if(!empty($id) && intval($id)>0){
            $a=($this->valex_type=='user'?$this->CI->Product_model->select_product_where_id_and_status(intval($id)):$this->CI->Product_model->select_product_where_id(intval($id)));
            if(!empty($a) && !empty($a['0']) && empty($a['0']['deleted_at']) && $this->valex_product_map_icon_finder($a['0']))
                $arr=[
                    'id'=>intval($id),
                    'info'=>$a['0'],
                    'map'=>$this->valex_product_map(intval($id),$a['0']),
                    'tel'=>$this->valex_product_tel(intval($id),$a['0']),
                    'chart'=>$this->valex_product_chart(intval($id),(!empty($a['0']['title'])?$a['0']['title']:(!empty($a['0']['key'])?$a['0']['key']:''))),
                    'key_value'=>$this->valex_product_key_value(intval($id)),
                    'chat'=>$this->valex_product_chat(intval($id),$a['0']),
                    'image'=>$this->valex_product_image(intval($id)),
                    'video'=>$this->valex_product_video(intval($id)),
                    'reserve'=>$this->valex_product_reserve(intval($id)),
                ];
        }
        return $arr;
    }
    public function valex_position_info_manager($id){
        $arr=[];
        $this->date=new JDF();
        if(!empty($id) && intval($id)>0 && ($a=$this->CI->Position_model->select_where_id(intval($id)))!==false && 
        !empty($a) && !empty($a['0']) && $this->valex_position_map_icon_finder($a['0']))
            $arr=[
                'id'=>intval($id),
                'info'=>$a['0'],
                'map'=>$this->valex_position_map(intval($id),$a['0']),
                'tel'=>$this->valex_position_tel(intval($id),$a['0']),
                'chat'=>$this->valex_position_chat(intval($id),$a['0']),
                'image'=>$this->valex_position_image(intval($id)),
                'video'=>$this->valex_position_video(intval($id)),
                'reserve'=>$this->valex_position_reserve(intval($id)),
                'reserve_time'=>$this->valex_position_reserve_time(intval($id)),
            ];
        return $arr;
    }
    public function valex_position_info($id){
        $arr=[];
        $this->date=new JDF();
        if(!empty($id) && intval($id)>0 && ($a=$this->CI->Position_model->select_where_id(intval($id)))!==false && 
        !empty($a) && !empty($a['0']) && empty($a['0']['deleted_at']) && $this->valex_position_map_icon_finder($a['0']))
            $arr=[
                'id'=>intval($id),
                'info'=>$a['0'],
                'map'=>$this->valex_position_map(intval($id),$a['0']),
                'tel'=>$this->valex_position_tel(intval($id),$a['0']),
                'chat'=>$this->valex_position_chat(intval($id),$a['0']),
                'image'=>$this->valex_position_image(intval($id)),
                'video'=>$this->valex_position_video(intval($id)),
                'reserve'=>$this->valex_position_reserve(intval($id)),
                'reserve_time'=>$this->valex_position_reserve_time(intval($id)),
            ];
        return $arr;
    }
    // info where id
    //
    // reserve
    private function valex_position_reserve($id){
        $arr=[];
        $where=(intval($this->valex_user_id)>0?[
            'user_id'=>intval($this->valex_user_id),
            'position_id'=>intval($id)
        ]:($this->valex_type=='manager'?[
            'position_id'=>intval($id)
        ]:[]));
        if(!empty($id) && intval($id)>0 && !empty($where) &&
        ($a=$this->CI->Position_model->select_user_where_arr($where)) !== false && !empty($a))
            foreach($a as $b) {
                if(!empty($b) && !empty($b['id']) && !empty($b['user_id']) && 
                intval($b['id'])>0 && intval($b['user_id'])>0 &&
                ($c=$this->CI->Position_model->select_order_where_position_user_id(intval($b['id'])))!==false) 
                    $arr[]=[
                        'position_user_status'=>(!empty($b['status']) && intval($b['status'])>0?intval($b['status']):0),
                        'position_user_info'=>$b,
                        'user_reserve_info'=>$this->CI->Users_model->select_info_where_user_id(intval($b['user_id'])),
                        'position_product_order_info'=>(!empty($c)?$c:[])
                    ];
            }
        return $arr;
    }
    public function valex_position_reserve_time($id){
        $pos=new Position_handler();
        $arr=[];
        if(!empty($id) && intval($id)>0 &&
        ($a=$this->CI->Position_model->select_user_where_arr(['position_id'=>intval($id)])) !== false && !empty($a))
            foreach($a as $b) {
                if(!empty($b) && !empty($b['id']) && !empty($b['user_id']) && intval($b['id'])>0 && intval($b['user_id'])>0){
                    $user_reserve_info=[];
                    if($this->valex_type=='manager') {$user_reserve_info=$this->CI->Users_model->select_info_where_user_id(intval($b['user_id']));}
                    $arr[]=[
                        'user_reserve_info'=>$user_reserve_info,
                        'position_user_id'=>intval($b['id']),
                        'position_user_status'=>(!empty($b['status']) && intval($b['status'])>0?intval($b['status']):0),
                        'exiting_time'=>$pos->calender_calcolate((!empty($b["date_reserve"])?strtotime($b["date_reserve"]):0),(!empty($b["time_reserve"]) && $b["time_reserve"]!=='00:00:00'?$b["time_reserve"]:0)),
                        'date_reserve'=>(!empty($b["date_reserve"])?strtotime($b["date_reserve"]):0),
                        'time_reserve'=>(!empty($b["time_reserve"])?$b["time_reserve"]:0),
                    ];
                }
            }
        return $arr;
    }
    private function valex_product_reserve($id){
        $arr=[];
        if(!empty($id) && intval($id)>0 && 
        ($a=$this->CI->Position_model->select_order_where_product_id(intval($id)))!==false && !empty($a))
            foreach($a as $b){
                if(!empty($b) && !empty($b['position_user_id']) && intval($b['position_user_id'])>0 &&
                ($c=$this->CI->Position_model->select_user_where_arr(['id'=>intval($b['position_user_id'])]))!==false && 
                !empty($c) && !empty($c['0']) && !empty($c['0']['user_id']) && intval($c['0']['user_id'])>0)
                    if($this->valex_type=='manager' || intval($c['0']['user_id'])===intval($this->valex_user_id))
                        $arr[]=[
                            'position_user_status'=>(!empty($c['0']['status']) && intval($c['0']['status'])>0?intval($c['0']['status']):0),
                            'position_user_info'=>$c['0'],
                            'user_reserve_info'=>$this->CI->Users_model->select_info_where_user_id(intval($c['0']['user_id'])),
                            'position_product_order_info'=>$b,
                            'position_info'=>(!empty($c['0']['position_id']) && intval($c['0']['position_id'])>0?$this->valex_position_info(intval($c['0']['position_id'])):[])
                        ];
            }
        
        return $arr;
    }
    // map
    private function valex_company_map_icon_finder($arr){
        if(!empty($arr) && is_array($arr) && !empty($arr['icon']) && is_string($arr['icon']))
            $this->valex_company_map_icon=base_url('assets/svg/company/'.$arr['icon']);
        else
            $this->valex_company_map_icon=base_url('assets/svg/icon/location.svg');
        if(!empty($arr) && is_array($arr) && !empty($arr['title']) && is_string($arr['title']))
            $this->valex_company_map_url=base_url('show_company/'.str_replace(' ','--',$arr['title']));
        else
            $this->valex_company_map_url=base_url('show_company/my--home');
        return true;
    }
    private function valex_company_map($id,$info){
        $arr=[];
        if(!empty($id)&&intval($id)>0&&
        ($a=$this->CI->Company_model->select_map_where_company_id(intval($id)))!==false && !empty($a)){
            foreach($a as $b){
                if(!empty($b) && !empty($b['lat']) && !empty($b['lon'])) 
                    $arr[]=[
                    'category_id'=>$this->valex_category_id,
                    'company_id'=>intval($id),
                    'product_id'=>0,
                    'lat'=>$b['lat'],
                    'lon'=>$b['lon'],
                    'id'=>intval($b['id']),
                    'type'=>'company',
                    'name'=>(!empty($info['title'])?$info['title']:''),
                    'd'=>(!empty($b['title'])?$b['title']:''),
                ];
                    // .'<br><a href="'.$this->valex_company_map_url.'" class="btn btn-success btn-block rounded-10 text-center">نمایش کسب و کار</a>'
                    // .' در ':'').
                    // $this->CI->Include_model->map_distance_four_param($b['lat'],$this->valex_lt,$b['lon'],$this->valex_ln)
            }
            return (!empty($arr)||$this->valex_type=='manager'?
                $this->CI->load->view('includes/map',[
                    'p_id'=>intval($id),
                    'position'=>false,
                    'company'=>true,
                    'icon'=>(!empty($this->valex_company_map_icon)?$this->valex_company_map_icon:''),
                    'role'=>$this->valex_type,
                    'lat'=>$this->valex_lt,
                    'lon'=>$this->valex_ln,
                    'lat_lon'=>$arr,
                    'add'=>$this->valex_add_map],true):'');
        }
        return '';
    }
    private function valex_position_map_icon_finder($arr){
        if(!empty($arr) && !empty($arr['id']) && intval($arr['id'])>0){
            $c=0;
            $a=$this->CI->Position_model->select_company_where_position_id(intval($arr['id']));
            if(!empty($a))
            foreach($a as $b){
                if(!empty($b) && !empty($b['company_id']) && intval($b['company_id'])>0) $c=$this->company_id_map=intval($b['company_id']);
            }
            $d=(intval($c)>0?$this->CI->Company_model->select_company_where_id(intval($c)):[]);
            $this->valex_company_map_url=base_url('show_company/'.(!empty($d) && !empty($d['0']) && !empty($d['0']['title'])?str_replace(' ','--',$d['0']['title']):'my--home'));
            $this->valex_company_map_icon=(!empty($d) && !empty($d['0']) && !empty($d['0']['icon'])?base_url('assets/svg/company/'.$d['0']['icon']):'');
        }
        if((!empty($arr) && is_array($arr) && !empty($arr['icon']) && is_string($arr['icon'])))
            $this->valex_position_map_icon=base_url('assets/svg/position/'.$arr['icon']);
        else
            if(!empty($this->valex_company_map_icon))
                $this->valex_position_map_icon=$this->valex_company_map_icon;
            else
                $this->valex_position_map_icon='';
        return true;
    }
    private function valex_position_map($id,$info){
        $arr=[];
        if(!empty($id)&&intval($id)>0&&
        ($a=$this->CI->Position_model->select_map_where_position_id(intval($id)))!==false && !empty($a)){
            foreach($a as $b){
                if(!empty($b) && !empty($b['lat']) && !empty($b['lng'])) 
                    $arr[]=[
                    'category_id'=>$this->valex_category_id,
                    'company_id'=>$this->company_id_map,
                    'product_id'=>0,
                    'position_id'=>intval($id),
                    'lat'=>$b['lat'],
                    'lon'=>$b['lng'],
                    'id'=>intval($b['id']),
                    'type'=>'position',
                    'name'=>(!empty($info['title'])?$info['title']:''),
                    'd'=>(!empty($b['title'])?$b['title']:''),
                ];
                    // .'<br><a href="'.$this->valex_company_map_url.'" class="btn btn-success btn-block rounded-10 text-center">نمایش کسب و کار</a>'
                    // .' در ':'').
                    // $this->CI->Include_model->map_distance_four_param($b['lat'],$this->valex_lt,$b['lng'],$this->valex_ln)
            }
            return (!empty($arr)||$this->valex_type=='manager'?
                $this->CI->load->view('includes/map',[
                    'p_id'=>intval($id),
                    'position'=>true,
                    'company'=>false,
                    'icon'=>(!empty($this->valex_position_map_icon)?$this->valex_position_map_icon:''),
                    'role'=>$this->valex_type,
                    'lat'=>$this->valex_lt,
                    'lon'=>$this->valex_ln,
                    'lat_lon'=>$arr,
                    'add'=>$this->valex_add_map],true):'');
        }
        return '';
    }
    private function valex_product_map_icon_finder($arr){
        if(!empty($arr) && !empty($arr['id']) && intval($arr['id'])>0){
            $c=0;
            $a=$this->CI->Product_model->select_category_where_product_id(intval($arr['id']));
            if(!empty($a))
            foreach($a as $b){
                if(!empty($b) && !empty($b['company_id']) && intval($b['company_id'])>0) $c=$this->company_id_map=intval($b['company_id']);
            }
            $d=(intval($c)>0?$this->CI->Company_model->select_company_where_id(intval($c)):[]);
            $this->valex_company_map_url=base_url('show_company/'.(!empty($d) && !empty($d['0']) && !empty($d['0']['title'])?str_replace(' ','--',$d['0']['title']):'my--home'));
            $this->valex_company_map_icon=(!empty($d) && !empty($d['0']) && !empty($d['0']['icon'])?base_url('assets/svg/company/'.$d['0']['icon']):'');
        }
        if((!empty($arr) && is_array($arr) && !empty($arr['icon']) && is_string($arr['icon'])))
            $this->valex_product_map_icon=base_url('assets/svg/product/'.$arr['icon']);
        else
            if(!empty($this->valex_position_map_icon))
                $this->valex_product_map_icon=$this->valex_position_map_icon;
            else
                if(!empty($this->valex_company_map_icon))
                    $this->valex_product_map_icon=$this->valex_company_map_icon;
                else
                    $this->valex_product_map_icon='';
        return true;
    }
    private function valex_product_map($id,$info){
        $arr=[];
        if(!empty($id)&&intval($id)>0&&
        ($a=$this->CI->Product_model->select_map_where_product_id_and_status(intval($id)))!==false && !empty($a)){
            foreach($a as $b){
                if(!empty($b) && !empty($b['lat']) && !empty($b['lon'])) 
                    $arr[]=[
                    'category_id'=>$this->valex_category_id,
                    'company_id'=>$this->company_id_map,
                    'position_id'=>$this->position_id_map,
                    'product_id'=>intval($id),
                    'lat'=>$b['lat'],
                    'lon'=>$b['lon'],
                    'id'=>intval($b['id']),
                    'type'=>'product',
                    'name'=>(!empty($info['title'])?$info['title']:(!empty($info['key'])?$info['key']:'')),
                    'd'=>(!empty($b['title'])?$b['title']:''),
                ];
                    // .'<br><a href="'.$this->valex_company_map_url.'" class="btn btn-success btn-block rounded-10 text-center">نمایش کسب و کار</a>'
                    // .' در ':'').
                    // $this->CI->Include_model->map_distance_four_param($b['lat'],$this->valex_lt,$b['lon'],$this->valex_ln)
            }
            return (!empty($arr)||$this->valex_type=='manager'?
                $this->CI->load->view('includes/map',[
                    'p_id'=>intval($id),
                    'position'=>false,
                    'company'=>false,
                    'icon'=>(!empty($this->valex_product_map_icon)?$this->valex_product_map_icon:''),
                    'role'=>$this->valex_type,
                    'lat'=>$this->valex_lt,
                    'lon'=>$this->valex_ln,
                    'lat_lon'=>$arr,
                    'add'=>$this->valex_add_map],true):'');
        }
        return '';
    }
    //map
    // tel
    private function valex_position_tel($id,$arr){
        if(!empty($id) && intval($id)>0 && !empty($arr) && is_array($arr)){
            $tel=($this->valex_type=='manager'?
                $this->CI->Position_model->select_tel_where_position_id(intval($id)):
                $this->CI->Position_model->select_tel_where_position_id_and_status(intval($id)));
            return $this->CI->load->view('includes/tel',['role'=>$this->valex_type,'type'=>'position','p_id'=>intval($id),'info'=>$arr,'tel'=>(!empty($tel)?$tel:[])],true);
        }
        return '';
    }
    private function valex_product_tel($id,$arr){
        if(!empty($id) && intval($id)>0){
            $tel=($this->valex_type=='manager'?
                $this->CI->Product_model->select_tel_where_product_id(intval($id)):
                $this->CI->Product_model->select_tel_where_product_id_and_status(intval($id)));
            return $this->CI->load->view('includes/tel',['type'=>'','role'=>$this->valex_type,'p_id'=>intval($id),'info'=>$arr,'tel'=>(!empty($tel)?$tel:[])],true);
        }
        return '';
    }
    // tel
    //chart
    private function valex_product_chart($id,$str){
        $arr=[];
        if(!empty($id) && intval($id)>0 && ($a=$this->CI->Product_model->select_change_where_product_id(intval($id)))!==false && 
        !empty($a))
            foreach($a as $b){
                if((stripos($b['new_value'],':')===false)&&(stripos($b['new_value'],'/')===false)&&(is_int($b['new_value']) || is_float($b['new_value']) || intval($b['new_value'])>0)){
                    if((stripos($b['new_value'],':')===false)&&(stripos($b['new_value'],'/')===false)&&(is_int($b['old_value']) || is_float($b['old_value']) || intval($b['old_value'])>0)){
                        $arr[]=[
                            'id'=>$id,
                            't'=>(!empty($str) && is_string($str)?$str:''),
                            'v_id'=>$b['product_value_id'],
                            'time'=>$b['time'] ,
                            'v'=>$b['new_value']
                        ];
                    }
                }
            }
        return $this->CI->load->view('includes/chart',['data'=>$arr],true);
    }
    //chart
    // key_value
    private function valex_product_key_value($id){
        if(!empty($id) && intval($id)>0){
            $z=($this->valex_type=='manager'?
                $this->CI->Product_model->select_product_key_where_product_id(intval($id)):
                $this->CI->Product_model->select_product_key_where_product_id_and_status(intval($id)));
            $x=$this->CI->Product_model->select_product_value_where_product_id(intval($id));                
            return $this->CI->load->view('includes/key_value',['p_id'=>intval($id),'role'=>$this->valex_type,'key'=>(!empty($z)?$z:[]),'value'=>(!empty($x)?$x:[])],true);
        }
        return '';
    }
    // key_value
    //chat
    private function valex_chat($arr){
        if(!empty($arr) && is_array($arr) && !empty($arr['p_id'])&&intval($arr['p_id'])>0 && !empty($arr['user']) && !empty($arr['chat_id']) && intval($arr['chat_id'])>0){
            $name='';
            if(!empty($arr['user']['name'])){  
                $name.=$arr['user']['name'];
            }
            if(!empty($arr['user']['family'])){ 
                $name.=' '.$arr['user']['family'];
            } 
            if(empty($name)){
                $name = $arr['user']['gmail'];
            }
            $name=trim(str_replace(['"',"'",',','.'],'',$name));
            // onclick="btnTypeAction('."'".'delete'."'".",'product_chat',this,event,".(!empty($arr['id']) && intval($arr['id'])>0?intval($arr['id']):0).');"
            return '<span>
                <div class="d-flex '.(!empty($arr['user_sender']) && $arr['user_sender']?'justify-content-start':'justify-content-end').'">
            	    <div class="msg_cotainer_send rounded-10 chat-item-div chat-item-id-'.intval($arr['chat_id']).'" style="min-width: 50%;">
            		    '.$name.'<br>
            			'.(!empty($arr['text'])?$arr['text']:'').'<br><br>
            			<span class="msg_time_send mt-2">'.
            			((!empty($arr['user_id'])&&intval($arr['user_id'])>0) ||
            			(!empty($arr['chat_box']) && $arr['chat_box'])?
            			    '<a onclick="showChatBox(this,'.intval($arr['chat_id']).','."'".$name."'".');">
            			        <img src="'.base_url('assets/svg/icon/send.svg').'" class="wd-20">
            			    </a>':'').
                            (!empty($arr['d'])?
                                '<a class="d-none hide-chat-childrens" onclick="hideChatChildrens(this,'."'".
                                (!empty($arr['type']) && $arr['type']=='position'?'position':'product')."'".','. intval($arr['p_id']).');">
                                    <img class="chat-up-icon wd-20" src="'. base_url('assets/svg/up.svg') .'">
                                </a>
                                <a class="show-chat-childrens" onclick="showChatChildrens(this,'."'".(!empty($arr['type']) && $arr['type']=='position'?'position':'product')."'".','. intval($arr['p_id']) .');">
                                    <img class="chat-down-icon wd-20" src="'. base_url('assets/svg/down.svg') .'">
                                </a>':'').
                            ((!empty($arr['user_sender']) && $arr['user_sender']) || (!empty($arr['role']) && $arr['role']==='manager')?
                                '<a onclick="deleteChatId(this,'."'".(!empty($arr['type']) && $arr['type']=='position'?'position':'product')."'".','.intval($arr['chat_id']).');">
                                    <img src="'. base_url('assets/svg/icon/delete.svg').'" class="wd-20">
                                </a>':'').
                            (!empty($arr['time']) ?
                                "<span class='chat-time'>".$this->date->jdate('Y/m/d h:i',strtotime($arr['time']))."</span>":'').
                		'</span>
                	</div>
                	<div class="img_cont_msg">
                	    <img class="rounded-circle user_img_msg"
                	    alt="chat-user-image" 
                		src="'. (!empty($arr['user']['image'])?$arr['user']['image']:base_url('assets/svg/user/user.svg')).'">
                	</div>
                </div>
                <span class="d-none child child-'.(!empty($arr['type']) && $arr['type']=='position'?'position':'product').'-'.intval($arr['p_id']).'">'.
                    (!empty($arr['d'])?$arr['d']:'').
                '</span>
            </span>';
        }
    }
    public function valex_position_chat($id,$arr){
        $result=$ret='';
        if(!empty($id) && intval($id)>0 &&
        !empty($arr) && is_array($arr)>0 &&
        ($a=$this->CI->Position_model->select_chat_where_position_id(intval($id)))!==false){
            if(!empty($a))
                foreach($a as $b){
                    if(!empty($b) && !empty($b['id']) && intval($b['id'])>0 && !empty($b['user_id']) &&
                    intval($b['user_id'])>0)
                        if(empty($b['parent_id'])||intval($b['parent_id'])==0)
                            if(($c=$this->CI->Users_model->select_info_where_user_id(intval($b['user_id'])))!==false &&
                            !empty($c) && !empty($c['0'])){
                                $d=(intval($this->valex_user_id)>0 && intval($b['user_id'])===intval($this->valex_user_id)?true:false);
                                $e=$this->valex_position_chat_parent(intval($b['id']));
                                $ret.=$this->valex_chat([
                                    'chat_box'=>(intval($this->valex_user_id)>0?true:false),
                                    'user_sender'=>$d,
                                    'p_id'=>intval($id),
                                    'chat_id'=>intval($b['id']),
                                    'time'=>(!empty($b['time'])?$b['time']:''),
                                    'text'=>(!empty($b['text'])?$b['text']:''),
                                    'user'=>$c['0'],
                                    'type'=>'position',
                                    'd'=>(!empty($e)?$e:''),
                                    'role'=>$this->valex_type
                                ]);
                            }
                }
            $result.=$this->CI->load->view('includes/chat',[
                'user_id'=>(intval($this->valex_user_id)>0?intval($this->valex_user_id):''),
                'data'=>$ret,
                'info'=>$arr,
                'p_id'=>intval($id),
                'type'=>'position',
                'chat_box'=>(intval($this->valex_user_id)>0?true:false)
            ],true);
        }
        return $result;        
    }
    private function valex_position_chat_parent($id){
        $ret='';
        if(!empty($id) && intval($id)>0 && 
        ($a=$this->CI->Position_model->select_chat_where_parent_id(intval($id)))!==false && !empty($a))
            foreach($a as $b){
                if(!empty($b) && !empty($b['id']) && intval($b['id'])>0 && 
                ($c=$this->CI->Users_model->select_info_where_user_id($b['user_id']))!==false && !empty($c) && !empty($c['0'])){
                    $d=(intval($this->valex_user_id)>0 && intval($b['user_id'])===intval($this->valex_user_id)?true:false);
                    $e=$this->valex_position_chat_parent(intval($b['id']));
                    $ret.=$this->valex_chat([
                        'chat_box'=>(intval($this->valex_user_id)>0?true:false),
                        'user_sender'=>$d,
                        'p_id'=>intval($id),
                        'chat_id'=>intval($b['id']),
                        'time'=>(!empty($b['time'])?$b['time']:''),
                        'text'=>(!empty($b['text'])?$b['text']:''),
                        'user'=>$c['0'],
                        'type'=>'position',
                        'd'=>(!empty($e)?$e:''),
                        'role'=>$this->valex_type
                    ]);
                }
            }
        return $ret;
    }
    public function valex_product_chat($id,$arr){
        $result=$ret='';
        if(!empty($id) && intval($id)>0 &&
        !empty($arr) && is_array($arr)>0 &&
        ($a=$this->CI->Product_model->select_chat_where_product_id(intval($id)))!==false){
            if(!empty($a))
                foreach($a as $b){
                    if(!empty($b) && !empty($b['id']) && intval($b['id'])>0 && !empty($b['user_id']) &&
                    intval($b['user_id'])>0)
                        if(empty($b['parent_id'])||intval($b['parent_id'])==0)
                            if(($c=$this->CI->Users_model->select_info_where_user_id(intval($b['user_id'])))!==false &&
                            !empty($c) && !empty($c['0'])) {
                                $d=(intval($this->valex_user_id)>0 && intval($b['user_id'])===intval($this->valex_user_id)?true:false);
                                $e=$this->valex_product_chat_parent(intval($b['id']));                                
                                $ret.=$this->valex_chat([
                                    'chat_box'=>(intval($this->valex_user_id)>0?true:false),
                                    'user_sender'=>$d,
                                    'p_id'=>intval($id),
                                    'chat_id'=>intval($b['id']),
                                    'time'=>(!empty($b['time'])?$b['time']:''),
                                    'text'=>(!empty($b['text'])?$b['text']:''),
                                    'user'=>$c['0'],
                                    'type'=>'product',
                                    'd'=>(!empty($e)?$e:''),
                                    'role'=>$this->valex_type
                                ]);
                            }
                }
            $result.=$this->CI->load->view('includes/chat',[
                'user_id'=>(intval($this->valex_user_id)>0?intval($this->valex_user_id):''),
                'data'=>$ret,
                'info'=>$arr,
                'p_id'=>intval($id),
                'type'=>'product',
                'chat_box'=>(intval($this->valex_user_id)>0?true:false)
            ],true);
        }
        return $result;
    }
    private function valex_product_chat_parent($id){
        $ret='';
        if(!empty($id) && intval($id)>0 && ($a=$this->CI->Product_model->select_chat_where_parent_id(intval($id)))!==false && !empty($a))
            foreach($a as $b){
                if(!empty($b) && !empty($b['id']) && intval($b['id'])>0 && 
                ($c=$this->CI->Users_model->select_info_where_user_id($b['user_id']))!==false && !empty($c) && !empty($c['0'])){
                    $d=(intval($this->valex_user_id)>0 && intval($b['user_id'])===intval($this->valex_user_id)?true:false);
                    $e=$this->valex_product_chat_parent(intval($b['id'])); 
                    $ret.=$this->valex_chat([
                        'chat_box'=>(intval($this->valex_user_id)>0?true:false),
                        'user_sender'=>$d,
                        'p_id'=>intval($id),
                        'chat_id'=>intval($b['id']),
                        'time'=>(!empty($b['time'])?$b['time']:''),
                        'text'=>(!empty($b['text'])?$b['text']:''),
                        'user'=>$c['0'],
                        'type'=>'product',
                        'd'=>(!empty($e)?$e:''),
                        'role'=>$this->valex_type
                    ]);
                }
            }
        return $ret;
    }
    //chat
    // image
    private function valex_position_image($id){
        if(!empty($id) && intval($id)>0){
            $data=($this->valex_type=='manager'?
                $this->CI->Position_model->select_image_where_position_id(intval($id)):
                $this->CI->Position_model->select_image_where_position_id_and_status(intval($id)));
            return $this->CI->load->view('includes/image_galery',[
                'uploader'=>$this->CI->load->view('includes/uploader',['url'=>'assets---pic---position','type'=>'image'],true),
                'type'=>'position','role'=>$this->valex_type,'p_id'=>intval($id),'data'=>(!empty($data)?$data:[])
            ],true);
        }
        return '';
    }
    private function valex_product_image($id){
        if(!empty($id) && intval($id)>0){
            $data=($this->valex_type=='manager'?
                $this->CI->Product_model->select_image_where_product_id(intval($id)):
                $this->CI->Product_model->select_image_where_product_id_and_status(intval($id)));
            return $this->CI->load->view('includes/image_galery',[
                'uploader'=>$this->CI->load->view('includes/uploader',['url'=>'assets---pic---product','type'=>'image'],true),
                'type'=>'product','role'=>$this->valex_type,'p_id'=>intval($id),'data'=>(!empty($data)?$data:[])
            ],true);
        }
        return '';
    }
    // image
    // video
    private function valex_position_video($id){
        if(!empty($id) && intval($id)>0){
            $data=($this->valex_type=='manager'?
                $this->CI->Position_model->select_video_where_position_id(intval($id)):
                $this->CI->Position_model->select_video_where_position_id_and_status(intval($id)));
            return $this->CI->load->view('includes/video_galery',[
                'uploader'=>$this->CI->load->view('includes/uploader',
                ['url'=>'assets---video---position','type'=>'video'
            ],true),
            'type'=>'position','role'=>$this->valex_type,'p_id'=>intval($id),'data'=>(!empty($data)?$data:[]),],true);
        }
        return '';
    }
    private function valex_product_video($id){
        if(!empty($id) && intval($id)>0){
            $data=($this->valex_type=='manager'?
                $this->CI->Product_model->select_video_where_product_id(intval($id)):
                $this->CI->Product_model->select_video_where_product_id_and_status(intval($id)));
            return $this->CI->load->view('includes/video_galery',[
                'uploader'=>$this->CI->load->view('includes/uploader',
                ['url'=>'assets---video---product','type'=>'video'
            ],true),
            'type'=>'product','role'=>$this->valex_type,'p_id'=>intval($id),'data'=>(!empty($data)?$data:[]),],true);
        }
        return '';
    }
    // video
    //tools
    // main exploder
    private function category_structure($x){
        if(!empty($x['company_id']) && intval($x['company_id'])>0 && 
        ($b=$this->valex_company_info(intval($x['company_id'])))!==false && 
        !empty($b)){
            $this->company_id_map=intval($x['company_id']);
            $this->valex_company_where_info($b,$x);
        }
        if(!empty($x['position_id']) && intval($x['position_id'])>0 && 
        ($b=$this->valex_position_info(intval($x['position_id'])))!==false && 
        !empty($b)){
            $this->position_id_map=intval($x['position_id']);
            $this->valex_position_where_info($b,$x);
        }
        if(!empty($x) &&!empty($x['product_id']) && intval($x['product_id'])>0 && 
        ($b=$this->valex_product_info(intval($x['product_id'])))!==false && 
        !empty($b)){
            $this->valex_product_where_info($b,$x);
        }
    }
    private function child_category_list_finder($id){
        $a=$this->CI->Category_model->select_where_parent_id(intval($id));
        while(!empty($a)){
            if(($b=array_pop($a))!==false && !empty($b) && !empty($b['id']) && intval($b['id'])>0){
                $this->valex_category_child_list[]=intval($b['id']);
                $this->child_category_list_finder(intval($b['id']));
            }
        }
        return true;
    }
    public function valex_category_main_exploder($category_id){
        if(($this->valex_category_id=(!empty($category_id) && intval($category_id)>0?intval($category_id):0))!==false && ($a=($this->valex_type=='manager'?
        $this->CI->Product_model->all_category():$this->CI->Product_model->select_category_where_status()))!==false && !empty($a) &&
        $this->child_category_list_finder($this->valex_category_id))
            foreach($a as $x){
                if(!empty($x) && (intval($x['category_id'])==$this->valex_category_id || in_array(intval($x['category_id']),$this->valex_category_child_list)))
                    $this->category_structure($x);
            }
        return true;
    }
    // main exploder
    
    // product exploder
    private function valex_product_where_info($b,$x){
        if(!empty($b) && is_array($b) && !empty($b['id']) && intval($b['id'])>0 && !empty($x) && is_array($x))
            if(!empty($x['company_id']) && intval($x['company_id'])>0 && !empty($x['position_id']) && intval($x['position_id'])>0){
                $this->company_id_map=intval($x['company_id']);
                $z=$this->valex_company_info(intval($x['company_id']));
                $w=$this->valex_position_info(intval($x['position_id']));
                if(!empty($w) && !empty($z)){
                    $this->valex_show_product_in_category[]=[
                        'product_info'=>$b,
                        'company_info'=>$z,
                        'position_info'=>$w,
                    ];
                // }elseif(!empty($z) && empty($w)){
                //     $this->valex_show_product_in_category_without_position[]=[
                //         'product_info'=>$b,
                //         'company_info'=>$z,
                //     ];
                // }elseif(!empty($w) && empty($z)){
                //     $this->valex_show_product_in_category_without_company[]=[
                //         'product_info'=>$b,
                //         'position_info'=>$w,
                //     ];
                // }else{
                //     $this->valex_show_product_in_category_without_company_position[]=[
                //         'product_info'=>$b,
                //     ];
                }
            // }elseif(!empty($x['position_id']) && intval($x['position_id'])>0 && (empty($x['company_id']) || intval($x['company_id'])==0)){
            //     $this->company_id_map=0;
            //     if(($w=$this->valex_position_info(intval($x['position_id'])))!==false && !empty($w))
            //         $this->valex_show_product_with_position_without_company_in_category[]=[
            //             'position_info'=>$w,
            //             'product_info'=>$b,
            //         ];
            //     else
            //         $this->valex_show_product_without_company_in_category_without_position[]=[
            //             'product_info'=>$b,
            //         ];
            }elseif(!empty($x['company_id']) && intval($x['company_id'])>0 && (empty($x['position_id']) || intval($x['position_id'])==0)){
                $this->company_id_map=intval($x['company_id']);
                if(($z=$this->valex_company_info(intval($x['company_id'])))!==false && !empty($z))
                    $this->valex_show_product_company_without_position_in_category[]=[
                        'product_info'=>$b,
                        'company_info'=>$z
                    ];
                // else
                //     $this->valex_show_product_without_position_in_category_without_company[]=[
                //         'product_info'=>$b
                //     ];
            }else{
                $this->company_id_map=0;
                $this->valex_show_product_without_company_position_in_category[]=[
                    'product_info'=>$b,
                ];
            }
        return true;
    }
    // product exploder
    
    // position exploder
    private function valex_position_where_info($b,$x){
        if(!empty($b) && is_array($b) && !empty($b['id']) && intval($b['id'])>0 && !empty($x) && is_array($x))
            if(!empty($x['company_id']) && intval($x['company_id'])>0 && !empty($x['product_id']) && intval($x['product_id'])>0){
                $z=$this->valex_company_info(intval($x['company_id']));
                $y=$this->valex_product_info(intval($x['product_id']));
                if(!empty($y) && !empty($z)){
                    $this->valex_show_position_in_category[]=[
                        'company_info'=>$z,
                        'product_info'=>$y,
                        'position_info'=>$b
                    ];
                }elseif(!empty($z) && empty($y)){
                    $this->valex_show_position_in_category_without_product_with_company[]=[
                        'company_info'=>$z,
                        'position_info'=>$b
                    ];
                // }elseif(!empty($y) && empty($z)){
                //     $this->valex_show_position_in_category_without_comapny_with_product[]=[
                //         'product_info'=>$y,
                //         'position_info'=>$b
                //     ];
                // }else{
                //     $this->valex_show_position_in_category_without_comapny_product[]=$b;
                }
            }elseif(!empty($x['company_id']) && intval($x['company_id'])>0 && (empty($x['product_id']) || intval($x['product_id'])==0)){
                $z=$this->valex_company_info(intval($x['company_id']));
                if(!empty($z))
                    $this->valex_show_position_with_company_without_product_in_category[]=[
                        'company_info'=>$z,
                        'position_info'=>$b
                    ];
                // else
                //     $this->valex_show_position_without_product_in_category_without_company[]=$b;
            // }elseif(!empty($x['product_id']) && intval($x['product_id'])>0 && (empty($x['company_id']) || intval($x['company_id'])==0)){
            //     $y=$this->valex_product_info(intval($x['product_id']));
            //     if(!empty($y))
            //         $this->valex_show_position_without_company_in_category_with_product[]=[
            //             'product_info'=>$y,
            //             'position_info'=>$b
            //         ];
            //     else
            //         $this->valex_show_position_without_company_in_category_without_product[]=$b;
            // }else{
            //     $this->valex_show_only_position[]=$b;
            }
        return true;
    }
    // position exploder
    
    // company exploder
    private function valex_company_where_info($b,$x){
        $this->valex_show_all_company_in_category[]=$b;
        if(!empty($b) && is_array($b) && !empty($b['id']) && intval($b['id'])>0 && !empty($x) && is_array($x))
            if(!empty($x['position_id']) && intval($x['position_id'])>0 && !empty($x['product_id']) && intval($x['product_id'])>0){
                $y=$this->valex_product_info(intval($x['product_id']));
                $z=$this->valex_position_info(intval($x['position_id']));
                if(!empty($y) && !empty($z)){
                    $this->valex_show_company_in_category[]=[
                        'company_info'=>$b,
                        'product_info'=>$y,
                        'position_info'=>$z
                    ];
                // }elseif(!empty($z) && empty($y)){
                //     $this->valex_show_company_in_category_without_product_with_position[]=[
                //         'company_info'=>$b,
                //         'position_info'=>$z
                //     ];
                // }elseif(!empty($y) && empty($z)){
                //     $this->valex_show_company_in_category_without_position_with_product[]=[
                //         'product_info'=>$y,
                //         'company_info'=>$b
                //     ];
                // }else{
                //     $this->valex_show_company_in_category_without_position_product[]=$b;
                }
                
            }elseif(!empty($x['position_id']) && intval($x['position_id'])>0 && (empty($x['product_id']) || intval($x['product_id'])==0)){
                $z=$this->valex_position_info(intval($x['position_id']));
                if(!empty($z))
                    $this->valex_show_company_without_product_in_category_with_position[]=[
                        'company_info'=>$b,
                        'position_info'=>$z
                    ];
                // else
                //     $this->valex_show_company_without_product_in_category_without_position[]=$b;
            }elseif(!empty($x['product_id']) && intval($x['product_id'])>0 && (empty($x['position_id']) || intval($x['position_id'])==0)){
                $y=$this->valex_product_info(intval($x['product_id']));
                if(!empty($y))
                    $this->valex_show_company_without_position_in_category_with_product[]=[
                        'product_info'=>$y,
                        'company_info'=>$b
                    ];
                // else
                //     $this->valex_show_company_without_position_in_category_without_product[]=$b;
            }else{
                $this->valex_show_comapny_in_category_without_position_product[]=$b;
            }
        return true;
    }
    // company exploder
}