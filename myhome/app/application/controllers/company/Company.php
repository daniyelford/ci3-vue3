<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Company extends MY_Controller
{
	public function __construct(){
		parent::__construct();
	}
	public function denied_user_resume_company_request(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!is_null($a) && $this->Include_model->chapcha($a) && 
	    !is_null($b) && is_array($b) && 
	    !empty($_SESSION['id']) && intval($_SESSION['id'])>0 &&
	    !empty($b['id']) && intval($b['id'])>0 &&
	    !empty($_SESSION['company_manager_data']) && is_array($_SESSION['company_manager_data']) &&
	    !empty($_SESSION['company_manager_data']['company_info']) &&
	    !empty($_SESSION['company_manager_data']['company_info']['id']) && 
	    intval($_SESSION['company_manager_data']['company_info']['id'])>0 &&
        !empty($_SESSION['company_manager_data']['role_id']) && 
	    intval($_SESSION['company_manager_data']['role_id'])>0 &&
	    $this->Company_model->edit_user_resume_company_role_request_weher_id(['status'=>2],intval($b['id']))) die('ok');
	    die('0');
	}
	public function accept_user_resume_company_request(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!is_null($a) && $this->Include_model->chapcha($a) && 
	    !is_null($b) && is_array($b) && 
	    !empty($_SESSION['id']) && intval($_SESSION['id'])>0 &&
	    !empty($b['id']) && intval($b['id'])>0 &&
	    !empty($_SESSION['company_manager_data']) && is_array($_SESSION['company_manager_data']) &&
	    !empty($_SESSION['company_manager_data']['company_info']) &&
	    !empty($_SESSION['company_manager_data']['company_info']['id']) && 
	    intval($_SESSION['company_manager_data']['company_info']['id'])>0 &&
        !empty($_SESSION['company_manager_data']['role_id']) && 
	    intval($_SESSION['company_manager_data']['role_id'])>0 &&
	    ($a=$this->Company_model->select_user_resume_company_role_request_where_id(intval($b['id'])))!==false && 
	    !empty($a) && !empty($a['0']) && !empty($a['0']['user_resume_id']) && intval($a['0']['user_resume_id'])>0 &&
	    ($c=$this->Users_model->select_resume_where_id(intval($a['0']['user_resume_id'])))!==false && !empty($c) && !empty($c['0']) &&
	    !empty($c['0']['user_id']) && intval($c['0']['user_id'])>0 &&
	    $this->Company_model->edit_user_resume_company_role_request_weher_id(['status'=>1],intval($b['id']))){
            $company_role_id=(($e=$this->Roles_model->select_company_role_where_array([
            'role_id'=>$a['0']['role_id'],
            'company_id'=>intval($_SESSION['company_manager_data']['company_info']['id'])
            ]))!==false && !empty($e) && !empty($e['0']) && !empty($e['0']['id']) && intval($e['0']['id'])>0?intval($e['0']['id']):
            (($f=$this->Roles_model->add_company_role_return_id([
            'role_id'=>$a['0']['role_id'],
            'company_id'=>intval($_SESSION['company_manager_data']['company_info']['id'])
            ]))!==false && !empty($f)?$f:0));
            if(($g=$this->Roles_model->select_company_user_where_array([
            'company_role_id'=>intval($company_role_id),
            'user_id'=>intval($c['0']['user_id']),
            'company_role_parent_id'=>intval($_SESSION['company_manager_data']['role_id'])
            ]))!==false && !empty($g) && !empty($g['0']))
            	die('22');
            else
            	if($this->Roles_model->add_company_user([
                'company_role_id'=>intval($company_role_id),
                'user_id'=>intval($c['0']['user_id']),
                'company_role_parent_id'=>intval($_SESSION['company_manager_data']['role_id'])
                ])) die('ok');
	    }
	    
	    die('0');
	}
	public function company_resume(){
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0){
	        if(!empty($_SESSION['company_manager_data']) && is_array($_SESSION['company_manager_data']) &&
	        !empty($_SESSION['company_manager_data']['company_info']) &&
	        !empty($_SESSION['company_manager_data']['company_info']['id']) && 
	        intval($_SESSION['company_manager_data']['company_info']['id'])>0 &&
            !empty($_SESSION['company_manager_data']['role_id']) && 
	        intval($_SESSION['company_manager_data']['role_id'])>0){
    	        $category=new Category_handler();
        	    $company=new Company_handler();
        	   // $main=new Main_exploder();
            //     $company_map=$main->valex_company_info(intval($_SESSION['company_manager_data']['company_info']['id']));
        	    $role=new Role_handler();
        	    $role->its_me=true;
        	    if(($this->id=intval($_SESSION['id']))!== false && 
        	    ($a=$this->Users_model->select_where_id($this->id))!==false && !empty($a) && !empty($a['0']) &&
                ($b=$this->Users_model->select_info_where_user_id(intval($this->id)))!==false && !empty($b) && !empty($b['0'])){
                    if(!isset($_SESSION['my_wallet']) || empty($_SESSION['my_wallet']) && ($c=$this->Order_model->select_wallet_where_user_id(intval($this->id)))!==false && !empty($c) && !empty(end($c)))
                        $_SESSION['my_wallet']=end($c);
                    $_SESSION['my_company']=$role->show_my_company_valex(intval($this->id));
                    if(!isset($_SESSION['user_info']) || empty($_SESSION['user_info']))
                        $_SESSION['user_info']=[
                            'image'=>(!empty($b['0']['image'])?$b['0']['image']:''),
                            'name'=>(!empty($b['0']['name'])?$b['0']['name']:''),
                            'family'=>(!empty($b['0']['family'])?$b['0']['family']:''),
                            'role'=>''
                        ];
                    $has_auth_info_error=(!empty($b['0']['mely_code']) && !empty($b['0']['cart_mely_picture'])?false:true);
                    $roles=$this->Roles_model->all_where_status();
                    $resume=$this->Users_model->all_resume();
                    $relation=$this->Company_model->all_user_resume_company_role_request();
                    $crr=$this->Company_model->select_company_role_request_where_company_id(intval($_SESSION['company_manager_data']['company_info']['id']));
                    $data=[];
                    if(!empty($crr) && !empty($roles))
                    foreach($crr as $cr){
                        if(!empty($cr) && !empty($cr['id']) && intval($cr['id'])>0 && !empty($relation)){
                            foreach($relation as $rel){
                                if(!empty($rel['company_role_request_id']) && intval($rel['company_role_request_id'])>0 && 
                                !empty($rel['role_id']) && intval($rel['role_id'])>0 && 
                                ($rol=$roles[array_search(intval($rel["role_id"]),array_column($roles,'id'))])!==false && !empty($rol) &&
                                intval($rel['company_role_request_id'])===intval($cr['id']) && !empty($rel['user_resume_id']) && 
                                intval($rel['user_resume_id'])>0 && !empty($resume) && 
                                ($res=$resume[array_search(intval($rel['user_resume_id']),array_column($resume,'id'))])!==false &&
                                !empty($res) && !empty($res['user_id']) && intval($res['user_id'])>0 && 
                                ($usr=$this->Users_model->select_info_where_user_id($res['user_id']))!==false &&
                                !empty($usr) && !empty($usr['0'])){
                                    $data[]=[
                                        'user_info'=>$usr['0'],
                                        'company_role_request'=>$cr,
                                        'user_resume_company_role_request'=>$rel,
                                        'user_resume'=>$res,
                                        'role'=>$rol
                                    ];
                                }
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
            			'title'=>'بررسی رزومه ها',
            		],true).
            	    $this->load->view('company/resume',[
            	        'company_role_id'=>intval($_SESSION['company_manager_data']['role_id']),
            	        'company_id'=>intval($_SESSION['company_manager_data']['company_info']['id']),
            	        'company_info'=>$_SESSION['company_manager_data']['company_info'],
            	        'data'=>$data
            	        ],true).
            		$this->load->view('footer',[
            		    'map'=>true,
                	    'my_company'=>$_SESSION['my_company'],
            		    'lang'=>'fa',
            		    'change_lang'=>'true',
            		    'id'=>$this->id,
                	],true);
                }
	        }else{
        	    $this->manage();
            }
        }else{
            header('Location:'.base_url());
            exit();
        }
	}
	public function edit_company_role_request_status(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!is_null($a) && $this->Include_model->chapcha($a) && 
	    !is_null($b) && is_array($b) && 
	    !empty($_SESSION['id']) && intval($_SESSION['id'])>0 &&
	    !empty($b['id']) && intval($b['id'])>0 &&
	    $this->Company_model->edit_role_request_weher_id(['status'=>(!empty($b['status']) && intval($b['status'])>0?1:0)],intval($b['id'])))
	        die('ok');
	    die('0');
	}
	public function edit_company_role_request_text(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!is_null($a) && $this->Include_model->chapcha($a) && 
	    !is_null($b) && is_array($b) && 
	    !empty($_SESSION['id']) && intval($_SESSION['id'])>0 &&
	    !empty($b['id']) && intval($b['id'])>0 && !empty($b['text']) && 
	    $this->Company_model->edit_role_request_weher_id(['text'=>$this->securite_value($b['text'])],intval($b['id'])))
	        die('ok');
	    die('0');
	}
	public function add_role_request(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) &&
	    !empty($b['role_id']) && intval($b['role_id'])>0 && !empty($b['text']) && !empty($_SESSION['company_manager_data']['company_info']) &&
	    !empty($_SESSION['company_manager_data']['company_info']['id']) && intval($_SESSION['company_manager_data']['company_info']['id'])>0 &&
	    $this->Company_model->add_role_request([
	        'company_id'=>intval($_SESSION['company_manager_data']['company_info']['id']),
	        'role_id'=>intval($b['role_id']),
	        'text'=>$this->securite_value($b['text'])])) die('111');
	    die('0');
	}
    public function accept_work(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !is_null($b) && !empty($b['i']) && intval($b['i'])>0 && 
	    $this->Roles_model->edit_company_user_where_id(['status'=>1],intval($b['i']))){
	        $c=$this->Roles_model->select_company_user_where_id(intval($b['i']));
	        if(!empty($c) && !empty($c['0']) && !empty($c['0']['company_role_parent_id']) && intval($c['0']['company_role_parent_id'])>0 && 
	        !empty($c['0']['user_id']) && intval($c['0']['user_id'])>0 &&
	        ($e=$this->Roles_model->select_company_role_where_id(intval($c['0']['company_role_parent_id'])))!==false &&
	        !empty($e) && !empty($e['0']) && !empty($e['0']['company_id']) && intval($e['0']['company_id'])>0 &&
	        ($f=$this->Company_model->select_company_where_id_and_status(intval($e['0']['company_id'])))!==false &&
	        !empty($f) && !empty($f['0']) && !empty($f['0']['title']) &&
	        ($d=$this->Roles_model->select_company_user_where_company_role_id_and_status($c['0']['company_role_parent_id']))!==false &&
	        !empty($d) && !empty($d['0']) && !empty($d['0']['user_id']) && intval($d['0']['user_id'])>0){
	            $s=$this->Users_model->select_info_where_user_id(intval($c['0']['user_id']));
                if(!empty($s) && !empty($s['0'])){
                    $text1=(!empty($s['0']['name'])?$s['0']['name']:'').' '.(!empty($s['0']['family'])?$s['0']['family']:'').
                    ' عزیز ورود شما به مجموعه ی'.
                    $f['0']['title'].
                    ' را به شما تبریک میگوییم';
                    $send=$this->Include_model->send_massage_to_user([],
                    (!empty($s['0']['phone'])?$s['0']['phone']:''),(!empty($s['0']['gmail'])?$s['0']['gmail']:''),
                    '',
                    'قبول درخواست کاری',
                    $text1);
                }
                $g=$this->Users_model->select_info_where_user_id(intval($d['0']['user_id']));
                if(!empty($g) && !empty($g['0'])){
                    $text1=(!empty($g['0']['name'])?$g['0']['name']:'').' '.(!empty($g['0']['family'])?$g['0']['family']:'').
                    ' عزیز درخواست کاری شما برای مجموعه ی'.
                    $f['0']['title'].
                    ' توسط '.
                    (!empty($s['0']['name'])?$s['0']['name']:'').' '.(!empty($s['0']['family'])?$s['0']['family']:'').
                    ' قبول شده است';
                    $send=$this->Include_model->send_massage_to_user([],
                    (!empty($s['0']['phone'])?$s['0']['phone']:''),(!empty($s['0']['gmail'])?$s['0']['gmail']:''),
                    '',
                    'قبول درخواست کاری',
                    $text1);
                }
            }
            $company=new Company_handler();
	        $role=new Role_handler();
	        $_SESSION['my_company']=$role->show_my_company_valex(intval($_SESSION['id'])); 
    	    die($this->load->view('company/all',[
    	        'my_order'=>$company->show_my_order_valex($_SESSION['my_company']),
    	        'company_info'=>$_SESSION['my_company']
    	    ],true));
	    }
    	die('0');
	}
	public function add_user(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !is_null($b) && !empty($b['companyId']) && intval($b['companyId'])>0 &&
	    !empty($b['companyRoleId']) && intval($b['companyRoleId'])>0 && !empty($b['roleId']) && intval($b['roleId'])>0 &&
	    !empty($b['value']) && !empty($b['type'])){
	        $arr=($b['type']=="#phone-number"?['phone'=>addslashes(strip_tags($b['value']))]:($b['type']=="#gmail"?['gmail'=>addslashes(strip_tags($b['value']))]:[]));
	        if(!empty($arr)){
	            $user_id=(($c=$this->Users_model->select_info_where_array($arr))!==false && !empty($c) && !empty($c['0']) && !empty($c['0']['id']) && intval($c['0']['id'])>0 && ($d=$this->Users_model->select_where_info_id(intval($c['0']['id'])))!==false && !empty($d) && !empty($d['0']) && !empty($d['0']['id']) && intval($d['0']['id'])>0?intval($d['0']['id']):0);
	            $company_role_id=(($e=$this->Roles_model->select_company_role_where_array(['role_id'=>intval($b['roleId']),'company_id'=>intval($b['companyId'])]))!==false && !empty($e) && !empty($e['0']) && !empty($e['0']['id']) && intval($e['0']['id'])>0?intval($e['0']['id']):(($f=$this->Roles_model->add_company_role_return_id(['role_id'=>intval($b['roleId']),'company_id'=>intval($b['companyId'])]))!==false && !empty($f)?$f:0));
	            if(intval($company_role_id)==0) die('0');
	            if(intval($user_id)==0){
	                if($b['type']=="#phone-number"){
	                    if(($h=$this->Users_model->add_info_return_id(['name'=>'کاربر','family'=>'مجازی','phone'=>addslashes(strip_tags($b['value']))]))!==false && !empty($h) && intval($h)>0 && ($i=$this->Users_model->add_user_return_id(['user_info_id'=>intval($h)]))!==false && !empty($i) && intval($i)>0 && $this->Users_model->add_wallet(['user_id'=>intval($i)])){
                            $user_id=intval($i);
    	                    $text='سلام دوست عزیز از شما دعوت به همکاری شده کافیه با همین شماره در سایت
    	                    https://www.my-home.ir
    	                    ثبت نام کنی تا فرصت شغلی خودت رو مدیریت کنی';
    	                    $j=$this->Include_model->send_whatsapp_massage($h['0']['phone'],$text);
                            $k=$this->Include_model->send_sms($text,[$h['0']['phone']]);
	                    }
	                }elseif($b['type']=="#gmail"){
	                    if(($h=$this->Users_model->add_info_return_id(['name'=>'کاربر','family'=>'مجازی','gmail'=>addslashes(strip_tags($b['value']))]))!==false && !empty($h) && intval($h)>0 && ($i=$this->Users_model->add_user_return_id(['user_info_id'=>intval($h)]))!==false && !empty($i) && intval($i)>0 && $this->Users_model->add_wallet(['user_id'=>intval($i)])){
                            $text='برای ثبت نام و بررسی درخواست شغلی می توانید با لینک زیر وارد شوید https://www.my-home.ir/users/users/auto_auth/google و سپس از صفحه ی https://www.my-home.ir/company_manager درخواست خود را بررسی کنید';
                            $user_id=intval($i);
                            $l=$this->Include_model->send_email($b['value'],'درخواست شغلی',$text);
	                    }
	                }else{
	                    die('0');
	                }
	            }else{
	                $h=$this->Users_model->select_info_where_user_id(intval($user_id));
        	        if(!empty($h) && !empty($h['0'])){
        	            $text=(!empty($h['0']['name'])?$h['0']['name']:'').' '.(!empty($h['0']['family'])?$h['0']['family']:'').
        	            ' عزیز از شما درخواست همکاری شده برای مشاهده ی بیشتر به آدرس 
        	             https://www.my-home.ir/company_manager
        	             بروید';
            	        $send=$this->Include_model->send_massage_to_user([],
                        (!empty($h['0']['phone'])?$h['0']['phone']:''),(!empty($h['0']['gmail'])?$h['0']['gmail']:''),
                        '',
            	        'درخواست شغلی',
                        $text);
        	        }
	            }
	            if(($g=$this->Roles_model->select_company_user_where_array(['company_role_id'=>intval($company_role_id),'user_id'=>intval($user_id),'company_role_parent_id'=>intval($b['companyRoleId'])]))!==false && !empty($g) && !empty($g['0']))
	                die('22');
	            else
	                if($this->Roles_model->add_company_user(['company_role_id'=>intval($company_role_id),'user_id'=>intval($user_id),'company_role_parent_id'=>intval($b['companyRoleId'])])) 
	                    die('111');
	            die('0');
	        }
	    }
	    die();
	}
	public function add(){
        $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !is_null($b) && !empty($b['user']) && intval($b['user'])>0 && intval($b['user'])==intval($_SESSION['id']) &&
	    ($b['title']=$this->securite_value($b['title']))!==false && ($b['des']=$this->securite_value($b['des']))!==false &&
	    !empty($b['title']) && !empty($b['des'])){
	        $f=(!empty($b['file']) && is_string($b['file'])?$b['file']:'');
	        $u=(!empty($b['url']) && is_string($b['url'])?$b['url']:'');
            $t=(!empty($b['type']) && intval($b['type'])>0?intval($b['type']):0);
            $handler=$this->Company_model->select_company_where_title($b['title']);
            if(!empty($handler) && !empty($handler['0'])) die('23');
	        if(($c_id=$this->Company_model->add_return_id(['qr_code'=>$this->generate_qrcode(base_url('show_company/'.$this->set_url($b['title']))),'title'=>$b['title'],'icon'=>$f,'description'=>$b['des'],'type'=>$t,'url'=>$u]))!==false&&
	        !empty($c_id) && intval($c_id)>0 &&
	        ($r_id=$this->Roles_model->add_company_role_return_id(['role_id'=>8,'company_id'=>intval($c_id)]))!==false &&
	        !empty($r_id) && intval($r_id)>0 &&
	        $this->Roles_model->add_company_user(['company_role_id'=>intval($r_id),'company_role_parent_id'=>0,'user_id'=>intval($b['user']),'status'=>1])){
                $s=$this->Users_model->select_info_where_user_id(intval($b['user']));
                if(!empty($s) && !empty($s['0'])){
                    $text1=(!empty($s['0']['name'])?$s['0']['name']:'').' '.(!empty($s['0']['family'])?$s['0']['family']:'').
                    ' عزیز کسب و کار شما تحت عنوان '.
                    $b['title'].
                    ' با موفقیت ایجاد شد از همراهی با شما باعث افتخار ماست';
                    $send=$this->Include_model->send_massage_to_user([],
                    (!empty($s['0']['phone'])?$s['0']['phone']:''),(!empty($s['0']['gmail'])?$s['0']['gmail']:''),
                    '',
                    'راه اندازی کسب و کار',
                    $text1);
                }
    	        die('11111111');
	        }
	    }
	    die('0');
    }
	private $id=0;
	private function reverse_url($str){
	    return (!empty($str) && is_string($str)?str_replace('--',' ',$str):'');
	}
	public function expier_user(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !is_null($b) && !empty($b['cuId']) && intval($b['cuId'])>0){
	        if($this->Roles_model->edit_company_user_where_id(['status'=>2],intval($b['cuId'])))die('1111111');
	    }
	    die();
	}
	public function edit_user(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !is_null($b) && 
	    !empty($b['rId']) && intval($b['rId'])>0 && 
	    !empty($b['cId']) && intval($b['cId'])>0 &&
	    !empty($b['cuId']) && intval($b['cuId'])>0){
	        $company_role_id=(($c=$this->Roles_model->select_company_role_where_array([
	            'role_id'=>intval($b['rId']),
	            'company_id'=>intval($b['cId'])
	        ]))!==false && !empty($c) && !empty($c['0']) && !empty($c['0']['id']) && intval($c['0']['id'])>0?
	            intval($c['0']['id']):
	            (($d=$this->Roles_model->add_company_role_return_id([
	                'role_id'=>intval($b['rId']),
	                'company_id'=>intval($b['cId'])
	            ]))!==false && !empty($d)?$d:0));
	        if(intval($company_role_id)==0) die('0');
	        if($this->Roles_model->edit_company_user_where_id(['status'=>1,'company_role_id'=>intval($company_role_id)],intval($b['cuId'])))die('1111111');
	    }
	    die();
	}
	public function show_profile_id(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if( !is_null($a) && $this->Include_model->chapcha($a) && 
	    !is_null($b) && 
	    !empty($b['cId']) && intval($b['cId'])>0 && ($c=$this->Company_model->select_company_where_id(intval($b['cId']))) && !empty($c) && !empty($c['0']) && !empty($c['0']['title']))
	        die($this->set_url($c['0']['title']));
	    die('0');
	}
	public function show($prop){
	    if(!empty($prop) && is_string($prop) && ($prop=$this->reverse_url($this->securite_value(rawurldecode($prop))))!==false && 
	    ($company_info=$this->Company_model->select_company_where_title_and_status($prop))!==false && !empty($company_info) && !empty($company_info['0']) && 
	    !empty($company_info['0']['id']) && intval($company_info['0']['id'])>0){
	        $this->id=(!empty($_SESSION['id']) && intval($_SESSION['id'])>0?intval($_SESSION['id']):0);
	        $company_products=$this->Company_model->select_category_product_where_company_id_and_status(intval($company_info['0']['id']));
	        $all_pos_arr=$all_pro_arr=$all_pos_id_arr=$all_pro_id_arr=[];
            $category=new Category_handler();
        	$role=new Role_handler();
        	$main=new Main_exploder();
        	$main->valex_user_id=intval($this->id);
	        $main->valex_lt=(!empty($_SESSION['lt'])?$_SESSION['lt']:'');
            $main->valex_ln=(!empty($_SESSION['ln'])?$_SESSION['ln']:'');
	        if(!empty($company_products)){
	            foreach($company_products as $compos){
	                if(!empty($compos) && !empty($compos['position_id']) && intval($compos['position_id'])>0 && !in_array(intval($compos['position_id']),$all_pos_id_arr)){
	                    $all_pos_id_arr[]=intval($compos['position_id']);
	                    $var=$main->valex_position_info(intval($compos['position_id']));
	                    if(!empty($var)) $all_pos_arr[]=$var;
	                }
	                if(!empty($compos) && !empty($compos['product_id']) && intval($compos['product_id'])>0 && !in_array(intval($compos['product_id']),$all_pro_id_arr)){
	                    $all_pro_id_arr[]=intval($compos['product_id']);
	                    $var=$main->valex_product_info(intval($compos['product_id']));
	                    if(!empty($var)) $all_pro_arr[]=$var;
	                }
	            }
	        }
        	$has_auth_info_error=true;
        	if(intval($this->id)>0&&($a=$this->Users_model->select_where_id($this->id))!==false && !empty($a) && !empty($a['0']) && ($b=$this->Users_model->select_info_where_user_id(intval($this->id)))!==false && !empty($b) && !empty($b['0'])){
                if(($c=$this->Order_model->select_wallet_where_user_id(intval($this->id)))!==false && !empty($c) && !empty(end($c))) $_SESSION['my_wallet']=end($c);
                $_SESSION['my_company']=$role->show_my_company_valex(intval($this->id));    
                if(!isset($_SESSION['user_info']) || empty($_SESSION['user_info'])) $_SESSION['user_info']=['image'=>(!empty($b['0']['image'])?$b['0']['image']:''),'name'=>(!empty($b['0']['name'])?$b['0']['name']:''),'family'=>(!empty($b['0']['family'])?$b['0']['family']:''),'role'=>''];
                $has_auth_info_error=(!empty($b['0']['mely_code']) && !empty($b['0']['cart_mely_picture'])?false:true);
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
                'title'=>$prop
            ],true).
            $this->load->view('company/profile',[
                'id'=>$this->id,
                'data'=>$main->valex_company_info(intval($company_info['0']['id'])),
                'pos'=>$all_pos_arr,
                'pro'=>$all_pro_arr
            ],true).
            $this->load->view('footer',[
        		'map'=>'true',
        		'chart'=>'true',
            	'my_company'=>(!empty($_SESSION['my_company'])?$_SESSION['my_company']:[]),
                'lang'=>'fa',
            	'change_lang'=>'true',
            	'id'=>$this->id
            ],true);
	    }else{
	        header('location:'.base_url());
	    }
	    exit();
	}
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
	public function remove_map(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !empty($b['id']) && intval($b['id'])>0 &&
	    !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
	    !empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && 
	    !empty($_SESSION['id']) && intval($_SESSION['id'])>0 && 
	    intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) &&
        $this->Company_model->remove_map_where_id(intval($b['id'])))die('111');
        die('0');
	}
	public function add_map(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !empty($b['lat']) && !empty($b['lon']) && !empty($b['title']) && !empty($b['id']) && intval($b['id'])>0 &&
	    !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
	    !empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && 
	    !empty($_SESSION['id']) && intval($_SESSION['id'])>0 && 
	    intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) &&
        $this->Company_model->add_map(['company_id'=>intval($b['id']),'lat'=>$b['lat'],'lon'=>$b['lon'],'title'=>$b['title']]))die('111');
        die('0');
	}
	public function check_company_access(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !is_null($b) && !empty($b['ccppId']) && intval($b['ccppId'])>0 && !empty($b['cuId']) && intval($b['cuId'])>0){
	        $arr=[
	            'is_position'=>(!empty($b['isPos']) && intval($b['isPos'])>0?1:0),
	            'company_category_product'=>intval($b['ccppId']),
	            'company_user_id'=>intval($b['cuId'])
	        ];
    	    $c=$this->Company_model->select_user_product_access_where_arr($arr);
    	    if(!empty($c) && !empty($c['0']) && !empty($c['0']['id']) && intval($c['0']['id'])>0){
        	    if($this->Company_model->edit_access_weher_arr(['status'=>(!empty($b['status']) && intval($b['status'])>0?1:0)],['id'=>intval($c['0']['id'])]))
        	        die('ok1');
    	    }else{
    	        if(!empty($b['status']) && intval($b['status'])>0 && $this->Company_model->add_access([
    	            'is_position'=>(!empty($b['isPos']) && intval($b['isPos'])>0?1:0),
    	            'company_category_product'=>intval($b['ccppId']),
    	            'company_user_id'=>intval($b['cuId']),
    	            'status'=>1
	            ]))
    	            die('ok2');
    	    }
	    }
	    die('');
	}
	public function company_user(){
	    if(!empty($_SESSION['company_user_one']) && is_array($_SESSION['company_user_one']) &&
	    !empty($_SESSION['company_user_one']['company_id']) && intval($_SESSION['company_user_one']['company_id'])>0 &&
	    !empty($_SESSION['company_user_one']['company_user_id']) && intval($_SESSION['company_user_one']['company_user_id'])>0){
            $category=new Category_handler();
        	$company=new Company_handler();
        	$role=new Role_handler();
        	if(($this->id=intval($_SESSION['id']))!== false && 
        	($a=$this->Users_model->select_where_id($this->id))!==false && !empty($a) && !empty($a['0']) &&
            ($b=$this->Users_model->select_info_where_user_id(intval($this->id)))!==false && !empty($b) && !empty($b['0'])){
                $_SESSION['my_company']=$role->show_my_company_valex(intval($this->id)); 
                if(!isset($_SESSION['my_wallet']) || empty($_SESSION['my_wallet']) && ($c=$this->Order_model->select_wallet_where_user_id(intval($this->id)))!==false && !empty($c) && !empty(end($c)))
                    $_SESSION['my_wallet']=end($c);
                if(!isset($_SESSION['user_info']) || empty($_SESSION['user_info']))
                    $_SESSION['user_info']=[
                        'image'=>(!empty($b['0']['image'])?$b['0']['image']:''),
                        'name'=>(!empty($b['0']['name'])?$b['0']['name']:''),
                        'family'=>(!empty($b['0']['family'])?$b['0']['family']:''),
                        'role'=>''
                    ];
                $has_auth_info_error=(!empty($b['0']['mely_code']) && !empty($b['0']['cart_mely_picture'])?false:true);
                $roles=$this->Roles_model->all_where_status();
            	echo $this->load->view('header',[
            	    'category'=>$category->valex_show(),
            		'lang'=>'',
            		'id'=>$this->id,
            		'user_info'=>$_SESSION['user_info'],
            		'lat'=>(!empty($_SESSION['lt'])?$_SESSION['lt']:''),
            		'lon'=>(!empty($_SESSION['ln'])?$_SESSION['ln']:''),
            		'chat'=>false,
            		'has_auth_info_error'=>$has_auth_info_error,
            		'title'=>'فعالیت همکار',
            	],true).
            	$this->load->view('company/user_in_company',[
            	    'user'=>[
            	        'name'=>$_SESSION['company_user_one']["user_info_name"],
                	    'img'=>$_SESSION['company_user_one']["user_info_image"]
                    ],
                    'roles'=>(!empty($roles) && is_array($roles)?$roles:[]),
                    'company_user_id'=>intval($_SESSION['company_user_one']['company_user_id']),
                    'company_id'=>intval($_SESSION['company_user_one']['company_id']),
            	    'role'=>$_SESSION['company_user_one']["user_role_info"],
            	    'company_action'=>$company->user_company_action(intval($_SESSION['company_user_one']['company_id']),intval($_SESSION['company_user_one']['company_user_id']))
            	],true).
            	$this->load->view('footer',[
            	    'my_company'=>$_SESSION['my_company'],
                    'lang'=>'fa',
            	    'change_lang'=>'true',
            	    'id'=>$this->id,
            	],true);
            }
        }else{
            $this->users();
        }
        exit();
	}
	public function user_company_manager(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !is_null($b) && ($_SESSION['company_user_one']=['user_info_image'=>(!empty($b["userImg"])?$b["userImg"]:''),'company_id'=>(!empty($b["companyId"])?$b["companyId"]:0),'user_id'=>(!empty($b["userId"])?$b["userId"]:0),'company_role_id'=>(!empty($b["companyRoleId"])?$b["companyRoleId"]:0),'company_user_id'=>(!empty($b["companyUserId"])?$b["companyUserId"]:0),'user_info_name'=>(!empty($b["userInfoName"])?$b["userInfoName"]:''),'user_role_info'=>(!empty($b["userRoleTitle"])?$b["userRoleTitle"]:'')])!==false)
	        die('111111');
	    die();
	}
	public function users(){
        if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0){
	        if(!empty($_SESSION['company_manager_data']) && is_array($_SESSION['company_manager_data']) &&
	        !empty($_SESSION['company_manager_data']['company_info']) &&
	        !empty($_SESSION['company_manager_data']['company_info']['id']) && 
	        intval($_SESSION['company_manager_data']['company_info']['id'])>0 &&
            !empty($_SESSION['company_manager_data']['role_id']) && 
	        intval($_SESSION['company_manager_data']['role_id'])>0){
    	        $category=new Category_handler();
        	    $company=new Company_handler();
        	    $role=new Role_handler();
        	    $role->its_me=true;
        	    if(($this->id=intval($_SESSION['id']))!== false && 
        	    ($a=$this->Users_model->select_where_id($this->id))!==false && !empty($a) && !empty($a['0']) &&
                ($b=$this->Users_model->select_info_where_user_id(intval($this->id)))!==false && !empty($b) && !empty($b['0'])){
                    if(!isset($_SESSION['my_wallet']) || empty($_SESSION['my_wallet'])&& ($c=$this->Order_model->select_wallet_where_user_id(intval($this->id)))!==false && !empty($c) && !empty(end($c)))
                        $_SESSION['my_wallet']=end($c);
                    $_SESSION['my_company']=$role->show_my_company_valex(intval($this->id));
                    if(!isset($_SESSION['user_info']) || empty($_SESSION['user_info']))
                        $_SESSION['user_info']=[
                            'image'=>(!empty($b['0']['image'])?$b['0']['image']:''),
                            'name'=>(!empty($b['0']['name'])?$b['0']['name']:''),
                            'family'=>(!empty($b['0']['family'])?$b['0']['family']:''),
                            'role'=>''
                        ];
                    $has_auth_info_error=(!empty($b['0']['mely_code']) && !empty($b['0']['cart_mely_picture'])?false:true);
                    $roles=$this->Roles_model->all_where_status();
            		echo $this->load->view('header',[
            		    'category'=>$category->valex_show(),
            			'lang'=>'',
            			'id'=>$this->id,
            			'user_info'=>$_SESSION['user_info'],
            			'lat'=>(!empty($_SESSION['lt'])?$_SESSION['lt']:''),
            			'lon'=>(!empty($_SESSION['ln'])?$_SESSION['ln']:''),
            			'chat'=>false,
            			'has_auth_info_error'=>$has_auth_info_error,
            			'title'=>'کارمندان',
            		],true).
            	    $this->load->view('company/users',[
            	        'company_role_request'=>$this->Company_model->select_company_role_request_where_company_id(intval($_SESSION['company_manager_data']['company_info']['id'])),
            	        'company_role_id'=>intval($_SESSION['company_manager_data']['role_id']),
            	        'company_id'=>intval($_SESSION['company_manager_data']['company_info']['id']),
            	        'company_info'=>$_SESSION['company_manager_data']['company_info'],
            	        'roles'=>(!empty($roles) && is_array($roles)?$roles:[]),
            	        'data'=>$company->users(intval($_SESSION['company_manager_data']['company_info']['id']))],true).
            		$this->load->view('footer',[
            		    'map_page'=>true,
                        'my_company'=>$_SESSION['my_company'],
                	    'lang'=>'fa',
            		    'change_lang'=>'true',
            		    'id'=>$this->id,
                	],true);
                }
	        }else{
        	    $this->manage();
            }
        }else{
            header('Location:'.base_url());
            exit();
        }
    }
    private function securite_value($str){
        return (!empty($str) && is_string($str)?strip_tags(str_replace(["/",'~','"',"'",':','#','@','!','|',';','?','<','>','.',',','&','*','and','=','%'],'',$str)):'');
    }
    private function set_url($str){
        return (!empty($str) && is_string($str)?str_replace(' ','--',$str):'');
    }
    public function edit(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !is_null($b) && ($b['t']=$this->securite_value($b['t']))!==false && ($b['d']=$this->securite_value($b['d']))!==false && 
	    !empty($b['t']) && !empty($b['d']) && !empty($b['id']) && intval($b['id'])>0){
	        $handler=$this->Company_model->select_company_where_title($b['t']);
            if(!empty($handler) && !empty($handler['0']) && !empty($handler['0']['id']) && intval($handler['0']['id'])>0 && 
            intval($handler['0']['id'])!==intval(intval($b['id']))) die('23');
	        $arr=[];
	        $arr['title']=$b['t'];
	        $arr['description']=$b['d'];
	        if(!empty($b['i'])) $arr['icon']=$b['i'];
	        if(!empty($b['u'])) $arr['url']=$b['u'];
	        $arr['qr_code']=$this->generate_qrcode(base_url('show_company/'.$this->set_url($b['t'])));
	        if($this->Company_model->edit_weher_id($arr,intval($b['id'])) && 
	        ($c=$this->Company_model->select_company_where_id(intval($b['id'])))!==false && 
	        !empty($c) && !empty($c['0']) & ($_SESSION['company_manager_data']['company_info']=$c['0'])!==false) die('11111111');
	    }
        die('0');
	}
	public function valex_disable_company(){
        $a=(!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b=(!empty($_POST['data']['id']) && intval($_POST['data']['id'])>0?intval($_POST['data']['id']):null);
	    if(!is_null($a) && !is_null($b) && $this->Include_model->chapcha($a) && !empty($_SESSION['id']) && intval($_SESSION['id'])===1 &&
	    $this->Company_model->edit_weher_id(['status'=>0],intval($b)))
	        die('ok');
	    die('0');
    }
    public function valex_enable_company(){
        $a=(!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b=(!empty($_POST['data']['id']) && intval($_POST['data']['id'])>0?intval($_POST['data']['id']):null);
	    if(!is_null($a) && !is_null($b) && $this->Include_model->chapcha($a) && !empty($_SESSION['id']) && intval($_SESSION['id'])===1 &&
	    $this->Company_model->edit_weher_id(['status'=>1],intval($b)))
	        die('ok');
	    die('0');
    }
	public function manage(){
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0){
            $category=new Category_handler();
        	$company=new Company_handler();
        	$role=new Role_handler();
        	if(($this->id=intval($_SESSION['id']))!== false && 
        	($a=$this->Users_model->select_where_id($this->id))!==false && !empty($a) && !empty($a['0']) &&
            ($b=$this->Users_model->select_info_where_user_id(intval($this->id)))!==false && !empty($b) && !empty($b['0'])){
                if(($c=$this->Order_model->select_wallet_where_user_id(intval($this->id)))!==false && !empty($c) && !empty(end($c)))
                    $_SESSION['my_wallet']=end($c);
                $_SESSION['user_info']=[
                    'image'=>(!empty($b['0']['image'])?$b['0']['image']:''),
                    'name'=>(!empty($b['0']['name'])?$b['0']['name']:''),
                    'family'=>(!empty($b['0']['family'])?$b['0']['family']:''),
                    'role'=>''
                ];
                $has_auth_info_error=(!empty($b['0']['mely_code']) && !empty($b['0']['cart_mely_picture'])?false:true);
            	echo $this->load->view('header',[
            	    'category'=>$category->valex_show(),
            		'lang'=>'',
            		'id'=>$this->id,
            		'user_info'=>$_SESSION['user_info'],
            		'lat'=>(!empty($_SESSION['lt'])?$_SESSION['lt']:''),
            		'lon'=>(!empty($_SESSION['ln'])?$_SESSION['ln']:''),
            		'chat'=>false,
            		'has_auth_info_error'=>$has_auth_info_error,
            		'title'=>'مدیریت کسب و کار',
            	],true).
            	$this->load->view('company/all',[
                    'my_order'=>$company->show_my_order_valex($role->show_my_company_valex(intval($this->id))),
            	    'company_info'=>$role->show_my_company_valex(intval($this->id))],true).
            	$this->load->view('footer',[
            	    'my_company'=>$role->show_my_company_valex(intval($this->id)),
            	    'lang'=>'fa',
            	    'change_lang'=>'true',
            	    'id'=>$this->id,
            	],true);
            }
        }else{
            header('Location:'.base_url());
            exit();
        }
	}
	public function choose_one(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
    	$b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
    	if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) && !is_null($b))
            if(!empty($b['rid']) && intval($b['rid'])>0 && !empty($b['cid']) && intval($b['cid'])>0 &&
        	($c=$this->Company_model->select_company_where_id(intval($b['cid'])))!==false && !empty($c) && !empty($c['0'])){
                $d=(!empty($b['crpid']) && intval($b['crpid'])>0?intval($b['crpid']):0);
                $e=(!empty($b['crid']) && intval($b['crid'])>0?intval($b['crid']):0);
                $f=(!empty($b['cuid']) && intval($b['cuid'])>0?intval($b['cuid']):0);
                $_SESSION['comapy_manager_info']=[
                    'company_id'=>intval($b['cid']),
                    'role_id'=>intval($b['rid']),
                    'user_id'=>intval($_SESSION['id']),
                    'company_role_parent_id'=>$d,
                    'company_role_id'=>$e,
                    'company_user_id'=>$f
                ];
                $_SESSION['company_manager_data']=['role_id'=>intval($b['rid']),
                    'user_id'=>intval($_SESSION['id']),
                    'company_info'=>$c['0'],
                ];
        	    die('1111');
            }
        die('1');
	}
	public function one(){
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0){
	        if(!empty($_SESSION['company_manager_data']) && is_array($_SESSION['company_manager_data']) &&
	        !empty($_SESSION['company_manager_data']['company_info']) && !empty($_SESSION['company_manager_data']['company_info']['id']) &&
	        intval($_SESSION['company_manager_data']['company_info']['id'])>0 &&
	        ($ch=$this->Company_model->select_company_where_id(intval($_SESSION['company_manager_data']['company_info']['id'])))!==false && 
	        !empty($ch) && !empty($ch['0'])){
    	        $category=new Category_handler();
            	$main=new Main_exploder();
            	$main->valex_type='manager';
            	$main->valex_lt=$_SESSION['ln'];
            	$main->valex_ln=$_SESSION['lt'];
        	    $role=new Role_handler();
        	    if(($this->id=intval($_SESSION['id']))!== false && 
        	    ($a=$this->Users_model->select_where_id($this->id))!==false && !empty($a) && !empty($a['0']) &&
                ($b=$this->Users_model->select_info_where_user_id(intval($this->id)))!==false && !empty($b) && !empty($b['0'])){
                    if(!isset($_SESSION['my_wallet']) || empty($_SESSION['my_wallet'])&& ($c=$this->Order_model->select_wallet_where_user_id(intval($this->id)))!==false && !empty($c) && !empty(end($c)))
                        $_SESSION['my_wallet']=end($c);
                    $_SESSION['my_company']=$role->show_my_company_valex(intval($this->id));
                    if(!isset($_SESSION['user_info']) || empty($_SESSION['user_info']))
                        $_SESSION['user_info']=[
                            'image'=>(!empty($b['0']['image'])?$b['0']['image']:''),
                            'name'=>(!empty($b['0']['name'])?$b['0']['name']:''),
                            'family'=>(!empty($b['0']['family'])?$b['0']['family']:''),
                            'role'=>''
                        ];
                    $_SESSION['code_mely']=(!empty($b['0']['mely_code']) && !empty($b['0']['cart_mely_picture'])?$b['0']['mely_code']:'');
                    $has_auth_info_error=(!empty($b['0']['mely_code']) && !empty($b['0']['cart_mely_picture'])?false:true);
            		echo $this->load->view('header',[
            		    'category'=>$category->valex_show(),
            			'lang'=>'',
            			'id'=>$this->id,
            			'user_info'=>$_SESSION['user_info'],
            			'lat'=>(!empty($_SESSION['lt'])?$_SESSION['lt']:''),
            			'lon'=>(!empty($_SESSION['ln'])?$_SESSION['ln']:''),
            			'chat'=>false,
            			'has_auth_info_error'=>$has_auth_info_error,
            			'title'=>'کسب و کار',
            		],true).
            	    $this->load->view('company/valex_manager',[
            	        'code_mely'=>(!empty($_SESSION['code_mely'])?$_SESSION['code_mely']:''),
            	        'map'=>(!empty($main->valex_company_info(intval($_SESSION['company_manager_data']['company_info']['id']))['map'])?$main->valex_company_info(intval($_SESSION['company_manager_data']['company_info']['id']))['map']:''),
            	        'company_info'=>$ch['0'],
            	        'data'=>$_SESSION['company_manager_data'],
            	        'company_logo_uploader'=>$this->load->view('includes/uploader',['url'=>'assets---svg---company','type'=>'image'],true)],true).
            		$this->load->view('footer',[
            		    'add_map_id'=>intval($_SESSION['company_manager_data']['company_info']['id']),
            		    'add_map'=>'company',
                        'map'=>'true',
                        'my_company'=>$_SESSION['my_company'],
                	    'lang'=>'fa',
            		    'change_lang'=>'true',
            		    'id'=>$this->id,
                	],true);
                }
	        }else{
        	    $this->manage();
            }
        }else{
            header('Location:'.base_url());
            exit();
        }
	}
} 