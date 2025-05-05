<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Users extends MY_Controller
{
	public function __construct(){
		parent::__construct();
	}
	public function auto_auth($provider){
		$this->load->spark('oauth2/0.3.1');
		$provider = $this->oauth2->provider($provider, ['id' => CID,'secret' => CSECRET]);
		if (!$this->input->get('code'))
			$provider->authorize();
		else
			try{
				$token = $provider->access($_GET['code']);
				$user = $provider->get_user_info($token);
				if(!empty($user) && is_array($user) && !empty($user["uid"]))
    				if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0){
                		if(($z=$this->Users_model->select_info_where_user_id(intval($_SESSION['id'])))!==false && 
                		!empty($z) && !empty($z['0']) && !empty($z['0']['id']) && intval($z['0']['id'])>0){
                		    $this->Users_model->edit(['gmail_user_id'=>$user['uid']],['id'=>intval($_SESSION['id'])]);
                		    if(!empty($user["email"])) $this->Users_model->edit_info(['gmail'=>$user["email"]],['id'=>intval($z['0']['id'])]);
                			header('location:'.base_url('user_setting'));
                			die();
                		}else{
                		    $this->log_out();
                		}
    				}else{
    				    if(($a=$this->Users_model->select_where_gmail_user_id_and_status($user['uid']))!==false && !empty($a) && !empty($a['0']) && !empty($a['0']['id']) && intval($a['0']['id'])>0){
        				    if(($b=$this->Include_model->ip_handler())!==false && !empty($b) && 
        				    !empty($b['contry']) && is_string($b['contry']) && !empty($b['city']) && is_string($b['city']) &&
        				    $this->Users_model->add_login(['user_id'=>intval($a['0']['id']),'country'=>$b['contry'],'city'=>$b['city'],'ip'=>$_SERVER['REMOTE_ADDR'],'login'=>1])){
        				        $_SESSION['id']=intval($a['0']['id']);
        				        $a=$this->Users_model->select_info_where_user_id(intval($a['0']['id']));
        				        if(!empty($a) && !empty($a['0']) && !empty($a['0']['id']) && intval($a['0']['id'])>0 && !empty($a['0']['name']) && !empty($a['0']['family']) && trim($a['0']['name'])=='کاربر' && trim($a['0']['family'])=='مجازی'){
        				            $this->Users_model->edit_info([
        				                'name'=>(!empty($user["first_name"])?$user["first_name"]:''),
    				                    'family'=>(!empty($user["last_name"])?$user["last_name"]:''),
        				            ],['id'=>intval($a['0']['id'])]);
        				        }
        				        header('location:'.base_url());
        				        die();
        				    }
    				    }else{
    				        if(($c=$this->Users_model->select_where_gmail_user_id($user['uid']))!==false && !empty($c) && !empty($c['0'])){
    				            header('location:'.base_url().'users/users/access_denied');
    				            die();
    				        }else{
        				        header('location:'.base_url().'users/users/access_denied_email');
        				        die();
    				        }
    				    }
    				}
				header('location:'.base_url());
				die();
			}catch (OAuth2_Exception $i){
				show_error('That didnt work: '.$i);
			}
	}
	public function check_add_user(){
	    $a=(!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $d=(!empty($_POST['phone'])?$_POST['phone']:null);
	    if(!is_null($a) &&
	    !is_null($d)
	    && $this->Include_model->chapcha($a)){
	        $_SESSION['phone_number_sms_login']=$d;
    	    if(($j=$this->Users_model->select_info_where_phone($d))!==false && 
    	    !empty($j) && !empty($j['0']) && !empty($j['0']['id']) && intval($j['0']['id'])>0){
    	        die('2');
	        }
	        $_SESSION['sms_register_code']=rand(100000,1000000);
	        if($this->Include_model->send_sms_force_two($_SESSION['sms_register_code'],$d)!==false) die('1');
	        $_SESSION['phone_number_sms_login']=$_SESSION['sms_register_code']='';
	        die('3');
	    }
        die('0');
	}
	public function change_phone_code(){
	    $a=(!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b=(!empty($_POST['data']['phone'])?$_POST['data']['phone']:null);
        if(!is_null($a) && !is_null($b) && $this->Include_model->chapcha($a)){
    	    $_SESSION['sms_register_code']=rand(100000,1000000);
    	    if($this->Include_model->send_sms_force_two($_SESSION['sms_register_code'],$b)) die('11');
    	    $_SESSION['sms_register_code']='';
    	    die('38');
	    }
	    die('0');
	}
	public function check_add_user_auth(){
	    $a=(!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b=(!empty($_POST['name'])?$_POST['name']:null);
	    $c=(!empty($_POST['family'])?$_POST['family']:null);
	    $d=(!empty($_POST['phone'])?$_POST['phone']:null);
	    $e=(!empty($_POST['code'])?$_POST['code']:'');
	    $f=(!empty($_POST['day'])?$_POST['day']:null);
	    $g=(!empty($_POST['month'])?$_POST['month']:null);
	    $h=(!empty($_POST['year'])?$_POST['year']:null);
	    if(!is_null($a) && !is_null($b) && !is_null($c) && !is_null($e) &&
	    !is_null($d) && $this->Include_model->chapcha($a) &&
	    !is_null($f) && 
	    !is_null($g) && !is_null($h) && ($i=$this->Include_model->change_to_time($f,$g,$h,'',''))!==false && !empty($i) &&
	    !empty($_SESSION['sms_register_code']) && intval($_SESSION['sms_register_code'])>0 && 
	    !empty($_SESSION['phone_number_sms_login']) && $_SESSION['phone_number_sms_login']===$d &&
	    intval($_SESSION['sms_register_code'])===intval($e)){
	      
	            $d= $this->Users_model->add_info_return_id(['name'=>$b,'family'=>$c,'phone'=>$d]);


	        $this->Users_model->edit_info(['name'=>$b,'family'=>$c,'birthday'=>$i],['id'=>intval($d)]);
	        $j=$this->Users_model->select_where_info_id(intval($d));
	        $id=0;
	        if(!empty($j) && !empty($j['0']) && !empty($j['0']['id']) && intval($j['0']['id'])>0){
	            $id=$j['0']['id'];
	        }else{
	            $p=$this->Users_model->add_user_return_id(['user_info_id'=>intval($d)]);
	            if(!empty($p) && intval($p)>0 && $this->Users_model->add_wallet(['user_id'=>intval($p)]))
	                $id=intval($p);
	        }
	        $k=$this->Include_model->ip_handler();
	        if(intval($id)>0 && !empty($k) && !empty($k['contry']) && 
	        is_string($k['contry']) && !empty($k['city']) && is_string($k['city']) && 
	        $this->Users_model->add_login([
	            'user_id'=>intval($id),
	            'country'=>$k['contry'],
	            'city'=>$k['city'],'ip'=>$_SERVER['REMOTE_ADDR'],'login'=>1]) &&
	        ($_SESSION['id']=intval($id))!==false) die('1');
	    }
	    die('0');
	}
	public function access_denied(){
	    echo $this->load->view('errors/500',[],true);
	}
	public function access_denied_email(){
	    echo $this->load->view('errors/500',['text'=>'این gmail قبلا ثبت نشده ابتدا ثبت نام کنید'],true);
	}
	public function log_out(){
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && ($a=$this->Include_model->ip_handler())!==false && !empty($a) && !empty($a['contry']) && is_string($a['contry']) && !empty($a['city']) && is_string($a['city'])) $this->Users_model->add_login(['user_id'=>intval($_SESSION['id']),'country'=>$a['contry'],'city'=>$a['city'],'ip'=>$_SERVER['REMOTE_ADDR'],'login'=>0]);
	    $_SESSION = [];
	    header('Location:'.base_url());
	    exit();
	}
	public function send_sms_login(){
	    $a=(!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b=(!empty($_POST['phone'])?$_POST['phone']:null);
        if(!is_null($a) && !is_null($b) && $this->Include_model->chapcha($a))
            if(($c=$this->Users_model->select_info_where_phone($b))!==false && !empty($c) && !empty($c['0']) && !empty($c['0']['id']) && intval($c['0']['id'])>0){
        	    $_SESSION['sms_login_code']=rand(100000,1000000);
                $_SESSION['sms_login_user_info_id']=intval($c['0']['id']);
        	    if($this->Include_model->send_sms_force_two($_SESSION['sms_login_code'],$b)) die('1');
        	    $_SESSION['sms_login_code']=$_SESSION['sms_login_user_info_id']='';
        	    die('2');
    	    }else{
    	        die('40');
    	    }
	    die('0');
	}
    public function send_sms_login_again(){
	    $a=(!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b=(!empty($_POST['data']['phone'])?$_POST['data']['phone']:null);
        if(!is_null($a) && !is_null($b) && $this->Include_model->chapcha($a) && 
        ($c=$this->Users_model->select_info_where_phone($b))!==false && !empty($c) && !empty($c['0']) && !empty($c['0']['id']) && intval($c['0']['id'])>0){
    	    $_SESSION['sms_login_code']=rand(100000,1000000);
            $_SESSION['sms_login_user_info_id']=intval($c['0']['id']);
    	    if($this->Include_model->send_sms_force_two($_SESSION['sms_login_code'],$b)) die('11');
    	    $_SESSION['sms_login_code']=$_SESSION['sms_login_user_info_id']='';
    	    die('38');
	    }
	    die('0');
	}
    public function sms_login(){
        $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b=(!empty($_POST['data']['code'])?$_POST['data']['code']:null);
	    if(!is_null($a) && !is_null($b) && $this->Include_model->chapcha($a) && 
	    !empty($_SESSION['sms_login_code']) && intval($_SESSION['sms_login_code'])>0 && 
	    !empty($_SESSION['sms_login_user_info_id']) && intval($_SESSION['sms_login_user_info_id'])>0)
	        if(intval($_SESSION['sms_login_code'])===intval($b))
	            if(($c=$this->Users_model->select_where_info_id(intval($_SESSION['sms_login_user_info_id'])))!==false && 
	            !empty($c) && !empty($c['0']) && !empty($c['0']['id']) && intval($c['0']['id'])>0 && ($d=intval($c['0']['id']))!==false && 
	            ($e=$this->Include_model->ip_handler())!==false && !empty($e) && !empty($e['contry']) && is_string($e['contry']) &&
	            !empty($e['city']) && is_string($e['city']) && 
	            $this->Users_model->add_login(['user_id'=>intval($d),'country'=>$e['contry'],'city'=>$e['city'],'ip'=>$_SERVER['REMOTE_ADDR'],'login'=>1])){
	                $_SESSION['id']=intval($d);
	                die('1');
	            }else{
	                die('0');
	            }
	        else
	            die('20');
	    else
	        die('0');
	    
    }
}
    // $sms=$this->Include_model->send_sms($text,["9336160295","09336160295","+989336160295"]);
    // $email=$this->Include_model->send_email('29danialfrd69@gmail.com','',$text);
    // public function show(){
    //     echo $this->load->view('users/index',[
    //         'setting'=>$this->load->view('users/setting',[],true),
    //         'login'=>$this->load->view('users/login',[],true),
    //         'add_user'=>$this->load->view('users/add_user',['timer'=>$this->load->view('includes/timer',['time'=>time()],true)],true),
    //     ],true);
    // }
//     public function check_auth_costom(){
// 	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
// 	    $b=(!empty($_POST['username'])?$_POST['username']:null);
// 	    $c=(!empty($_POST['password'])?$_POST['password']:null);
// 	    if(!is_null($a) && !is_null($b) && !is_null($c) && $this->Include_model->chapcha($a) && ($d=$this->Users_model->auth_costum_and_return_user_id($b,$c))!==false && !empty($d) && intval($d)>0 && ($e=$this->Include_model->ip_handler())!==false && !empty($e) && !empty($e['contry']) && is_string($e['contry']) && !empty($e['city']) && is_string($e['city']) && $this->Users_model->add_login(['user_id'=>intval($d),'country'=>$e['contry'],'city'=>$e['city'],'ip'=>$_SERVER['REMOTE_ADDR'],'login'=>1])){
// 	        $_SESSION['id']=intval($d);
// 	        die('1');
// 	    }else{
// 	        die('0');
// 	    }
// 	}

        				        
    				            // if(($f=$this->Users_model->add_info_return_id([
    				            //     'name'=>(!empty($user["first_name"])?$user["first_name"]:''),
    				            //     'family'=>(!empty($user["last_name"])?$user["last_name"]:''),
    				            //     'gmail'=>(!empty($user["email"])?$user["email"]:''),
    				            //     'image'=>(!empty($user["image"])?$user["image"]:'')
    				            // ]))!==false && !empty($f) && intval($f)>0 && 
    				            // ($g=$this->Users_model->add_user_return_id([
    				            //     'user_info_id'=>intval($f),
    				            //     'gmail_user_id'=>$user['uid']
    				            // ]))!==false && !empty($g) && 
    				            // intval($g)>0 && $this->Users_model->add_wallet(['user_id'=>intval($g)]) && ($h=$this->Include_model->ip_handler())!==false && !empty($f) && !empty($h['contry']) &&
    				            // is_string($h['contry']) && !empty($h['city']) && is_string($h['city']) && 
    				            // $this->Users_model->add_login(['user_id'=>intval($g),'country'=>$h['contry'],'city'=>$h['city'],'ip'=>$_SERVER['REMOTE_ADDR'],'login'=>1])){
                    //                 $_SESSION['id']=intval($g);
                    //                 if(!empty($user['email']))$this->Include_model->send_email($user['email'],'ثبت نام موفق', 'به کسب و کار خانه ی من خوش آمدید برای تکمیل اطلاعات خود به لینک https://www.my-home.ir/user_setting بروید');
                    //                 header('location:'.base_url());
                    //                 die();
    				            // }