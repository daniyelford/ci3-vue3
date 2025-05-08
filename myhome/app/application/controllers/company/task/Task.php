<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Task extends MY_Controller
{
	public function __construct(){
		parent::__construct();
	}
	public function add(){
	    $company=new Company_handler();
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!is_null($a) && $this->Include_model->chapcha($a) && !is_null($b) && 
	    !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
	    !empty($_SESSION['comapy_manager_info']['company_user_id']) && intval($_SESSION['comapy_manager_info']['company_user_id'])>0 && 
	    !empty($_SESSION['comapy_manager_info']['role_id']) && intval($_SESSION['comapy_manager_info']['role_id'])>0 && 
	    !empty($_SESSION['comapy_manager_info']['company_role_id']) && intval($_SESSION['comapy_manager_info']['company_role_id'])>0 && 
	    !empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && 
	    !empty($_SESSION['id']) && intval($_SESSION['id'])>0 && 
	    intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && 
	    !empty($b['t']) && !empty($b['d']) && !empty($b['CuId']) && intval($b['CuId'])>0 &&
	    !empty($b['userList']) && is_array($b['userList']) &&
	    ($arr=(!empty($b['hd']) && !empty($b['dd']) && !empty($b['md']) && !empty($b['yd']) && ($c=explode(':',$b['hd'])) !==false &&($d=$this->Include_model->change_to_time($b['dd'],$b['md'],$b['yd'],$c['0'],$c['1']))!==false?['title'=>$b['t'],'description'=>$b['d'],'dead_time'=>date('Y-m-d H:i:s', $d)]:['title'=>$b['t'],'description'=>$b['d']]))!==false &&
	    ($e=$this->Company_model->add_task_return_id($arr))!==false &&
	    !empty($e) && intval($e)>0 && ($i=$this->Users_model->select_info_where_user_id(intval($_SESSION['id'])))!==false && !empty($i) && !empty($i['0'])){
	        $user_task_names=$g=$user_connect_options=[];
	        foreach($b['userList'] as $f){
	            if(!$this->Company_model->add_task_user(['company_task_id'=>intval($e),'request_company_user_id'=>intval($f),'from_company_user_id'=>intval($b['CuId'])]))die('0');
	            if(!empty($f) && intval($f)>0 && !in_array(intval($f),$g)){
        	        $g[]=intval($f);
        	        if(($t=$this->Company_model->select_user_where_id(intval($f)))!==false &&
        	        !empty($t) && !empty($t['0']) && !empty($t['0']['user_id']) && intval($t['0']['user_id'])>0 &&
                	($m=$this->Users_model->select_info_where_user_id(intval($t['0']['user_id'])))!==false &&
        	        !empty($m) && !empty($m['0'])){
            	        $user_task_names[]=(!empty($m['0']['name'])?$m['0']['name']:'').' '.(!empty($m['0']['family'])?$m['0']['family']:'');
            	        $user_connect_options[]=[
            	            'gmail'=>(!empty($m['0']['gmail'])?$m['0']['gmail']:''),
            	            'tel'=>(!empty($m['0']['phone'])?$m['0']['phone']:''),
            	            'text'=>(!empty($m['0']['name'])?$m['0']['name']:'').' '.(!empty($m['0']['family'])?$m['0']['family']:'').
            	            ' عزیز از سمت '.
            	            (!empty($i['0']['name'])?$i['0']['name']:'').' '.(!empty($i['0']['family'])?$i['0']['family']:'').
            	            ' درخواست انجام کاری با موضوع '.
            	            $b['t'].
            	            ' به توضیحات '.
            	            $b['d'].
            	            'دارید برای مشاهده ی جزییات به 
            	            https://www.my-home.ir/chat
            	            بروید'
            	        ];
            	    }
        	    }
	        }
        	if(!empty($user_connect_options) && is_array($user_connect_options)){
        	    foreach($user_connect_options as $uco){
        	        if(!empty($uco)){
                        $j=$this->Include_model->send_massage_to_user($b,
                	    $uco['tel'],
                	    $uco['gmail'],
                	    'includes/email_includes/add_task',
                	    'پیشنهاد کاری',
                	    $uco['text']);
        	        }
        	    }
        	    $text=
        	    (!empty($i['0']['name'])?$i['0']['name']:'').' '.(!empty($i['0']['family'])?$i['0']['family']:'').
        	    ' عزیز درخواست قبول وظیفه ی '.
        	    $b['t'].
        	    ' با توضیحات '.
        	    $b['d'].
        	    ' به '.
        	    implode(" و ",$user_task_names).
        	    'ارسال شد برای مشاهده ی بیشتر به
        	    https://www.my-home.ir/chat
        	    بروید';
        	    $k=$this->Include_model->send_massage_to_user($b,
        	    (!empty($i['0']['phone'])?$i['0']['phone']:''),
        	    (!empty($i['0']['gmail'])?$i['0']['gmail']:''),
        	    'includes/email_includes/add_task',
        	    'ارجاع وظیفه',
        	    $text);
            }
            die($this->load->view('company/task/my',[
                'timer'=>$this->load->view('includes/timer',['next_years'=>true,'want_hour'=>true,'time'=>time()],true),
            	'company_user_id'=>intval($_SESSION['comapy_manager_info']['company_user_id']),
            	'role_id'=>intval($_SESSION['comapy_manager_info']['role_id']),
            	'company_users'=>$company->children_users(intval($_SESSION['comapy_manager_info']['company_role_id'])),
            	'data'=>$company->show_my_compny_task(intval($_SESSION['comapy_manager_info']['company_user_id']))
            ],true));
	    }
	    die('0');
	}
	public function accept_task(){
	    $i=$l=[];
	    $company=new Company_handler();
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!is_null($a) && $this->Include_model->chapcha($a) && !is_null($b) && 
	    !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
	    !empty($_SESSION['comapy_manager_info']['company_user_id']) && intval($_SESSION['comapy_manager_info']['company_user_id'])>0 && 
	    !empty($_SESSION['comapy_manager_info']['role_id']) && intval($_SESSION['comapy_manager_info']['role_id'])>0 && 
	    !empty($_SESSION['comapy_manager_info']['company_role_id']) && intval($_SESSION['comapy_manager_info']['company_role_id'])>0 && 
	    !empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && 
	    !empty($_SESSION['id']) && intval($_SESSION['id'])>0 && 
	    intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && 
	    !empty($b['tUId']) && intval($b['tUId'])>0 && 
	    !empty($b['h']) && !empty($b['d']) && !empty($b['m']) && !empty($b['y']) &&
	    !empty($b['hd']) && !empty($b['dd']) && !empty($b['md']) && !empty($b['yd']) && 
	    ($c=explode(':',$b['h'])) !==false &&
	    ($d=$this->Include_model->change_to_time($b['d'],$b['m'],$b['y'],$c['0'],$c['1']))!==false && 
        ($e=explode(':',$b['hd'])) !==false &&
	    ($f=$this->Include_model->change_to_time($b['dd'],$b['md'],$b['yd'],$e['0'],$e['1']))!==false &&
	    $this->Company_model->edit_task_user_weher_id([
    	    'run_time'=>date('Y-m-d H:i:s', $d),
            'suggest_time'=>date('Y-m-d H:i:s', $f),
            'status'=>1
	    ],intval($b['tUId']))){
	        if(($g=$this->Company_model->select_task_user_where_id(intval($b['tUId'])))!==false && !empty($g) && !empty($g['0']) && 
	        !empty($g['0']['company_task_id']) && intval($g['0']['company_task_id'])>0 && 
	        ($q=$this->Company_model->select_task_where_id(intval($g['0']['company_task_id'])))!==false && !empty($q) && !empty($q['0'])){
	            if(!empty($g['0']['request_company_user_id']) && intval($g['0']['request_company_user_id'])>0 &&
	            ($h=$this->Company_model->select_user_where_id(intval($g['0']['request_company_user_id'])))!==false &&
	            !empty($h) && !empty($h['0']) && !empty($h['0']['user_id']) && intval($h['0']['user_id'])>0)
                    $i=$this->Users_model->select_info_where_user_id(intval($h['0']['user_id']));
	            if(!empty($g['0']['from_company_user_id']) && intval($g['0']['from_company_user_id'])>0 &&
	            ($k=$this->Company_model->select_user_where_id(intval($g['0']['from_company_user_id'])))!==false &&
	            !empty($k) && !empty($k['0']) && !empty($k['0']['user_id']) && intval($k['0']['user_id'])>0)
    	   	        $l=$this->Users_model->select_info_where_user_id(intval($k['0']['user_id']));
        	   	if(!empty($l) && !empty($l['0'])){
                    $accept_task_massage=
                    (!empty($l['0']['name'])?$l['0']['name']:'').' '.(!empty($l['0']['family'])?$l['0']['family']:'').
                    ' عزیز پیشنهاد شما به '.
                    (!empty($i['0']['name'])?$i['0']['name']:'').' '.(!empty($i['0']['family'])?$i['0']['family']:'').
                    ' برای انجام کار '.
                    (!empty($q['0']['title'])?$q['0']['title']:'').
                    (!empty($q['0']['description'])?' با توضیحات '.$q['0']['description']:'').
                    ' پذیرفته شد وی موظف است از تاریخ '.
                    $b['d'].'/'.$b['m'].'/'.$b['y'].' ساعت '.$b['h'].
                    ' تا تاریخ '.
                    $b['dd'].'/'.$b['md'].'/'.$b['yd'].' ساعت '.$b['hd'].
                    ' کار خود را به اتمام برساند برای مشاهده ی بیشتر به
                    https://www.my-home.ir/chat
                    بروید';
                    $m=$this->Include_model->send_massage_to_user(['type'=>'f','f_info'=>$l['0'],'r_info'=>(!empty($i) && !empty($i['0'])?$i['0']:[]),'task'=>$q['0'],'info'=>$b],(!empty($l['0']['phone'])?$l['0']['phone']:''),(!empty($l['0']['gmail'])?$l['0']['gmail']:''),
                    'includes/email_includes/accept_task',
                    'قبول درخواست کاری شما',
                    $accept_task_massage);
                }
                if(!empty($i) && !empty($i['0'])){
                    $accept_task_massage=(!empty($i['0']['name'])?$i['0']['name']:'').' '.(!empty($i['0']['family'])?$i['0']['family']:'').
                    ' عزیز شما درخواست '.
                    (!empty($l['0']['name'])?$l['0']['name']:'').' '.(!empty($l['0']['family'])?$l['0']['family']:'').
                    ' برای انجام کار '.
                    (!empty($q['0']['title'])?$q['0']['title']:'').
                    (!empty($q['0']['description'])?' با توضیحات '.$q['0']['description']:'').
                    ' را پذیرفتید و موظف هستید از تاریخ '.
                    $b['d'].'/'.$b['m'].'/'.$b['y'].' ساعت '.$b['h'].
                    ' تا تاریخ '.
                    $b['dd'].'/'.$b['md'].'/'.$b['yd'].' ساعت '.$b['hd'].
                    ' کار خود را به اتمام برسانید برای مشاهده ی بیشتر به
                    https://www.my-home.ir/chat
                    بروید';
                    $j=$this->Include_model->send_massage_to_user(['type'=>'r','f_info'=>(!empty($l) && !empty($l['0'])?$l['0']:[]),'r_info'=>$i['0'],'task'=>$q['0'],'info'=>$b],(!empty($i['0']['phone'])?$i['0']['phone']:''),(!empty($i['0']['gmail'])?$i['0']['gmail']:''),
                    'includes/email_includes/accept_task',
                    'قبول انجام کار توسط شما',
                    $accept_task_massage);
                }
	        }
            die($this->load->view('company/task/my',[
                'timer'=>$this->load->view('includes/timer',['next_years'=>true,'want_hour'=>true,'time'=>time()],true),
            	'company_user_id'=>intval($_SESSION['comapy_manager_info']['company_user_id']),
            	'role_id'=>intval($_SESSION['comapy_manager_info']['role_id']),
            	'company_users'=>$company->children_users(intval($_SESSION['comapy_manager_info']['company_role_id'])),
            	'data'=>$company->show_my_compny_task(intval($_SESSION['comapy_manager_info']['company_user_id']))
            ],true));
	    }
	    die('0');
	}
	public function reject_task(){
	    $company=new Company_handler();
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!is_null($a) && $this->Include_model->chapcha($a) && !is_null($b) && 
	    !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
	    !empty($_SESSION['comapy_manager_info']['company_user_id']) && intval($_SESSION['comapy_manager_info']['company_user_id'])>0 && 
	    !empty($_SESSION['comapy_manager_info']['role_id']) && intval($_SESSION['comapy_manager_info']['role_id'])>0 && 
	    !empty($_SESSION['comapy_manager_info']['company_role_id']) && intval($_SESSION['comapy_manager_info']['company_role_id'])>0 && 
	    !empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && 
	    !empty($_SESSION['id']) && intval($_SESSION['id'])>0 && 
	    intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && 
	    !empty($b['id']) && intval($b['id'])>0 && 
	    $this->Company_model->edit_task_user_weher_id([
            'status'=>2
	    ],intval($b['id']))){
	        if(($g=$this->Company_model->select_task_user_where_id(intval($b['id'])))!==false && !empty($g) && !empty($g['0']) && 
	        !empty($g['0']['company_task_id']) && intval($g['0']['company_task_id'])>0 && 
	        ($q=$this->Company_model->select_task_where_id(intval($g['0']['company_task_id'])))!==false && !empty($q) && !empty($q['0'])){
	            if(!empty($g['0']['request_company_user_id']) && intval($g['0']['request_company_user_id'])>0 &&
	            ($h=$this->Company_model->select_user_where_id(intval($g['0']['request_company_user_id'])))!==false &&
	            !empty($h) && !empty($h['0']) && !empty($h['0']['user_id']) && intval($h['0']['user_id'])>0)
                    $i=$this->Users_model->select_info_where_user_id(intval($h['0']['user_id']));
	            if(!empty($g['0']['from_company_user_id']) && intval($g['0']['from_company_user_id'])>0 &&
	            ($k=$this->Company_model->select_user_where_id(intval($g['0']['from_company_user_id'])))!==false &&
	            !empty($k) && !empty($k['0']) && !empty($k['0']['user_id']) && intval($k['0']['user_id'])>0)
    	   	        $l=$this->Users_model->select_info_where_user_id(intval($k['0']['user_id']));
        	   	if(!empty($l) && !empty($l['0'])){
                    $accept_task_massage=(!empty($l['0']['name'])?$l['0']['name']:'').' '.(!empty($l['0']['family'])?$l['0']['family']:'').
                    ' عزیز درخواست شما از '.
                    (!empty($i['0']['name'])?$i['0']['name']:'').' '.(!empty($i['0']['family'])?$i['0']['family']:'').
                    ' برای انجام کار '.
                    (!empty($q['0']['title'])?$q['0']['title']:'').
                    (!empty($q['0']['description'])?' با توضیحات '.$q['0']['description']:'').
                    ' پذیرفته نشد برای مشاهده ی بیشتر به
                    https://www.my-home.ir/chat
                    بروید';
                    $m=$this->Include_model->send_massage_to_user(['type'=>'f','f_info'=>$l['0'],'r_info'=>(!empty($i) && !empty($i['0'])?$i['0']:[]),'task'=>$q['0']],(!empty($l['0']['phone'])?$l['0']['phone']:''),(!empty($l['0']['gmail'])?$l['0']['gmail']:''),
                    'includes/email_includes/reject_task',
                    'رد پیشنهاد کاری شما',
                    $accept_task_massage);
                }
                if(!empty($i) && !empty($i['0'])){
        	   	    $accept_task_massage=(!empty($i['0']['name'])?$i['0']['name']:'').' '.(!empty($i['0']['family'])?$i['0']['family']:'').
                    ' عزیز شما درخواست '.
                    (!empty($l['0']['name'])?$l['0']['name']:'').' '.(!empty($l['0']['family'])?$l['0']['family']:'').
                    ' برای انجام کار '.
                    (!empty($q['0']['title'])?$q['0']['title']:'').
                    (!empty($q['0']['description'])?' با توضیحات '.$q['0']['description']:'').
                    ' را نپذیرفتید برای مشاهده ی بیشتر به
                    https://www.my-home.ir/chat
                    بروید';
                    $j=$this->Include_model->send_massage_to_user(['type'=>'r','f_info'=>(!empty($l) && !empty($l['0'])?$l['0']:[]),'r_info'=>$i['0'],'task'=>$q['0']],(!empty($i['0']['phone'])?$i['0']['phone']:''),(!empty($i['0']['gmail'])?$i['0']['gmail']:''),
                    'includes/email_includes/reject_task',
                    'رد درخواست کاری از شما',
                    $accept_task_massage);
                }
	        }
            die($this->load->view('company/task/my',[
                'timer'=>$this->load->view('includes/timer',['next_years'=>true,'want_hour'=>true,'time'=>time()],true),
            	'company_user_id'=>intval($_SESSION['comapy_manager_info']['company_user_id']),
            	'role_id'=>intval($_SESSION['comapy_manager_info']['role_id']),
            	'company_users'=>$company->children_users(intval($_SESSION['comapy_manager_info']['company_role_id'])),
            	'data'=>$company->show_my_compny_task(intval($_SESSION['comapy_manager_info']['company_user_id']))
            ],true));
	    }
	    die('0');
	}
//  need to send massage
	public function save_result(){
	    $company=new Company_handler();
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!is_null($a) && $this->Include_model->chapcha($a) && !is_null($b) &&
	    !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
	    !empty($_SESSION['comapy_manager_info']['company_user_id']) && intval($_SESSION['comapy_manager_info']['company_user_id'])>0 && 
	    !empty($_SESSION['comapy_manager_info']['role_id']) && intval($_SESSION['comapy_manager_info']['role_id'])>0 && 
	    !empty($_SESSION['comapy_manager_info']['company_role_id']) && intval($_SESSION['comapy_manager_info']['company_role_id'])>0 && 
	    !empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && 
	    !empty($_SESSION['id']) && intval($_SESSION['id'])>0 && 
	    intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && 
	    !empty($b['i']) && intval($b['i'])>0 && !empty($b['t']) && !empty(trim($b['t'])) &&
	    $this->Company_model->edit_task_weher_id(['result'=>trim($b['t'])],intval($b['i']))){
	        if(($q=$this->Company_model->select_task_where_id(intval($b['i'])))!==false && !empty($q) && !empty($q['0']) &&
	        !empty($q['0']['id']) && intval($q['0']['id'])>0 &&
	        ($c=$this->Company_model->select_task_user_where_company_task_id(intval($q['0']['id'])))!==false && !empty($c))
	            foreach($c as $d){
	                $i=$l=[];
	                if(!empty($d) && !empty($d['request_company_user_id']) && intval($d['request_company_user_id'])>0 &&
    	            ($h=$this->Company_model->select_user_where_id(intval($d['request_company_user_id'])))!==false &&
    	            !empty($h) && !empty($h['0']) && !empty($h['0']['user_id']) && intval($h['0']['user_id'])>0)
                        $i=$this->Users_model->select_info_where_user_id(intval($h['0']['user_id']));
    	            if(!empty($d) && !empty($d['from_company_user_id']) && intval($d['from_company_user_id'])>0 &&
    	            ($k=$this->Company_model->select_user_where_id(intval($d['from_company_user_id'])))!==false &&
    	            !empty($k) && !empty($k['0']) && !empty($k['0']['user_id']) && intval($k['0']['user_id'])>0)
            	   	    $l=$this->Users_model->select_info_where_user_id(intval($k['0']['user_id'])); 
    	            if(!empty($l) && !empty($l['0'])){
                        $accept_task_massage=(!empty($l['0']['name'])?$l['0']['name']:'').' '.(!empty($l['0']['family'])?$l['0']['family']:'').
                        ' عزیز گزارشی از کار ' .
                        (!empty($q['0']['title'])?$q['0']['title']:'').(!empty($q['0']['description'])?' با توضیحات '.$q['0']['description']:'').
                        ' توسط  '.
                        (!empty($i['0']['name'])?$i['0']['name']:'').' '.(!empty($i['0']['family'])?$i['0']['family']:'').
                        ' مبنی بر '.
                        trim($b['t']).
                        ' منتشر شده جهت مشاهده ی بیشتر به 
                        https://www.my-home.ir/chat
                        بروید';
                        $m=$this->Include_model->send_massage_to_user(['type'=>'f','f_info'=>$l['0'],'r_info'=>$i['0'],'task'=>$q['0']],(!empty($l['0']['phone'])?$l['0']['phone']:''),(!empty($l['0']['gmail'])?$l['0']['gmail']:''),
                        'includes/email_includes/save_result_task',
                        'ارسال گزارش کار',
                        $accept_task_massage);
                    }
                    if(!empty($i) && !empty($i['0'])){
                        $accept_task_massage=(!empty($i['0']['name'])?$i['0']['name']:'').' '.(!empty($i['0']['family'])?$i['0']['family']:'').
                        ' عزیز گزارش کار '.
                        (!empty($q['0']['title'])?$q['0']['title']:'').(!empty($q['0']['description'])?' با توضیحات '.$q['0']['description']:'').
                        ' مبنی بر  '.
                        trim($b['t']).
                        ' به '.
                        (!empty($l['0']['name'])?$l['0']['name']:'').' '.(!empty($l['0']['family'])?$l['0']['family']:'').
                        ' ارائه داده شد';
                        $j=$this->Include_model->send_massage_to_user(['type'=>'r','f_info'=>$l['0'],'r_info'=>$i['0'],'task'=>$q['0']],(!empty($i['0']['phone'])?$i['0']['phone']:''),(!empty($i['0']['gmail'])?$i['0']['gmail']:''),
                        'includes/email_includes/save_result_task',
                        'گزارش کار ارسالی',
                        $accept_task_massage);
                    }
	            }
	        die($this->load->view('company/task/my',[
                'timer'=>$this->load->view('includes/timer',['next_years'=>true,'want_hour'=>true,'time'=>time()],true),
            	'company_user_id'=>intval($_SESSION['comapy_manager_info']['company_user_id']),
            	'role_id'=>intval($_SESSION['comapy_manager_info']['role_id']),
            	'company_users'=>$company->children_users(intval($_SESSION['comapy_manager_info']['company_role_id'])),
            	'data'=>$company->show_my_compny_task(intval($_SESSION['comapy_manager_info']['company_user_id']))
            ],true)); 
	    }
	    die('0');
	}
	public function do_task(){
	    $company=new Company_handler();
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!is_null($a) && $this->Include_model->chapcha($a) && !is_null($b) &&
	    !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
	    !empty($_SESSION['comapy_manager_info']['company_user_id']) && intval($_SESSION['comapy_manager_info']['company_user_id'])>0 && 
	    !empty($_SESSION['comapy_manager_info']['role_id']) && intval($_SESSION['comapy_manager_info']['role_id'])>0 && 
	    !empty($_SESSION['comapy_manager_info']['company_role_id']) && intval($_SESSION['comapy_manager_info']['company_role_id'])>0 && 
	    !empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && 
	    !empty($_SESSION['id']) && intval($_SESSION['id'])>0 && 
	    intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && 
	    !empty($b['id']) && intval($b['id'])>0 &&
	    $this->Company_model->edit_task_weher_id(['status'=>1],intval($b['id']))){
            if(($q=$this->Company_model->select_task_where_id(intval($b['id'])))!==false && !empty($q) && !empty($q['0']) &&
	        !empty($q['0']['id']) && intval($q['0']['id'])>0 &&
	        ($c=$this->Company_model->select_task_user_where_company_task_id(intval($q['0']['id'])))!==false && !empty($c))
	            foreach($c as $d){
	                $i=$l=[];
	                if(!empty($d) && !empty($d['request_company_user_id']) && intval($d['request_company_user_id'])>0 &&
    	            ($h=$this->Company_model->select_user_where_id(intval($d['request_company_user_id'])))!==false &&
    	            !empty($h) && !empty($h['0']) && !empty($h['0']['user_id']) && intval($h['0']['user_id'])>0)
                        $i=$this->Users_model->select_info_where_user_id(intval($h['0']['user_id']));
    	            if(!empty($d) && !empty($d['from_company_user_id']) && intval($d['from_company_user_id'])>0 &&
    	            ($k=$this->Company_model->select_user_where_id(intval($d['from_company_user_id'])))!==false &&
    	            !empty($k) && !empty($k['0']) && !empty($k['0']['user_id']) && intval($k['0']['user_id'])>0)
            	   	    $l=$this->Users_model->select_info_where_user_id(intval($k['0']['user_id'])); 
    	            if(!empty($l) && !empty($l['0'])){
                        $accept_task_massage=(!empty($l['0']['name'])?$l['0']['name']:'').' '.(!empty($l['0']['family'])?$l['0']['family']:'').
                        'عزیز شما انجام شدن کار '.
                        (!empty($q['0']['title'])?$q['0']['title']:'').
                        (!empty($q['0']['description'])?' با توضیحات '.$q['0']['description']:'').
                        ' را تایید کردید';
                        $m=$this->Include_model->send_massage_to_user(['type'=>'f','f_info'=>$l['0'],'r_info'=>(!empty($i) && !empty($i['0'])?$i['0']:[]),'task'=>$q['0']],(!empty($l['0']['phone'])?$l['0']['phone']:''),(!empty($l['0']['gmail'])?$l['0']['gmail']:''),
                        'includes/email_includes/do_task',
                        'تاییدیه شما برای انجام کار',
                        $accept_task_massage);
                    }
                    if(!empty($i) && !empty($i['0'])){
                        $accept_task_massage=(!empty($i['0']['name'])?$i['0']['name']:'').' '.(!empty($i['0']['family'])?$i['0']['family']:'').
                        ' عزیز انجام شدن کار '.
                        (!empty($q['0']['title'])?$q['0']['title']:'').
                        (!empty($q['0']['description'])?' با توضیحات '.$q['0']['description']:'').
                        ' توسط '.
                        (!empty($l['0']['name'])?$l['0']['name']:'').' '.(!empty($l['0']['family'])?$l['0']['family']:'').
                        ' تایید شد';
                        $j=$this->Include_model->send_massage_to_user(['type'=>'r','f_info'=>(!empty($l) && !empty($l['0'])?$l['0']:[]),'r_info'=>$i['0'],'task'=>$q['0']],(!empty($i['0']['phone'])?$i['0']['phone']:''),(!empty($i['0']['gmail'])?$i['0']['gmail']:''),
                        'includes/email_includes/do_task',
                        'تایید انجام کار محوله به شما',
                        $accept_task_massage);
                    }
	            } 
	        die($this->load->view('company/task/my',[
                'timer'=>$this->load->view('includes/timer',['next_years'=>true,'want_hour'=>true,'time'=>time()],true),
            	'company_user_id'=>intval($_SESSION['comapy_manager_info']['company_user_id']),
            	'role_id'=>intval($_SESSION['comapy_manager_info']['role_id']),
            	'company_users'=>$company->children_users(intval($_SESSION['comapy_manager_info']['company_role_id'])),
            	'data'=>$company->show_my_compny_task(intval($_SESSION['comapy_manager_info']['company_user_id']))
            ],true)); 
	    }
	    die('0');
	}
	//need to send massage
	public function my(){
	    if(!empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && !empty($_SESSION['comapy_manager_info']['company_user_id']) && intval($_SESSION['comapy_manager_info']['company_user_id'])>0 && !empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && !empty($_SESSION['id']) && intval($_SESSION['id'])>0 && intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && !empty($_SESSION['comapy_manager_info']['role_id']) && intval($_SESSION['comapy_manager_info']['role_id'])>0 && !empty($_SESSION['comapy_manager_info']['company_role_id']) && intval($_SESSION['comapy_manager_info']['company_role_id'])>0){
            $category=new Category_handler();
        	$company=new Company_handler();
        	$role=new Role_handler();
        	if(($this->id=intval($_SESSION['id']))!== false && ($a=$this->Users_model->select_where_id($this->id))!==false && !empty($a) && !empty($a['0']) &&($b=$this->Users_model->select_info_where_user_id(intval($this->id)))!==false && !empty($b) && !empty($b['0'])){
                if(!isset($_SESSION['my_wallet']) || empty($_SESSION['my_wallet'])&& ($c=$this->Order_model->select_wallet_where_user_id(intval($this->id)))!==false && !empty($c) && !empty(end($c))) $_SESSION['my_wallet']=end($c);
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
                	'title'=>'وظایف سازمانی'
                ],true).
            	$this->load->view('company/task/my',[
            	    'timer'=>$this->load->view('includes/timer',['next_years'=>true,'want_hour'=>true,'time'=>time()],true),
            	    'company_user_id'=>intval($_SESSION['comapy_manager_info']['company_user_id']),
            	    'role_id'=>intval($_SESSION['comapy_manager_info']['role_id']),
            	    'company_users'=>$company->children_users(intval($_SESSION['comapy_manager_info']['company_role_id'])),
            	    'data'=>$company->show_my_compny_task(intval($_SESSION['comapy_manager_info']['company_user_id']))
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