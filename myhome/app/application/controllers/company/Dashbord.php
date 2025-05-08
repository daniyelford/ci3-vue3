<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Dashbord extends MY_Controller
{
	public function __construct(){
		parent::__construct();
	}
	private $id=0;
	public function promotion(){
	    if(!empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
	    !empty($_SESSION['comapy_manager_info']['company_user_id']) && intval($_SESSION['comapy_manager_info']['company_user_id'])>0 && 
	    !empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && 
	    !empty($_SESSION['id']) && intval($_SESSION['id'])>0 && 
	    intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && 
	    !empty($_SESSION['comapy_manager_info']['role_id']) && intval($_SESSION['comapy_manager_info']['role_id'])>0 && 
	    (intval(intval($_SESSION['comapy_manager_info']['role_id']))==8||intval($_SESSION['comapy_manager_info']['role_id'])==1) &&
	    !empty($_SESSION['comapy_manager_info']['company_id']) && intval($_SESSION['comapy_manager_info']['company_id'])>0){
            $category=new Category_handler();
        	$company=new Company_handler();
        	$role=new Role_handler();
        	if(($this->id=intval($_SESSION['id']))!== false && ($a=$this->Users_model->select_where_id($this->id))!==false && !empty($a) && !empty($a['0']) &&($b=$this->Users_model->select_info_where_user_id(intval($this->id)))!==false && !empty($b) && !empty($b['0'])){
                if(!isset($_SESSION['my_wallet']) || empty($_SESSION['my_wallet']) && ($c=$this->Order_model->select_wallet_where_user_id(intval($this->id)))!==false && !empty($c) && !empty(end($c))) $_SESSION['my_wallet']=end($c);
                if(!isset($_SESSION['my_company']) || empty($_SESSION['my_company'])) $_SESSION['my_company']=$role->show_my_company_valex(intval($this->id));    
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
                	'title'=>'ارتقاء کسب و کار'
                ],true).
            	$this->load->view('company/dashbord/promotion',[
            	    'wallet'=>$_SESSION['my_wallet'],
            	    'company_user_id'=>intval($_SESSION['comapy_manager_info']['company_user_id']),
            	    'company_id'=>intval($_SESSION['comapy_manager_info']['company_id']),
            	    'paks'=>$this->Order_model->all_package_status(),
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
	public function promotion_order(){
	    if(!empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
	    !empty($_SESSION['comapy_manager_info']['company_user_id']) && intval($_SESSION['comapy_manager_info']['company_user_id'])>0 && 
	    !empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && 
	    !empty($_SESSION['id']) && intval($_SESSION['id'])>0 && 
	    intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && 
	    !empty($_SESSION['comapy_manager_info']['role_id']) && intval($_SESSION['comapy_manager_info']['role_id'])>0 && 
	    (intval(intval($_SESSION['comapy_manager_info']['role_id']))==8||intval($_SESSION['comapy_manager_info']['role_id'])==1) &&
	    !empty($_SESSION['comapy_manager_info']['company_id']) && intval($_SESSION['comapy_manager_info']['company_id'])>0){
            $category=new Category_handler();
        	$company=new Company_handler();
        	$role=new Role_handler();
        	if(($this->id=intval($_SESSION['id']))!== false && ($a=$this->Users_model->select_where_id($this->id))!==false && !empty($a) && !empty($a['0']) &&($b=$this->Users_model->select_info_where_user_id(intval($this->id)))!==false && !empty($b) && !empty($b['0'])){
                if(!isset($_SESSION['my_wallet']) || empty($_SESSION['my_wallet']) && ($c=$this->Order_model->select_wallet_where_user_id(intval($this->id)))!==false && !empty($c) && !empty(end($c))) $_SESSION['my_wallet']=end($c);
                if(!isset($_SESSION['my_company']) || empty($_SESSION['my_company'])) $_SESSION['my_company']=$role->show_my_company_valex(intval($this->id));    
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
                	'title'=>'سفارش ها'
                ],true).
            	$this->load->view('company/dashbord/promotion_order',[
            	    'wallet'=>$_SESSION['my_wallet'],
            	    'company_user_id'=>intval($_SESSION['comapy_manager_info']['company_user_id']),
            	    'company_id'=>intval($_SESSION['comapy_manager_info']['company_id']),
            	    'paks'=>$this->Order_model->all_package_status(),
            	    'order'=>$this->Order_model->select_package_order_where_company_id(intval($_SESSION['comapy_manager_info']['company_id']))
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
	public function buy_pak(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!is_null($a) && $this->Include_model->chapcha($a) && !is_null($b) && 
        !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
	    !empty($_SESSION['comapy_manager_info']['company_user_id']) && intval($_SESSION['comapy_manager_info']['company_user_id'])>0 && 
	    !empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && 
	    !empty($_SESSION['id']) && intval($_SESSION['id'])>0 && 
	    intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && 
	    !empty($_SESSION['comapy_manager_info']['role_id']) && intval($_SESSION['comapy_manager_info']['role_id'])>0 && 
	    (intval(intval($_SESSION['comapy_manager_info']['role_id']))==8||intval($_SESSION['comapy_manager_info']['role_id'])==1) &&
	    !empty($b['pakId']) && !empty($b['cId']) && intval($b['pakId'])>0 && intval($b['cId'])>0 &&
	    ($c=$this->Order_model->select_package_where_id(intval($b['pakId'])))!==false && !empty($c) && !empty($c['0']) && 
	    ($d=$this->Order_model->select_package_order_where_company_id_and_package_id(intval($b['cId']),intval($b['pakId'])))!==false){
	        if(!empty($d) && !empty($d['0'])){
    	        if(!empty($d['0']['factor']))
    	            if(!empty($d['0']['end_time']) && strtotime($d['0']['end_time'])>time())
    	                die('25');    
                    else
                        die('26');
                else
                    die('27');
	        }else{
    	        if(!$this->Order_model->add_order_package(['company_id'=>intval($b['cId']),'package'=>intval($b['pakId'])])) die('0');
    	        die('111111111');
	        }
	    }
	    die('0');
	}
	public function pay(){
	    $date=new JDF();
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!is_null($a) && $this->Include_model->chapcha($a) && !is_null($b) && 
        !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
	    !empty($_SESSION['comapy_manager_info']['company_user_id']) && intval($_SESSION['comapy_manager_info']['company_user_id'])>0 && 
	    !empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && 
	    !empty($_SESSION['id']) && intval($_SESSION['id'])>0 && 
	    intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && 
	    !empty($_SESSION['comapy_manager_info']['role_id']) && intval($_SESSION['comapy_manager_info']['role_id'])>0 && 
	    (intval(intval($_SESSION['comapy_manager_info']['role_id']))==8||intval($_SESSION['comapy_manager_info']['role_id'])==1) &&
	    !empty($b['oId']) && intval($b['oId'])>0 && 
	    !empty($b['cId']) && intval($b['cId'])>0 &&
	    !empty($b['pId']) && intval($b['pId'])>0 &&
	    ($t=$this->Company_model->select_company_where_id(intval($b['cId'])))!==false && !empty($t) && !empty($t['0']) && 
	    ($check=$this->Order_model->select_package_order_where_company_id(intval($b['cId'])))!==false){
    	    if(!empty($check))
    	        foreach($check as $g){
    	            if(!empty($g['end_time']) && strtotime($g['end_time'])>time()) die('30');
    	        }
    	    if(($c=$this->Order_model->select_wallet_where_user_id(intval($_SESSION['id'])))!==false && !empty($c) && !empty(end($c)) &&
    	    ($d=$this->Order_model->select_package_order_where_id(intval($b['oId'])))!==false && !empty($d) && !empty($d['0']) &&
    	    ($e=$this->Order_model->select_package_where_id(intval($b['pId'])))!==false && !empty($e) && !empty($e['0'])
    	    ){
    	        $price=(!empty($e['0']['price']) && intval($e['0']['price'])>0?$e['0']['price']:0);
    	        $old_value=(!empty(end($c)['value']) && intval(end($c)['value'])>0?end($c)['value']:0);
    	        $value=$old_value-$price;
    	        $exp_time=(!empty($e['0']['exp_time_count']) && intval($e['0']['exp_time_count'])>0?time()+intval($e['0']['exp_time_count']):time());
    	        if(intval($value)>0)
    	            if(($w_id=$this->Order_model->add_wallet_return_id([
                    'user_id'=>intval($_SESSION['id']),
                    'old_value'=>intval($old_value),
                    'change_value'=>-intval($price),
                    'value'=>intval($value)]))!==false && !empty($w_id) && intval($w_id)>0 &&
        	        ($pay_id=$this->Order_model->add_payment_return_id([
        	            'user_id_buier'=>intval($_SESSION['id']),
        	            'user_id_seller'=>1,
        	            'pay_value'=>intval($price),
        	            'status'=>1]))!==false && !empty($pay_id) && intval($pay_id)>0 &&
        	        $this->Order_model->add_wallet_payemt([
        	           'wallet_id'=>intval($w_id),
        	           'payment_id'=>intval($pay_id),
        	           'package_company_order'=>intval($b['oId'])]) &&
        	        $this->Order_model->edit_order_package_weher_id([
        	           'payment'=>intval($pay_id),
        	           'factor'=>'ok',
        	           'end_time'=>date('Y-m-d H:i:s', intval($exp_time))
        	        ],intval($b['oId'])) &&
        	        $this->Company_model->edit_weher_id(['type'=>1],intval($b['cId']))){
        	            if(($f=$this->Order_model->select_wallet_where_user_id(1))!==false && !empty($f) && !empty(end($f))){
                	        $old_value_f=(!empty(end($f)['value']) && intval(end($f)['value'])>0?end($f)['value']:0);
                	        $value_f=intval($old_value_f+$price);
                            $this->Order_model->add_wallet([
                                'user_id'=>1,
                                'old_value'=>intval($old_value_f),
                                'change_value'=>+intval($price),
                                'value'=>intval($value_f)
                            ]);
        	            }
            	        $p=$this->Users_model->select_info_where_user_id(intval($_SESSION['id']));
                        $r=$this->Users_model->select_info_where_user_id(1);
                        if(!empty($p) && !empty($p['0'])){
            	            $text=(!empty($p['0']['name'])?$p['0']['name']:'').' '.(!empty($p['0']['family'])?$p['0']['family']:'').
            	            ' عزیز بسته ی ارتقای کسب و کار شما به قیمت '.
            	            number_format($price).
            	            ' تومان خریداری شد و کسب و کار '.
            	            (!empty($t['0']['title'])?$t['0']['title']:'').
            	            ' تا تاریخ '.
            	            $date->jdate('Y/m/d h:i',$exp_time).
            	            ' دارای اشتراک ویژه است برای مشاهده ی بیشتر به 
            	            https://www.my-home.ir/chat
            	             بروید.موجودی جدید:'.
            	            number_format($value).    
            	            'تومان برای مشاهده ی جزییات به 
            	            https://www.my-home.ir/wallet_payment
            	            بروید';
                            $q=$this->Include_model->send_massage_to_user([
                                'user'=>$r['0'],
                                'price'=>$price,
                                'exp_time'=>date('Y-m-d H:i:s', intval($exp_time)),
                                'company_info'=>$t['0']
                            ],
                            (!empty($p['0']['phone'])?$p['0']['phone']:''),(!empty($p['0']['gmail'])?$p['0']['gmail']:''),
                            'includes/email_includes/buy_pak',
                            'خرید بسته ارتقای کسب و کار',
                            $text);
                        }
                        if(!empty($r) && !empty($r['0'])){
                            $text='بسته ی ارتقای کسب و کار به ارزش '.
                            number_format($price).
                            'تومان توسط '.
                            (!empty($p['0']['name'])?$p['0']['name']:'').' '.(!empty($p['0']['family'])?$p['0']['family']:'').
                            'برای کسب و کار  '.
                            (!empty($t['0']['title'])?$t['0']['title']:'').
                            'خریداری شد';
                            $k=$this->Include_model->send_massage_to_user([
                                'user'=>$r['0'],
                                'price'=>$price,
                                'exp_time'=>date('Y-m-d H:i:s', intval($exp_time)),
                                'company_info'=>$t['0']
                            ],
                            (!empty($r['0']['phone'])?$r['0']['phone']:''),(!empty($r['0']['gmail'])?$r['0']['gmail']:''),
                            'includes/email_includes/buy_pak',
                            'ارتقای کسب و کار',
                            $text);
                        }
            	        die('11111111');
            	    }else{
            	        die('0');
            	    }
    	        else
    	           die('28');
    	    }
	    }
	    die('0');
	}
}