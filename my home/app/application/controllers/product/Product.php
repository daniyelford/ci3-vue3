<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Product extends MY_Controller
{
    private $handler;
	public function __construct(){
		parent::__construct();
	}
	public function detail_setting($id){
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])==1 && !empty($id) && intval($id)>0 && ($_SESSION['product_id']=intval($id))!==false){
	        $category=new Category_handler();
        	$company=new Company_handler();
        	$role=new Role_handler();
        	if(($this->id=intval($_SESSION['id']))!== false && ($a=$this->Users_model->select_where_id($this->id))!==false && !empty($a) && !empty($a['0']) &&($b=$this->Users_model->select_info_where_user_id(intval($this->id)))!==false && !empty($b) && !empty($b['0'])){
                if(($c=$this->Order_model->select_wallet_where_user_id(intval($this->id)))!==false && !empty($c) && !empty(end($c))) $_SESSION['my_wallet']=end($c);
                $_SESSION['my_company']=$role->show_my_company_valex(intval($this->id));    
                if(!isset($_SESSION['user_info']) || empty($_SESSION['user_info'])) $_SESSION['user_info']=['image'=>(!empty($b['0']['image'])?$b['0']['image']:''),'name'=>(!empty($b['0']['name'])?$b['0']['name']:''),'family'=>(!empty($b['0']['family'])?$b['0']['family']:''),'role'=>''];
                $has_auth_info_error=(!empty($b['0']['cart_mely_picture']) && !empty($b['0']['mely_code'])?false:true);
            	echo $this->load->view('header',[
                    'category'=>$category->valex_show(),
                	'lang'=>'',
                	'id'=>$this->id,
                	'user_info'=>$_SESSION['user_info'],
                	'lat'=>(!empty($_SESSION['lt'])?$_SESSION['lt']:''),
                	'lon'=>(!empty($_SESSION['ln'])?$_SESSION['ln']:''),
                	'chat'=>false,
                	'has_auth_info_error'=>$has_auth_info_error,
                	'title'=>'مشخصات محصولات'
                ],true).
            	$this->load->view('company/product/one_manage',[
            	    'ty'=>'true',
            	    'category'=>$this->Category_model->select_where_status(),
            	    'product_id'=>intval($id),
            	    'category_selected'=>$this->Product_model->select_category_where_product_id(intval($id)),
            	    'role_id'=>1,
            	    'company_id'=>1,
            	    'uploader'=>$this->load->view('includes/uploader',['url'=>'assets---svg---product','type'=>'image'],true),
            	    'data'=>$this->Product_model->select_product_where_id(intval($id))
                ],true).
            	$this->load->view('footer',[
            	    'my_company'=>$_SESSION['my_company'],
            	    'lang'=>'fa',
            	    'change_lang'=>'true',
            	    'id'=>$this->id
                ],true);
            }
	    }else{
	        header('Location:'.base_url());
	    }
	}
	public function setting($id){
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])==1 && !empty($id) && intval($id)>0 && ($_SESSION['product_id']=intval($id))!==false){
	        $category=new Category_handler();
	        $main=new Main_exploder();
        	$company=new Company_handler();
        	$role=new Role_handler();
        	if(($this->id=intval($_SESSION['id']))!== false && ($a=$this->Users_model->select_where_id($this->id))!==false && !empty($a) && !empty($a['0']) &&($b=$this->Users_model->select_info_where_user_id(intval($this->id)))!==false && !empty($b) && !empty($b['0'])){
                if(($c=$this->Order_model->select_wallet_where_user_id(intval($this->id)))!==false && !empty($c) && !empty(end($c))) $_SESSION['my_wallet']=end($c);
                $_SESSION['my_company']=$role->show_my_company_valex(intval($this->id));    
                if(!isset($_SESSION['user_info']) || empty($_SESSION['user_info'])) $_SESSION['user_info']=['image'=>(!empty($b['0']['image'])?$b['0']['image']:''),'name'=>(!empty($b['0']['name'])?$b['0']['name']:''),'family'=>(!empty($b['0']['family'])?$b['0']['family']:''),'role'=>''];
                $has_auth_info_error=(!empty($b['0']['cart_mely_picture']) && !empty($b['0']['mely_code'])?false:true);
                $main->valex_type='manager';
            	$main->valex_lt=$_SESSION['ln'];
            	$main->valex_ln=$_SESSION['lt'];
                $main->valex_user_id=$this->id;
            	echo $this->load->view('header',[
                    'category'=>$category->valex_show(),
                	'lang'=>'',
                	'id'=>$this->id,
                	'user_info'=>$_SESSION['user_info'],
                	'lat'=>(!empty($_SESSION['lt'])?$_SESSION['lt']:''),
                	'lon'=>(!empty($_SESSION['ln'])?$_SESSION['ln']:''),
                	'chat'=>false,
                	'has_auth_info_error'=>$has_auth_info_error,
                	'title'=>'تنظیمات محصولات'
                ],true).
            	$this->load->view('company/product/setting',[
            	    'ty'=>'true',
            	    'category'=>$this->Category_model->select_where_status(),
            	    'role_id'=>1,
            	    'company_id'=>1,
            	    'p_id'=>intval($id),
            	    'uploader'=>$this->load->view('includes/uploader',['url'=>'assets---svg---product','type'=>'image'],true),
            	    'data'=>$main->valex_product_info(intval($id))
                ],true).
            	$this->load->view('footer',[
            	    'add_map_id'=>intval($id),
            	    'add_map'=>'product',
                    'map'=>'true',
            	    'my_company'=>$_SESSION['my_company'],
            	    'lang'=>'fa',
            	    'change_lang'=>'true',
            	    'id'=>$this->id
                ],true);
            }
	    }else{
	        header('Location:'.base_url());
	    }
	}
	public function valex_disable_product(){
        $company=new Company_handler();
	    $a=(!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b=(!empty($_POST['data']['id']) && intval($_POST['data']['id'])>0?intval($_POST['data']['id']):null);
	    if(!is_null($a) && !is_null($b) && $this->Include_model->chapcha($a) &&
	    !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
	    !empty($_SESSION['comapy_manager_info']['company_user_id']) && intval($_SESSION['comapy_manager_info']['company_user_id'])>0 && 
	    !empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && 
	    !empty($_SESSION['id']) && intval($_SESSION['id'])>0 && 
	    intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && 
	    !empty($_SESSION['comapy_manager_info']['role_id']) && intval($_SESSION['comapy_manager_info']['role_id'])>0 && 
	    (intval(intval($_SESSION['comapy_manager_info']['role_id']))==8||intval($_SESSION['comapy_manager_info']['role_id'])==1||intval($_SESSION['comapy_manager_info']['role_id'])==10||intval($_SESSION['comapy_manager_info']['role_id'])==14) &&
	    !empty($_SESSION['comapy_manager_info']['company_id']) && intval($_SESSION['comapy_manager_info']['company_id'])>0 &&
	    $this->Product_model->edit(['status'=>0],['id'=>intval($b)]))
	        die('ok');
	    die('0');
	}
    public function valex_enable_product(){
        $company=new Company_handler();
	    $a=(!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b=(!empty($_POST['data']['id']) && intval($_POST['data']['id'])>0?intval($_POST['data']['id']):null);
	    if(!is_null($a) && !is_null($b) && $this->Include_model->chapcha($a) &&
	    !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
	    !empty($_SESSION['comapy_manager_info']['company_user_id']) && intval($_SESSION['comapy_manager_info']['company_user_id'])>0 && 
	    !empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && 
	    !empty($_SESSION['id']) && intval($_SESSION['id'])>0 && 
	    intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && 
	    !empty($_SESSION['comapy_manager_info']['role_id']) && intval($_SESSION['comapy_manager_info']['role_id'])>0 && 
	    (intval(intval($_SESSION['comapy_manager_info']['role_id']))==8||intval($_SESSION['comapy_manager_info']['role_id'])==1||intval($_SESSION['comapy_manager_info']['role_id'])==10||intval($_SESSION['comapy_manager_info']['role_id'])==14) &&
	    !empty($_SESSION['comapy_manager_info']['company_id']) && intval($_SESSION['comapy_manager_info']['company_id'])>0 &&
	    $this->Product_model->edit(['status'=>1],['id'=>intval($b)]))
	        die('ok');
	    die('0');
    }
    public function manager_disable_product(){
        $company=new Company_handler();
	    $a=(!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b=(!empty($_POST['data']['id']) && intval($_POST['data']['id'])>0?intval($_POST['data']['id']):null);
	    if(!is_null($a) && !is_null($b) && $this->Include_model->chapcha($a) &&
	    !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
	    !empty($_SESSION['comapy_manager_info']['company_user_id']) && intval($_SESSION['comapy_manager_info']['company_user_id'])>0 && 
	    !empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && 
	    !empty($_SESSION['id']) && intval($_SESSION['id'])>0 && 
	    intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && 
	    !empty($_SESSION['comapy_manager_info']['role_id']) && intval($_SESSION['comapy_manager_info']['role_id'])>0 && 
	    (intval(intval($_SESSION['comapy_manager_info']['role_id']))==8||intval($_SESSION['comapy_manager_info']['role_id'])==1) &&
	    !empty($_SESSION['comapy_manager_info']['company_id']) && intval($_SESSION['comapy_manager_info']['company_id'])>0 &&
	    $this->Product_model->edit(['deleted_at'=>date("Y-m-d H:i:s")],['id'=>intval($b)]))
	        die('ok');
	    die('0');
	}
    public function manager_enable_product(){
        $company=new Company_handler();
	    $a=(!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b=(!empty($_POST['data']['id']) && intval($_POST['data']['id'])>0?intval($_POST['data']['id']):null);
	    if(!is_null($a) && !is_null($b) && $this->Include_model->chapcha($a) &&
	    !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
	    !empty($_SESSION['comapy_manager_info']['company_user_id']) && intval($_SESSION['comapy_manager_info']['company_user_id'])>0 && 
	    !empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && 
	    !empty($_SESSION['id']) && intval($_SESSION['id'])>0 && 
	    intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && 
	    !empty($_SESSION['comapy_manager_info']['role_id']) && intval($_SESSION['comapy_manager_info']['role_id'])>0 && 
	    (intval(intval($_SESSION['comapy_manager_info']['role_id']))==8||intval($_SESSION['comapy_manager_info']['role_id'])==1) &&
	    !empty($_SESSION['comapy_manager_info']['company_id']) && intval($_SESSION['comapy_manager_info']['company_id'])>0 &&
	    $this->Product_model->edit(['deleted_at'=>null],['id'=>intval($b)]))
	        die('ok');
	    die('0');
    }
    public function edit_product(){
        $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !empty($b['t']) && !empty($b['d']) && !empty($b['id']) && intval($b['id'])>0 && 
	    !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
	    !empty($_SESSION['comapy_manager_info']['company_user_id']) && intval($_SESSION['comapy_manager_info']['company_user_id'])>0 && 
	    !empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && 
	    !empty($_SESSION['id']) && intval($_SESSION['id'])>0 && 
	    intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && 
	    !empty($_SESSION['comapy_manager_info']['role_id']) && intval($_SESSION['comapy_manager_info']['role_id'])>0 && 
	    (intval(intval($_SESSION['comapy_manager_info']['role_id']))==8||intval($_SESSION['comapy_manager_info']['role_id'])==1||intval($_SESSION['comapy_manager_info']['role_id'])==10||intval($_SESSION['comapy_manager_info']['role_id'])==14) &&
	    !empty($_SESSION['comapy_manager_info']['company_id']) && intval($_SESSION['comapy_manager_info']['company_id'])>0){
            $data=[];
            $data['title']=$b['t'];
            $data['description']=$b['d'];	
            if(!empty($b['i'])){
                $data['icon']=$b['i'];
            }
            $data['price']=(!empty($b['p'])?intval($b['p']):0);
            if($this->Product_model->edit($data,['id'=>intval($b['id'])])) die('111111111111111');
	    }
	    die('0');
    }
}