<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Product_handler{
    private $CI;
    public function __construct(){
		$this->CI =& get_instance();
		$this->CI->load->helper('url');
        $this->CI->load->library('session');
        $this->CI->config->item('base_url');
	}

	
	
	
	
//     public $lt='';
// 	public $ln='';
//     public $type='';
//     public $dont=[];
//     public $map_inner='';
//     private $category=[];
//     private $company=[];
//     public $category_product=[];
//     public $company_product=[];
//     public $product_id_in_category=[];
//     public $user_id=0;
//     public $chat_box=false;
//     public $add_location=false;
//     public $map_icon='';
//     public $category_id_map=0;
//     public $company_id_map=0;
//     private $copmany_product=[];
//     public function set_lt_ln(){
//         $a= $this->CI->Include_model->ip_handler();
//         if(!empty($a) && !empty($a['lat']) && !empty($a['lon'])){
//             $this->lt=$a['lat'];
//             $this->ln=$a['lon'];
//         }
//         return true;
//     }
//     public function other(){
//         $arr=[];
//         if(($a=$this->CI->Product_model->all())!==false && !empty($a))
//             foreach($a as $b){
//                 if(!empty($b) && !empty($b['id']) && intval($b['id'])>0){
//                     $c=$this->CI->Company_model->select_category_product_where_product_id($b['id']);
//                     if(empty($c)){
//                         $this->company_id_map=$this->category_id_map=0;
//                         $t=(!empty($b['title'])?$b['title']:(!empty($b['key'])?$b['key']:''));
//                         $arr[]=[
//                             'info'=>$b,
//                             'category'=>$this->product_category(intval($b['id'])),
//                             'company_category'=>$this->company_product_category(intval($b['id'])),
//                             'key_value'=>$this->show_key_value(intval($b['id'])),
//                             'tel'=>$this->show_tel(intval($b['id'])),
//                             'map'=>$this->product_map_creator(intval($b['id'])),
//                             'chat'=>$this->chat_product(intval($b['id'])),
//                             'image'=>$this->show_image_product(intval($b['id'])),
//                             'video'=>$this->show_video_product(intval($b['id'])),
//                             'chart'=>$this->product_chart(intval($b['id']),(!empty($b['title'])?$b['title']:$b['key']))
//                         ];
//                     }
                    
//                 }
//             }
//         return $arr;
//     }
//     public function other_user(){
//         $arr=[];
//         if(($a=$this->CI->Product_model->select_product_where_status())!==false && !empty($a))
//             foreach ($a as $b){
//                 if(!empty($b) && !empty($b['id']) && intval($b['id'])>0 && 
//                 !in_array(intval($b['id']),$this->dont) && 
//                 !in_array(intval($b['id']),$this->product_id_in_category)){ 
//                     $t=(!empty($b['title'])?$b['title']:(!empty($b['key'])?$b['key']:''));
//                     $arr[]=[
//                         'id'=>$b['id'],
//                         'title'=>$t,
//                         'description'=>(!empty($b['description'])?$b['description']:''),
//                         'key_value'=>$this->show_key_value(intval($b['id'])),
//                         'tel'=>$this->show_tel(intval($b['id'])),
//                         'image'=>$this->show_image_product(intval($b['id'])),
//                         'video'=>$this->show_video_product(intval($b['id'])),
//                         'map'=>$this->product_map_creator(intval($b['id'])),
//                         'chat'=>$this->chat_product(intval($b['id'])),
//                         'chart'=>$this->product_chart(intval($b['id']),$t)
//                     ];
//                 }
                
//             }
//         return $arr;
//     }
//     public function dont_show(){
//         if(($a=$this->CI->Company_model->select_category_product_where_status())!==false && !empty($a))
//             foreach($a as $b){
//                 if(!empty($b['product_id']) && intval($b['product_id'])>0 && !in_array(intval($b['product_id']),$this->dont))$this->dont[]=intval($b['product_id']);
//             }
//     }
//     // get all product category table and find data
//     public function category_fider(){
//         $a=($this->type=='manager'?$this->CI->Product_model->all_category():$this->CI->Product_model->select_category_where_status());
//         if(!empty($a))
//             foreach($a as $b){
//                 if(!empty($b['category_id']) && intval($b['category_id'])>0 && !in_array(intval($b['category_id']),$this->category))$this->category[]=intval($b['category_id']);
//             }
//         $this->category_product_finder();
//     }
//     public function company_finder(){
//         if(($a=($this->type=='manager'?$this->CI->Company_model->all_category_product():$this->CI->Company_model->select_category_product_where_status()))!==false && !empty($a))
//             foreach($a as $b){
//                 if(intval($b['category_id'])==0 && 
//                 !empty($b['company_id']) && intval($b['company_id'])>0 && 
//                 !empty($b['product_id']) && intval($b['product_id'])>0) 
//                     $this->company[intval($b['company_id'])][]=intval($b['product_id']);
//             }
//         $this->company_product_finder();
//     }
//     private function company_product_finder(){
//         $c=$e=[];
//         if(!empty($this->company))
//             foreach($this->company as $a=>$b){
//                 if(intval($a)>0){
//                     $c=($this->type=='manager'?
//                         $this->CI->Company_model->select_company_where_id_and_status($a):
//                         $this->CI->Company_model->select_company_where_id($a));
//                     if(!empty($c) && !empty($c['0']))
//                         $this->company_product[intval($a)]['info']=$c['0'];
//                     if(!empty($b)){
//                         foreach($b as $f => $g){
//                             $d=($this->type=='manager'?
//                                 $this->CI->Product_model->select_product_where_id(intval($g)):
//                                 $this->CI->Product_model->select_product_where_id_and_status(intval($g)));
//                             if(!empty($d) && is_array($d['0']) && !empty($d['0']['id']) && intval($d['0']['id'])>0){
//                                 $e=$this->product_info($d['0']);
//                                 $this->company_product[intval($a)]['product'][intval($d['0']['id'])]=(!empty($e) && !empty($e['0'])?$e['0']:[]);
//                             }
//                         }
//                     }
//                 }
//             }
//         return true;
//     }
//     private function product_category($id){
//         $arr=[];
//         if(!empty($id) && intval($id)>0){
//             if(($a=$this->CI->Product_model->select_category_where_product_id(intval($id)))!==false && !empty($a))
//                 foreach($a as $b){
//                     if(!empty($b['category_id']) && intval($b['category_id'])>0 && 
//                     ($this->category_id_map=intval($b['category_id']))!==false && 
//                     ($c=$this->CI->Category_model->select_where_id(intval($b['category_id'])))!==false && 
//                     !empty($c) && !empty($c['0']) && !empty($c['0']['title']))$arr[]=$c['0']['title'];
//                 }
//         }
//         return $arr;
//     }
//     private function company_product_category($id){
//         $arr=[];
//         if(!empty($id) && intval($id)>0 && ($a=$this->CI->Company_model->select_category_product_where_product_id(intval($id)))!==false && !empty($a))
//             foreach($a as $b){
//                 if(!empty($b['category_id']) && intval($b['category_id'])>0 && 
//                 ($c=$this->CI->Category_model->select_where_id(intval($b['category_id'])))!==false && !empty($c) && !empty($c['0']) && !empty($c['0']['title']) && !empty($b['company_id']) && intval($b['company_id'])>0 && ($d=$this->CI->Company_model->select_company_where_id(intval($b['company_id'])))!==false && !empty($d) && !empty($d['0']))$arr[]=['title'=>$c['0']['title'],'company'=>$d['0']];
//             }
//         return $arr;
//     }
//     //set category_product variable
//     private function category_product_finder(){
//         if(!empty($this->category) && is_array($this->category))
//             while(!empty($this->category)){
//                 $a=array_pop($this->category);
//                 if(!empty($a) && intval($a)>0)
//                     $b=($this->type=='manager'?
//                         $this->CI->Product_model->select_category_where_category_id(intval($a)):
//                         $this->CI->Product_model->select_category_where_category_id_and_status(intval($a)));
//                 if(!empty($b))
//                     $c=$this->product_info_finder($b);
//                 if(!empty($c))
//                     $this->category_product[]=($this->type=='manager'?
//                         ['category_info'=>$this->CI->Category_model->select_where_id(intval($a)),'product'=>$c]:
//                         ['category_id'=>intval($a),'product'=>$c]);
//             }
//     }
//     private function product_info_finder($arr){
//         $ret=[];
//         if(!empty($arr) && is_array($arr))
//             foreach($arr as $a){
//                 if(!empty($a['product_id']) && intval($a['product_id'])>0 && 
//                 !in_array(intval($a['product_id']),$this->product_id_in_category))
//                     $this->product_id_in_category[]=intval($a['product_id']);
                    
//                 if(!empty($a['product_id']) && intval($a['product_id'])>0 && 
//                 ($b=($this->type=='manager'?
//                     $this->CI->Product_model->select_product_where_id(intval($a['product_id'])):
//                     $this->CI->Product_model->select_product_where_id_and_status(intval($a['product_id']))))!==false && 
//                 !empty($b) && !empty($b['0']))
//                     foreach($b as $c){
//                         if(!empty($c) && is_array($c) && !empty($c['id']) && intval($c['id'])>0)
//                             $ret[]=$this->product_info($c);
//                     }
//             }
//         return $ret;
//     }
//     public function product_chart($id,$str=''){
//         $arr=[];
//         if(!empty($id) && intval($id)>0 && ($a=$this->CI->Product_model->select_change_where_product_id(intval($id)))!==false && !empty($a))
//             foreach($a as $b){
//                 if(is_int($b['new_value']) || is_float($b['new_value']) || intval($b['new_value'])>0){
//                     if(is_int($b['old_value']) || is_float($b['old_value']) || intval($b['old_value'])>0){
//                         $arr[]=[
//                             'id'=>$id,
//                             't'=>(!empty($str) && is_string($str)?$str:''),
//                             'v_id'=>$b['product_value_id'],
//                             'time'=>$b['time'] ,
//                             'v'=>$b['new_value']
//                         ];
//                     }
//                 }
//             }
//         return $this->CI->load->view('includes/chart',['data'=>$arr],true);
//     }
//     public function chat_product($id){
//         $ret='';
//         if(!empty($id) && intval($id)>0 && ($a=$this->CI->Product_model->select_chat_where_product_id(intval($id)))!==false)
//             if(!empty($a))
//                 for($b=0;$b<=count($a)-1;$b++){
//                     if(!empty($a[$b]) && !empty($a[$b]['id']) && intval($a[$b]['id'])>0 && !empty($a[$b]['user_id']) && intval($a[$b]['user_id'])>0)
//                         if(empty($a[$b]['parent_id'])||intval($a[$b]['parent_id'])<0)
//                             if(($c=$this->CI->Users_model->select_info_where_user_id($a[$b]['user_id']))!==false && !empty($c) && !empty($c['0'])) 
//                                 $ret.=$this->CI->load->view('includes/chat',['user_id'=>(intval($this->user_id)>0?intval($this->user_id):0),'p_id'=>intval($id),'id'=>intval($a[$b]['id']),'chat_box'=>$this->chat_box,'role'=>(!empty($this->type)?$this->type:''),'time'=>(!empty($a[$b]['time'])?$a[$b]['time']:''),'text'=>(!empty($a[$b]['text'])?$a[$b]['text']:''),'user'=>$c['0'],'d'=>$this->find_children_chat(intval($a[$b]['id']))],true);
//                 }
//             else
//                 if($this->type=="user"||$this->type=="manager"||intval($this->user_id)>0)
//                     $ret=$this->CI->load->view('includes/chat',['user_id'=>(intval($this->user_id)>0?intval($this->user_id):0),'p_id'=>intval($id),'chat_box'=>$this->chat_box,'role'=>(!empty($this->type)?$this->type:'')],true);
//         return $ret;
//     }
//     private function find_children_chat($id){
//         $ret='';
//         if(!empty($id) && intval($id)>0 && ($a=$this->CI->Product_model->select_chat_where_parent_id(intval($id)))!==false && !empty($a))
//             for($b=0;$b<=count($a)-1;$b++){
//                 if(!empty($a[$b]) && !empty($a[$b]['id']) && intval($a[$b]['id'])>0 && ($c=$this->CI->Users_model->select_info_where_user_id($a[$b]['user_id']))!==false && !empty($c) && !empty($c['0']))$ret.=$this->CI->load->view('includes/chat',['role'=>(!empty($this->type)?'manager':''),'time'=>(!empty($a[$b]['time'])?$a[$b]['time']:''),'text'=>(!empty($a[$b]['text'])?$a[$b]['text']:''),'user'=>$c['0'],'d'=>$this->find_children_chat(intval($a[$b]['id']))],true);
//             }
//         return $ret;
//     }
//     public function product_map_creator($id){
//         $arr=[];
//         if(!empty($id)&&intval($id)>0&&
//         ($a=$this->CI->Product_model->select_map_where_product_id_and_status(intval($id)))!==false && !empty($a))
//             for($c=0;$c<=count($a)-1;$c++){
//                 if(!empty($a[$c]) && !empty($a[$c]['lat']) && !empty($a[$c]['lon'])) 
//                     $arr[]=[
//                     'category_id'=>$this->category_id_map,
//                     'company_id'=>$this->company_id_map,
//                     'product_id'=>intval($id),
//                     'lat'=>$a[$c]['lat'],
//                     'lon'=>$a[$c]['lon'],
//                     'd'=>(!empty($a[$c]['title'])?$a[$c]['title'].' با فاصله ی ':'').
//                     $this->CI->Include_model->map_distance_four_param($a[$c]['lat'],$this->lt,$a[$c]['lon'],$this->ln)
//                 ];
//             }
//         return (!empty($arr)||$this->type=='manager'?
//             $this->CI->load->view('includes/map',['p_id'=>intval($id),
//             'position'=>false,
//             'company'=>false,
//             'icon'=>(!empty($this->map_icon)?$this->map_icon:''),
//             'role'=>$this->type,
//             'lat'=>$this->lt,
//             'lon'=>$this->ln,
//             'lat_lon'=>$arr,
//             'add'=>$this->add_location],true):'');
//     }
//     public function show_key_value($id){
//         if(!empty($id) && intval($id)>0){
//             $z=($this->type=='manager'?
//                 $this->CI->Product_model->select_product_key_where_product_id(intval($id)):
//                 $this->CI->Product_model->select_product_key_where_product_id_and_status(intval($id)));
//             $x=$this->CI->Product_model->select_product_value_where_product_id(intval($id));                
//             return $this->CI->load->view('includes/key_value',['p_id'=>intval($id),'role'=>$this->type,'key'=>(!empty($z)?$z:[]),'value'=>(!empty($x)?$x:[])],true);
//         }
//         return '';
//     }
//     public function show_tel($id){
//         if(!empty($id) && intval($id)>0){
//             $tel=($this->type=='manager'?
//                 $this->CI->Product_model->select_tel_where_product_id(intval($id)):
//                 $this->CI->Product_model->select_tel_where_product_id_and_status(intval($id)));
//             return $this->CI->load->view('includes/tel',['p_id'=>intval($id),'tel'=>(!empty($tel)?$tel:[])],true);
//         }
//         return '';
//     }
//     public function show_image($t,$id,$data){
//         $a=($t=='p'?'product':'company');
//         return $this->CI->load->view('includes/image_galery',['uploader'=>$this->CI->load->view('includes/uploader',['url'=>'assets---pic---'.$a,'type'=>'image'],true),'t'=>$t,'role'=>$this->type,'p_id'=>intval($id),'data'=>$data,],true);
//     }
//     private function show_image_product($id){
//         if(!empty($id) && intval($id)>0){
//             $data=($this->type=='manager'?
//                 $this->CI->Product_model->select_image_where_product_id(intval($id)):
//                 $this->CI->Product_model->select_image_where_product_id_and_status(intval($id)));
//             return $this->CI->load->view('includes/image_galery',[
//                 'uploader'=>$this->CI->load->view('includes/uploader',['url'=>'assets---pic---product','type'=>'image'],true),
//                 't'=>'p','role'=>$this->type,'p_id'=>intval($id),'data'=>(!empty($data)?$data:[])
//             ],true);
//         }
//         return '';
//     }
//     public function show_video($t,$id,$data){
//         $a=($t=='p'?'product':'company');
//         return $this->CI->load->view('includes/video_galery',['uploader'=>$this->CI->load->view('includes/uploader',['url'=>'assets---video---'.$a,'type'=>'video'],true),'t'=>$t,'role'=>$this->type,'p_id'=>intval($id),'data'=>$data,],true);
//     }
//     private function show_video_product($id){
//         if(!empty($id) && intval($id)>0){
//             $data=($this->type=='manager'?
//                 $this->CI->Product_model->select_video_where_product_id(intval($id)):
//                 $this->CI->Product_model->select_video_where_product_id_and_status(intval($id)));
//             return $this->CI->load->view('includes/video_galery',[
//                 'uploader'=>$this->CI->load->view('includes/uploader',
//                 ['url'=>'assets---video---product','type'=>'video'
//             ],true),
//             't'=>'p','role'=>$this->type,'p_id'=>intval($id),'data'=>(!empty($data)?$data:[]),],true);
//         }
//         return false;
//     }
//     private function product_info($c){
//         $ret=[];
//         if(!empty($c) && is_array($c) && !empty($c['id']) && intval($c['id'])>0){
//             $t=(!empty($c['title'])?
//                 $c['title']:
//                     (!empty($c['key'])?
//                     $c['key']:
//                     ''));

//             $ret[]=[
//                 'status'=>$c['status'],
//                 'id'=>$c['id'],
//                 'key'=>(!empty($c['key'])?$c['key']:''),
//                 'title'=>(!empty($c['title'])?$c['title']:''),
//                 'description'=>(!empty($c['description'])?$c['description']:''),
//                 'key_value'=>$this->show_key_value(intval($c['id'])),
//                 'tel'=>$this->show_tel(intval($c['id'])),
//                 'image'=>$this->show_image_product(intval($c['id'])),
//                 'video'=>$this->show_video_product(intval($c['id'])),
//                 'map'=>$this->product_map_creator(intval($c['id'])),
//                 'chat'=>$this->chat_product(intval($c['id'])),
//                 'chart'=>$this->product_chart(intval($c['id']),$t)
//             ];
//         }
//         return $ret;
//     }
}