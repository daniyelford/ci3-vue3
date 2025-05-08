<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Home_page extends MY_Controller
{
	public function __construct(){
		parent::__construct();
	}
	public function all_pay_request(){
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])===1){
            $category=new Category_handler();
        	$company=new Company_handler();
        	$role=new Role_handler();
        	if(($this->id=intval($_SESSION['id']))!== false && ($a=$this->Users_model->select_where_id($this->id))!==false && !empty($a) && !empty($a['0']) && ($b=$this->Users_model->select_info_where_user_id(intval($this->id)))!==false && !empty($b) && !empty($b['0'])){
                if(($c=$this->Order_model->select_wallet_where_user_id(intval($this->id)))!==false && !empty($c) && !empty(end($c))) $_SESSION['my_wallet']=end($c);
                $_SESSION['my_company']=$role->show_my_company_valex(intval($this->id));    
                if(!isset($_SESSION['user_info']) || empty($_SESSION['user_info'])) $_SESSION['user_info']=['image'=>(!empty($b['0']['image'])?$b['0']['image']:''),'name'=>(!empty($b['0']['name'])?$b['0']['name']:''),'family'=>(!empty($b['0']['family'])?$b['0']['family']:''),'role'=>''];
                $has_auth_info_error=(!empty($b['0']['cart_mely_picture']) && !empty($b['0']['mely_code'])?false:true);
            	$info=[];
            	$data=$this->Users_model->all_user();
            	if(!empty($data))
            	    foreach($data as $da){
            	        if(!empty($da) && !empty($da['id']) && intval($da['id'])>0 && !empty($da['user_info_id']) && intval($da['user_info_id'])>0 &&
            	        ($daa=$this->Users_model->select_info_where_id(intval($da['user_info_id'])))!==false && !empty($daa) && !empty($daa['0'])){
            	            $daa['0']['user_id']=intval($da['id']);
            	            $daa['0']['user_status']=(!empty($da['status']) && intval($da['status'])>0?intval($da['status']):0);
            	            $info[]=$daa['0'];
            	        }
            	    }
            	$requests=[];
            	$req=$this->Order_model->select_wallet_where_self_wallet_action();
            	if(!empty($req)){
            	    foreach($req as $re){
            	        if(!empty($re) && !empty($re) && !empty($re['id']) && intval($re['id'])>0){
            	            $requests[]= [
            	                'pay_wallet_id'=>intval($re['id']),
            	                'cart_action_status'=>(!empty($re['cart_action_status']) && intval($re['cart_action_status'])>0?intval($re['cart_action_status']):0),
                	            'cart'=>(!empty($re['cart_id']) && intval($re['cart_id'])>0 && ($cart=$this->Users_model->select_cart_where_id($re['cart_id']))!==false && !empty($cart) && !empty($cart['0'])?$cart['0']:[]),
            	                'pay'=>(!empty($re['payment_id']) && intval($re['payment_id'])>0 && ($pay=$this->Order_model->select_payment_where_id($re['payment_id']))!==false && !empty($pay) && !empty($pay['0'])?$pay['0']:[])
            	            ];
            	        }
            	    }
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
                	'title'=>'مدیریت درخواست های واریز'
                ],true).
            	$this->load->view('home/pay',[
            	    'user_data'=>$info,
            	    'data'=>$requests
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
    //ok
    public function new_support(){
        if(!empty($_SESSION['id']) && intval($_SESSION['id'])===1){
            echo json_encode($this->all_support_manager_data());
        }
    }
    private function all_support_manager_data(){
        $data=$user_id=[];
        $a=$this->Users_model->all_support_chat();
    	if(!empty($a)){
    	    foreach($a as $e){
    	        if(!empty($e) && !empty($e['id']) && intval($e['id'])>0 && !empty($e['text']))
                    if(!empty($e['user_reciver_id']) && intval($e['user_reciver_id'])>0){
                        if(!in_array(intval($e['user_reciver_id']),$user_id)){
                            $user_id[]=intval($e['user_reciver_id']);
                            $f=$this->Users_model->select_info_where_user_id(intval($e['user_reciver_id']));
                            if(!empty($f) && !empty($f['0']))
                                $data[intval($e['user_reciver_id'])]['user_info']=$f['0'];
                        }
                        $data[intval($e['user_reciver_id'])]['msg'][]=['id'=>intval($e['id']),'text'=>$e['text'],'send'=>true];
                    }elseif(!empty($e['user_sender_id']) && intval($e['user_sender_id'])>0){
                        if(!in_array(intval($e['user_sender_id']),$user_id)){
                            $user_id[]=intval($e['user_sender_id']);
                            $f=$this->Users_model->select_info_where_user_id(intval($e['user_sender_id']));
                            if(!empty($f) && !empty($f['0']))
                                $data[intval($e['user_sender_id'])]['user_info']=$f['0'];
                        }
                        $data[intval($e['user_sender_id'])]['msg'][]=['id'=>intval($e['id']),'text'=>$e['text'],'send'=>false];
                    }
            }
        }
        return $data;
    }
    public function all_support_manager(){
        if(!empty($_SESSION['id']) && intval($_SESSION['id'])===1){
            $category=new Category_handler();
        	$company=new Company_handler();
        	$role=new Role_handler();
        	if(($this->id=intval($_SESSION['id']))!== false && ($a=$this->Users_model->select_where_id($this->id))!==false && !empty($a) && !empty($a['0']) && ($b=$this->Users_model->select_info_where_user_id(intval($this->id)))!==false && !empty($b) && !empty($b['0'])){
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
                	'title'=>'پشتیبانی'
                ],true).
            	$this->load->view('home/chat',[
            	    'data'=>$this->all_support_manager_data()
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
    public function all_wallet_changeing(){
        if(!empty($_SESSION['id']) && intval($_SESSION['id'])===1){
            $category=new Category_handler();
        	$company=new Company_handler();
        	$role=new Role_handler();
        	if(($this->id=intval($_SESSION['id']))!== false && ($a=$this->Users_model->select_where_id($this->id))!==false && !empty($a) && !empty($a['0']) && ($b=$this->Users_model->select_info_where_user_id(intval($this->id)))!==false && !empty($b) && !empty($b['0'])){
                if(($c=$this->Order_model->select_wallet_where_user_id(intval($this->id)))!==false && !empty($c) && !empty(end($c))) $_SESSION['my_wallet']=end($c);
                $_SESSION['my_company']=$role->show_my_company_valex(intval($this->id));    
                if(!isset($_SESSION['user_info']) || empty($_SESSION['user_info'])) $_SESSION['user_info']=['image'=>(!empty($b['0']['image'])?$b['0']['image']:''),'name'=>(!empty($b['0']['name'])?$b['0']['name']:''),'family'=>(!empty($b['0']['family'])?$b['0']['family']:''),'role'=>''];
                $has_auth_info_error=(!empty($b['0']['cart_mely_picture']) && !empty($b['0']['mely_code'])?false:true);
            	$info=[];
            	$data=$this->Users_model->all_user();
            	if(!empty($data))
            	    foreach($data as $da){
            	        if(!empty($da) && !empty($da['id']) && intval($da['id'])>0 && !empty($da['user_info_id']) && intval($da['user_info_id'])>0 &&
            	        ($daa=$this->Users_model->select_info_where_id(intval($da['user_info_id'])))!==false && !empty($daa) && !empty($daa['0']) &&
            	        ($waa=$this->Users_model->select_cart_where_user_id(intval($da['id'])))!==false && !empty($waa)){
            	            $daa['0']['user_id']=intval($da['id']);
            	            $daa['0']['wallet']=$waa;
            	            $daa['0']['user_status']=(!empty($da['status']) && intval($da['status'])>0?intval($da['status']):0);
            	            $info[]=$daa['0'];
            	        }
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
                	'title'=>'استعلام کارت ها'
                ],true).
            	$this->load->view('home/wallet',[
            	    'data'=>$info
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
    public function all_user_manager(){
        if(!empty($_SESSION['id']) && intval($_SESSION['id'])===1){
            $category=new Category_handler();
        	$company=new Company_handler();
        	$role=new Role_handler();
        	if(($this->id=intval($_SESSION['id']))!== false && ($a=$this->Users_model->select_where_id($this->id))!==false && !empty($a) && !empty($a['0']) && ($b=$this->Users_model->select_info_where_user_id(intval($this->id)))!==false && !empty($b) && !empty($b['0'])){
                if(($c=$this->Order_model->select_wallet_where_user_id(intval($this->id)))!==false && !empty($c) && !empty(end($c))) $_SESSION['my_wallet']=end($c);
                $_SESSION['my_company']=$role->show_my_company_valex(intval($this->id));    
                if(!isset($_SESSION['user_info']) || empty($_SESSION['user_info'])) $_SESSION['user_info']=['image'=>(!empty($b['0']['image'])?$b['0']['image']:''),'name'=>(!empty($b['0']['name'])?$b['0']['name']:''),'family'=>(!empty($b['0']['family'])?$b['0']['family']:''),'role'=>''];
                $has_auth_info_error=(!empty($b['0']['cart_mely_picture']) && !empty($b['0']['mely_code'])?false:true);
            	$info=[];
            	$data=$this->Users_model->all_user();
            	if(!empty($data))
            	    foreach($data as $da){
            	        if(!empty($da) && !empty($da['id']) && intval($da['id'])>0 && !empty($da['user_info_id']) && intval($da['user_info_id'])>0 &&
            	        ($daa=$this->Users_model->select_info_where_id(intval($da['user_info_id'])))!==false && !empty($daa) && !empty($daa['0'])){
            	            $daa['0']['user_id']=intval($da['id']);
            	            $daa['0']['user_status']=(!empty($da['status']) && intval($da['status'])>0?intval($da['status']):0);
            	            $info[]=$daa['0'];
            	        }
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
                	'title'=>'مدیریت کاربران'
                ],true).
            	$this->load->view('home/users',[
            	    'data'=>$info
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
	public function all_position_manager(){
        if(!empty($_SESSION['id']) && intval($_SESSION['id'])===1){
            $category=new Category_handler();
        	$company=new Company_handler();
        	$role=new Role_handler();
        	if(($this->id=intval($_SESSION['id']))!== false && ($a=$this->Users_model->select_where_id($this->id))!==false && !empty($a) && !empty($a['0']) && ($b=$this->Users_model->select_info_where_user_id(intval($this->id)))!==false && !empty($b) && !empty($b['0'])){
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
                	'title'=>'مدیریت جایگاه ها'
                ],true).
            	$this->load->view('home/position',[
            	    'data'=>$this->Position_model->select_all()
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
	public function all_product_manager(){
        if(!empty($_SESSION['id']) && intval($_SESSION['id'])===1){
            $category=new Category_handler();
        	$company=new Company_handler();
        	$role=new Role_handler();
        	if(($this->id=intval($_SESSION['id']))!== false && ($a=$this->Users_model->select_where_id($this->id))!==false && !empty($a) && !empty($a['0']) && ($b=$this->Users_model->select_info_where_user_id(intval($this->id)))!==false && !empty($b) && !empty($b['0'])){
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
            	$this->load->view('home/product',[
            	    'data'=>$this->Product_model->all(),
            	    'category_company'=>$this->Product_model->all_category()
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
	public function all_company_manager(){
        if(!empty($_SESSION['id']) && intval($_SESSION['id'])===1){
            $category=new Category_handler();
        	$company=new Company_handler();
        	$role=new Role_handler();
        	if(($this->id=intval($_SESSION['id']))!== false && ($a=$this->Users_model->select_where_id($this->id))!==false && !empty($a) && !empty($a['0']) && ($b=$this->Users_model->select_info_where_user_id(intval($this->id)))!==false && !empty($b) && !empty($b['0'])){
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
                	'title'=>'مدیریت کسب و کار ها'
                ],true).
            	$this->load->view('home/company',[
            	    'data'=>$this->Company_model->all(),
            	    
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
    public function all_category_manager(){
        if(!empty($_SESSION['id']) && intval($_SESSION['id'])===1){
            $category=new Category_handler();
        	$company=new Company_handler();
        	$role=new Role_handler();
        	if(($this->id=intval($_SESSION['id']))!== false && ($a=$this->Users_model->select_where_id($this->id))!==false && !empty($a) && !empty($a['0']) && ($b=$this->Users_model->select_info_where_user_id(intval($this->id)))!==false && !empty($b) && !empty($b['0'])){
                if(($c=$this->Order_model->select_wallet_where_user_id(intval($this->id)))!==false && !empty($c) && !empty(end($c))) $_SESSION['my_wallet']=end($c);
                $_SESSION['my_company']=$role->show_my_company_valex(intval($this->id));    
                if(!isset($_SESSION['user_info']) || empty($_SESSION['user_info'])) $_SESSION['user_info']=['image'=>(!empty($b['0']['image'])?$b['0']['image']:''),'name'=>(!empty($b['0']['name'])?$b['0']['name']:''),'family'=>(!empty($b['0']['family'])?$b['0']['family']:''),'role'=>''];
                $has_auth_info_error=(!empty($b['0']['cart_mely_picture']) && !empty($b['0']['mely_code'])?false:true);
            	$d=$this->Category_model->all();
                $f=[];
            	if(!empty($d))
            	    foreach($d as $e){
            	        $f[]=['info'=>$e,'category_logo_editor'=>$this->load->view('includes/uploader',['url'=>'assets---svg---category','type'=>'image'],true)];
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
                	'title'=>'مدیریت دسته بندی'
                ],true).
            	$this->load->view('home/category',[
            	    'data'=>$f,
            	    'category'=>$this->Category_model->select_where_status(),
            	    'category_logo_uploader'=>$this->load->view('includes/uploader',['url'=>'assets---svg---category','type'=>'image'],true),
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
}