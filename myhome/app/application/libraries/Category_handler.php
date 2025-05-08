<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Category_handler{
    private $CI;
    public function __construct(){
		$this->CI =& get_instance();
		$this->CI->load->helper('url');
        $this->CI->load->library('session');
        $this->CI->config->item('base_url');
	}
    public function valex_show(){
        $this->select_category('status');
        $this->select_children_category('status');
        return $this->valex_tem_find_handler(); 
    }
	public function show_all(){
        $this->select_category('status');
        $this->select_children_category('status');
        echo $this->CI->load->view('category/nav',['menu'=>$this->parent_array],true).
        $this->CI->load->view('category/index',['menu'=>$this->children_array],true);
    }
    public function show_company_manager(){
        $this->select_category('status');
        $this->select_children_category('status');
        echo $this->CI->load->view('category/dashbord/main_company_manager',['mode'=>'company_manager','menu'=>$this->parent_array],true).
        $this->CI->load->view('category/dashbord/company_manager',['mode'=>'company_manager','menu'=>$this->children_array],true);
    }
    public function show_manager(){
        $this->select_category('none_status');
        $this->select_children_category('none_status');
        return [
            'mode'=>'manager',
            'menu'=>$this->parent_array,
            'children'=>$this->children_array
        ];
    }
    private $parent_array=[];
    private $children_array=[];
    private $children_list_array=[];
    private function select_category($type){
        switch($type){
            case 'status':
                $this->parent_array=$this->CI->Category_model->select_parent_where_status();
                $this->children_list_array=$this->CI->Category_model->only_parent_id_all_children_and_status();
                break;

            case 'none_status':
                $this->parent_array=$this->CI->Category_model->select_parent();
                $this->children_list_array=$this->CI->Category_model->only_parent_id_all_children();
                break;

            default:
                break;
        }
        return true;
    }
    private function select_children_category($type){
        while (!empty($this->children_list_array)) {
            if(($a=array_pop($this->children_list_array))!==false && !empty($a) && !empty($a['parent_id']) && intval($a['parent_id'])>0)
                switch ($type) {
                    case 'status':
                        if(($b=$this->CI->Category_model->select_where_id_and_status(intval($a['parent_id'])))!==false && !empty($b) && !empty($b['0'])){
                            $c=(!empty($b['0']['parent_id']) && intval($b['0']['parent_id'])>0?intval($b['0']['parent_id']):0);
                            $this->children_array[]=[
                                'p_p_id'=>$c,
                                'p_id'=>$a['parent_id'],
                                'data'=>$this->CI->Category_model->select_where_parent_id_and_status(intval($a['parent_id']))];
                        }
                        break;
                    case 'none_status':
                        if(($b=$this->CI->Category_model->select_where_id(intval($a['parent_id'])))!==false && !empty($b) && !empty($b['0'])){
                            $c=(!empty($b['0']['parent_id']) && intval($b['0']['parent_id'])>0?intval($b['0']['parent_id']):0);
                            $this->children_array[]=['p_p_id'=>$c,'p_id'=>$a['parent_id'],'data'=>$this->CI->Category_model->select_where_parent_id(intval($a['parent_id']))];
                        }
                        break;
                    default:
                        break;
                }
        }
    }
    private function find_handler(){
        $ret='';
        while(!empty($this->parent_array)){
            $ret.='<ul>';
            if(($a=array_pop($this->parent_array))!==false && !empty($a) && !empty($a['id']) && intval($a['id'])>0 && !empty($a['title'])){
                $ret.='<li><a class="category-id-'.intval($a['id']).'" onclick="changeParentIdVal(this,'.intval($a['id']).');">'.
                $a['title'].'</a>';
                if(!empty($this->children_array)) 
                    $ret.=$this->change_arr_to_tem(intval($a['id']),$this->children_array);
                $ret.='</li>';
            }
            $ret.='</ul>';
        }
        return $ret;
    }
    private function change_arr_to_tem($p_id,$arr){
        $ret='';
        $array=[];
        if(!empty($p_id) && intval($p_id)>0 && !empty($arr) && is_array($arr))
            foreach($arr as $a){
                if(!empty($a) && !empty($a['data']) && !empty($a['p_id']) && intval($p_id) == intval($a['p_id']) && !in_array(intval($a['p_id']),$array)){
                    $array[]=intval($a['p_id']);
                    $ret.='<ul>';
                    foreach ($a['data'] as $b) {
                        if(!empty($b['id']) && !empty($b['title']))
                        $ret.='<li><a class="p-id-'.intval($b['id']).'" onclick="changeParentIdVal(this,'.
                        intval($b['id']).');">'.$b['title'].'</a>';
                        if(!empty($this->children_array)) 
                            $ret.=$this->change_arr_to_tem(intval($b['id']),$this->children_array);
                        $ret.='</li>';
                    }
                    $ret.='</ul>';
                }
            }
        return $ret;
    }
    private function valex_tem_find_handler(){
        $ret=$b='';
        while(!empty($this->parent_array)){
            if(($a=array_pop($this->parent_array))!==false && !empty($a) && !empty($a['id']) && intval($a['id'])>0 && !empty($a['title'])){
                if(!empty($this->children_array)) 
                    $b=$this->valex_tem_find_handler_children(intval($a['id']),$this->children_array,'sub-side-menu__item" data-toggle="sub-slide');
                if((($c=$this->CI->Product_model->select_category_where_category_id(intval($a['id'])))!==false && !empty($c))||!empty($b))
                    $ret.='<li 
                    class="slide">
                    <a class="'.(!empty($b)?'p-category-id-':'category-id-').intval($a['id']).' side-menu__item py-4 changeParentIdVal" 
                    data-toggle="slide">
                        <img class="wd-20 hd-20 mg-l-5" src="'.base_url('assets/svg/category/').(!empty($a['icon'])?$a['icon']:'category.svg').'">    
                        <span 
                        '.(!empty($_SESSION['page']) && $_SESSION['page']=='map'?'onclick="changeCategoryInMap('.intval($a['id']).');"':'onclick="changeCategory('.intval($a['id']).');"').'
                        class="side-menu__label">'.$a['title'].'</span>'.
                        (!empty($b)?'<i class="angle fe fe-chevron-down"></i>':'').'</a>'.
                        (!empty($b)?'<ul class="slide-menu">'.$b.'</ul>':'').'</li>';
            }
        }
        return $ret;
    }
    private function valex_tem_find_handler_children($p_id,$arr,$class_name=''){
        $ret=$c='';
        $array=[];
        if(!empty($p_id) && intval($p_id)>0 && !empty($arr) && is_array($arr))
            foreach($arr as $a){
                if(!empty($a) && !empty($a['data']) && !empty($a['p_id']) && intval($p_id) == intval($a['p_id']) && !in_array(intval($a['p_id']),$array)){
                    $array[]=intval($a['p_id']);
                    foreach ($a['data'] as $b) {
                        if(!empty($b['id']) && intval($b['id']) > 0 && !empty($b['title'])){
                            if(!empty($this->children_array)) 
                                $c=$this->valex_tem_find_handler_children(intval($b['id']),$this->children_array,'sub-slide-item');
                            if((($d=$this->CI->Product_model->select_category_where_category_id(intval($b['id'])))!==false && !empty($d))||!empty($c))
                                $ret.='<li class="sub-slide">
                                <a class="py-4 '.(!empty($b)?'p-category-id-':'category-id-').intval($b['id']).' '.(!empty($class_name) && is_string($class_name)?$class_name:'').'">
                                    <img class="wd-15 hd-15 mg-l-5" src="'.base_url('assets/svg/category/').(!empty($b['icon'])?$b['icon']:'category.svg').'"> 
                                    <span
                                    '.(!empty($_SESSION['page']) && $_SESSION['page']=='map'?'onclick="changeCategoryInMap('.intval($b['id']).');"':'onclick="changeCategory('.intval($b['id']).');"').'
                                    class="sub-side-menu__label">'.$b['title'].'</span>
                                    '.(!empty($c)?'<i class="sub-angle fe fe-chevron-down"></i>':'').'
                                </a>'.(!empty($c)?'<ul class="sub-slide-menu">'.$c.'</ul>':'').'</li>';
                        }
                    }
                }
            }
        return $ret;
    }
}