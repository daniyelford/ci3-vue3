<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Category extends MY_Controller
{
	public function __construct(){
		parent::__construct();
	}
	private $main;
	private $id=0;
	public function index(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!is_null($a) && $this->Include_model->chapcha($a) && 
	    !is_null($b) && !empty($b['id']) && intval($b['id'])>0){
	        $this->id=(!empty($_SESSION['id']) && intval($_SESSION['id'])>0?intval($_SESSION['id']):0);
	        $this->main=new Main_exploder();
	        $this->main->valex_user_id=intval($this->id);
            $this->main->valex_lt=(!empty($_SESSION['lt'])?$_SESSION['lt']:'');
            $this->main->valex_ln=(!empty($_SESSION['ln'])?$_SESSION['ln']:'');
            $this->main->valex_category_main_exploder(intval($b['id']));
                if(intval($this->id)>0)
                    echo $this->load->view('index',[
        			    'wallet'=>(!empty($_SESSION['my_wallet'])?$_SESSION['my_wallet']:[]),
                        'id'=>$this->id,
        			    'login'=>true,
        			    'company_position_product'=>$this->main->valex_show_product_in_category,
                        'company_product'=>$this->main->valex_show_product_company_without_position_in_category,
                        'product'=>$this->main->valex_show_product_without_company_position_in_category,
                        'position'=>(!empty($this->main->valex_show_position_with_company_without_product_in_category)?$this->main->valex_show_position_with_company_without_product_in_category:$this->main->valex_show_position_in_category),
    			    ],true);
                else
        	        echo $this->load->view('index',[
        	            'company_position_product'=>$this->main->valex_show_product_in_category,
                        'company_product'=>$this->main->valex_show_product_company_without_position_in_category,
                        'product'=>$this->main->valex_show_product_without_company_position_in_category,
                        'position'=>(!empty($this->main->valex_show_position_with_company_without_product_in_category)?$this->main->valex_show_position_with_company_without_product_in_category:$this->main->valex_show_position_in_category),
        	        ],true);
	    }else{
	        echo 0;
	    }
	}
	public function valex_edit_category(){
        $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!is_null($a) && $this->Include_model->chapcha($a) && !is_null($b) && 
	    !empty($_SESSION['id']) && intval($_SESSION['id'])===1 &&
	    ($p_id=(!empty($b['parentId']) && intval($b['parentId'])>0?intval($b['parentId']):0))!==false &&
	    ($description=(!empty($b['description'])?$b['description']:''))!==false &&
	    ($file=(!empty($b['file'])?$b['file']:''))!==false &&
	    !empty($b['id']) && intval($b['id'])>0 && !empty($b['title']) &&
	    $this->Category_model->edit((!empty($file)?['icon'=>$file,'title'=>$b['title'],'description'=>$description,'parent_id'=>$p_id]:['title'=>$b['title'],'description'=>$description,'parent_id'=>$p_id]),['id'=>intval($b['id'])]))
            die('111');
        else
    	    die('0');
    }
	public function valex_add_category(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!is_null($a) && $this->Include_model->chapcha($a) && !is_null($b) && 
	    !empty($_SESSION['id']) && intval($_SESSION['id'])===1 &&
	    ($p_id=(!empty($b['parentId']) && intval($b['parentId'])>0?intval($b['parentId']):0))!==false &&
	    ($description=(!empty($b['description'])?$b['description']:''))!==false &&
	    ($file=(!empty($b['file'])?$b['file']:''))!==false && !empty($b['title']) &&
	    $this->Category_model->add((!empty($file)?['icon'=>$file,'title'=>$b['title'],'description'=>$description,'parent_id'=>$p_id]:['title'=>$b['title'],'description'=>$description,'parent_id'=>$p_id])))
            die('111');
        else
    	    die('0');
    }
    public function valex_disable_category(){
        $a=(!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b=(!empty($_POST['data']['id']) && intval($_POST['data']['id'])>0?intval($_POST['data']['id']):null);
	    if(!is_null($a) && !is_null($b) && $this->Include_model->chapcha($a) &&
	    !empty($_SESSION['id']) && intval($_SESSION['id'])===1 &&
	    $this->Category_model->edit(['status'=>0],['id'=>intval($b)]))
	        die('ok');
	    die('0');
    }
    public function valex_enable_category(){
        $a=(!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b=(!empty($_POST['data']['id']) && intval($_POST['data']['id'])>0?intval($_POST['data']['id']):null);
	    if(!is_null($a) && !is_null($b) && $this->Include_model->chapcha($a) && !empty($_SESSION['id']) && intval($_SESSION['id'])===1 && $this->Category_model->edit(['status'=>1],['id'=>intval($b)]))
	        die('ok');
	    die('0');
    }




	private $category_parent=[];
	private $category_children='';
    public function show(){
        $this->category_handler('other');
        echo $this->load->view('category/nav',['menu'=>$this->category_parent],true).$this->load->view('category/main',['menu'=>$this->category_children],true);
    }
    private function category_handler($t){
	    $data=[];
	    switch($t){
	        case 'manager': 
        	    $this->category_parent=$this->Category_model->select_where_parent_id(0);
                $this->category_children=$this->category_sprator($this->Category_model->select_only_parent_where_child(),$t);
        	    break;
            case 'other':
        	    $this->category_parent=$this->Category_model->select_where_parent_id_and_status(0);
                $this->category_children=$this->category_sprator($this->Category_model->select_only_parent_where_child_and_status(),$t);
        	    break;
	       default:
	           $this->category_parent[]=[];
	           break;
	    }
        return true;
	}
    private function category_sprator($arr,$t){
        $ret='';
        $array=$p_id_array=[];
        if(!empty($arr) && is_array($arr) && !empty($t) && is_string($t)){
            foreach($arr as $a){
                if(!in_array(intval($a['parent_id']),$p_id_array) && ($p_id_array[]=intval($a['parent_id']))!==false)
                    switch($t){
    	                case 'manager':
        	                $b=$this->Category_model->select_where_id(intval($a['parent_id']));
        	                $c=$this->Category_model->select_where_parent_id(intval($a['parent_id']));
                            if(!empty($c) && !in_array(intval($a['parent_id']),$array)){
    	                        $array[]=intval($a['parent_id']);
                                $arr=['p_p_id'=>(!empty($b) && !empty($b['0']) && !empty($b['0']['parent_id'])?intval($b['0']['parent_id']):0),'p_id'=>intval($a['parent_id']),'info'=>$c];
                                $ret.=$this->load->view('category/dashbord/other_manager',['data'=>(!empty($arr)?$arr:[])],true);
                            } 
    	                    break;
    	                case 'other':
    	                    $b=$this->Category_model->select_where_id_and_status(intval($a['parent_id']));
    	                    $c=$this->Category_model->select_where_parent_id_and_status(intval($a['parent_id']));
                            if(!empty($c)) $arr=['p_p_id'=>(!empty($b) && !empty($b['0']) && !empty($b['0']['parent_id'])?intval($b['0']['parent_id']):0),'p_id'=>intval($a['parent_id']),'info'=>$c];
                            $ret.=$this->load->view('category/index',['menu'=>(!empty($arr)?$arr:[])],true);
    	                    break;
    	                default:
    	                    $b=[];
    	                    break;
                    }
            }
        }
        return $ret;
    }
    private function category_another_handler($data){
        $b=[];
        $e='';
        if(!empty($data) && is_array($data)){
            foreach($data as $a){
                if(intval($a['parent_id'])==0){
                    $b[]=$a;
                }
            }
            if(!empty($b)) $e=$this->change_arr_to_tem($this->find_children($b,$data));
        }
        return $e;
    }
    private function find_children($arr,$data){
        $c=$d=[];
        while(!empty($arr)){
            $a=array_shift($arr);
            if(!empty($a) && !empty($a['id'])){
                foreach($data as $b){
                    if(intval($b['parent_id'])==intval($a['id'])){
                        $d[]=$this->find_children($b,$data);
                    }
                }
                $c[]=['info'=>$a,'child'=>$d];
            }
        }
        return $c;
        
    }
    private function change_arr_to_tem($arr){
        $ret='';
        if(!empty($arr) && is_array($arr)){
            $ret.='<ul>';
            foreach($arr as $a){
                if(!empty($a['info'])){
                    $ret.='<li><a class="p-id-'.intval($a['info']['id']).'" onclick="changeParentIdVal(this,'.intval($a['info']['id']).');">'.$a['info']['title'].'</a>';
                    if(!empty($a['child'])) $ret.=$this->change_arr_to_tem($a['child']);
                    $ret.='</li>';
                }
            }
            $ret.='</ul>';
        }
        return $ret;
    }
    public function manager(){
        if(!empty($_POST['token']) && $_POST['token']==='ok')
	        echo $this->manager_show();
	    else
	        echo $this->load->view('errors/404',[],true);
    }
    private function manager_show(){
        $this->category_handler('manager');
        return $this->load->view('category/dashbord/manager',[
	        'mode'=>'manager',
	        'add'=>$this->load->view('category/dashbord/add',[
	            'upload'=>$this->load->view('includes/uploader',['url'=>'assets---svg---category','type'=>'image'],true),
	        ],true),
	        'edit'=>$this->load->view('category/dashbord/edit',[
	            'parent'=>$this->category_another_handler($this->Category_model->all()),
	            'upload'=>$this->load->view('includes/uploader',['url'=>'assets---svg---category','type'=>'image'],true),
	        ],true),
	        'data'=>[
	            'p'=>$this->category_parent,
                'child'=>$this->category_children
	        ]
	    ],true);
    }
    public function company_manager_show(){
        $this->category_handler('other');
        echo $this->load->view('category/dashbord/company_manager',['mode'=>'company_manager_show','data'=>[
            'p'=>$this->category_parent,
            'child'=>$this->category_children]
        ],true);
    }
    public function add_category(){
        $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b=(!empty($_POST['data']['p']) && intval($_POST['data']['p'])>0?intval($_POST['data']['p']):0);
	    $c=(!empty($_POST['data']['f']) && is_string($_POST['data']['f'])?$_POST['data']['f']:'');
	    $d=(!empty($_POST['data']['t']) && is_string($_POST['data']['t'])?$_POST['data']['t']:null);
	    $e=(!empty($_POST['data']['m']) && is_string($_POST['data']['m'])?$_POST['data']['m']:null);
	    $f=(!empty($_POST['data']['d']) && is_string($_POST['data']['d'])?$_POST['data']['d']:'');
	    if(!is_null($a) && !is_null($b) && !is_null($d) && !is_null($e) && $this->Include_model->chapcha($a) && ($g=$this->Category_model->select_where_title($d))!==false)
	        if(!empty($g) && !empty($g['0']) && !empty($g['0']['id']) && intval($g['0']['id'])>0)
	            die('010');
	        else
	            if($this->Category_model->add(['icon'=>$c,'title'=>$d,'parent_id'=>intval($b),'description'=>$f,'status'=>1]))
	                $this->show_function($e);
	            else
	                die('011');
	    else
            die('0');
    }
    public function edit_category(){
        $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b=(!empty($_POST['data']['i']) && intval($_POST['data']['i'])>0?intval($_POST['data']['i']):null);
	    $c=(!empty($_POST['data']['f']) && is_string($_POST['data']['f'])?$_POST['data']['f']:'');
	    $d=(!empty($_POST['data']['t']) && is_string($_POST['data']['t'])?$_POST['data']['t']:null);
	    $e=(!empty($_POST['data']['m']) && is_string($_POST['data']['m'])?$_POST['data']['m']:null);
	    $f=(!empty($_POST['data']['d']) && is_string($_POST['data']['d'])?$_POST['data']['d']:'');
	    $h=(!empty($_POST['data']['pi']) && intval($_POST['data']['pi'])>0?intval($_POST['data']['pi']):0);
	    if(!is_null($a) && !is_null($b) && !is_null($d) && !is_null($e) && 
	    $this->Include_model->chapcha($a) && ($g=$this->Category_model->select_where_title($d))!==false)
	        if($this->check_parent_id(intval($b),intval($h)))
        	    if(!empty($g) && !empty($g['0']) && !empty($g['0']['id']) && intval($g['0']['id'])>0) 
        	        if(intval($b)==intval($g['0']['id']))
        	            if($this->Category_model->edit((!empty($c)?['icon'=>$c,'title'=>$d,'description'=>$f]:['title'=>$d,'description'=>$f]),['id'=>intval($b)]))
        	                $this->show_function($e);
        	            else
        	                die('011');
        	        else
        	            die('010');
        	    else
        	        if($this->Category_model->edit((!empty($c)?['icon'=>$c,'title'=>$d,'description'=>$f]:['title'=>$d,'description'=>$f]),['id'=>intval($b)]))
    	                $this->show_function($e);
    	            else
    	                die('011');
    	    else
    	        die('013');
        else
    	    die('0');
    }
    private function check_parent_id($id,$parent_id){
        if(intval($id)>0){
            while(intval($parent_id)>0){
                if(($a=$this->Category_model->select_where_id(intval($parent_id)))!==false && !empty($a) && !empty($a['0']) && !empty($a['0']['parent_id']))
                    if(intval($a['0']['parent_id'])==intval($id))
                        return false;
                    else
                        $parent_id=intval($a['0']['parent_id']);
                else
                    return false;
            }
            return true;
        }else{
            return false;
        }
    }
    private function show_function($str){
        if(!empty($str) && is_string($str))
            if($str=='manager'){
                echo $this->manager_show();
                exit();
            }elseif($str=='company_manager_show'){
                return $this->company_manager_show();
            }   
        die('0112');
    }
    public function disable_category(){
        $a=(!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b=(!empty($_POST['data']['id']) && intval($_POST['data']['id'])>0?intval($_POST['data']['id']):null);
	    if(!is_null($a) && !is_null($b) && $this->Include_model->chapcha($a) && $this->Category_model->edit(['status'=>0],['id'=>intval($b)]))
	        die('1');
	    die('0');
    }
    public function enable_category(){
        $a=(!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b=(!empty($_POST['data']['id']) && intval($_POST['data']['id'])>0?intval($_POST['data']['id']):null);
	    if(!is_null($a) && !is_null($b) && $this->Include_model->chapcha($a) && $this->Category_model->edit(['status'=>1],['id'=>intval($b)]))
	        die('1');
	    die('0');
    }
    public function remove_category(){
        $a=(!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b=(!empty($_POST['data']['id']) && intval($_POST['data']['id'])>0?intval($_POST['data']['id']):null);
	    $g=(!empty($_POST['data']['m']) && is_string($_POST['data']['m'])?$_POST['data']['m']:null);
	    if(!is_null($a) && !is_null($b) && !is_null($g) && $this->Include_model->chapcha($a) && ($c=$this->Category_model->select_where_parent_id(intval($b)))!==false){
	        if(!empty($c) && ($d=$this->Category_model->select_where_id(intval($b)))!==false && !empty($d) && !empty($d['0']) && !empty($d['0']['id']) && intval($d['0']['id'])>0 && ($e=(!empty($d['0']['parent_id']) && intval($d['0']['parent_id'])>0?intval($d['0']['parent_id']):0))!==false){
    	        foreach($c as $f){
    	            if(!$this->Category_model->edit(['parent_id'=>$e],['id'=>intval($f['id'])]) || !$this->Company_model->edit_category_product_weher_category_id(['category_id'=>$e],intval($f['id'])) || !$this->Product_model->edit_category_weher_category_id(['category_id'=>$e],intval($f['id'])))die('3');
    	        }
    	        if(!$this->Company_model->edit_category_product_weher_category_id(['category_id'=>$e],intval($b)) || !$this->Product_model->edit_category_weher_category_id(['category_id'=>$e],intval($b))) die('3');
	        }
	        if($this->Category_model->remove(intval($b))) $this->show_function($g);
	    }
	    die('0');
    }
}
