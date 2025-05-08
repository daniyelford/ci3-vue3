<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Dashbord extends MY_Controller
{
	public function __construct(){
		parent::__construct();
	}
	public function pay_product_now(){
	    $date = new JDF();
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) &&
	    !empty($b['id']) && intval($b['id'])>0 && 
	    ($d=$this->Product_model->select_product_where_id(intval($b['id'])))!==false &&
	    !empty($d) && !empty($d['0'])){
	        if(!empty($d['0']['id']) && intval($d['0']['id'])>0 && !empty($d['0']['price']) && intval($d['0']['price'])>0){
	            $d['0']['price']=intval($d['0']['price']*(!empty($b['count']) && intval($b['count'])>1?intval($b['count']):1));
	            if(($e=$this->Order_model->select_wallet_where_user_id(intval($_SESSION['id'])))!==false && !empty($e) && !empty(end($e))) $e=end($e);
	            $price=intval($d['0']['price']*10/11);
	            if(!empty($e)){
	                if(!empty($e['value']) && intval($e['value'])>=0 && intval($e['value'])>intval($price)){
	                    $f=$this->Product_model->select_category_where_product_id(intval($d['0']['id']));
	                    $h=0;
	                    $company_info=[];
	                    foreach($f as $g){
	                        if(!empty($g) && !empty($g['company_id']) && intval($g['company_id'])>0 && ($company_info=$this->Company_model->select_company_where_id(intval($g['company_id'])))!==false && !empty($company_info) && !empty($company_info['0'])){
	                            $company_info=$company_info['0'];
	                            $h=intval($g['company_id']);
	                            break;
	                        }
	                    }
	                    if(!empty($h) && intval($h)>0 && !empty($company_info)){
	                        $i=$this->Roles_model->select_company_role_where_array(['company_id'=>intval($h),'role_id'=>8]);
	                        if(!(!empty($i) && !empty($i['0']) && !empty($i['0']['id']) && intval($i['0']['id'])>0)){
	                            $i=$this->Roles_model->select_company_role_where_array(['company_id'=>intval($h),'role_id'=>1]);
	                        }
	                        if(!empty($i) && !empty($i['0']) && !empty($i['0']['id']) && intval($i['0']['id'])>0){
	                            $j=$this->Roles_model->select_company_user_where_company_role_id(intval($i['0']['id']));
	                            if(!empty($j) && !empty($j['0']) && !empty($j['0']['user_id']) && intval($j['0']['user_id'])>0){
    	                            $c=$this->Position_model->add_user_return_id([
    	                                'position_id'=>0,
    	                                'user_id'=>intval($_SESSION['id']),
    	                                'status'=>1,
    	                            ]);
    	                            $c=$this->Position_model->add_order_return_id([
    	                                'position_user_id'=>intval($c),
    	                                'product_id'=>intval($b['id']),
    	                                'count'=>(!empty($b['count']) && intval($b['count'])>1?intval($b['count']):1)
    	                            ]);
    	                            $malyat=intval($d['0']['price']-$price);
    	                            $k=$this->Order_model->add_payment_return_id([
    	                                'user_id_buier'=>intval($_SESSION['id']),
    	                                'user_id_seller'=>intval($j['0']['user_id']),
    	                                'pay_value'=>intval($d['0']['price']),
    	                                'factor_api_token'=>'ok',
    	                                'status'=>1
    	                            ]);
    	                            if(!empty($k) && intval($k)>0 && ($p=$this->Order_model->add_wallet_return_id([
    	                                'user_id'=>intval($_SESSION['id']),
    	                                'change_value'=>-intval($d['0']['price']),
    	                                'value'=>intval($e['value']-$d['0']['price']),
    	                                'old_value'=>intval($e['value'])
    	                            ]))!==false && !empty($p) && intval($p)>0 && 
    	                            ($m=$this->Order_model->select_wallet_where_user_id(intval($j['0']['user_id'])))!==false &&
	                                !empty($m) && !empty(end($m)) && ($m=end($m))!==false &&
	                                ($o=(!empty($m['value']) && intval($m['value'])>0?$m['value']:0))!==false &&
    	                            ($ass=$this->Order_model->add_wallet_return_id([
    	                                'user_id'=>intval($j['0']['user_id']),
    	                                'change_value'=>intval($price),
    	                                'value'=>intval($price+$o),
    	                                'old_value'=>intval($o)
    	                            ]))!==false &&
    	                            ($my=$this->Order_model->select_wallet_where_user_id(1))!==false &&
    	                            !empty($my) && !empty(end($my)) && ($my=end($my))!==false &&
	                                !empty($my) &&
    	                            ($om=(!empty($my['value']) && intval($my['value'])>0?$my['value']:0))!==false &&
    	                            $this->Order_model->add_wallet([
    	                                'user_id'=>1,
    	                                'change_value'=>intval($malyat),
    	                                'value'=>intval($om+$malyat),
    	                                'old_value'=>intval($om)
    	                            ]) && $this->Order_model->add_wallet_payemt([
    	                                'wallet_id'=>intval($p),
    	                                'payment_id'=>intval($k),
    	                                'seller_wallet_id'=>intval($ass),
    	                                'position_product_order'=>intval($c)]) && 
    	                            $this->Position_model->edit_order([
    	                                'status'=>1,
    	                                'payment_id'=>intval($k),
    	                                'time'=>time()
    	                            ],['id'=>intval($c)]) &&
    	                            ($x=$this->Order_model->select_wallet_where_user_id(intval($_SESSION['id'])))!==false && !empty($e) && !empty(end($e)) && ($x=end($x))!==false && !empty($x) &&
    	                            ($_SESSION['my_wallet']=$x)!==false) {
                                        $p=$this->Users_model->select_info_where_user_id(intval($_SESSION['id']));
                            	        $r=$this->Users_model->select_info_where_user_id(intval($j['0']['user_id']));
    	                                $text=(!empty($_SESSION['user_info']['name'])?$_SESSION['user_info']['name']:'').' '.(!empty($_SESSION['user_info']['family'])?$_SESSION['user_info']['family']:'')
    	                                .' عزیز شما در تاریخ
    	                                '.$date->jdate('Y/m/d',time()).'
    	                                و در ساعت
    	                                '.$date->jdate('H:i',time()).'
    	                                به تعداد
    	                                '.(!empty($b['count']) && intval($b['count'])>1?intval($b['count']):1).'
    	                                عدد محصول 
    	                                '.(!empty($d['0']['title'])?$d['0']['title']:'').'  
    	                                را به قیمت 
    	                                '.(!empty($d['0']['price']) && intval($d['0']['price'])>0?number_format($d['0']['price']):'0').'
    	                                تومان 
    	                                '.(!empty($company_info['title'])?'از '.$company_info['title']:'').'
    	                                خرید کردید برای مشاهده ی محصول به
                                	    https://www.my-home.ir/product/'.intval($b['id']).'
                                	    بروید موجودی جدید
                                	    '.(($v_p=intval($e['value']-$d['0']['price']))!==false?number_format($v_p):0).' تومان
                                	    برای مدیریت کبف پول به
                                	    https://www.my-home.ir/wallet_payment/
                                	    بروید ';
                                	    $text1=(!empty($r['0']) && !empty($r['0']['name'])?$r['0']['name']:'').' '.(!empty($r['0']) && !empty($r['0']['family'])?$r['0']['family']:'').'
                                	    عزیز محصول 
                                	    '.(!empty($d['0']['title'])?$d['0']['title']:'شما ').'
                                	    در تاریخ 
                                	    '.$date->jdate('Y/m/d',time()).'
                                	    و در ساعت
                                	    '.$date->jdate('H:i',time()).'
                                	    به تعداد
    	                                '.(!empty($b['count']) && intval($b['count'])>1?intval($b['count']):1).'
    	                                عدد به 
                                	    '.(!empty($_SESSION['user_info']['name'])?$_SESSION['user_info']['name']:'').' '.(!empty($_SESSION['user_info']['family'])?$_SESSION['user_info']['family']:'').'
                                	    فروخته شده است برای مشاهده ی سفارشات به
                                	    https://www.my-home.ir/chat 
                                	    بروید 
                                	    موجودی جدید 
                                	    '.intval($price+$o).'
                                	    تومان
                                	    برای مدیریت کیف پول به
                                	    https://www.my-home.ir/wallet_payment/
                                	    بروید ';
                            	        if(!empty($p) && !empty($p['0'])){
                            	            $q=$this->Include_model->send_massage_to_user(['count'=>(!empty($b['count']) && intval($b['count'])>1?intval($b['count']):1)
                            	            ,'product'=>$d['0'],'seller'=>(!empty($r) && !empty($r['0'])?$r['0']:[]),'buyer'=>$p['0'],'price'=>intval($d['0']['price'])],
                            	            (!empty($p['0']['phone'])?$p['0']['phone']:''),(!empty($p['0']['gmail'])?$p['0']['gmail']:''),'includes/email_includes/pay_product_now',
                                        	'پرداخت صورتحساب',
                            	            $text);
                            	        }
                            	        if(!empty($r) && !empty($r['0'])){
                            	            $k=$this->Include_model->send_massage_to_user(['count'=>(!empty($b['count']) && intval($b['count'])>1?intval($b['count']):1)
                            	            ,'product'=>$d['0'],'seller'=>$r['0'],'buyer'=>(!empty($p) && !empty($p['0'])?$p['0']:[]),'price'=>intval($d['0']['price'])],
                            	            (!empty($r['0']['phone'])?$r['0']['phone']:''),(!empty($r['0']['gmail'])?$r['0']['gmail']:''),'includes/email_includes/pay_product_now',
                                    	    'صورتحساب دریافتی', 
                            	            $text1);
                            	        }
                            	        $product_chat_text=(!empty($_SESSION['user_info']['name'])?$_SESSION['user_info']['name']:'').' '.(!empty($_SESSION['user_info']['family'])?$_SESSION['user_info']['family']:'')
    	                                .' عزیز شما در تاریخ
    	                                '.$date->jdate('Y/m/d',time()).'
    	                                و در ساعت
    	                                '.$date->jdate('H:i',time()).'
    	                                محصول 
    	                                '.(!empty($d['0']['title'])?$d['0']['title']:'').'  
    	                                را به قیمت 
    	                                '.(!empty($d['0']['price']) && intval($d['0']['price'])>0?number_format($d['0']['price']):'0').'
    	                                تومان 
    	                                '.(!empty($company_info['title'])?'از '.$company_info['title']:'').'
    	                                خرید کردید آیا از خرید خود راضی هستید؟
    	                                ';
                            	        $this->Product_model->add_chat([
                                            'product_id'=>intval($b['id']),
                                            'user_id'=>intval($_SESSION['id']),
                                            'text'=>$product_chat_text]);
    	                                die('111');
    	                            }
	                            }
	                        }
	                    }
	                    die('0');
	                }
    	            die('19');
	            }
	            die('0');
	        }
	    }
	    die('0');
	}
	public function show_company_product($d,$a,$b){
	    if(!empty($a) && !empty($b) && intval($b)>0 && ($c=$this->Product_model->select_category_where_id_and_status(intval($b)))!==false && !empty($c) && !empty($c['0']) && !empty($c['0']['product_id']) && intval($c['0']['product_id'])>0){
	        return $this->show_product($c['0']['product_id']);
	    }else{
	        header('Location:'.base_url());
	        die();
	    }
	}
	public function show_company_position($d,$a,$b){
	    if(!empty($a) && !empty($b) && intval($b)>0 && ($c=$this->Product_model->select_category_where_id_and_status(intval($b)))!==false && !empty($c) && !empty($c['0']) && !empty($c['0']['position_id']) && intval($c['0']['position_id'])>0){
	        return $this->show_position($c['0']['position_id']);
	    }else{
	        header('Location:'.base_url());
	        die();
	    }
	}
	private function show_product($id){
	    if(!empty($id) && intval($id)>0 && 
	    ($product_info=$this->Product_model->select_product_where_id(intval($id)))!==false && 
	    !empty($product_info) && !empty($product_info['0']) &&
	    ($this->id=(!empty($_SESSION['id']) && intval($_SESSION['id'])>0?intval($_SESSION['id']):0))!==false &&
	    ($company_products=$this->Product_model->select_category_where_product_id_and_status(intval($id)))!==false){
            $category=new Category_handler();
        	$company=new Company_handler();
        	$role=new Role_handler();
        	$main=new Main_exploder();
        	$main->valex_user_id=intval($this->id);
	        $main->valex_lt=(!empty($_SESSION['lt'])?$_SESSION['lt']:'');
            $main->valex_ln=(!empty($_SESSION['ln'])?$_SESSION['ln']:'');
            $positions=$position_ids=[];
            $company_product_id=0;
            $_SESSION['user_info']=$_SESSION['my_company']=$_SESSION['my_position']=$_SESSION['my_order']=$_SESSION['my_wallet']=[];
            if(!empty($company_products)){
                foreach($company_products as $a){
                    if(!empty($a) && !empty($a['position_id']) && intval($a['position_id'])>0 && !in_array(intval($a['position_id']),$position_ids)){
                        $position_ids[]=intval($a['position_id']);
                        $positions[]=$main->valex_position_info(intval($a['position_id']));
                    }
                    if(intval($company_product_id)==0 && !empty($a['company_id']) && intval($a['company_id'])>0){
                        $company_product_id=intval($a['company_id']);
                    }
                }
            }
            if(intval($company_product_id)>0){
            	$has_auth_info_error=true;
            	if(intval($this->id)>0 && ($a=$this->Users_model->select_where_id($this->id))!==false && !empty($a) && !empty($a['0']) && ($b=$this->Users_model->select_info_where_user_id(intval($this->id)))!==false && !empty($b) && !empty($b['0'])){
                    if(($c=$this->Order_model->select_wallet_where_user_id(intval($this->id)))!==false && !empty($c) && !empty(end($c))) $_SESSION['my_wallet']=end($c);
                    $_SESSION['my_company']=$role->show_my_company_valex(intval($this->id));    
                    if(!isset($_SESSION['user_info']) || empty($_SESSION['user_info'])) $_SESSION['user_info']=['image'=>(!empty($b['0']['image'])?$b['0']['image']:''),'name'=>(!empty($b['0']['name'])?$b['0']['name']:''),'family'=>(!empty($b['0']['family'])?$b['0']['family']:''),'role'=>''];
                    $has_auth_info_error=(!empty($b['0']['cart_mely_picture']) && !empty($b['0']['mely_code'])?false:true);
                }
                echo $this->load->view('header',[
                    'category'=>$category->valex_show(),
                    'lang'=>'',
                    'id'=>$this->id,
                    'user_info'=>(!empty($_SESSION['user_info'])?$_SESSION['user_info']:[]),
                    'lat'=>(!empty($_SESSION['lt'])?$_SESSION['lt']:''),
                    'lon'=>(!empty($_SESSION['ln'])?$_SESSION['ln']:''),
                    'chat'=>false,
                    'has_auth_info_error'=>$has_auth_info_error,
                    'title'=>(!empty($product_info['0']['title'])?$product_info['0']['title']:(!empty($product_info['0']['key'])?$product_info['0']['key']:''))
                ],true).
                $this->load->view('product/product',[
                    'id'=>$this->id,
                    'company'=>$main->valex_company_info(intval($company_product_id)),
                    'position'=>$positions,
                    'wallet'=>$_SESSION['my_wallet'],
                    'data'=>$main->valex_product_info(intval($id))
                ],true).
                $this->load->view('footer',[
            		'map'=>'true',
            		'chart'=>'true',
                	'my_company'=>(!empty($_SESSION['my_company'])?$_SESSION['my_company']:[]),
                    'lang'=>'fa',
                	'change_lang'=>'true',
                	'id'=>$this->id
                ],true);
                die();
            }
	    }
	    header('location:'.base_url());
	    exit();
	}
	private function show_position($id){
	    if(!empty($id) && intval($id)>0 && 
	    ($position_info=$this->Position_model->select_where_id(intval($id)))!==false && !empty($position_info) && !empty($position_info['0']) && 
	    !empty($position_info['0']['id']) && intval($position_info['0']['id'])>0 &&
	    ($this->id=(!empty($_SESSION['id']) && intval($_SESSION['id'])>0?intval($_SESSION['id']):0))!==false &&
	    ($company_products=$this->Position_model->select_company_where_position_id(intval($position_info['0']['id'])))!==false
	    && !empty($company_products) && !empty($company_products['0'])){
            $category=new Category_handler();
        	$company=new Company_handler();
        	$role=new Role_handler();
        	$main=new Main_exploder();
        	$main->valex_user_id=intval($this->id);
	        $main->valex_lt=(!empty($_SESSION['lt'])?$_SESSION['lt']:'');
            $main->valex_ln=(!empty($_SESSION['ln'])?$_SESSION['ln']:'');
        	$has_auth_info_error=true;
        	$products=$product_ids=[]; 
        	$company_product_id=0;
            if(!empty($company_products)){
                foreach($company_products as $a){
                    if(!empty($a) && !empty($a['product_id']) && intval($a['product_id'])>0 && !in_array(intval($a['product_id']),$product_ids)){
                        $product_ids[]=intval($a['product_id']);
                        $products[]=$main->valex_product_info(intval($a['product_id']));
                    }
                    if(!(intval($company_product_id)>0) && !empty($a['company_id']) && intval($a['company_id'])>0){
                        $company_product_id=intval($a['company_id']);
                    }
                }
            }
            if(intval($company_product_id)>0){
            	if(intval($this->id)>0&&($a=$this->Users_model->select_where_id($this->id))!==false && !empty($a) && !empty($a['0']) && ($b=$this->Users_model->select_info_where_user_id(intval($this->id)))!==false && !empty($b) && !empty($b['0'])){
                    if(($c=$this->Order_model->select_wallet_where_user_id(intval($this->id)))!==false && !empty($c) && !empty(end($c))) $_SESSION['my_wallet']=end($c);
                    $_SESSION['my_company']=$role->show_my_company_valex(intval($this->id));    
                    if(!isset($_SESSION['user_info']) || empty($_SESSION['user_info'])) $_SESSION['user_info']=['image'=>(!empty($b['0']['image'])?$b['0']['image']:''),'name'=>(!empty($b['0']['name'])?$b['0']['name']:''),'family'=>(!empty($b['0']['family'])?$b['0']['family']:''),'role'=>''];
                    $has_auth_info_error=(!empty($b['0']['cart_mely_picture']) && !empty($b['0']['mely_code'])?false:true);
                }    
                echo $this->load->view('header',[
                    'category'=>$category->valex_show(),
                    'lang'=>'',
                    'id'=>$this->id,
                    'user_info'=>(!empty($_SESSION['user_info'])?$_SESSION['user_info']:[]),
                    'lat'=>(!empty($_SESSION['lt'])?$_SESSION['lt']:''),
                    'lon'=>(!empty($_SESSION['ln'])?$_SESSION['ln']:''),
                    'chat'=>false,
                    'has_auth_info_error'=>$has_auth_info_error,
                    'title'=>(!empty($position_info['0']['title'])?$position_info['0']['title']:'')
                ],true).
                $this->load->view('product/position',[
                    'id'=>$this->id,
                    'company'=>$main->valex_company_info(intval($company_product_id)),
                    'product'=>$products,
                    'data'=>$main->valex_position_info(intval($id))
                ],true).
                $this->load->view('footer',[
            		'map'=>'true',
            		'chart'=>'true',
                	'my_company'=>(!empty($_SESSION['my_company'])?$_SESSION['my_company']:[]),
                    'lang'=>'fa',
                	'change_lang'=>'true',
                	'id'=>$this->id
                ],true);
                die();
            }
	    }
        header('location:'.base_url());
	    exit();
	}
	public function change_product_url($id){
	    if(!empty($id) && intval($id)>0 && 
	    ($a=$this->Product_model->select_category_where_product_id_and_status(intval($id)))!==false && !empty($a) && 
	    !empty($a['0']) && !empty($a['0']['id']) && intval($a['0']['id'])>0 && !empty($a['0']['company_id']) && intval($a['0']['company_id'])>0 &&
	    ($b=$this->Product_model->select_product_where_id_and_status(intval($id)))!==false && !empty($b) && !empty($b['0']) && 
	    ($d=$this->Company_model->select_company_where_id_and_status($a['0']['company_id']))!==false && 
	    !empty($d) && !empty($d['0']) && !empty($d['0']['title']) &&
	    ($c=(!empty($b['0']['title'])?$b['0']['title']:(!empty($b['0']['key'])?$b['0']['key']:'')))!==false && !empty($c)){
	        header('Location:'.base_url('company_product'.DS.$this->xss_link($d['0']['title']).DS.$this->xss_link($c).DS.intval($a['0']['id'])));
	    }else{
	        header('Location:'.base_url());
	    }
	    die();
	}
	public function change_position_url($id){
	    if(!empty($id) && intval($id)>0 && 
	    ($a=$this->Position_model->select_company_where_arr(['position_id'=>intval($id),'status'=>1]))!==false && !empty($a) && 
	    !empty($a['0']) && !empty($a['0']['id']) && intval($a['0']['id'])>0 && !empty($a['0']['company_id']) && intval($a['0']['company_id'])>0 &&
	    ($b=$this->Position_model->select_where_id(intval($id)))!==false && !empty($b) && !empty($b['0']) && 
	    ($d=$this->Company_model->select_company_where_id_and_status($a['0']['company_id']))!==false && 
	    !empty($d) && !empty($d['0']) && !empty($d['0']['title']) &&
	    ($c=(!empty($b['0']['title'])?$b['0']['title']:''))!==false && !empty($c)){
	        header('Location:'.base_url('company_position'.DS.$this->xss_link($d['0']['title']).DS.$this->xss_link($c).DS.intval($a['0']['id'])));
	    }else{
	        header('Location:'.base_url());
	    }
	    die();
	}
	private function xss_link($str){
	    return (!empty($str) && is_string($str) && ($a=str_replace(['`',"/",'~','"',"'",':','#','@','!','|',';','?','<','>','.',',','&','*','and','=','%',' '],'__',$str))!==false?$a:'');
	}
}