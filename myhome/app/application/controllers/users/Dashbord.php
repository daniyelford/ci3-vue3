<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Dashbord extends MY_Controller{
	public function __construct(){
		parent::__construct();
	}
// 	chat needed
	public function send_resume(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!is_null($a) && $this->Include_model->chapcha($a) && 
	    !is_null($b) && is_array($b) && 
	    !empty($_SESSION['id']) && intval($_SESSION['id'])>0 &&
	    !empty($b['crrId']) && intval($b['crrId'])>0 &&
	    !empty($b['urId']) && intval($b['urId'])>0 &&
	    !empty($b['rId']) && intval($b['rId'])>0 &&
	    $this->Users_model->add_resume_company_role_request(['role_id'=>intval($b['rId']),'user_resume_id'=>intval($b['urId']),'company_role_request_id'=>intval($b['crrId'])]))
	        die('111');
	    die('0');
	}
	private function securite_value($str){
        return (!empty($str) && is_string($str)?strip_tags(str_replace(["/",'~','"',"'",':','#','@','!','|',';','?','<','>','.',',','&','*','`','=','%'],'',$str)):'');
    }
	public function edit_resume_status(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!is_null($a) && $this->Include_model->chapcha($a) && 
	    !is_null($b) && is_array($b) && 
	    !empty($_SESSION['id']) && intval($_SESSION['id'])>0 &&
	    !empty($b['id']) && intval($b['id'])>0 &&
	    $this->Users_model->edit_resume(['status'=>(!empty($b['status']) && intval($b['status'])>0?1:0)],['id'=>intval($b['id'])]))
	        die('ok');
	    die('0');
	}
	public function edit_resume_text(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!is_null($a) && $this->Include_model->chapcha($a) && 
	    !is_null($b) && is_array($b) && 
	    !empty($_SESSION['id']) && intval($_SESSION['id'])>0 &&
	    !empty($b['id']) && intval($b['id'])>0 && !empty($b['text']) && 
	    $this->Users_model->edit_resume(['text'=>$this->securite_value($b['text'])],['id'=>intval($b['id'])]))
	        die('ok');
	    die('0');
	}
	public function add_resume(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!is_null($a) && $this->Include_model->chapcha($a) && 
	    !is_null($b) && is_array($b) && 
	    !empty($_SESSION['id']) && intval($_SESSION['id'])>0 &&
	    !empty($b['role_id']) && intval($b['role_id'])>0 && !empty($b['text']) && 
	    $this->Users_model->add_resume(['user_id'=>intval($_SESSION['id']),'role_id'=>intval($b['role_id']),'text'=>$this->securite_value($b['text'])]))
	        die('111');
	    die('0');
	}
	private function user_resume(){
	    $return=['roles'=>[],'resume'=>[]];
	    $role_ids_array=[];
	    $roles=$this->Roles_model->all_where_status();
	    $requests=$this->Company_model->all_role_request();
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && ($a=$this->Users_model->select_resume_where_user_id(intval($_SESSION['id'])))!==false && !empty($a))
	        foreach($a as $b){
	            $ret=[];
	            if(!empty($b) && !empty($b['id']) && intval($b['id'])>0 && !empty($b['role_id']) && intval($b['role_id'])>0 && !empty($roles)){
    	            $ret['resume_id']=intval($b['id']);
    	            $ret['resume_status']=(!empty($b['status']) && intval($b['status'])>0?1:0);
    	            $ret['resume_text']=(!empty($b['text'])?$b['text']:'');
    	            $ret['user_resume_role']=$roles[array_search(intval($b['role_id']), array_column($roles, 'id'))];
            	    $company_role_request_id_array=[];
            	    $role_ids_array[]=intval($b['role_id']);
    	            if(($g=$this->Users_model->select_resume_company_role_request_where_user_resume_id(intval($b['id'])))!==false && !empty($g) && !empty($requests)){
        	            foreach($g as $c){
            	            $arr=[];
            	            if(!empty($c) && !empty($c['company_role_request_id']) && intval($c['company_role_request_id'])>0 && 
            	            ($q=$requests[array_search(intval($c['company_role_request_id']), array_column($requests, 'id'))])!==false &&
            	            !empty($q) && !empty($q['company_id']) &&  intval($q['company_id'])>0 && !empty($q['role_id']) && intval($q['role_id'])>0 &&
                	        ($d=$this->Company_model->select_company_where_id(intval($q['company_id'])))!==false &&
                	        !empty($d) && !empty($d['0'])){
                	            $company_role_request_id_array[]=intval($c['company_role_request_id']);
                	            $arr['resume_company_role_request_status']=(!empty($c['status']) && intval($c['status'])>0?intval($c['status']):0);
                	            $arr['company_request_role']=$roles[array_search(intval($q['role_id']), array_column($roles, 'id'))];
                	            $arr['company_role_request_text']=$q['text'];
                	            $arr['company_info']=$d['0'];
                	            $ret['send_resume'][]=$arr;
            	            }
        	            }
    	            }
            	    $e=[];
            	    foreach($requests as $r){
            	        if(!empty($r) && !empty($r['id']) && intval($r['id'])>0 && !empty($r['status']) && intval($r['status'])>0 && !empty($r['company_id']) && 
            	        intval($r['company_id'])>0 && !empty($r['role_id']) && intval($r['role_id'])>0 && 
            	        !in_array(intval($r['id']),$company_role_request_id_array) &&
            	        intval($r['role_id'])===intval($b['role_id']) && 
            	        ($f=$this->Company_model->select_company_where_id(intval($r['company_id'])))!==false && !empty($f) && 
            	        !empty($f['0']))
            	            $e[]=['role_id'=>intval($r['role_id']),'company_role_request_id'=>$r['id'],'user_resume_id'=>$b['id'],'company_info'=>$f['0'],'text'=>(!empty($r['text'])?$r['text']:'')];
            	    }
            	    $ret['other_company_request']=$e;
	            }
	            $return['resume'][]=$ret;
	        }
	        $return['roles']=$roles;
	        $return['access_roles']=$role_ids_array;
	    return $return;
	}
	public function resume(){
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 &&
	    ($a=$this->Users_model->select_where_id(intval($_SESSION['id'])))!==false&&!empty($a) && !empty($a['0']) && 
	    !empty($a['0']['user_info_id']) && intval($a['0']['user_info_id'])>0 && 
	    ($b=$this->Users_model->select_info_where_id(intval($a['0']['user_info_id'])))!==false && !empty($b) && !empty($b['0'])){
            $has_auth_info_error=(!empty($b['0']['cart_mely_picture']) && !empty($b['0']['mely_code'])?false:true);
            $category=new Category_handler();
            echo $this->load->view('header',[
    		    'category'=>$category->valex_show(),
    			'id'=>intval($_SESSION['id']),
    			'has_auth_info_error'=>$has_auth_info_error,
    			'user_info'=>(!empty($_SESSION['user_info'])?$_SESSION['user_info']:[]),
    			'lat'=>(!empty($_SESSION['lt'])?$_SESSION['lt']:''),
    			'lon'=>(!empty($_SESSION['ln'])?$_SESSION['ln']:''),
    			'title'=>'رزومه ها',
    	    ],true).
    		$this->load->view('users/dashbord/resume',[
    		    'info'=>$b['0'],
    		    'data'=>$this->user_resume(),
    		],true).
    		$this->load->view('footer',[
    		    'map_page'=>false,
    		    'lang'=>'fa',
    		    'change_lang'=>'true',
    		    'my_company'=>(!empty($_SESSION['my_company'])?$_SESSION['my_company']:[]),
                'id'=>intval($_SESSION['id']),
        	],true);
	    }else{
	        header('Location:'.base_url());
	    }
	}
	public function shopping(){
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 &&
	    ($a=$this->Users_model->select_where_id(intval($_SESSION['id'])))!==false&&!empty($a) && !empty($a['0']) && 
	    !empty($a['0']['user_info_id']) && intval($a['0']['user_info_id'])>0 && 
	    ($b=$this->Users_model->select_info_where_id(intval($a['0']['user_info_id'])))!==false && !empty($b) && !empty($b['0'])){
            $has_auth_info_error=(!empty($b['0']['cart_mely_picture']) && !empty($b['0']['mely_code'])?false:true);
            $category=new Category_handler();
            $position=new Position_handler();
            $position->show_my_position_valex(intval($_SESSION['id']));
    	    echo $this->load->view('header',[
    		    'category'=>$category->valex_show(),
    			'id'=>intval($_SESSION['id']),
    			'has_auth_info_error'=>$has_auth_info_error,
    			'user_info'=>(!empty($_SESSION['user_info'])?$_SESSION['user_info']:[]),
    			'lat'=>(!empty($_SESSION['lt'])?$_SESSION['lt']:''),
    			'lon'=>(!empty($_SESSION['ln'])?$_SESSION['ln']:''),
    			'title'=>'سبد خرید',
    	    ],true).
    	    '<span id="side2">'.
        	$this->load->view('users/shop/shop',[
        		'info'=>$_SESSION['user_info'],
        		'my_position'=>(!empty($position->my_position)?1:0),
        	    'none_position'=>$position->my_position,
        	    'type'=>'none_position'
            ],true).
    	    '</span>'.
    		$this->load->view('footer',[
    		    'map_page'=>false,
    		    'lang'=>'fa',
    		    'change_lang'=>'true',
    		    'my_company'=>(!empty($_SESSION['my_company'])?$_SESSION['my_company']:[]),
    		    'id'=>intval($_SESSION['id']),
        	],true);
	    }else{
	        header('Location:'.base_url());
	    }
	}
	public function reserve(){
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 &&
	    ($a=$this->Users_model->select_where_id(intval($_SESSION['id'])))!==false&&!empty($a) && !empty($a['0']) && 
	    !empty($a['0']['user_info_id']) && intval($a['0']['user_info_id'])>0 && 
	    ($b=$this->Users_model->select_info_where_id(intval($a['0']['user_info_id'])))!==false && !empty($b) && !empty($b['0'])){
	        $has_auth_info_error=(!empty($b['0']['cart_mely_picture']) && !empty($b['0']['mely_code'])?false:true);
            $category=new Category_handler();
            $position=new Position_handler();
            $position->show_my_position_valex(intval($_SESSION['id']));
    	    echo $this->load->view('header',[
    	        'has_auth_info_error'=>$has_auth_info_error,
    		    'category'=>$category->valex_show(),
    			'id'=>intval($_SESSION['id']),
    			'user_info'=>(!empty($_SESSION['user_info'])?$_SESSION['user_info']:[]),
    			'lat'=>(!empty($_SESSION['lt'])?$_SESSION['lt']:''),
    			'lon'=>(!empty($_SESSION['ln'])?$_SESSION['ln']:''),
    			'title'=>'سبد رزرو',
    	    ],true).
    	    '<span id="side2">'.
        	$this->load->view('users/shop/shop',[
        	    'info'=>$_SESSION['user_info'],
        		'my_position'=>(!empty($position->my_position)?1:0),
        		'type'=>'has_position',
        		'has_position'=>$position->my_position,
        		'calendar'=>$position->calendar
        	],true).
    	    '</span>'.
    		$this->load->view('footer',[
    		    'map_page'=>false,
    		    'lang'=>'fa',
    		    'change_lang'=>'true',
    		    'my_company'=>(!empty($_SESSION['my_company'])?$_SESSION['my_company']:[]),
    		    'id'=>intval($_SESSION['id']),
        	],true);
	    }else{
	        header('Location:'.base_url());
	    }
	}
	public function setting(){
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 &&
	    ($a=$this->Users_model->select_where_id(intval($_SESSION['id'])))!==false&&!empty($a) && !empty($a['0']) && 
	    !empty($a['0']['user_info_id']) && intval($a['0']['user_info_id'])>0 && 
	    ($b=$this->Users_model->select_info_where_id(intval($a['0']['user_info_id'])))!==false && !empty($b) && !empty($b['0'])){
            $category=new Category_handler();
    	    echo $this->load->view('header',[
    		    'category'=>$category->valex_show(),
    			'id'=>intval($_SESSION['id']),
    			'user_info'=>(!empty($_SESSION['user_info'])?$_SESSION['user_info']:[]),
    			'lat'=>(!empty($_SESSION['lt'])?$_SESSION['lt']:''),
    			'lon'=>(!empty($_SESSION['ln'])?$_SESSION['ln']:''),
    			'title'=>'',
    	    ],true).
    		$this->load->view('users/dashbord/setting',[
    		    'uploader'=>$this->load->view('includes/uploader',['url'=>'assets---svg---user','type'=>'image'],true),
    		    'upload'=>$this->load->view('includes/uploader',['url'=>'assets---svg---user','type'=>'image'],true),
    		    'data'=>$a['0'],
    		    'info'=>$b['0'],
    		    'timer'=>$this->load->view('includes/timer',['dont_use_id'=>false,'want_hour'=>false,'next_years'=>'','time'=>(!empty($b['0']['birthday'])?$b['0']['birthday']:time())],true)
    		],true).
    		$this->load->view('footer',[
    		    'map_page'=>false,
    		    'lang'=>'fa',
    		    'change_lang'=>'true',
    		    'my_company'=>(!empty($_SESSION['my_company'])?$_SESSION['my_company']:[]),
                'id'=>intval($_SESSION['id']),
        	],true);
	    }else{
	        header('Location:'.base_url());
	    }
	}
	public function send_code_phone(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']['phone'])?$_POST['data']['phone']:null);
	    if(!is_null($a) && $this->Include_model->chapcha($a) && 
	    !is_null($b) &&
	    !empty($_SESSION['id']) && intval($_SESSION['id'])>0 && 
	    ($z=$this->Users_model->select_info_where_user_id(intval($_SESSION['id'])))!==false && !empty($z) && !empty($z['0']) &&
        !empty($z['0']['id'])){
            $x=$this->Users_model->select_info_where_phone($b);
            if(!empty($x)){
                die('2');
            }else{
                $_SESSION['sms_edit_code']=rand(100000,1000000);
                $_SESSION['sms_edit_user_info_id']=intval($z['0']['id']);
                if($this->Include_model->send_sms_force_two($_SESSION['sms_edit_code'],$b)) die('1');
                $_SESSION['sms_edit_code']=$_SESSION['sms_edit_user_info_id']='';
                die('3');
            }
	    }
	    die('0');
	}
	public function send_code_phone_accept(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']['code'])?$_POST['data']['code']:null);
	    $c = (!empty($_POST['data']['phone'])?$_POST['data']['phone']:null);
	    if(!is_null($a) && $this->Include_model->chapcha($a) && 
	    !is_null($b) && !is_null($c) && 
	    !empty($_SESSION['id']) && intval($_SESSION['id'])>0 &&
	    !empty($_SESSION['sms_edit_code']) && intval($_SESSION['sms_edit_code'])>0)
    	    if(intval($_SESSION['sms_edit_code'])===intval($b) && 
    	    !empty($_SESSION['sms_edit_user_info_id']) && intval($_SESSION['sms_edit_user_info_id'])>0 &&
    	    $this->Users_model->edit_info(['phone'=>$c],['id'=>intval($_SESSION['sms_edit_user_info_id'])]))
    	        die('111');
    	    else
                die('20');
    	else
    	    die('0');
	}
	public function edit_user(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!is_null($a) && $this->Include_model->chapcha($a) && 
	    !is_null($b) && is_array($b) && 
	    !empty($_SESSION['id']) && intval($_SESSION['id'])>0 &&
	    ($c=$this->Users_model->select_where_id(intval($_SESSION['id'])))!==false&&!empty($c) && !empty($c['0']) &&
	    !empty($c['0']['user_info_id']) && intval($c['0']['user_info_id'])>0){
	        $arr=[];
	        if(!empty($b['name'])) $arr['name'] = $b['name'];
	        if(!empty($b['family'])) $arr['family'] = $b['family'];
	        if(!empty($b['image'])) $arr['image'] = base_url('assets/svg/user/'.$b['image']);
	        if(!empty($b['melyCod'])) $arr['mely_code'] = $b['melyCod'];
            if(!empty($b['gmail'])) $arr['gmail'] = $b['gmail'];
            if(!empty($b['phone']))$arr['phone'] = $b['phone'];
            if(!empty($b['day']) && !empty($b['month']) && !empty($b['year'])) $arr['birthday'] = $this->Include_model->change_to_time($b['day'],$b['month'],$b['year'],0,0);
            if(!empty($b['tel'])) $arr['home_tel'] = $b['tel'];
            if(!empty($b['address'])) $arr['address'] = $b['address'];
            if(!empty($b['postyCod'])) $arr['posty_code'] = $b['postyCod'];
            if(!empty($b['cartMelyImage'])) $arr['cart_mely_picture'] = $b['cartMelyImage'];
            if(!$this->Users_model->edit_info($arr,['id'=>intval($c['0']['user_info_id'])])) die('0');
            if(!empty($c['0']['auth_info_id']) && intval($c['0']['auth_info_id'])>0 && !empty($b['password']) && 
            $this->Users_model->edit_auth(['password'=>$this->Users_model->xss_cleaner($b['password'])],
            ['id'=>intval($c['0']['auth_info_id'])])){
                die('11111');
            }elseif((empty($c['0']['auth_info_id']) || intval($c['0']['auth_info_id'])==0) &&
            !empty($b['username']) && !empty($b['password']) && 
            ($d=$this->Users_model->auth_where_username($b['username']))!==false){
                if(!empty($d) && !empty($d['0'])) die('2');
                if(($e=$this->Users_model->add_auth_return_id($b['username'],$b['password']))!==false &&
                !empty($e) && intval($e)>0 &&
                $this->Users_model->edit(['auth_info_id'=>intval($e)],['id'=>intval($_SESSION['id'])])) die('111');
            }elseif(!empty($b['username']) || !empty($b['password'])){
                die('39');
            }else{
                die('11111');
            }
	    }
	    die('0');
	}
	public function disable_cart_pic(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])==1 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !empty($b['id']) && intval($b['id'])>0 && 
	    $this->Users_model->edit_info(['cart_mely_picture'=>null],['id'=>intval($b['id'])])){
    	    $g=$this->Users_model->select_info_where_id(intval($b['id']));
            $accept_task_massage=(!empty($g['0']['name'])?$g['0']['name']:'').' '.(!empty($g['0']['family'])?$g['0']['family']:'').'عزیز عکس کارت ملی شما مورد تایید نیست لطفا کارت ملی خود را به برگه ی سفید بچسبانید و روی آن ادرس سایت را یادداشت نمایید و از کسی بخواهید که از شما عکس بگیرد و سپس در آدرس https://www.my-home.ir/user_setting مجددا بارگذاری کنید';
            $h=$this->Include_model->send_massage_to_user([],(!empty($g['0']['phone'])?$g['0']['phone']:''),(!empty($g['0']['gmail'])?$g['0']['gmail']:''),
            '',
            'اخطار اطلاعاتی',
            $accept_task_massage);
            die('ok');
	    }
	    die('0');    
	}
	public function disable_cart_code(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])==1 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !empty($b['id']) && intval($b['id'])>0 && 
	    $this->Users_model->edit_info(['mely_code'=>null],['id'=>intval($b['id'])])){
	        $g=$this->Users_model->select_info_where_id(intval($b['id']));
            $accept_task_massage=(!empty($g['0']['name'])?$g['0']['name']:'').' '.(!empty($g['0']['family'])?$g['0']['family']:'').
            'عزیز کد ملی شما با بقیه اطلاعات شما همخوانی ندارد لطفا کد ملی صحیح را در آدرس https://www.my-home.ir/user_setting مجددا یادداشت کنید';
            $h=$this->Include_model->send_massage_to_user([],(!empty($g['0']['phone'])?$g['0']['phone']:''),(!empty($g['0']['gmail'])?$g['0']['gmail']:''),
            '',
            'اخطار اطلاعاتی',
            $accept_task_massage);
            die('ok');
	    }
	    die('0');    
	}
	public function disable(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])==1 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !empty($b['id']) && intval($b['id'])>0 && 
	    $this->Users_model->edit(['status'=>0],['id'=>intval($b['id'])]))
	        die('ok');
	    die('0');    
	}
	public function enable(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])==1 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !empty($b['id']) && intval($b['id'])>0 && 
	    $this->Users_model->edit(['status'=>1],['id'=>intval($b['id'])]))
	        die('ok');
	    die('0');   
	}
	public function disable_cart(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])==1 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !empty($b['id']) && intval($b['id'])>0 && 
	    $this->Users_model->edit_cart(['status'=>0],['id'=>intval($b['id'])]))
	        die('ok');
	    die('0'); 
	}
    public function enable_cart(){
        $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])==1 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !empty($b['id']) && intval($b['id'])>0 && 
	    $this->Users_model->edit_cart(['status'=>1],['id'=>intval($b['id'])]))
	        die('ok');
	    die('0'); 
    }
	//user manager
    public function manager(){
        $arr=[];
        if(!empty($_POST['token']) && $_POST['token']==='ok' && ($a=$this->Users_model->all_user())!==false&&!empty($a))
            foreach($a as $b){
                if(!empty($b['id']) && intval($b['id']) > 0 && intval($b['id']) !== 1 && !empty($b['user_info_id']) && intval($b['user_info_id'])>0){
                    $c=$this->Roles_model->select_company_user_where_user_id_and_status($b['id']);
                    $arr[]=[
                        'id'=>intval($b['id']),
                        'info'=>$this->Users_model->select_info_where_id(intval($b['user_info_id'])),
                        'status'=>$b['status'],
                        'login'=>$this->Users_model->select_login_where_user_id(intval($b['id']))
                    ];
                }
            }
        $this->load->view('users/dashbord/all_users',['data'=>$arr]);
    }
    public function user_none_company(){
        $arr=$ret=[];
        if(!empty($_POST['token']) && $_POST['token']==='ok'){
            if(($a=$this->Roles_model->all_user())!==false && !empty($a))
                foreach($a as $b){
                    if(!empty($b['user_id']) && intval($b['user_id'])>0 && !in_array(intval($b['user_id']),$arr))$arr[]=intval($b['user_id']);
                }
            if(($c=$this->Users_model->all_user())!==false && !empty($c))
                foreach($c as $d){
                    if(!empty($d['id']) && intval($d['id'])>0 && !in_array(intval($d['id']),$arr))
                        $ret[]=[                        
                            'id'=>intval($d['id']),
                            'info'=>$this->Users_model->select_info_where_id(intval($d['user_info_id'])),
                            'status'=>$d['status'],
                            'login'=>$this->Users_model->select_login_where_user_id(intval($d['id']))
                        ];
                }
        }
        $this->load->view('users/dashbord/user_none_company',['data'=>$ret]);
    }
    public function users_in_company(){
        $d=$g=$i=[];
        if(!empty($_POST['token']) && $_POST['token']==='ok' && !empty($_POST['company_id']) && intval($_POST['company_id'])>0 && ($a=$this->Roles_model->select_company_role_where_company_id(intval($_POST['company_id'])))!==false && !empty($a))
            foreach($a as $b){
                if(!empty($b['id']) && intval($b['id'])>0 && !in_array(intval($b['id']),$d) && !empty($b['role_id']) && intval($b['role_id'])>0 && ($c=$this->Roles_model->select_where_id_and_status(intval($b['role_id'])))!==false && !empty($c) && !empty($c['0']) && !empty($c['0']['title'])){
                    $d[]=intval($b['id']);
                    if(($e=$this->Roles_model->select_company_user_where_company_role_id(intval($b['id'])))!==false && !empty($e))
                        foreach($e as $f){
                            if(!empty($f['user_id']) && intval($f['user_id'])>0 && !empty($f['company_role_parent_id']) && intval($f['company_role_parent_id'])>0 &&
                            !in_array(intval($f['user_id']),$g)){
                                $g[]=intval($f['user_id']);
                                if(($h=$this->Users_model->select_info_where_user_id(intval($f['user_id'])))!==false && !empty($h) && !empty($h['0']))
                                    $i[]=['role'=>$c['0']['title'],'id'=>intval($f['user_id']),'user_info'=>$h['0']];
                            }
                        }
                }
            }
        $this->load->view('users/dashbord/users_in_company',['data'=>$i]);
    }
    public function section_persenel_manager(){
        $ret=[];
        if(!empty($_POST['token']) && $_POST['token']==='ok' && !empty($_POST['company_role_id']) && intval($_POST['company_role_id'])>0)
            if(($a=$this->Roles_model->select_company_user_where_company_role_parent_id_and_status(intval($_POST['company_role_id'])))!==false && !empty($a))
                foreach($a as $b){
                    if(!empty($b['user_id']) && intval($b['user_id'])>0 && !empty($b['company_role_id']) && intval($b['company_role_id'])>0 && ($c=$this->Roles_model->select_company_role_where_id(intval($b['company_role_id'])))!==false && !empty($c) && !empty($c['0']) && !empty($c['0']['role_id']) && intval($c['0']['role_id'])>0 && ($d=$this->Roles_model->select_where_id_and_status(intval($c['0']['role_id'])))!==false &&!empty($d) && !empty($d['0']) && !empty($d['0']['title']) && ($e=$this->Users_model->select_info_where_user_id(intval($b['user_id'])))!==false && !empty($e) &&!empty($e['0']))
                        $ret[]=['id'=>intval($b['user_id']),'role'=>$d['0']['title'],'info'=>$e['0']];
                }
        $this->load->view('users/dashbord/section_persenel_manager',['data'=>$ret]);
    }
}