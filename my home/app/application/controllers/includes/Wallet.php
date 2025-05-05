<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Wallet extends MY_Controller
{
	public function __construct(){
		parent::__construct();
	}
	public function disable_pay(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])==1 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !empty($b['payWalletId']) && intval($b['payWalletId'])>0 && !empty($b['payId']) && intval($b['payId'])>0 && 
	    $this->Order_model->edit_wallet_payment_weher_id(['cart_action_status'=>0],intval($b['payWalletId']))&&
        $this->Order_model->edit_pay_weher_id(['factor_api_token'=>''],intval($b['payId'])))
    	    die('ok');
	    die('0');

	}
	public function enable_pay(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])==1 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !empty($b['payWalletId']) && intval($b['payWalletId'])>0 && !empty($b['payId']) && intval($b['payId'])>0 && 
	    $this->Order_model->edit_wallet_payment_weher_id(['cart_action_status'=>1],intval($b['payWalletId']))&&
        $this->Order_model->edit_pay_weher_id(['factor_api_token'=>'ok'],intval($b['payId'])))
    	    die('ok');
	    die('0');
	}
	public function add_cart_action(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !empty($b) && is_array($b) && !empty($b['c']) && (strlen($b['c'])==22||strlen($b['c'])==24) &&
	    !empty($b['u']) && intval($b['u'])>0 && intval($b['u'])==intval($_SESSION['id']) && 
	    $this->Users_model->add_cart([
	        'user_id'=>intval($b['u']),
	        'cart_number'=>$b['c']
	    ])){
	        $text="کاربر کارت خود را ثبت کرده استعلام بگیرید برای اطلاعات بیشتر به ادرس 
	        ".base_url('all_wallet_changeing')."
	        بروید";
	        $p=$this->Users_model->select_info_where_user_id(1);
	        $q=$this->Include_model->send_massage_to_user(['cart_number'=>$b['c'],'user'=>$this->Users_model->select_info_where_user_id(intval($b['u']))],
            (!empty($p['0']['phone'])?$p['0']['phone']:''),(!empty($p['0']['gmail'])?$p['0']['gmail']:''),'includes/email_includes/add_cart_action',
            'تایید کارت کاربر',
            $text);        
    	    die('111');
	    }
	    
	    die('0');
	}
	private function redius_value($a,$b){
	    return intval($a)-intval($b);
	}
	public function harvest(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !empty($b) && is_array($b) && !empty($b['u']) && intval($b['u'])>0 && intval($b['u'])==intval($_SESSION['id']) && 
	    ($z=$this->Users_model->select_info_where_user_id(intval($b['u'])))!==false && !empty($z) && !empty($z['0']) && 
	    !empty($b['c']) && intval($b['c'])>0 && !empty($b['v']) && intval($b['v'])>0 && !empty($b['w']) && intval($b['w'])>0 &&
	    ($a=$this->Order_model->select_wallet_where_id(intval($b['w'])))!==false && !empty($a) && !empty($a['0']) &&
        !empty($a['0']['value']) && intval($a['0']['value'])>0 && ($new_value=$this->redius_value(intval($a['0']['value']),intval($b['v'])))!==false &&
        intval($new_value)>=0 &&
        ($c=$this->Order_model->add_wallet_return_id([
	        'old_value'=>intval($a['0']['value']),
	        'change_value'=>-intval($b['v']),
	        'value'=>$new_value,
	        'user_id'=>intval($b['u'])
	    ]))!==false && !empty($c) && intval($c)>0 &&
	    ($d=$this->Order_model->add_payment_return_id([
	        'user_id_buier'=>intval($b['u']),
	        'user_id_seller'=>0,
	        'pay_value'=>intval($b['v']),
	        'status'=>1
	    ]))!==false && !empty($d) && intval($d)>0 &&
	    $this->Order_model->add_wallet_payemt([
	        'wallet_id'=>intval($c),
	        'payment_id'=>intval($d),
	        'cart_id'=>intval($b['c']),
	        'self_wallet_action'=>1,
	        'cart_action_status'=>0,
	        'position_product_order'=>0,
	        'package_company_order'=>0,
	    ]) && ($_SESSION['my_wallet']=[
	        'id'=>intval($c),
	        'old_value'=>intval($a['0']['value']),
	        'change_value'=>-intval($b['v']),
	        'value'=>$new_value,
	        'user_id'=>intval($b['u'])
	    ])!==false){
            $text="برداشت از کیف پول حساب کاربری شما در https://www.my-home.ir به مبلغ ".intval($b['v']).' تومان درحال انجام است.موجودی جدید:'.number_format($new_value).' تومان';
	        $send=$this->Include_model->send_massage_to_user(['user'=>$z['0'],'value'=>intval($b['v'])],
            (!empty($z['0']['phone'])?$z['0']['phone']:''),(!empty($z['0']['gmail'])?$z['0']['gmail']:''),
            'includes/email_includes/harvest',
            'برداشت از حساب', 
            $text);
            $text=(!empty($z['0']['name'])?$z['0']['name']:'').' '.(!empty($z['0']['family'])?$z['0']['family']:'')." درخواست برداشت وجه به مبلغ ".intval($b['v']).' تومان '."از کیف پول خود را دارد برای مشاهده ی بیشتر به ".base_url('all_pay_request').' بروید';
            $p=$this->Users_model->select_info_where_user_id(1);
            $q=$this->Include_model->send_massage_to_user(['user'=>$z['0'],'value'=>intval($b['v'])],
            (!empty($p['0']['phone'])?$p['0']['phone']:''),(!empty($p['0']['gmail'])?$p['0']['gmail']:''),
            'includes/email_includes/harvest',
            'برداشت از حساب', 
            $text);
	        die('111');
    	}else{
	        die('0');
    	}
	}
	public function wallet_payment(){
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && ($id=intval($_SESSION['id']))!== false && 
	    ($a=$this->Users_model->select_where_id($id))!==false && !empty($a) && !empty($a['0']) && 
	    ($user_info=$this->Users_model->select_info_where_user_id(intval($id)))!==false && !empty($user_info) && !empty($user_info['0'])){
	        $detailes=[];
	        $has_auth_info_error=(!empty($user_info['0']['cart_mely_picture']) && !empty($user_info['0']['mely_code'])?false:true);
	        if(($a=$this->Users_model->select_wallet_where_user_id(intval($_SESSION['id'])))!==false && !empty($a))
	            foreach($a as $b){
	                if(!empty($b) && !empty($b['id']) && intval($b['id'])>0){
	                    if(($c=$this->Order_model->select_wallet_where_wallet_id(intval($b['id'])))!==false && !empty($c) && !empty($c['0'])){
                            $j=(!empty($c['0']['payment_id']) && intval($c['0']['payment_id'])>0 && ($e=$this->Order_model->select_payment_where_id($c['0']['payment_id']))!==false && !empty($e) && !empty($e['0'])?$e['0']:[]);
                            $l=[];
                            if(!empty($j))
                                $l=[
                                    'user_id'=>intval($_SESSION['id']),
                                    'pay_value'=>(!empty($j['pay_value'])?$j['pay_value']:''), 
                                    'factor_api_token'=>(!empty($j['factor_api_token'])?$j['factor_api_token']:''), 
                                    'user_id_buier'=>(!empty($j['user_id_buier'])&&intval($j['user_id_buier'])>0&&($m=$this->Users_model->select_info_where_user_id(intval($j['user_id_buier'])))!==false&&!empty($m)&&!empty($m['0'])?['id'=>intval($j['user_id_buier']),'info'=>$m['0']]:[]),
                                    'user_id_seller'=>(!empty($j['user_id_seller'])&&intval($j['user_id_seller'])>0&&($n=$this->Users_model->select_info_where_user_id(intval($j['user_id_seller'])))!==false&&!empty($n)&&!empty($n['0'])?['id'=>intval($j['user_id_seller']),'info'=>$n['0']]:[])
                                ];
                            
    	                    $detailes[]=['info'=>$b,'detailes'=>[
    	                        'type'=>(!empty($c['0']['self_wallet_action']) && intval($c['0']['self_wallet_action'])>0?1:0),
                                'cart_info'=>(!empty($c['0']['cart_id']) && intval($c['0']['cart_id'])>0 && ($d=$this->Users_model->select_cart_where_id(intval($c['0']['cart_id'])))!==false && !empty($d) && !empty($d['0'])?$d['0']:[]),
                                'action'=>(!empty($c['0']['cart_action_status']) && intval($c['0']['cart_action_status'])>0?1:0),
                                'payment'=>$l,
                                'product'=>(!empty($c['0']['position_product_order']) && intval($c['0']['position_product_order'])>0 && ($f=$this->Position_model->select_order_where_id(intval($c['0']['position_product_order'])))!==false && !empty($f) &&!empty($f['0']) && !empty($f['0']['product_id']) && intval($f['0']['product_id'])>0 && ($g=$this->Product_model->select_product_where_id(intval($f['0']['product_id'])))!==false && !empty($g) && !empty($g['0'])?$g['0']:[]),
                                'package'=>(!empty($c['0']['package_company_order']) && intval($c['0']['package_company_order'])>0 && ($h=$this->Order_model->select_package_order_where_id(intval($c['0']['package_company_order'])))!==false && !empty($h) && !empty($h['0']) && !empty($h['0']['package']) && intval($h['0']['package'])>0 && ($i=$this->Order_model->select_package_where_id(intval($h['0']['package'])))!==false && !empty($i) && !empty($i['0'])?$i['0']:[]),
                                'position'=>(!empty($c['0']['position_user_id']) && intval($c['0']['position_user_id'])>0 && ($j=$this->Position_model->select_user_where_arr(['id'=>intval($c['0']['position_user_id'])]))!==false && !empty($j) && !empty($j['0']) && !empty($j['0']['position_id']) && intval($j['0']['position_id'])>0 && ($k=$this->Position_model->select_where_id(intval($j['0']['position_id'])))!==false && !empty($k) && !empty($k['0'])?$k['0']:[]),
    	                    ]];
	                    }elseif(($c=$this->Order_model->select_wallet_where_seller_wallet_id(intval($b['id'])))!==false && !empty($c) && !empty($c['0'])){
                            $j=(!empty($c['0']['payment_id']) && intval($c['0']['payment_id'])>0 && ($e=$this->Order_model->select_payment_where_id($c['0']['payment_id']))!==false && !empty($e) && !empty($e['0'])?$e['0']:[]);
                            $l=[];
                            if(!empty($j))
                                $l=[
                                    'user_id'=>intval($_SESSION['id']),
                                    'pay_value'=>(!empty($j['pay_value'])?$j['pay_value']:''), 
                                    'factor_api_token'=>(!empty($j['factor_api_token'])?$j['factor_api_token']:''), 
                                    'user_id_buier'=>(!empty($j['user_id_buier'])&&intval($j['user_id_buier'])>0&&($m=$this->Users_model->select_info_where_user_id(intval($j['user_id_buier'])))!==false&&!empty($m)&&!empty($m['0'])?['id'=>intval($j['user_id_buier']),'info'=>$m['0']]:[]),
                                    'user_id_seller'=>(!empty($j['user_id_seller'])&&intval($j['user_id_seller'])>0&&($n=$this->Users_model->select_info_where_user_id(intval($j['user_id_seller'])))!==false&&!empty($n)&&!empty($n['0'])?['id'=>intval($j['user_id_seller']),'info'=>$n['0']]:[])
                                ];
                            
    	                    $detailes[]=['info'=>$b,'detailes'=>[
    	                        'type'=>(!empty($c['0']['self_wallet_action']) && intval($c['0']['self_wallet_action'])>0?1:0),
                                'cart_info'=>(!empty($c['0']['cart_id']) && intval($c['0']['cart_id'])>0 && ($d=$this->Users_model->select_cart_where_id(intval($c['0']['cart_id'])))!==false && !empty($d) && !empty($d['0'])?$d['0']:[]),
                                'action'=>(!empty($c['0']['cart_action_status']) && intval($c['0']['cart_action_status'])>0?1:0),
                                'payment'=>$l,
                                'product'=>(!empty($c['0']['position_product_order']) && intval($c['0']['position_product_order'])>0 && ($f=$this->Position_model->select_order_where_id(intval($c['0']['position_product_order'])))!==false && !empty($f) &&!empty($f['0']) && !empty($f['0']['product_id']) && intval($f['0']['product_id'])>0 && ($g=$this->Product_model->select_product_where_id(intval($f['0']['product_id'])))!==false && !empty($g) && !empty($g['0'])?$g['0']:[]),
                                'package'=>(!empty($c['0']['package_company_order']) && intval($c['0']['package_company_order'])>0 && ($h=$this->Order_model->select_package_order_where_id(intval($c['0']['package_company_order'])))!==false && !empty($h) && !empty($h['0']) && !empty($h['0']['package']) && intval($h['0']['package'])>0 && ($i=$this->Order_model->select_package_where_id(intval($h['0']['package'])))!==false && !empty($i) && !empty($i['0'])?$i['0']:[]),
                                'position'=>(!empty($c['0']['position_user_id']) && intval($c['0']['position_user_id'])>0 && ($j=$this->Position_model->select_user_where_arr(['id'=>intval($c['0']['position_user_id'])]))!==false && !empty($j) && !empty($j['0']) && !empty($j['0']['position_id']) && intval($j['0']['position_id'])>0 && ($k=$this->Position_model->select_where_id(intval($j['0']['position_id'])))!==false && !empty($k) && !empty($k['0'])?$k['0']:[]),
    	                    ]];
	                    }else{
	                        $detailes[]=['info'=>$b,'detailes'=>[]];
	                    }
	                }
	            }
	        $category=new Category_handler();
	        echo $this->load->view('header',[
                'has_auth_info_error'=>$has_auth_info_error,
			    'category'=>$category->valex_show(),
			    'lang'=>'',
			    'id'=>intval($_SESSION['id']),
			    'user_info'=>(!empty($_SESSION['user_info'])?$_SESSION['user_info']:[]),
			    'lat'=>(!empty($_SESSION['lt'])?$_SESSION['lt']:''),
			    'lon'=>(!empty($_SESSION['ln'])?$_SESSION['ln']:''),
			    'title'=>'کیف پول',
			    'icon'=>'',
		    ],true).
			$this->load->view('includes/wallet_detailes',[
			    'wallet'=>(!empty($detailes) && is_array($detailes)?$detailes:[])],true).
    		$this->load->view('footer',[
    		    'my_company'=>(!empty($_SESSION['my_company'])?$_SESSION['my_company']:[]),
                'lang'=>'fa',
    		    'change_lang'=>'true',
			    'id'=>intval($_SESSION['id'])
    		],true);
	    }else{
	        header('Location:'.base_url());
	    }
	}
    public function add_cart(){
        if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 &&
        ($c=$this->Users_model->select_info_where_user_id(intval($_SESSION['id'])))!==false &&
        !empty($c) && !empty($c['0'])){
	        $a=(($b=$this->Users_model->select_cart_where_user_id(intval($_SESSION['id'])))!==false && !empty($b) && is_array($b)?$b:[]);
	        $has_auth_info_error=(!empty($c['0']['cart_mely_picture']) && !empty($c['0']['mely_code'])?false:true);
	        $category=new Category_handler();
	        echo $this->load->view('header',[
			    'category'=>$category->valex_show(),
			    'lang'=>'',
			    'has_auth_info_error'=>$has_auth_info_error,
			    'id'=>intval($_SESSION['id']),
			    'user_info'=>(!empty($_SESSION['user_info'])?$_SESSION['user_info']:[]),
			    'lat'=>(!empty($_SESSION['lt'])?$_SESSION['lt']:''),
			    'lon'=>(!empty($_SESSION['ln'])?$_SESSION['ln']:''),
			    'title'=>'حساب های بانکی',
			    'icon'=>'',
		    ],true).
			$this->load->view('includes/wallet_cart',[
			    'has_info'=>(!empty($c['0']['cart_mely_picture']) && !empty($c['0']['mely_code'])?true:false),
			    'carts'=>$a,
                'id'=>intval($_SESSION['id'])
            ],true).
    		$this->load->view('footer',[
    		    'my_company'=>(!empty($_SESSION['my_company'])?$_SESSION['my_company']:[]),
                'lang'=>'fa',
    		    'change_lang'=>'true',
			    'id'=>intval($_SESSION['id'])
    		],true);
	    }else{
	        header('Location:'.base_url());
	    }
    }
	public function add_value(){
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && ($id=intval($_SESSION['id']))!== false && ($a=$this->Users_model->select_where_id($id))!==false && !empty($a) && !empty($a['0']) &&($b=$this->Users_model->select_info_where_user_id(intval($id)))!==false && !empty($b) && !empty($b['0'])){
            if(($c=$this->Order_model->select_wallet_where_user_id(intval($id)))!==false && !empty($c) && !empty(end($c))) $_SESSION['my_wallet']=end($c);
            $has_auth_info_error=(!empty($b['0']['cart_mely_picture']) && !empty($b['0']['mely_code'])?false:true);
	        $category=new Category_handler();
	        echo $this->load->view('header',[
                'has_auth_info_error'=>$has_auth_info_error,
			    'category'=>$category->valex_show(),
			    'lang'=>'',
			    'id'=>intval($_SESSION['id']),
			    'user_info'=>(!empty($_SESSION['user_info'])?$_SESSION['user_info']:[]),
			    'lat'=>(!empty($_SESSION['lt'])?$_SESSION['lt']:''),
			    'lon'=>(!empty($_SESSION['ln'])?$_SESSION['ln']:''),
			    'title'=>'افزودن وجه',
			    'icon'=>'',
		    ],true).
			$this->load->view('includes/wallet_add_value',[
			    'wallet'=>$_SESSION['my_wallet'],
                'id'=>intval($_SESSION['id'])
            ],true).
    		$this->load->view('footer',[
    		    'my_company'=>(!empty($_SESSION['my_company'])?$_SESSION['my_company']:[]),
                'lang'=>'fa',
    		    'change_lang'=>'true',
			    'id'=>intval($_SESSION['id'])
    		],true);
	    }else{
	        header('Location:'.base_url());
	    }
	}
	public function remove_value(){
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 &&
        ($c=$this->Users_model->select_info_where_user_id(intval($_SESSION['id'])))!==false &&
        !empty($c) && !empty($c['0'])){
            $has_auth_info_error=(!empty($c['0']['cart_mely_picture']) && !empty($c['0']['mely_code'])?false:true);
	        $a=(($b=$this->Users_model->select_cart_where_user_id(intval($_SESSION['id'])))!==false && !empty($b) && is_array($b)?$b:[]);
	        $category=new Category_handler();
	        echo $this->load->view('header',[
	            'has_auth_info_error'=>$has_auth_info_error,
			    'category'=>$category->valex_show(),
			    'lang'=>'',
			    'id'=>intval($_SESSION['id']),
			    'user_info'=>(!empty($_SESSION['user_info'])?$_SESSION['user_info']:[]),
			    'lat'=>(!empty($_SESSION['lt'])?$_SESSION['lt']:''),
			    'lon'=>(!empty($_SESSION['ln'])?$_SESSION['ln']:''),
			    'title'=>'برداشت وجه',
			    'icon'=>'',
		    ],true).
			$this->load->view('includes/wallet_remove_value',[
			    'carts'=>$a,
			    'wallet'=>$_SESSION['my_wallet'],
                'id'=>intval($_SESSION['id'])
            ],true).
    		$this->load->view('footer',[
    		    'my_company'=>(!empty($_SESSION['my_company'])?$_SESSION['my_company']:[]),
                'lang'=>'fa',
    		    'change_lang'=>'true',
			    'id'=>intval($_SESSION['id'])
    		],true);
	    }else{
	        header('Location:'.base_url());
	    }
	}
	public function index(){
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 &&
        ($c=$this->Users_model->select_info_where_user_id(intval($_SESSION['id'])))!==false &&
        !empty($c) && !empty($c['0'])){
	        $a=$this->Users_model->select_wallet_where_user_id(intval($_SESSION['id']));
	        $category=new Category_handler();
	        $has_auth_info_error=(!empty($c['0']['cart_mely_picture']) && !empty($c['0']['mely_code'])?false:true);
	        echo $this->load->view('header',[
			    'category'=>$category->valex_show(),
			    'has_auth_info_error'=>$has_auth_info_error,
			    'lang'=>'',
			    'id'=>intval($_SESSION['id']),
			    'user_info'=>(!empty($_SESSION['user_info'])?$_SESSION['user_info']:[]),
			    'lat'=>(!empty($_SESSION['lt'])?$_SESSION['lt']:''),
			    'lon'=>(!empty($_SESSION['ln'])?$_SESSION['ln']:''),
			    'title'=>'کیف پول',
			    'icon'=>'',
		    ],true).
			$this->load->view('includes/wallet',['wallet'=>(!empty($a) && is_array($a)?$a:[])],true).
    		$this->load->view('footer',[
    		    'my_company'=>(!empty($_SESSION['my_company'])?$_SESSION['my_company']:[]),
                'lang'=>'fa',
    		    'change_lang'=>'true',
			    'id'=>intval($_SESSION['id'])
    		],true);
	    }else{
	        header('Location:'.base_url());
	    }
	}
	public function pay(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !is_null($b) && !empty($b['u']) && !empty($b['t']) && !empty($b['v']) && intval($b['v'])>10000 && !empty($b['w']) && 
	    intval($b['u'])>0 && intval($_SESSION['id'])===intval($b['u']) && ($c=$this->Users_model->select_info_where_user_id(intval($b['u'])))!==false && !empty($c) && !empty($c['0'])){
            $_SESSION['money_value_for_add']=intval($b['v']);
            $inv=rand(10000000000000,100000000000000);
            $date=new JDF();
            $description= "افزایش مبلغ کیف پول اینترنتی واقع در سایت کسب و کار خانه ی من به مبلغ ".intval($b['v']).' تومان درحال انجام است';
            $pay_body = '{"amount":'.intval($b['v']*10).',"callbackApi":"https://www.my-home.ir/includes/wallet/pay_status",
            "invoice":"'.$inv.'","description":"'. $description.'","serviceCode": "8","invoiceDate" :"'. $date->jdate('Y/m/d',time()) .'",
            "mobileNumber" : "'.(!empty($c['0']['phone'])?$c['0']['phone']:'').'","payerMail" : "'.(!empty($c['0']['gmail'])?$c['0']['gmail']:'').'",
            "payerName" : "'.(!empty($c['0']['name'])?$c['0']['name']:'').' '.(!empty($c['0']['family'])?$c['0']['family']:'').'",
            "serviceType" : "PURCHASE","terminalNumber":'.BANKTERMINAL.',"pans":"","nationalCode":"'.(!empty($c['0']['mely_code'])?$c['0']['mely_code']:'').'"}';
            $bank= $this->Include_model->send_text_json_data_and_resive_data('https://pep.shaparak.ir/nvcservice/token/getToken','{"username":"'.BANKUSER.'","password":"'.BANKPASS.'"}');
            $bank=json_decode($bank,true);
            if(!empty($bank) && (intval($bank['resultCode'])==0 || empty($bank['resultCode'])) && !empty($bank['token'])){
                $bank=$this->Include_model->wallet_send_two_selection($bank['token'],'https://pep.shaparak.ir/nvcservice/api/payment/purchase',$pay_body);
                $bank=json_decode($bank,true);
                if(!empty($bank) && (intval($bank['resultCode'])==0 || empty($bank['resultCode'])) && !empty($bank['data']) && !empty($bank['data']['url']) && !empty($bank['data']['urlId'])){
                    $_SESSION['pay_inv']=$inv;
                    $_SESSION['pay_url_id']=$bank['data']['urlId'];
                    echo $bank['data']['url'];
                    die();
                }
            }
	    }
	    die('0');
	}
	public function pay_status(){
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && 
	    ($z=$this->Users_model->select_info_where_user_id(intval($_SESSION['id'])))!==false && !empty($z) && !empty($z['0']) &&
	    !empty($_SESSION['pay_inv']) && !empty($_SESSION['pay_url_id']) && 
	    !empty($_SESSION['money_value_for_add']) && intval($_SESSION['money_value_for_add'])>0 &&
        !empty($_GET['status']) && !empty($_GET['invoiceId']) && intval($_GET['invoiceId'])>0 && 
        intval($_SESSION['pay_inv'])===intval($_GET['invoiceId'])){
            $bank= json_decode($this->Include_model->send_text_json_data_and_resive_data('https://pep.shaparak.ir/nvcservice/token/getToken','{"username":"'.BANKUSER.'","password":"'.BANKPASS.'"}'),true);
            if(!empty($bank) && (intval($bank['resultCode'])==0 || empty($bank['resultCode'])) && !empty($bank['token'])){
                $data='{"invoice":"'.$_SESSION['pay_inv'].'","urlId":"'.$_SESSION['pay_url_id'].'"}';
            	$bank1=json_decode($this->Include_model->wallet_send_two_selection($bank['token'],'https://pep.shaparak.ir/nvcservice/api/payment/confirm-transactions',$data),true);
            	if(!empty($bank1) && ((!empty($bank1['resultCode']) && intval($bank1['resultCode'])==13029) || (empty($bank1['resultCode']) || intval($bank1['resultCode'])==0)) && !empty($_GET['trackId'])){
            	    $bank=json_decode($this->Include_model->wallet_send_two_selection($bank['token'],'https://pep.shaparak.ir/nvcservice/api/payment/verify-transactions',$data),true);
            	    if(!empty($bank) && !empty($bank['resultCode']) && (intval($bank1['resultCode'])==13029||intval($bank1['resultCode'])==0)){
                        $a=$this->Order_model->select_wallet_where_user_id(intval($_SESSION['id']));
                        if(!empty($a) && !empty(end($a))){
                            end($a)['value']=(!empty(end($a)['value']) && intval(end($a)['value'])>0?end($a)['value']:0);
                            $new_value=intval(end($a)['value']+$_SESSION['money_value_for_add']);
                            $b=$this->Order_model->add_payment_return_id([
                                'user_id_seller'=>intval($_SESSION['id']),
                                'pay_value'=>$_SESSION['money_value_for_add'],
                                'factor_api_token'=>$_GET['invoiceId'],
                                'status'=>1
                            ]);
                            $c=$this->Order_model->add_wallet_return_id([
                                'user_id'=>intval($_SESSION['id']),
                                'old_value'=>intval(end($a)['value']),
                                'change_value'=>$_SESSION['money_value_for_add'],
                                'value'=>intval($new_value)
                            ]);
                            if(!empty($b) && intval($b)>0 && !empty($c) && intval($c)>0 && $this->Order_model->add_wallet_payemt([
                                'wallet_id'=>intval($c),
                        	    'payment_id'=>intval($b),
                        	    'cart_id'=>0,
                        	    'self_wallet_action'=>1,
                            	'cart_action_status'=>'',
                            	'position_product_order'=>0,
                            	'package_company_order'=>0,
                            ])){
                                $_SESSION['my_wallet']=[
                                    'id'=>intval($c),
                                	'user_id'=>intval($_SESSION['id']),
                                    'old_value'=>intval(end($a)['value']),
                                    'change_value'=>$_SESSION['money_value_for_add'],
                                    'value'=>intval($new_value)
                                ];
                                $text="افزایش مبلغ کیف پول اینترنتی واقع در سایت کسب و کار خانه ی من https://www.my-home.ir/ به مبلغ ".intval($_SESSION['money_value_for_add']).' تومان انجام شد موجودی جدید:'.number_format($new_value).' تومان';
                    	        $send=$this->Include_model->send_massage_to_user(['user'=>$z['0'],'type'=>'success','value'=>$_SESSION['money_value_for_add']],
                                (!empty($z['0']['phone'])?$z['0']['phone']:''),
                                (!empty($z['0']['gmail'])?$z['0']['gmail']:''),
                                'includes/email_includes/pay_status',
                                'افزایش اعتبار',
                                $text);
                                $p=$this->Users_model->select_info_where_user_id(1);
                    	        $q=$this->Include_model->send_massage_to_user(['user'=>$z['0'],'type'=>'success','value'=>$_SESSION['money_value_for_add']],
                                (!empty($p['0']['phone'])?$p['0']['phone']:''),(!empty($p['0']['gmail'])?$p['0']['gmail']:''),
                                'includes/email_includes/pay_status',
                                'افزایش اعتبار',
                                $text);
                                $_SESSION['pay_inv']=$_SESSION['pay_url_id']=$_SESSION['money_value_for_add']='';
                                header('Location:'.base_url('wallet'));
                            	die();
                            }
                        }
            	    }
            	}
            }
            $text="افزایش مبلغ کیف پول اینترنتی واقع در سایت کسب و کار خانه ی من https://www.my-home.ir/ به مبلغ ".intval($_SESSION['money_value_for_add']).' تومان ناموفق بوده در صورت کسر وجه تا 48 ساعت آینده مبلغ به حسابتان بازخواهد گشت';
            $send=$this->Include_model->send_massage_to_user(['user'=>$z['0'],'type'=>'success','value'=>$_SESSION['money_value_for_add']],
            (!empty($z['0']['phone'])?$z['0']['phone']:''),
            (!empty($z['0']['gmail'])?$z['0']['gmail']:''),
            'includes/email_includes/pay_status',
            'افزایش اعتبار ناموفق',
            $text);
            $p=$this->Users_model->select_info_where_user_id(1);
            $q=$this->Include_model->send_massage_to_user(['user'=>$z['0'],'type'=>'success','value'=>$_SESSION['money_value_for_add']],
            (!empty($p['0']['phone'])?$p['0']['phone']:''),(!empty($p['0']['gmail'])?$p['0']['gmail']:''),
            'includes/email_includes/pay_status',
            'افزایش اعتبار ناموفق',
            $text);
        }
    	header('Location:'.base_url('add_wallet_value'));
    	die();
	}
}