<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Product extends MY_Controller
{
    private $handler;
	public function __construct(){
		parent::__construct();
	}
// 	check live
	public function product_company_order_manager(){
	    if(!empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
	    !empty($_SESSION['comapy_manager_info']['company_user_id']) && 
	    intval($_SESSION['comapy_manager_info']['company_user_id'])>0 && 
	    !empty($_SESSION['comapy_manager_info']['user_id']) && 
	    intval($_SESSION['comapy_manager_info']['user_id'])>0 &&
	    !empty($_SESSION['id']) && intval($_SESSION['id'])>0 && 
	    intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && 
	    !empty($_SESSION['comapy_manager_info']['role_id']) && intval($_SESSION['comapy_manager_info']['role_id'])>0 && 
	    (intval($_SESSION['comapy_manager_info']['role_id'])===1 || intval($_SESSION['comapy_manager_info']['role_id'])===8 || intval($_SESSION['comapy_manager_info']['role_id'])===10) &&
	    !empty($_SESSION['comapy_manager_info']['company_role_id']) && intval($_SESSION['comapy_manager_info']['company_role_id'])>0 &&
	    !empty($_SESSION['comapy_manager_info']['company_id']) && intval($_SESSION['comapy_manager_info']['company_id'])>0){
	        $category=new Category_handler();
	        $main=new Main_exploder();
        	$company=new Company_handler();
        	$role=new Role_handler();
	        $user_company_action=$company->user_company_action(intval($_SESSION['comapy_manager_info']['company_id']),intval($_SESSION['comapy_manager_info']['company_user_id']));
        	if(($this->id=intval($_SESSION['id']))!== false && ($a=$this->Users_model->select_where_id($this->id))!==false && !empty($a) && !empty($a['0']) &&($b=$this->Users_model->select_info_where_user_id(intval($this->id)))!==false && !empty($b) && !empty($b['0'])){
                if(($c=$this->Order_model->select_wallet_where_user_id(intval($this->id)))!==false && !empty($c) && !empty(end($c))) $_SESSION['my_wallet']=end($c);
                $_SESSION['my_company']=$role->show_my_company_valex(intval($this->id));    
                if(!isset($_SESSION['user_info']) || empty($_SESSION['user_info'])) $_SESSION['user_info']=['image'=>(!empty($b['0']['image'])?$b['0']['image']:''),'name'=>(!empty($b['0']['name'])?$b['0']['name']:''),'family'=>(!empty($b['0']['family'])?$b['0']['family']:''),'role'=>''];
                $has_auth_info_error=(!empty($b['0']['cart_mely_picture']) && !empty($b['0']['mely_code'])?false:true);
                $main->valex_type='manager';
            	$main->valex_lt=$_SESSION['ln'];
            	$main->valex_ln=$_SESSION['lt'];
                $main->valex_user_id=$this->id;
                $data=$access_product_id=[];
                if(!empty($user_company_action) && !empty($user_company_action['products']) && 
                !empty($user_company_action['products']['access'])){
                    foreach($user_company_action['products']['access'] as $access_pro){
                        if(!empty($access_pro) && !empty($access_pro['product_id']) && 
                        intval($access_pro['product_id'])>0 && 
                        !in_array(intval($access_pro['product_id']),$access_product_id))
                            $access_product_id[]=intval($access_pro['product_id']);
                    }
                }
                $d=$company->company_product_list(intval($_SESSION['comapy_manager_info']['company_id']));
                foreach($d as $e){
                    if(!empty($e) && intval($e)>0 && in_array(intval($e),$access_product_id) && 
                    ($f=$main->valex_product_info_manager(intval($e)))!==false && !empty($f) && !empty($f['info']))
                        $data[]=$f;
                }
            	echo $this->load->view('header',[
                    'category'=>$category->valex_show(),
                	'lang'=>'',
                	'id'=>$this->id,
                	'user_info'=>$_SESSION['user_info'],
                	'lat'=>(!empty($_SESSION['lt'])?$_SESSION['lt']:''),
                	'lon'=>(!empty($_SESSION['ln'])?$_SESSION['ln']:''),
                	'chat'=>false,
                	'has_auth_info_error'=>$has_auth_info_error,
                	'title'=>'سفارش محصولات'
                ],true).
            	$this->load->view('company/product/order',[
                    'category'=>$this->Category_model->select_where_status(),
            	    'role_id'=>intval($_SESSION['comapy_manager_info']['role_id']),
            	    'company_id'=>intval($_SESSION['comapy_manager_info']['company_id']),
            	    'product_logo_uploader'=>$this->load->view('includes/uploader',['url'=>'assets---svg---product','type'=>'image'],true),
            	    'data'=>$data
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
	    exit();
	}
// 	check live
	public function add_product_relation(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) &&
	    !empty($b) && !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
        !empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && 
    	intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && 
    	!empty($_SESSION['comapy_manager_info']['company_user_id']) && intval($_SESSION['comapy_manager_info']['company_user_id'])>0 &&
    	!empty($_SESSION['comapy_manager_info']['role_id']) && intval($_SESSION['comapy_manager_info']['role_id'])>0 && 
    	(intval($_SESSION['comapy_manager_info']['role_id'])===1 || intval($_SESSION['comapy_manager_info']['role_id'])===8 || intval($_SESSION['comapy_manager_info']['role_id'])===10 || intval($_SESSION['comapy_manager_info']['role_id'])===14) &&
    	!empty($_SESSION['comapy_manager_info']['company_id']) && intval($_SESSION['comapy_manager_info']['company_id'])>0 &&
    	!empty($_SESSION['product_id']) && intval($_SESSION['product_id'])>0 && 
    	!empty($b["zarib"]) && (intval($b["zarib"])>0||is_numeric($b["zarib"]))){
            $data=[];
            $data['product_id']=intval($_SESSION['product_id']);
    	    $data['zarib']=$b['zarib'];
            if(!empty($b['description'])){
                $data['description']=$b['description'];
            }
    	    if(!empty($b["productPriceId"]) && intval($b["productPriceId"])>0){
    	        $data['product_price_id']=intval($b["productPriceId"]);
    	        $data['auto_change']=1;
    	    }elseif(!empty($b["price"]) && (intval($b["price"])>0||is_numeric($b["price"]))){
    	        $data['price']=$b["price"];
    	    }else{
    	        die('0');
    	    }
    	    if(($r_id=$this->Product_model->add_relation_return_id($data))!==false && !empty($r_id) && intval($r_id)>0){
        	    $d=$this->Product_model->select_product_relation_where_array(['product_id'=>intval($_SESSION['product_id']),'status'=>1]);
        	    $price=0;
        	    foreach($d as $e){
        	        if(!empty($e) && !empty($e['zarib']))
        	            if(!empty($e['auto_change']) && intval($e['auto_change'])>0 && 
        	            !empty($e['product_price_id']) && intval($e['product_price_id'])>0 && 
        	            ($f=$this->Product_model->select_product_where_id(intval($e['product_price_id'])))!==false && 
        	            !empty($f) && !empty($f['0']) && !empty($f['0']['price'])){
        	                $price+=$f['0']['price']*$e['zarib'];
        	            }else{
        	                if(!empty($e['price'])) $price+=$e['price']*$e['zarib'];
        	            }
        	    }
    	        $price+=$price/10;
    	        if($this->Product_model->edit(['price'=>$price],['id'=>intval($_SESSION['product_id'])])) die("countId[".$b['num']."]=".intval($r_id).";");
    	        die('0');
    	    }
    	}
        die('0');
	}
	public function disable_product_relation(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) &&
	    !empty($b['id']) && intval($b['id'])>0 && !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
        !empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && 
    	intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && 
    	!empty($_SESSION['comapy_manager_info']['company_user_id']) && intval($_SESSION['comapy_manager_info']['company_user_id'])>0 &&
    	!empty($_SESSION['comapy_manager_info']['role_id']) && intval($_SESSION['comapy_manager_info']['role_id'])>0 && 
    	(intval($_SESSION['comapy_manager_info']['role_id'])===1 || intval($_SESSION['comapy_manager_info']['role_id'])===8 || intval($_SESSION['comapy_manager_info']['role_id'])===10 || intval($_SESSION['comapy_manager_info']['role_id'])===14) &&
    	!empty($_SESSION['comapy_manager_info']['company_id']) && intval($_SESSION['comapy_manager_info']['company_id'])>0 &&
    	!empty($_SESSION['product_id']) && intval($_SESSION['product_id'])>0 &&
    	$this->Product_model->edit_relation(['status'=>0],['id'=>intval($b['id'])])){
    	    $d=$this->Product_model->select_product_relation_where_array(['product_id'=>intval($_SESSION['product_id']),'status'=>1]);
    	    $price=0;
    	    foreach($d as $e){
    	        if(!empty($e) && !empty($e['zarib']))
    	            if(!empty($e['auto_change']) && intval($e['auto_change'])>0 && 
    	            !empty($e['product_price_id']) && intval($e['product_price_id'])>0 && 
    	            ($f=$this->Product_model->select_product_where_id(intval($e['product_price_id'])))!==false && 
    	            !empty($f) && !empty($f['0']) && !empty($f['0']['price'])){
    	                $price+=$f['0']['price']*$e['zarib'];
    	            }else{
    	                if(!empty($e['price'])) $price+=$e['price']*$e['zarib'];
    	            }
    	    }
	        $price+=$price/10;
	        if($this->Product_model->edit(['price'=>$price],['id'=>intval($_SESSION['product_id'])])) die('ok');
	        die('0');
    	}
    	die('0');
	}
	public function enable_product_relation(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) &&
	    !empty($b['id']) && intval($b['id'])>0 && !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
        !empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && 
    	intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && 
    	!empty($_SESSION['comapy_manager_info']['company_user_id']) && intval($_SESSION['comapy_manager_info']['company_user_id'])>0 &&
    	!empty($_SESSION['comapy_manager_info']['role_id']) && intval($_SESSION['comapy_manager_info']['role_id'])>0 && 
    	(intval($_SESSION['comapy_manager_info']['role_id'])===1 || intval($_SESSION['comapy_manager_info']['role_id'])===8 || intval($_SESSION['comapy_manager_info']['role_id'])===10 || intval($_SESSION['comapy_manager_info']['role_id'])===14) &&
    	!empty($_SESSION['comapy_manager_info']['company_id']) && intval($_SESSION['comapy_manager_info']['company_id'])>0 &&
    	!empty($_SESSION['product_id']) && intval($_SESSION['product_id'])>0 &&
        $this->Product_model->edit_relation(['status'=>1],['id'=>intval($b['id'])])){
    	    $d=$this->Product_model->select_product_relation_where_array(['product_id'=>intval($_SESSION['product_id']),'status'=>1]);
    	    $price=0;
    	    foreach($d as $e){
    	        if(!empty($e) && !empty($e['zarib']))
    	            if(!empty($e['auto_change']) && intval($e['auto_change'])>0 && 
    	            !empty($e['product_price_id']) && intval($e['product_price_id'])>0 && 
    	            ($f=$this->Product_model->select_product_where_id(intval($e['product_price_id'])))!==false && 
    	            !empty($f) && !empty($f['0']) && !empty($f['0']['price'])){
    	                $price+=$f['0']['price']*$e['zarib'];
    	            }else{
    	                if(!empty($e['price'])) $price+=$e['price']*$e['zarib'];
    	            }
    	    }
	        $price+=$price/10;
	        if($this->Product_model->edit(['price'=>$price],['id'=>intval($_SESSION['product_id'])])) die('ok');
	        die('0');
    	}
    	die('0');
	}
	public function remove_product_relation(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) &&
	    !empty($b['id']) && intval($b['id'])>0 && !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
        !empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && 
    	intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && 
    	!empty($_SESSION['comapy_manager_info']['company_user_id']) && intval($_SESSION['comapy_manager_info']['company_user_id'])>0 &&
    	!empty($_SESSION['comapy_manager_info']['role_id']) && intval($_SESSION['comapy_manager_info']['role_id'])>0 && 
    	(intval($_SESSION['comapy_manager_info']['role_id'])===1 || intval($_SESSION['comapy_manager_info']['role_id'])===8 || intval($_SESSION['comapy_manager_info']['role_id'])===10 || intval($_SESSION['comapy_manager_info']['role_id'])===14) &&
    	!empty($_SESSION['comapy_manager_info']['company_id']) && intval($_SESSION['comapy_manager_info']['company_id'])>0 &&
    	!empty($_SESSION['product_id']) && intval($_SESSION['product_id'])>0 &&
    	$this->Product_model->remove_relation(intval($b['id']))){
    	    $d=$this->Product_model->select_product_relation_where_array(['product_id'=>intval($_SESSION['product_id']),'status'=>1]);
    	    $price=0;
    	    foreach($d as $e){
    	        if(!empty($e) && !empty($e['zarib']))
    	            if(!empty($e['auto_change']) && intval($e['auto_change'])>0 && 
    	            !empty($e['product_price_id']) && intval($e['product_price_id'])>0 && 
    	            ($f=$this->Product_model->select_product_where_id(intval($e['product_price_id'])))!==false && 
    	            !empty($f) && !empty($f['0']) && !empty($f['0']['price'])){
    	                $price+=$f['0']['price']*$e['zarib'];
    	            }else{
    	                if(!empty($e['price'])) $price+=$e['price']*$e['zarib'];
    	            }
    	    }
	        $price+=$price/10;
	        if($this->Product_model->edit(['price'=>$price],['id'=>intval($_SESSION['product_id'])]))die('ok');
	        die('0');
    	}
    	die('0');
	}
	public function delete_key(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) &&
	    !empty($b['id']) && intval($b['id'])>0 && !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
    	!empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && 
    	intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && 
    	!empty($_SESSION['comapy_manager_info']['company_user_id']) && intval($_SESSION['comapy_manager_info']['company_user_id'])>0 &&
    	!empty($_SESSION['comapy_manager_info']['role_id']) && intval($_SESSION['comapy_manager_info']['role_id'])>0 && 
    	(intval($_SESSION['comapy_manager_info']['role_id'])===1 || intval($_SESSION['comapy_manager_info']['role_id'])===8 || intval($_SESSION['comapy_manager_info']['role_id'])===10 || intval($_SESSION['comapy_manager_info']['role_id'])===14) &&
    	!empty($_SESSION['comapy_manager_info']['company_id']) && intval($_SESSION['comapy_manager_info']['company_id'])>0 &&
    	$this->Product_model->remove_key(intval($b['id'])))
    	    die('ok');
	    die('0');
	}
	public function disable_key(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !empty($b['id']) && intval($b['id'])>0 && !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
    	!empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && 
    	intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && 
    	!empty($_SESSION['comapy_manager_info']['company_user_id']) && intval($_SESSION['comapy_manager_info']['company_user_id'])>0 &&
    	!empty($_SESSION['comapy_manager_info']['role_id']) && intval($_SESSION['comapy_manager_info']['role_id'])>0 && 
    	(intval($_SESSION['comapy_manager_info']['role_id'])===1 || intval($_SESSION['comapy_manager_info']['role_id'])===8 || intval($_SESSION['comapy_manager_info']['role_id'])===10 || intval($_SESSION['comapy_manager_info']['role_id'])===14) &&
    	!empty($_SESSION['comapy_manager_info']['company_id']) && intval($_SESSION['comapy_manager_info']['company_id'])>0 &&
        $this->Product_model->edit_product_key(['status'=>0],['id'=>intval($b['id'])])) 
            die('ok');
	    die('0');
	}
	public function enable_key(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !empty($b['id']) && intval($b['id'])>0 && !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
    	!empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && 
    	intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && 
    	!empty($_SESSION['comapy_manager_info']['company_user_id']) && intval($_SESSION['comapy_manager_info']['company_user_id'])>0 &&
    	!empty($_SESSION['comapy_manager_info']['role_id']) && intval($_SESSION['comapy_manager_info']['role_id'])>0 && 
    	(intval($_SESSION['comapy_manager_info']['role_id'])===1 || intval($_SESSION['comapy_manager_info']['role_id'])===8 || intval($_SESSION['comapy_manager_info']['role_id'])===10 || intval($_SESSION['comapy_manager_info']['role_id'])===14) &&
        !empty($_SESSION['comapy_manager_info']['company_id']) && intval($_SESSION['comapy_manager_info']['company_id'])>0 &&
        $this->Product_model->edit_product_key(['status'=>1],['id'=>intval($b['id'])])) 
            die('ok');
	    die('0');
	}
	public function edit_key(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !empty($b['id']) && intval($b['id'])>0 && !empty($b['t']) && !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
    	!empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && 
    	intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && 
    	!empty($_SESSION['comapy_manager_info']['company_user_id']) && intval($_SESSION['comapy_manager_info']['company_user_id'])>0 &&
    	!empty($_SESSION['comapy_manager_info']['role_id']) && intval($_SESSION['comapy_manager_info']['role_id'])>0 && 
        (intval($_SESSION['comapy_manager_info']['role_id'])===1 || intval($_SESSION['comapy_manager_info']['role_id'])===8 || intval($_SESSION['comapy_manager_info']['role_id'])===10 || intval($_SESSION['comapy_manager_info']['role_id'])===14) &&
        !empty($_SESSION['comapy_manager_info']['company_id']) && intval($_SESSION['comapy_manager_info']['company_id'])>0 &&
        $this->Product_model->edit_product_key(['title'=>$b['t']],['id'=>intval($b['id'])]))
            die('ok');
	    die('0');
	}
	public function edit_value(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !empty($b['id']) && intval($b['id'])>0 && !empty($b['t']) && !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
    	!empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && 
    	intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && 
    	!empty($_SESSION['comapy_manager_info']['company_user_id']) && intval($_SESSION['comapy_manager_info']['company_user_id'])>0 &&
    	!empty($_SESSION['comapy_manager_info']['role_id']) && intval($_SESSION['comapy_manager_info']['role_id'])>0 && 
    	(intval($_SESSION['comapy_manager_info']['role_id'])===1 || intval($_SESSION['comapy_manager_info']['role_id'])===8 || intval($_SESSION['comapy_manager_info']['role_id'])===10 || intval($_SESSION['comapy_manager_info']['role_id'])===14) &&
    	!empty($_SESSION['comapy_manager_info']['company_id']) && intval($_SESSION['comapy_manager_info']['company_id'])>0 &&
        $this->Product_model->edit_product_value(['title'=>$b['t']],['id'=>intval($b['id'])])) 
            die('ok');
	    die('0');
	}
    public function add_key_value(){
        $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !empty($b['pId']) && intval($b['pId'])>0 && !empty($b['key']) && !empty($b['value']) && !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
    	!empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && 
    	intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && 
    	!empty($_SESSION['comapy_manager_info']['company_user_id']) && intval($_SESSION['comapy_manager_info']['company_user_id'])>0 &&
    	!empty($_SESSION['comapy_manager_info']['company_id']) && intval($_SESSION['comapy_manager_info']['company_id'])>0 &&
    	!empty($_SESSION['comapy_manager_info']['role_id']) && intval($_SESSION['comapy_manager_info']['role_id'])>0 && 
    	(intval($_SESSION['comapy_manager_info']['role_id'])===1 || intval($_SESSION['comapy_manager_info']['role_id'])===8 || intval($_SESSION['comapy_manager_info']['role_id'])===10 || intval($_SESSION['comapy_manager_info']['role_id'])===14) &&
    	($c=$this->Product_model->add_product_key_return_id(['product_id'=>intval($b['pId']),'title'=>$b['key'],'key'=>'']))!==false &&
        $this->Product_model->add_product_value(['product_key_id'=>$c,'product_id'=>intval($b['pId']),'title'=>$b['value']]))
    	    die('111');
	    die('0');
	}
	public function remove_map(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !empty($b['id']) && intval($b['id'])>0  && !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
    	!empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && 
        intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && 
    	!empty($_SESSION['comapy_manager_info']['company_user_id']) && intval($_SESSION['comapy_manager_info']['company_user_id'])>0 &&
    	!empty($_SESSION['comapy_manager_info']['company_id']) && intval($_SESSION['comapy_manager_info']['company_id'])>0 &&
    	!empty($_SESSION['comapy_manager_info']['role_id']) && intval($_SESSION['comapy_manager_info']['role_id'])>0 && 
    	(intval($_SESSION['comapy_manager_info']['role_id'])===1 || intval($_SESSION['comapy_manager_info']['role_id'])===8 || intval($_SESSION['comapy_manager_info']['role_id'])===10 || intval($_SESSION['comapy_manager_info']['role_id'])===14) &&
        $this->Product_model->remove_map(intval($b['id'])))
            die('111');
        die('0');
	}
	public function add_map(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !empty($b['lat']) && !empty($b['lon']) && !empty($b['title']) && !empty($b['id']) && intval($b['id'])>0 && !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
    	!empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && 
    	intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && 
    	!empty($_SESSION['comapy_manager_info']['company_user_id']) && intval($_SESSION['comapy_manager_info']['company_user_id'])>0 &&
    	!empty($_SESSION['comapy_manager_info']['company_id']) && intval($_SESSION['comapy_manager_info']['company_id'])>0 &&
    	!empty($_SESSION['comapy_manager_info']['role_id']) && intval($_SESSION['comapy_manager_info']['role_id'])>0 && 
    	(intval($_SESSION['comapy_manager_info']['role_id'])===1 || intval($_SESSION['comapy_manager_info']['role_id'])===8 || intval($_SESSION['comapy_manager_info']['role_id'])===10 || intval($_SESSION['comapy_manager_info']['role_id'])===14) &&
            $this->Product_model->add_map(['product_id'=>intval($b['id']),'lat'=>$b['lat'],'lon'=>$b['lon'],'title'=>$b['title']]))die('111');
        die('0');
	}
	private function random_string(){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 10; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
	}
	public function add_video(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !empty($b['i']) && !empty($b['pId']) && intval($b['pId'])>0 && !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
        !empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && 
    	intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && 
    	!empty($_SESSION['comapy_manager_info']['role_id']) && intval($_SESSION['comapy_manager_info']['role_id'])>0 &&
        (intval($_SESSION['comapy_manager_info']['role_id'])===1 || intval($_SESSION['comapy_manager_info']['role_id'])===8 || intval($_SESSION['comapy_manager_info']['role_id'])===10 || intval($_SESSION['comapy_manager_info']['role_id'])===14) &&
        $this->Product_model->add_video(['address'=>$b['i'],'product_id'=>intval($b['pId'])])) 
            die('111');
	    die('0');
	}
    public function remove_video(){
        $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !empty($b['id']) && intval($b['id'])>0 && !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
    	!empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && 
    	intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && 
    	!empty($_SESSION['comapy_manager_info']['company_user_id']) && intval($_SESSION['comapy_manager_info']['company_user_id'])>0 &&
    	!empty($_SESSION['comapy_manager_info']['role_id']) && intval($_SESSION['comapy_manager_info']['role_id'])>0 && 
    	!empty($_SESSION['comapy_manager_info']['company_id']) && intval($_SESSION['comapy_manager_info']['company_id'])>0 &&
    	(intval($_SESSION['comapy_manager_info']['role_id'])===1 || intval($_SESSION['comapy_manager_info']['role_id'])===8 || intval($_SESSION['comapy_manager_info']['role_id'])===10 || intval($_SESSION['comapy_manager_info']['role_id'])===14) &&
        ($c=$this->Product_model->select_video_where_id(intval($b['id'])))!==false && !empty($c) && !empty($c['0']) && !empty($c['0']['address']) &&
            $this->Product_model->remove_video(intval($b['id'])) && $this->Include_model->remove_file('./assets/video/product/'.$c['0']['address']))
            die('11');
        die('0');
    }
    public function add_image(){
        $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !empty($b['i']) && !empty($b['pId']) && intval($b['pId'])>0 &&
	    !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
    	!empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && 
    	intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && 
    	!empty($_SESSION['comapy_manager_info']['role_id']) && intval($_SESSION['comapy_manager_info']['role_id'])>0 &&
    	(intval($_SESSION['comapy_manager_info']['role_id'])===1 || intval($_SESSION['comapy_manager_info']['role_id'])===8 || intval($_SESSION['comapy_manager_info']['role_id'])===10 || intval($_SESSION['comapy_manager_info']['role_id'])===14) &&
        $this->Product_model->add_image(['address'=>$b['i'],'product_id'=>intval($b['pId'])])) 
            die('111');
	    die('0');
    }
    public function remove_image(){
        $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !empty($b['id']) && intval($b['id'])>0 && !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
    	!empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && 
    	intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && 
    	!empty($_SESSION['comapy_manager_info']['company_user_id']) && intval($_SESSION['comapy_manager_info']['company_user_id'])>0 &&
    	!empty($_SESSION['comapy_manager_info']['role_id']) && intval($_SESSION['comapy_manager_info']['role_id'])>0 && 
    	!empty($_SESSION['comapy_manager_info']['company_id']) && intval($_SESSION['comapy_manager_info']['company_id'])>0 &&
    	(intval($_SESSION['comapy_manager_info']['role_id'])===1 || intval($_SESSION['comapy_manager_info']['role_id'])===8 || intval($_SESSION['comapy_manager_info']['role_id'])===10 || intval($_SESSION['comapy_manager_info']['role_id'])===14) &&
        ($c=$this->Product_model->select_image_where_id(intval($b['id'])))!==false && !empty($c) && !empty($c['0']) && !empty($c['0']['address']) &&
        $this->Product_model->remove_image(intval($b['id'])) && $this->Include_model->remove_file('./assets/pic/product/'.$c['0']['address'])) 
            die('11');
        die('0');
    }
    public function product_company_manager(){
        if(!empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
        !empty($_SESSION['comapy_manager_info']['company_user_id']) && intval($_SESSION['comapy_manager_info']['company_user_id'])>0 && 
        !empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && !empty($_SESSION['id']) && 
        intval($_SESSION['id'])>0 && intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && 
        !empty($_SESSION['comapy_manager_info']['role_id']) && intval($_SESSION['comapy_manager_info']['role_id'])>0 && 
        !empty($_SESSION['comapy_manager_info']['company_id']) && intval($_SESSION['comapy_manager_info']['company_id'])>0 &&
        !empty($_SESSION['comapy_manager_info']['company_role_id']) && intval($_SESSION['comapy_manager_info']['company_role_id'])>0 &&
        (intval($_SESSION['comapy_manager_info']['role_id'])===1 || intval($_SESSION['comapy_manager_info']['role_id'])===8 || intval($_SESSION['comapy_manager_info']['role_id'])===10 || intval($_SESSION['comapy_manager_info']['role_id'])===14)){
            $category=new Category_handler();
        	$company=new Company_handler();
        	$role=new Role_handler();
        	$main=new Main_exploder();
            $main->valex_type='user';
            $main->valex_lt=$_SESSION['ln'];
            $main->valex_ln=$_SESSION['lt'];
            $main->valex_user_id=$this->id;
            $main->valex_category_main_exploder(0);
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
                	'title'=>'مدیریت محصولات'
                ],true).
            	$this->load->view('company/product/index',[
                    'category'=>$this->Category_model->select_where_status(),
            	    'role_id'=>intval($_SESSION['comapy_manager_info']['role_id']),
            	    'company_id'=>intval($_SESSION['comapy_manager_info']['company_id']),
            	    'other_product_price'=>$main->valex_show_product_without_company_position_in_category,
            	    'product_logo_uploader'=>$this->load->view('includes/uploader',['url'=>'assets---svg---product','type'=>'image'],true),
            	    'data'=>$company->user_company_action(intval($_SESSION['comapy_manager_info']['company_id']),intval($_SESSION['comapy_manager_info']['company_user_id']))
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
	    exit();
    }
	private $id=0;
	private function generate_qrcode($data){
	    $hex_data   = bin2hex($data);
        $this->load->library('ciqrcode');
        $params['data'] = $data;
        $params['level'] = 'H';
        $params['size'] = 10;
        $params['savename'] = FCPATH.'assets/qrcode/'.$hex_data.'.png';
        $this->ciqrcode->generate($params);
        return $hex_data.'.png';
    }
	public function add(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !empty($b['t']) && !empty($b['d']) && !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
    	!empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && 
    	intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && 
    	!empty($_SESSION['comapy_manager_info']['company_user_id']) && intval($_SESSION['comapy_manager_info']['company_user_id'])>0 &&
    	!empty($_SESSION['comapy_manager_info']['company_id']) && intval($_SESSION['comapy_manager_info']['company_id'])>0 &&
    	!empty($_SESSION['comapy_manager_info']['role_id']) && intval($_SESSION['comapy_manager_info']['role_id'])>0 && 
    	(intval($_SESSION['comapy_manager_info']['role_id'])===1 || intval($_SESSION['comapy_manager_info']['role_id'])===8 || intval($_SESSION['comapy_manager_info']['role_id'])===10 || intval($_SESSION['comapy_manager_info']['role_id'])===14)){
    	    $company=new Company_handler();
    	    $key='';
    	    $c=true;
    	    while($c){
    	        $key.=$this->random_string();
        	    $d=$this->Product_model->select_product_where_key($key);
        	    if(!(!empty($d) && !empty($d['0']))) $c=false;
    	    }
        	$p_id=$this->Product_model->add_return_id([
                'title'=>$b['t'],	
                'icon'=>(!empty($b['i'])?$b['i']:''),
                'key'=>$key,
                'description'=>$b['d'],	
                'price'=>(!empty($b['p'])?$b['p']:(!empty($b['prp'])?$b['prp']:'')),
            ]);
        	$this->Product_model->edit(['qr_code'=>$this->generate_qrcode(base_url('product/'.$p_id))],['id'=>$p_id]);
            $ccpp_id=$this->Position_model->add_company_category_return_id([
                'product_id'=>intval($p_id),
                'company_id'=>intval($_SESSION['comapy_manager_info']['company_id']),	
                'position_id'=>0,	
                'category_id'=>(!empty($b['c']) && intval($b['c'])>0?intval($b['c']):0),
            ]);
            $this->Company_model->add_access([
                'company_user_id'=>intval($_SESSION['comapy_manager_info']['company_user_id']),	
                'company_category_product'=>intval($ccpp_id),	
                'is_position'=>0,	
                'status'=>1
            ]);
            if(!empty($b['rp'])){
                foreach($b['rp'] as $e){
                    if(!empty($e) && !empty($e['3'])){
                        $data=[];
                        $data['product_id']=intval($p_id);
                        $data['zarib']=$e['3'];
                        if(!empty($e['2'])) $data['description']=$e['2'];
                        if(!empty($e['0']) && intval($e['0'])>0){
                            $data['product_price_id']=$e['0'];
                            $data['auto_change']=1;
                        }else{
                            if(!empty($e['1'])) $data['price']=$e['1']; else $data['price']=0;
                        }
                        $this->Product_model->add_relation($data);
                    }
                }
            }
    	    die('111');
	    }
	    die('0');
    }
    public function edit(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !empty($b['t']) && !empty($b['d']) && !empty($b['id']) && intval($b['id'])>0 &&
	    !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
    	!empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && 
    	intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && 
    	!empty($_SESSION['comapy_manager_info']['company_user_id']) && intval($_SESSION['comapy_manager_info']['company_user_id'])>0 &&
    	!empty($_SESSION['comapy_manager_info']['company_id']) && intval($_SESSION['comapy_manager_info']['company_id'])>0 && 
    	!empty($_SESSION['comapy_manager_info']['role_id']) && intval($_SESSION['comapy_manager_info']['role_id'])>0 && 
    	(intval($_SESSION['comapy_manager_info']['role_id'])===1 || intval($_SESSION['comapy_manager_info']['role_id'])===8 || intval($_SESSION['comapy_manager_info']['role_id'])===10 || intval($_SESSION['comapy_manager_info']['role_id'])===14) &&
    	!empty($_SESSION['product_id']) && intval($_SESSION['product_id'])>0)
        	if(intval($_SESSION['product_id'])===intval($b['id'])){
        	    $company=new Company_handler();
        	    $main=new Main_exploder();
                $main->valex_type='user';
                $main->valex_lt=$_SESSION['ln'];
                $main->valex_ln=$_SESSION['lt'];
                $main->valex_user_id=$this->id;
                $main->valex_category_main_exploder(0);
                $data=[];
                $data['title']=$b['t'];
                $data['description']=$b['d'];	
                if(!empty($b['i'])){
                    $data['icon']=$b['i'];
                }
                $data['qr_code']=$this->generate_qrcode(base_url('product/'.intval($b['id'])));
                $data['price']=(!empty($b['p'])?intval($b['p']):0);
                if(($c=$this->Product_model->select_product_where_id(intval($b['id'])))!==false && !empty($c) && !empty($c['0'])){
            	    if(intval($b['p'])!==intval($c['0']['price'])){
            	        $this->Product_model->add_product_change_value([
                            'product_id'=>intval($b['id']),
                            'is_costum'=>1,
                            'user_id'=>intval($_SESSION['id']),
                            'old_value'=>(!empty($c['0']['price'])?intval($c['0']['price']):0),
                            'new_value'=>(!empty($b['p'])?intval($b['p']):0)
            	        ]);
            	    }
            	    if(($x=$this->Product_model->select_category_where_product_id(intval($b['id'])))!==false)
            	        if(!empty($x) && !empty($x['0'])){
            	            if($this->Product_model->edit($data,['id'=>intval($b['id'])]) &&
                            $this->Position_model->edit_company([
                                'company_id'=>intval($_SESSION['comapy_manager_info']['company_id']),
                                'category_id'=>(!empty($b['c']) && intval($b['c'])>0?intval($b['c']):0)
                            ],[
                                'product_id'=>intval($b['id'])
                            ]))
                                die('1111111111111111');
                            }else{
                                if($this->Position_model->add_company_category([
                                    'company_id'=>intval($_SESSION['comapy_manager_info']['company_id']),
                                    'category_id'=>(!empty($b['c']) && intval($b['c'])>0?intval($b['c']):0),
                                    'product_id'=>intval($b['id'])]))
                                    die('1111111111111111');
                            }
                    }
            }else{
    	        die('10');
    	    }
	    die('0');
    }
    public function add_tel(){
        $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !empty($b['tel']) && !empty($b['des']) && !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
    	!empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && 
    	intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && 
    	!empty($_SESSION['comapy_manager_info']['company_user_id']) && intval($_SESSION['comapy_manager_info']['company_user_id'])>0 &&
    	!empty($_SESSION['comapy_manager_info']['company_id']) && intval($_SESSION['comapy_manager_info']['company_id'])>0 && 
    	!empty($_SESSION['comapy_manager_info']['role_id']) && intval($_SESSION['comapy_manager_info']['role_id'])>0 &&
    	(intval($_SESSION['comapy_manager_info']['role_id'])===1 || intval($_SESSION['comapy_manager_info']['role_id'])===8 || intval($_SESSION['comapy_manager_info']['role_id'])===10 || intval($_SESSION['comapy_manager_info']['role_id'])===14) &&
    	!empty($_SESSION['product_id']) && intval($_SESSION['product_id'])>0 &&
    	    $this->Product_model->add_product_tel(['product_id'=>intval($_SESSION['product_id']),'tel'=>$b['tel'],'description'=>$b['des']])) die('111');
	    die('0');
    }
    public function disable_tel(){
        $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !empty($b['id']) && intval($b['id'])>0 && !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
    	!empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && 
    	intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && 
    	!empty($_SESSION['comapy_manager_info']['company_user_id']) && intval($_SESSION['comapy_manager_info']['company_user_id'])>0 &&
    	!empty($_SESSION['comapy_manager_info']['company_id']) && intval($_SESSION['comapy_manager_info']['company_id'])>0 && 
    	!empty($_SESSION['comapy_manager_info']['role_id']) && intval($_SESSION['comapy_manager_info']['role_id'])>0 &&
    	(intval($_SESSION['comapy_manager_info']['role_id'])===1 || intval($_SESSION['comapy_manager_info']['role_id'])===8 || intval($_SESSION['comapy_manager_info']['role_id'])===10 || intval($_SESSION['comapy_manager_info']['role_id'])===14) &&
    	!empty($_SESSION['product_id']) && intval($_SESSION['product_id'])>0 &&
    	$this->Product_model->edit_tel(['status'=>0],['id'=>intval($b['id'])]))
    	   die('ok');
	    die('0');
    }
    public function enable_tel(){
        $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !empty($b['id']) && intval($b['id'])>0 && !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
    	!empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && 
    	intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && 
    	!empty($_SESSION['comapy_manager_info']['company_user_id']) && intval($_SESSION['comapy_manager_info']['company_user_id'])>0 &&
    	!empty($_SESSION['comapy_manager_info']['company_id']) && intval($_SESSION['comapy_manager_info']['company_id'])>0 &&
    	!empty($_SESSION['comapy_manager_info']['role_id']) && intval($_SESSION['comapy_manager_info']['role_id'])>0 && 
    	(intval($_SESSION['comapy_manager_info']['role_id'])===1 || intval($_SESSION['comapy_manager_info']['role_id'])===8 || intval($_SESSION['comapy_manager_info']['role_id'])===10 || intval($_SESSION['comapy_manager_info']['role_id'])===14) &&
    	!empty($_SESSION['product_id']) && intval($_SESSION['product_id'])>0 &&
    	$this->Product_model->edit_tel(['status'=>1],['id'=>intval($b['id'])]))
    	    die('ok');
	    die('0');
    }
    public function management(){
        $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !empty($b['t']) && !empty($b['i']) && intval($b['i'])>0 && 
	    !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
	    !empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && 
	    !empty($_SESSION['id']) && intval($_SESSION['id'])>0 && 
	    intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id'])){
	        $_SESSION['product_id']=intval($b['i']);
	        if($b['t']=='d'){
	            die('111111111111');
	        }elseif($b['t']=='m'){
	            die('1111111111111');
	        }
	    }
	    die('0');
    }
    public function one(){
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 &&
	    !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
	    !empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && 
	    !empty($_SESSION['id']) && intval($_SESSION['id'])>0 && 
	    intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && !empty($_SESSION['product_id']) && intval($_SESSION['product_id'])>0){
	        $category=new Category_handler();
        	$company=new Company_handler();
        	$role=new Role_handler();
        	$main=new Main_exploder();
            $main->valex_type='user';
            $main->valex_lt=$_SESSION['ln'];
            $main->valex_ln=$_SESSION['lt'];
            $main->valex_user_id=$this->id;
            $main->valex_category_main_exploder(0);
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
            	    'category'=>$this->Category_model->select_where_status(),
            	    'product_id'=>intval($_SESSION['product_id']),
            	    'category_selected'=>$this->Product_model->select_category_where_product_id(intval($_SESSION['product_id'])),
            	    'role_id'=>intval($_SESSION['comapy_manager_info']['role_id']),
            	    'company_id'=>intval($_SESSION['comapy_manager_info']['company_id']),
            	    'uploader'=>$this->load->view('includes/uploader',['url'=>'assets---svg---product','type'=>'image'],true),
            	    'data'=>$this->Product_model->select_product_where_id(intval($_SESSION['product_id'])),
            	    'other_product_price'=>$main->valex_show_product_without_company_position_in_category,
            	    'relations'=>$this->Product_model->select_product_relation_where_array(['product_id'=>intval($_SESSION['product_id'])]),
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
    public function setting(){
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 &&
	    !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
	    !empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && 
	    !empty($_SESSION['id']) && intval($_SESSION['id'])>0 && 
	    intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && !empty($_SESSION['product_id']) && intval($_SESSION['product_id'])>0){
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
            	    'category'=>$this->Category_model->select_where_status(),
            	    'role_id'=>intval($_SESSION['comapy_manager_info']['role_id']),
            	    'company_id'=>intval($_SESSION['comapy_manager_info']['company_id']),
            	    'p_id'=>intval($_SESSION['product_id']),
            	    'uploader'=>$this->load->view('includes/uploader',['url'=>'assets---svg---product','type'=>'image'],true),
            	    'data'=>$main->valex_product_info(intval($_SESSION['product_id']))
                ],true).
            	$this->load->view('footer',[
            	    'add_map_id'=>intval($_SESSION['product_id']),
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
}