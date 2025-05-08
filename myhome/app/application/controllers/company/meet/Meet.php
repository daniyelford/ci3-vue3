<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Meet extends MY_Controller
{
	public function __construct(){
		parent::__construct();
	}
	private $id=0;
	//need to send massage
	public function add(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!is_null($a) && $this->Include_model->chapcha($a) && !is_null($b) && 
	    !empty($b['t']) && !empty($b['d']) && !empty($b['fromCuId']) && intval($b['fromCuId'])>0 &&
	    ($from_company_user_info=$this->Company_model->select_user_where_id(intval($b['fromCuId'])))!==false && 
	    !empty($from_company_user_info) && !empty($from_company_user_info['0']) &&
	    !empty($from_company_user_info['0']['user_id']) && intval($from_company_user_info['0']['user_id'])>0 &&
	    ($c=$this->Company_model->add_meet_return_id(['title'=>$b['t'],'description'=>$b['d']]))!==false &&
	    !empty($c) && intval($c)>0){
            $i=$j=[];
            $text='';$text1='';
            $from_company_user_info=$from_company_user_info['0'];
            $g=$this->Users_model->select_info_where_user_id($from_company_user_info['user_id']);
	        foreach($b['userList'] as $d){
	            if(!empty($d) && intval($d)>0 && !in_array(intval($d),$i)){
	                if(!$this->Company_model->add_meet_user(['company_meet_id'=>intval($c),'request_company_user_id'=>intval($d),'from_company_user_id'=>intval($b['fromCuId'])]))die('0');
        	        $i[]=intval($d);
        	        $q=$this->Company_model->select_user_where_id(intval($d));
        	        if(!empty($q) && !empty($q['0']) && !empty($q['0']['user_id']) && intval($q['0']['user_id'])>0 && 
        	        ($p=$this->Users_model->select_info_where_user_id(intval($q['0']['user_id'])))!==false && !empty($p) && !empty($p['0'])){
        	            $text=(!empty($p['0']['name'])?$p['0']['name']:'').' '.(!empty($p['0']['family'])?$p['0']['family']:'').' عزیز شما از '.(!empty($g['0']['name'])?$g['0']['name']:'').' '.(!empty($g['0']['family'])?$g['0']['family']:'').' درخواست جلسه ای با موضوع ' 
        	            .$b['t'].
        	            'دارید و ایشان تقاضا دارند زمان نشست تعیین شود .برای اطلاعات بیشتر به https://www.my-home.ir/chat بروید';
        	            $j[]=['info'=>$p['0'],'text'=>$text];
        	        }
	            }
	        }
            if(!empty($g) && !empty($g['0'])){
                $accept_task_massage=(!empty($g['0']['name'])?$g['0']['name']:'').' '.(!empty($g['0']['family'])?$g['0']['family']:'').'عزیز درخواست جلسه ی شما ثبت شد و در حال بررسی زمان مناسب است';
            	$h=$this->Include_model->send_massage_to_user([
            	    'meet_users'=>$j,'f'=>$i,'user'=>$b['userList'],'r'=>$g['0'],
            	    'title'=>$b['t'],'description'=>$b['d']
                ],(!empty($g['0']['phone'])?$g['0']['phone']:''),(!empty($g['0']['gmail'])?$g['0']['gmail']:''),
            	'includes/email_includes/add_meet',
            	'درخواست شما برای جلسه',
                $accept_task_massage);
            }
            foreach($j as $k){
                if(!empty($k) && !empty($k['info'])){
                    $accept_task_massage=(!empty($k['text'])?$k['text']:'درخواست جلسه سازمانی ');
                	$h=$this->Include_model->send_massage_to_user([
                	    'meet_users'=>$j,'f'=>$k['info'],'r'=>$g['0'],
                	    'title'=>$b['t'],'description'=>$b['d']
                	],(!empty($k['info']['phone'])?$k['info']['phone']:''),(!empty($k['info']['gmail'])?$k['info']['gmail']:''),
                	'includes/email_includes/add_meet',
                	'درخواست جلسه از شما',
                    $accept_task_massage);
                }
            }
	        die('111');
	    }
	    die();
	}
	public function accept_meet(){
	    $company=new Company_handler();
	    $date=new JDF();
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!is_null($a) && $this->Include_model->chapcha($a) && !is_null($b) && !empty($b['id']) && intval($b['id'])>0 && !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && !empty($_SESSION['comapy_manager_info']['company_id']) && intval($_SESSION['comapy_manager_info']['company_id'])>0 && !empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 &&  !empty($_SESSION['id']) && intval($_SESSION['id'])>0 &&  intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && 
	    $this->Company_model->edit_meet_user_weher_company_meet_id(['status'=>1],intval($b['id']))){
            if(($a=$this->Company_model->select_meet_where_id(intval($b['id'])))!==false && !empty($a) && !empty($a['0']) &&
            ($c=$this->Company_model->select_meet_user_weher_company_meet_id(intval($b['id'])))!==false && !empty($c)){
                $e=$f=$g=[];
                foreach($c as $d){
                    if(!empty($d)){
                        if(!empty($d['from_company_user_id']) && intval($d['from_company_user_id']) > 0 && !in_array(intval($d['from_company_user_id']),$e) && 
                        ($k=$this->Company_model->select_user_where_id(intval($d['from_company_user_id'])))!==false &&
                        !empty($k) && !empty($k['0']) && !empty($k['0']['user_id']) && intval($k['0']['user_id'])>0 &&
                        ($l=$this->Users_model->select_info_where_user_id(intval($k['0']['user_id'])))!==false &&
                        !empty($l) && !empty($l['0']))
                            $g[]=['info'=>$l['0'],'text'=>(!empty($l['0']['name'])?$l['0']['name']:'').' '.(!empty($l['0']['family'])?$l['0']['family']:'').'عزیز جلسه ای که از شما درخواست شده بود تعیین قطعی شده است'];
                        if(!empty($d['request_company_user_id']) && intval($d['request_company_user_id']) > 0 && !in_array(intval($d['request_company_user_id']),$f) &&
                        ($k=$this->Company_model->select_user_where_id(intval($d['request_company_user_id'])))!==false &&
                        !empty($k) && !empty($k['0']) && !empty($k['0']['user_id']) && intval($k['0']['user_id'])>0 &&
                        ($l=$this->Users_model->select_info_where_user_id(intval($k['0']['user_id'])))!==false &&
                        !empty($l) && !empty($l['0']))
                            $g[]=['info'=>$l['0'],'text'=>(!empty($l['0']['name'])?$l['0']['name']:'').' '.(!empty($l['0']['family'])?$l['0']['family']:'').'عزیز جلسه ی درخواستی شما تعیین قطعی شده است'];
                    }
                }
                if(!empty($g))
                    foreach($g as $i){
                        if(!empty($i) && !empty($i['info'])){
                            $accept_task_massage=(!empty($i['text'])?$i['text']:'');
                        	$h=$this->Include_model->send_massage_to_user(['text'=>$accept_task_massage,'users'=>$g,'info'=>$a['0']],
                        	(!empty($i['info']['phone'])?$i['info']['phone']:''),(!empty($i['info']['gmail'])?$i['info']['gmail']:''),
                        	'includes/email_includes/accept_meet',
                        	'تعیین تکلیف نشست',
                            $accept_task_massage);
                        }
                    }
            }
	        die($this->load->view('company/meet/manager',['timer'=>$this->load->view('includes/timer',['next_years'=>true,'want_hour'=>true,'time'=>time()],true),'data'=>$company->show_compny_meet(intval($_SESSION['comapy_manager_info']['company_id']))],true));
	    }
	    die('0');
	}
	public function accept_meet_exp(){
	    $company=new Company_handler();
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!is_null($a) && $this->Include_model->chapcha($a) && !is_null($b) && !empty($b['id']) && intval($b['id'])>0 && 
	    !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
	    !empty($_SESSION['comapy_manager_info']['company_id']) && intval($_SESSION['comapy_manager_info']['company_id'])>0 && 
	    !empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 &&  
	    !empty($_SESSION['id']) && intval($_SESSION['id'])>0 &&  intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) &&
	    $this->Company_model->edit_meet_user_weher_id(['status'=>3],intval($b['id']))){
            if(($c=$this->Company_model->select_meet_user_where_id(intval($b['id'])))!==false &&
            !empty($c) && !empty($c['0']) && !empty($c['0']['company_meet_id']) && intval($c['0']['company_meet_id'])>0 &&
            ($d=$this->Company_model->select_meet_where_id(intval($c['0']['company_meet_id'])))!==false && !empty($d) && !empty($d['0'])){
                $e=$g=[];
                if(!empty($c['0']['request_company_user_id']) && intval($c['0']['request_company_user_id'])>0 &&
                ($i=$this->Company_model->select_user_where_id(intval($c['0']['request_company_user_id'])))!==false &&
                !empty($i) && !empty($i['0']) && !empty($i['0']['user_id']) && intval($i['0']['user_id'])>0)
                    $e=$this->Users_model->select_info_where_user_id(intval($i['0']['user_id']));
                if(!empty($c['0']['from_company_user_id']) && intval($c['0']['from_company_user_id'])>0 &&
                ($j=$this->Company_model->select_user_where_id(intval($c['0']['from_company_user_id'])))!==false &&
                !empty($j) && !empty($j['0']) && !empty($j['0']['user_id']) && intval($j['0']['user_id'])>0) 
                    $g=$this->Users_model->select_info_where_user_id(intval($j['0']['user_id']));
                    
                $accept_task_massage='جلسه ای از طرف'
                .(!empty($g['0']['name'])?$g['0']['name']:'').' '.(!empty($g['0']['family'])?$g['0']['family']:'').
                ' درخواست شده و با '.
                (!empty($e['0']['name'])?$e['0']['name']:'').' '.(!empty($e['0']['family'])?$e['0']['family']:'').
                ' هماهنگ شده است';
                if(!empty($e) && !empty($e['0'])){
                	$f=$this->Include_model->send_massage_to_user(['text'=>$accept_task_massage,'info'=>$d['0'],'meet_user'=>$c['0'],'f'=>$g['0'],'r'=>$e['0']],(!empty($e['0']['phone'])?$e['0']['phone']:''),(!empty($e['0']['gmail'])?$e['0']['gmail']:''),
                	'includes/email_includes/accept_meet_exp',
                	'تعیین زمان جلسه',
                	$accept_task_massage);
                }
                if(!empty($g) && !empty($g['0'])){
                	$h=$this->Include_model->send_massage_to_user(['text'=>$accept_task_massage,'info'=>$d['0'],'meet_user'=>$c['0'],'f'=>$g['0'],'r'=>$e['0']],(!empty($g['0']['phone'])?$g['0']['phone']:''),(!empty($g['0']['gmail'])?$g['0']['gmail']:''),
                	'includes/email_includes/accept_meet_exp',
                	'تعیین زمان جلسه',
                	$accept_task_massage);
                }
            }  
	        die($this->load->view('company/meet/manager',['timer'=>$this->load->view('includes/timer',['next_years'=>true,'want_hour'=>true,'time'=>time()],true),'data'=>$company->show_compny_meet(intval($_SESSION['comapy_manager_info']['company_id']))],true));
	    }
	    die('0');
	}
	public function accept_meet_exp_single(){
	    $company=new Company_handler();
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!is_null($a) && $this->Include_model->chapcha($a) && !is_null($b) && !empty($b['id']) && intval($b['id'])>0 && !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && !empty($_SESSION['comapy_manager_info']['company_id']) && intval($_SESSION['comapy_manager_info']['company_id'])>0 && !empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 &&  !empty($_SESSION['id']) && intval($_SESSION['id'])>0 &&  intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && 
	    $this->Company_model->edit_meet_user_weher_id(['status'=>1],intval($b['id']))){
	        if(($c=$this->Company_model->select_meet_user_where_id(intval($b['id'])))!==false &&
            !empty($c) && !empty($c['0']) && !empty($c['0']['company_meet_id']) && intval($c['0']['company_meet_id'])>0 &&
            ($d=$this->Company_model->select_meet_where_id(intval($c['0']['company_meet_id'])))!==false && !empty($d) && !empty($d['0'])){
                $e=$g=[];
                if(!empty($c['0']['request_company_user_id']) && intval($c['0']['request_company_user_id'])>0 &&
                ($i=$this->Company_model->select_user_where_id(intval($c['0']['request_company_user_id'])))!==false &&
                !empty($i) && !empty($i['0']) && !empty($i['0']['user_id']) && intval($i['0']['user_id'])>0)
                    $e=$this->Users_model->select_info_where_user_id(intval($i['0']['user_id']));
                if(!empty($c['0']['from_company_user_id']) && intval($c['0']['from_company_user_id'])>0 &&
                ($j=$this->Company_model->select_user_where_id(intval($c['0']['from_company_user_id'])))!==false &&
                !empty($j) && !empty($j['0']) && !empty($j['0']['user_id']) && intval($j['0']['user_id'])>0) 
                    $g=$this->Users_model->select_info_where_user_id(intval($j['0']['user_id']));
                    
                $accept_task_massage='جلسه ای از طرف'
                .(!empty($g['0']['name'])?$g['0']['name']:'').' '.(!empty($g['0']['family'])?$g['0']['family']:'').
                ' درخواست شده و با '.
                (!empty($e['0']['name'])?$e['0']['name']:'').' '.(!empty($e['0']['family'])?$e['0']['family']:'').
                ' هماهنگ شده است';
                if(!empty($e) && !empty($e['0'])){
                	$f=$this->Include_model->send_massage_to_user(['text'=>$accept_task_massage,'info'=>$d['0'],'meet_user'=>$c['0'],'f'=>$g['0'],'r'=>$e['0']],(!empty($e['0']['phone'])?$e['0']['phone']:''),(!empty($e['0']['gmail'])?$e['0']['gmail']:''),
                	'includes/email_includes/accept_meet_exp_single',
                	'جلسه ی فوری', 
                	$accept_task_massage);
                }
                if(!empty($g) && !empty($g['0'])){
                	$h=$this->Include_model->send_massage_to_user(['text'=>$accept_task_massage,'info'=>$d['0'],'meet_user'=>$c['0'],'f'=>$g['0'],'r'=>$e['0']],(!empty($g['0']['phone'])?$g['0']['phone']:''),(!empty($g['0']['gmail'])?$g['0']['gmail']:''),
                	'includes/email_includes/accept_meet_exp_single',
                	'جلسه ی فوری', 
                	$accept_task_massage);
                }
            }
	        die($this->load->view('company/meet/manager',['timer'=>$this->load->view('includes/timer',['next_years'=>true,'want_hour'=>true,'time'=>time()],true),'data'=>$company->show_compny_meet(intval($_SESSION['comapy_manager_info']['company_id']))],true));
	    }
	    die('0');
	}
	public function accept_meet_time(){
	    $company=new Company_handler();
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!is_null($a) && $this->Include_model->chapcha($a) && !is_null($b) && !empty($b['id']) && intval($b['id'])>0 && !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && !empty($_SESSION['comapy_manager_info']['company_user_id']) && intval($_SESSION['comapy_manager_info']['company_user_id'])>0 && !empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && !empty($_SESSION['id']) && intval($_SESSION['id'])>0 && intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && 
	    $this->Company_model->edit_meet_user_weher_id(['status'=>2],intval($b['id']))){
            if(($c=$this->Company_model->select_meet_user_where_id(intval($b['id'])))!==false &&
            !empty($c) && !empty($c['0']) && !empty($c['0']['company_meet_id']) && intval($c['0']['company_meet_id'])>0 &&
            ($d=$this->Company_model->select_meet_where_id(intval($c['0']['company_meet_id'])))!==false && !empty($d) && !empty($d['0'])){
                $e=$g=[];
                if(!empty($c['0']['request_company_user_id']) && intval($c['0']['request_company_user_id'])>0 &&
                ($i=$this->Company_model->select_user_where_id(intval($c['0']['request_company_user_id'])))!==false &&
                !empty($i) && !empty($i['0']) && !empty($i['0']['user_id']) && intval($i['0']['user_id'])>0)
                    $e=$this->Users_model->select_info_where_user_id(intval($i['0']['user_id']));
                if(!empty($c['0']['from_company_user_id']) && intval($c['0']['from_company_user_id'])>0 &&
                ($j=$this->Company_model->select_user_where_id(intval($c['0']['from_company_user_id'])))!==false &&
                !empty($j) && !empty($j['0']) && !empty($j['0']['user_id']) && intval($j['0']['user_id'])>0) 
                    $g=$this->Users_model->select_info_where_user_id(intval($j['0']['user_id']));
                    
                $accept_task_massage='جلسه ای از طرف'
                .(!empty($g['0']['name'])?$g['0']['name']:'').' '.(!empty($g['0']['family'])?$g['0']['family']:'').
                ' درخواست شده و با '.
                (!empty($e['0']['name'])?$e['0']['name']:'').' '.(!empty($e['0']['family'])?$e['0']['family']:'').
                ' هماهنگ شده است';
                if(!empty($e) && !empty($e['0'])){
                	$f=$this->Include_model->send_massage_to_user(['text'=>$accept_task_massage,'info'=>$d['0'],'meet_user'=>$c['0'],'f'=>$g['0'],'r'=>$e['0']],(!empty($e['0']['phone'])?$e['0']['phone']:''),(!empty($e['0']['gmail'])?$e['0']['gmail']:''),
                	'includes/email_includes/accept_meet_time',
                	'تعیین زمان جلسه',
                	$accept_task_massage);
                }
                if(!empty($g) && !empty($g['0'])){
                	$h=$this->Include_model->send_massage_to_user(['text'=>$accept_task_massage,'info'=>$d['0'],'meet_user'=>$c['0'],'f'=>$g['0'],'r'=>$e['0']],(!empty($g['0']['phone'])?$g['0']['phone']:''),(!empty($g['0']['gmail'])?$g['0']['gmail']:''),
                	'includes/email_includes/accept_meet_time',
                	'تعیین زمان جلسه',
                	$accept_task_massage);
                }
            }
	        die($this->load->view('company/meet/company',['timer'=>$this->load->view('includes/timer',['want_hour'=>true,'time'=>time()],true),'data'=>$company->show_my_compny_meet(intval($_SESSION['comapy_manager_info']['company_user_id']))],true));
	    }
	    die('0');
	}
	public function change_time_meet(){
	    $company=new Company_handler();
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!is_null($a) && $this->Include_model->chapcha($a) && !is_null($b) && 
	    !empty($b['mUId']) && intval($b['mUId'])>0 &&!empty($_SESSION['comapy_manager_info']) && 
	    is_array($_SESSION['comapy_manager_info']) &&!empty($_SESSION['comapy_manager_info']['company_user_id']) && 
	    intval($_SESSION['comapy_manager_info']['company_user_id'])>0 &&!empty($_SESSION['comapy_manager_info']['user_id']) && 
	    intval($_SESSION['comapy_manager_info']['user_id'])>0 && !empty($_SESSION['id']) && intval($_SESSION['id'])>0 && 
	    intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) &&
	    !empty($b['h']) && ($c=explode(':',$b['h'])) !==false && !empty($b['d']) && !empty($b['m']) && !empty($b['y']) && 
	    !empty($b['mId']) && intval($b['mId'])>0 && 
	    ($d=$this->Include_model->change_to_time($b['d'],$b['m'],$b['y'],$c['0'],$c['1']))!==false && !empty($d) &&
	    ($e=$this->Company_model->select_meet_where_id(intval($b['mId'])))!==false && !empty($e) && !empty($e['0'])){
            $arr=(!empty($e['0']['run_time'])?['status'=>(!empty($b['mT']) && intval($b['mT'])>0?intval($b['mT']):0),'run_time'=>date('Y-m-d H:i:s', $d)]:['status'=>(!empty($b['mT']) && intval($b['mT'])>0?intval($b['mT']):0)]);
            $this->Company_model->edit_meet_user_weher_id($arr,intval($b['mUId']));
            if(empty($e['0']['run_time']) && !$this->Company_model->edit_meet_weher_id(['run_time'=>date('Y-m-d H:i:s', $d)],intval($b['mId']))) die('0');
            if(($a=$this->Company_model->select_meet_where_id(intval($b['mId'])))!==false && !empty($a) && !empty($a['0']) &&
            ($c=$this->Company_model->select_meet_user_weher_company_meet_id(intval($b['mId'])))!==false && !empty($c)){
                $e=$f=$g=[];
                foreach($c as $d){
                    if(!empty($d)){
                        if(!empty($d['from_company_user_id']) && intval($d['from_company_user_id']) > 0 && !in_array(intval($d['from_company_user_id']),$e) &&
                        ($k=$this->Company_model->select_user_where_id(intval($d['from_company_user_id'])))!==false && 
                        !empty($k) && !empty($k['0']) && !empty($k['0']['user_id']) && intval($k['0']['user_id'])>0 &&
                        ($l=$this->Users_model->select_info_where_user_id(intval($k['0']['user_id'])))!==false && !empty($l) && !empty($l['0']))
                            $g[]=['info'=>$l['0'],'text'=>'زمان جلسه توسط شرکت کننده تغییر کرده است'];            
                        if(!empty($d['request_company_user_id']) && intval($d['request_company_user_id']) > 0 && !in_array(intval($d['request_company_user_id']),$f) &&
                        ($k=$this->Company_model->select_user_where_id(intval($d['request_company_user_id'])))!==false && 
                        !empty($k) && !empty($k['0']) && !empty($k['0']['user_id']) && intval($k['0']['user_id'])>0 &&
                        ($l=$this->Users_model->select_info_where_user_id(intval($k['0']['user_id'])))!==false && !empty($l) && !empty($l['0']))
                            $g[]=['info'=>$l['0'],'text'=>'زمان جلسه توسط شرکت کننده تغییر کرده است'];
                    }
                }
                if(!empty($g))
                    foreach($g as $i){
                        if(!empty($i) && !empty($i['info'])){
                            $accept_task_massage=(!empty($i['text'])?$i['text']:'');
                        	$h=$this->Include_model->send_massage_to_user(['users'=>$g,'info'=>$a['0']],
                        	(!empty($i['info']['phone'])?$i['info']['phone']:''),(!empty($i['info']['gmail'])?$i['info']['gmail']:''),
                        	'includes/email_includes/change_time_meet',
                        	'تغییر زمان جلسه',
                            $accept_task_massage);
                        }
                    }
            } 
	        die($this->load->view('company/meet/company',['timer'=>$this->load->view('includes/timer',['want_hour'=>true,'time'=>time()],true),'data'=>$company->show_my_compny_meet(intval($_SESSION['comapy_manager_info']['company_user_id']))],true));
	    }
	    die('0');
	}
	public function change_time_meet_manager(){
	    $company=new Company_handler();
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!is_null($a) && $this->Include_model->chapcha($a) && !is_null($b) && !empty($b['mUId']) && intval($b['mUId'])>0 &&
	    !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) &&
	    !empty($_SESSION['comapy_manager_info']['company_user_id']) && intval($_SESSION['comapy_manager_info']['company_user_id'])>0 &&
	    !empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && 
	    !empty($_SESSION['id']) && intval($_SESSION['id'])>0 && intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) &&
	    !empty($b['h']) && ($c=explode(':',$b['h'])) !==false && !empty($b['d']) && !empty($b['m']) && !empty($b['y']) && 
	    !empty($b['mId']) && intval($b['mId'])>0 &&
	    ($d=$this->Include_model->change_to_time($b['d'],$b['m'],$b['y'],$c['0'],$c['1']))!==false && !empty($d) &&
	    $this->Company_model->edit_meet_user_weher_id(['status'=>(!empty($b['mT']) && intval($b['mT'])>0?intval($b['mT']):0)],intval($b['mUId'])) && 
	    $this->Company_model->edit_meet_weher_id(['run_time'=>date('Y-m-d H:i:s', $d)],intval($b['mId']))){
            if(($a=$this->Company_model->select_meet_where_id(intval($b['mId'])))!==false && !empty($a) && !empty($a['0']) &&
            ($c=$this->Company_model->select_meet_user_weher_company_meet_id(intval($b['mId'])))!==false && !empty($c)){
                $e=$f=$g=[];
                foreach($c as $d){
                    if(!empty($d)){
                        if(!empty($d['from_company_user_id']) && intval($d['from_company_user_id']) > 0 && !in_array(intval($d['from_company_user_id']),$e) &&
                        ($k=$this->Company_model->select_user_where_id(intval($d['from_company_user_id'])))!==false && 
                        !empty($k) && !empty($k['0']) && !empty($k['0']['user_id']) && intval($k['0']['user_id'])>0 &&
                        ($l=$this->Users_model->select_info_where_user_id(intval($k['0']['user_id'])))!==false && !empty($l) && !empty($l['0']))
                            $g[]=['info'=>$l['0'],'text'=>'زمان جلسه توسط تنظیم کننده تغییر کرده است'];            
                        if(!empty($d['request_company_user_id']) && intval($d['request_company_user_id']) > 0 && !in_array(intval($d['request_company_user_id']),$f) &&
                        ($k=$this->Company_model->select_user_where_id(intval($d['request_company_user_id'])))!==false && 
                        !empty($k) && !empty($k['0']) && !empty($k['0']['user_id']) && intval($k['0']['user_id'])>0 &&
                        ($l=$this->Users_model->select_info_where_user_id(intval($k['0']['user_id'])))!==false && !empty($l) && !empty($l['0']))
                            $g[]=['info'=>$l['0'],'text'=>'زمان جلسه توسط تنظیم کننده تغییر کرده است'];
                    }
                }
                if(!empty($g))
                    foreach($g as $i){
                        if(!empty($i) && !empty($i['info'])){
                            $accept_task_massage=(!empty($i['text'])?$i['text']:'');
                        	$h=$this->Include_model->send_massage_to_user(['text'=>$accept_task_massage,'users'=>$g,'info'=>$a['0']],
                        	(!empty($i['info']['phone'])?$i['info']['phone']:''),(!empty($i['info']['gmail'])?$i['info']['gmail']:''),
                        	'includes/email_includes/change_time_meet_manager',
                        	'تغییر زمان جلسه',
                            $accept_task_massage);
                        }
                    }
            } 
	        die($this->load->view('company/meet/manager',['timer'=>$this->load->view('includes/timer',['next_years'=>true,'want_hour'=>true,'time'=>time()],true),'data'=>$company->show_compny_meet(intval($_SESSION['comapy_manager_info']['company_id']))],true));
	    }
	    die('0');
	}
	public function save_result(){
	    $company=new Company_handler();
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!is_null($a) && $this->Include_model->chapcha($a) && !is_null($b) && !empty($b['i']) && intval($b['i'])>0 && !empty($b['t']) && !empty(trim($b['t'])) && !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && !empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 &&!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && 
	    $this->Company_model->edit_meet_weher_id(['result'=>trim($b['t']),'status'=>1],intval($b['i']))){
            if(($a=$this->Company_model->select_meet_where_id(intval($b['i'])))!==false && !empty($a) && !empty($a['0']) &&
            ($c=$this->Company_model->select_meet_user_weher_company_meet_id(intval($b['i'])))!==false && !empty($c)){
                $e=$f=$g=[];
                foreach($c as $d){
                    if(!empty($d)){
                        if(!empty($d['from_company_user_id']) && intval($d['from_company_user_id']) > 0 && !in_array(intval($d['from_company_user_id']),$e) &&
                        ($k=$this->Company_model->select_user_where_id(intval($d['from_company_user_id'])))!==false && 
                        !empty($k) && !empty($k['0']) && !empty($k['0']['user_id']) && intval($k['0']['user_id'])>0 &&
                        ($l=$this->Users_model->select_info_where_user_id(intval($k['0']['user_id'])))!==false && !empty($l) && !empty($l['0']))
                            $g[]=['info'=>$l['0'],'text'=>'پس از بررسی،گزارش جلسه توسط مدیریت مجموعه نتیجه گیری و ثبت شده و هم اکنون در دسترس قرار دارد'];            
                        if(!empty($d['request_company_user_id']) && intval($d['request_company_user_id']) > 0 && !in_array(intval($d['request_company_user_id']),$f) &&
                        ($k=$this->Company_model->select_user_where_id(intval($d['request_company_user_id'])))!==false && 
                        !empty($k) && !empty($k['0']) && !empty($k['0']['user_id']) && intval($k['0']['user_id'])>0 &&
                        ($l=$this->Users_model->select_info_where_user_id(intval($k['0']['user_id'])))!==false && !empty($l) && !empty($l['0']))
                            $g[]=['info'=>$l['0'],'text'=>'پس از بررسی،گزارش جلسه توسط مدیریت مجموعه نتیجه گیری و ثبت شده و هم اکنون در دسترس قرار دارد']; 
                    }
                }
                if(!empty($g))
                    foreach($g as $i){
                        if(!empty($i) && !empty($i['info'])){
                            $accept_task_massage=(!empty($i['text'])?$i['text']:'');
                        	$h=$this->Include_model->send_massage_to_user(['users'=>$g,'info'=>$a['0']],
                        	(!empty($i['info']['phone'])?$i['info']['phone']:''),(!empty($i['info']['gmail'])?$i['info']['gmail']:''),
                        	'includes/email_includes/save_result_meet',
                        	'نتیجه گیری جلسه',
                            $accept_task_massage);
                        }
                    }
            } 
	        die($this->load->view('company/meet/company',['timer'=>$this->load->view('includes/timer',['want_hour'=>true,'time'=>time()],true),'data'=>$company->show_my_compny_meet(intval($_SESSION['comapy_manager_info']['company_user_id']))],true));
	    }
	    die('0');
	}
    //need to send massage
    public function meet_manager(){
        if(!empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && !empty($_SESSION['comapy_manager_info']['company_user_id']) && intval($_SESSION['comapy_manager_info']['company_user_id'])>0 && !empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && !empty($_SESSION['id']) && intval($_SESSION['id'])>0 && intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && !empty($_SESSION['comapy_manager_info']['company_id']) && intval($_SESSION['comapy_manager_info']['company_id'])>0){
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
                	    'title'=>'مدیریت جلسات'
            	    ],true).
            	    $this->load->view('company/meet/manager',[
            	        'timer'=>$this->load->view('includes/timer',['dont_use_id'=>'','next_years'=>true,'want_hour'=>true,'time'=>time()],true),
            	        'data'=>$company->show_compny_meet(intval($_SESSION['comapy_manager_info']['company_id']))
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
    public function company_meet(){
        if(!empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && !empty($_SESSION['comapy_manager_info']['company_user_id']) && intval($_SESSION['comapy_manager_info']['company_user_id'])>0 && !empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && !empty($_SESSION['id']) && intval($_SESSION['id'])>0 && intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && !empty($_SESSION['comapy_manager_info']['company_id']) && intval($_SESSION['comapy_manager_info']['company_id'])>0){
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
                	    'title'=>'جلسات سازمانی'
            	    ],true).
            	    $this->load->view('company/meet/company',[
            	        'timer'=>$this->load->view('includes/timer',['next_years'=>true,'want_hour'=>true,'time'=>time()],true),
            	        'company_user_id'=>intval($_SESSION['comapy_manager_info']['company_user_id']),
            	        'company_users'=>$company->users(intval($_SESSION['comapy_manager_info']['company_id'])),
            	        'data'=>$company->show_my_compny_meet(intval($_SESSION['comapy_manager_info']['company_user_id']))
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