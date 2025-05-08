<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Position extends MY_Controller
{
	public function __construct(){
		parent::__construct();
	}
	private $id=0;
	public function edit_form_status(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) &&
	    !empty($b) && !empty($_SESSION['position_id']) && intval($_SESSION['position_id'])>0 &&
	    !empty($b['id']) && intval($b['id'])>0 &&
	    $this->Position_model->edit_form_question(['status'=>(!empty($b['status']) && intval($b['status'])>0?1:0)],['id'=>intval($b['id'])]))
	       die('ok');
	    die('0');
	}	
	public function edit_type_question_form_question(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) &&
	    !empty($b) && !empty($_SESSION['position_id']) && intval($_SESSION['position_id'])>0 &&
	    !empty($b['id']) && intval($b['id'])>0 &&
	    !empty($b['type_question']) && ($b['type_question']=='image' || $b['type_question']=='text') &&
	    $this->Position_model->edit_form_question(['type_question'=>$b['type_question']],['id'=>intval($b['id'])]))
	       die('ok');
	    die('0');
	}
	public function edit_required_form_question(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) &&
	    !empty($b) && !empty($_SESSION['position_id']) && intval($_SESSION['position_id'])>0 &&
	    !empty($b['id']) && intval($b['id'])>0 &&
	    $this->Position_model->edit_form_question(['required'=>(!empty($b['required']) && intval($b['required'])>0?1:0)],['id'=>intval($b['id'])]))
	       die('ok');
	    die('0');
	}
	public function edit_question_form_question(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) &&
	    !empty($b) && !empty($_SESSION['position_id']) && intval($_SESSION['position_id'])>0 &&
	    !empty($b['id']) && intval($b['id'])>0 &&
	    ($a=$this->xss_cleaner($b['question']))!==false && !empty($a) &&
	    $this->Position_model->edit_form_question(['question'=>$a],['id'=>intval($b['id'])]))
	       die('ok');
	    die('0');
	}
	public function add_form(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) &&
	    !empty($b) && !empty($_SESSION['position_id']) && intval($_SESSION['position_id'])>0 && 
	    array_key_exists('question',$b) && array_key_exists('required',$b) && array_key_exists('type_question',$b) &&
	    ($a=$this->Position_model->add_form_question_return_id($b))!==false && !empty($a) && intval($a)>0 && $this->Position_model->add_form(['position_id'=>intval($_SESSION['position_id']),'position_form_question_id'=>intval($a)]))
	        die('111');
	    die('0');
	}
	private function xss_cleaner($str){
	    return (!empty($str) && is_string($str) && ($a=str_replace(["/",'`','~','"',"'",':','#','@','!','|',';','?','<','>',',','&','*','=','%'],'',$str))!==false?$a:'');
	}
	public function add_position_question_answer(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    $arr=[];
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) &&
	    !empty($b) && !empty($b['data']) && is_array($b['data']))
	        foreach($b['data'] as $c){
	            $d=[];
	            if(!empty($c) && count($c)==3 && count(array_keys($c))==3 && 
	            array_key_exists('position_form_question_id',$c) &&
	            array_key_exists('user_answer_value',$c) &&
	            array_key_exists('position_user_id',$c)){
	                $c['user_answer_value']=(!empty($c['user_answer_value'])?$this->xss_cleaner($c['user_answer_value']):'');
	                if(!empty($c['user_answer_value'])){
	                    $d=$c;
    	                $d['user_id']=$_SESSION['id'];
    	                $arr[]=$d;
	                }
	            }else{
	                die('no');
	            }
	        }
	    if(!empty($arr) && $this->Position_model->add_answer_question($arr)) die('111');
	    die('0');
	}
	public function position_company_reserve_manager(){
        if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 &&
	    !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
	    !empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && 
	    !empty($_SESSION['id']) && intval($_SESSION['id'])>0 && 
	    intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id'])){
	        $category=new Category_handler();
	        $main=new Main_exploder();
        	$company=new Company_handler();
        	$role=new Role_handler();
        	$position=new Position_handler();
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
                $g=$data=$access_product_id=$access_position_id=$reserve=$position_product=[];
                if(!empty($user_company_action) && !empty($user_company_action['products']) && !empty($user_company_action['products']['access'])){
                    foreach($user_company_action['products']['access'] as $access_pro){
                        if(!empty($access_pro) && !empty($access_pro['product_id']) && 
                        intval($access_pro['product_id'])>0 && 
                        !in_array(intval($access_pro['product_id']),$access_product_id))
                            $access_product_id[]=intval($access_pro['product_id']);
                    }
                }
                if(!empty($user_company_action) && !empty($user_company_action['positions']) && !empty($user_company_action['positions']['access'])){
                    foreach($user_company_action['positions']['access'] as $access_pos){
                        if(!empty($access_pos) && !empty($access_pos['position_id']) &&
                        intval($access_pos['position_id'])>0 &&
                        !in_array(intval($access_pos['position_id']),$access_position_id))
                            $access_position_id[]=intval($access_pos['position_id']);
                    }
                }
                $d=$company->company_product_list(intval($_SESSION['comapy_manager_info']['company_id']));
                foreach($d as $e){
                    if(!empty($e) && intval($e)>0 && in_array(intval($e),$access_product_id) && 
                    ($f=$main->valex_product_info(intval($e)))!==false && !empty($f) && !empty($f['info']))
                        $g[]=$f['info'];
                }
            	$d=$company->company_position_list(intval($_SESSION['comapy_manager_info']['company_id']));
                foreach($d as $e){
                    if(!empty($e) && intval($e)>0 && in_array(intval($e),$access_position_id) && 
                    ($f=$main->valex_position_info_manager(intval($e)))!==false && !empty($f) && !empty($f['info'])){
                        $data[]=$f;
                        $_SESSION['position_id']=intval($e);
                        $reserve[intval($e)]=$this->setting_reserve_handler($main);
                        $position_product[]=['product'=>$position->position_product_list(intval($e)),'position_id'=>intval($e)];
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
                	'title'=>'رزرو جایگاه ها'
                ],true).
            	$this->load->view('company/position/order',[
            	    'category'=>$this->Category_model->select_where_status(),
            	    'role_id'=>intval($_SESSION['comapy_manager_info']['role_id']),
            	    'company_id'=>intval($_SESSION['comapy_manager_info']['company_id']),
            	    'company_info'=>$this->Company_model->select_company_where_id(intval($_SESSION['comapy_manager_info']['company_id'])),
            	    'uploader'=>$this->load->view('includes/uploader',['url'=>'assets---svg---position','type'=>'image'],true),
            	    'data'=>$data,
            	    'position_product'=>$position_product,
            	    'company_product'=>$g,
            	    'reserve'=>$reserve
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
    // check for deleted_at needed
	private function setting_reserve_handler($main){
        if(!empty($_SESSION['position_id']) && intval($_SESSION['position_id'])>0){
            $k=[];
            $h=$this->Position_model->select_user_where_position_id(intval($_SESSION['position_id']));
            $p=1;
            foreach($h as $i){
                if(!empty($i) && !empty($i['id']) && intval($i['id'])>0 && !empty($i['user_id']) && ($j=$this->Users_model->select_info_where_user_id(intval($i['user_id'])))!==false && !empty($j) && !empty($j['0'])){
                    $l=$this->Position_model->select_order_where_position_user_id(intval($i['id']));
                    $n=[];
                    if(!empty($l)){
                        foreach($l as $m){
                            if(!empty($m) && !empty($m['product_id']) && intval($m['product_id'])>0 &&
                            ($o=$this->Product_model->select_product_where_id(intval($m['product_id'])))!==false && !empty($o) && !empty($o['0']))
                                $n[]=['data'=>$m,'pro'=>$o['0']];
                        }
                    }
                    
                    $k[]=[
                        'reserve_user_status'=>(!empty($i['status']) && intval($i['status'])>0?intval($i['status']):0),
                        'position_user_id'=>intval($i['id']),
                        'id'=>$p,
                        'position_id'=>intval($_SESSION['position_id']),
                        'product_order'=>$n,
                        'user_info'=>$j['0'],
                        'data'=>$i,
                        'form'=>$this->Position_model->position_form_info_where_position_id_and_position_user_id(intval($_SESSION['position_id']),intval($i['id'])),
                        'timer'=>$this->load->view('includes/timer',[
                            'next_years'=>true,
                            'want_hour'=>true,
                            'time'=>(!empty($i['date_reserve'])?strtotime($i['date_reserve']):time())
                        ],true),
                    ];
                    $p++;
                }
            }
            return $this->load->view('company/position/reserve',['reserve'=>$k,'data'=>$main->valex_position_info_manager(intval($_SESSION['position_id']))],true);
        }
        return '';
    }
    // check for deleted_at needed
    // product or position chat creator
    private function chat_creator_pro_pos($pos_user_id,$position_id,$product_id,$text){
        if(!empty($pos_user_id) && intval($pos_user_id)>0){
            $where=[];
            if(!empty($position_id) && intval($position_id)>0) $where['position_id']=intval($position_id);
            $where['position_user_id']=intval($pos_user_id);
            $where['user_id']=intval($_SESSION['id']);
            $where['parent_id']=0;
            $x=$this->Position_model->select_chat_where_arr($where);
            $this->Position_model->add_chat([
                'position_user_id'=>intval($pos_user_id),
                'position_id'=>(!empty($position_id) && intval($position_id)>0?intval($position_id):0),
                'parent_id'=>(!empty($x) && !empty(end($x)) && !empty(end($x)['id']) && intval(end($x)['id'])>0?intval(end($x)['id']):0),
                'user_id'=>intval($_SESSION['id']),
                'text'=>(!empty($text)?$text:'')
            ]);
            if(!empty($product_id) && intval($product_id)>0)
                $this->Product_model->add_chat([
                    'product_id'=>intval($product_id),
                    'user_id'=>intval($_SESSION['id']),
                    'text'=>(!empty($text)?$text:'')
                ]);
                
            return true;
        }
        return false;
    }
	// need to send massage
    // base_url('product_company_order_manager')
    // base_url('wallet_payment')
    // base_url('chat')
    // chat_creator_pro_pos($pos_user_id,$position_id,$product_id,$text)
    // رزرو محصول قابل ارائه در جایگاه توسط مشتری
    public function reserve_product_in_position(){
        $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) && !empty($b['productId']) && intval($b['productId'])>0){
	        if(!(!empty($b['positionId']) && intval($b['positionId'])>0)){
	            $control=$this->Product_model->select_category_where_product_id_and_status(intval($b['productId']));
	            $positionId=[];
	            if(!empty($control))
	                foreach($control as $co){
	                    if(!empty($co) && !empty($co['position_id']) && intval($co['position_id'])>0 && !in_array(intval($co['position_id']),$positionId))
    	                    $positionId[]=intval($co['position_id']);
	                }
	            if(!empty($positionId)){
	                $position_control=$this->Position_model->select_user_where_arr(['user_id'=>intval($_SESSION['id']),'status'=>1]);
                    if(!empty($position_control))
    	                foreach($position_control as $pc){
        	                if(!empty($pc) && !empty($pc['position_id']) && intval($pc['position_id'])>0 && in_array(intval($pc['position_id']),$positionId))
    	                        $b['positionId']=intval($pc['position_id']);
    	                }
    	            
	            }
	        }
	        if(!(!empty($b['positionId']) && intval($b['positionId'])>0)) $b['positionId']=(!empty($positionId) && !empty($positionId['0']) && intval($positionId['0'])>0?intval($positionId['0']):null);
	        if(!(!empty($b['positionId']) && intval($b['positionId'])>0))die('34');
    	    $d=$this->Position_model->select_user_where_arr(['position_id'=>intval($b['positionId']),'user_id'=>intval($_SESSION['id']),'status'=>1]);
    	    if(!empty($d))
    	        foreach($d as $e){
    	            if(!empty($e) && !empty($e['id']) && intval($e['id'])>0)
        	            if($this->Position_model->add_order(['position_user_id'=>intval($e['id']),'product_id'=>intval($b['productId'])])){
        	               // $text=(!empty($_SESSION['user_info']['name'])?$_SESSION['user_info']['name']:'').' '.(!empty($_SESSION['user_info']['family'])?$_SESSION['user_info']['family']:'').
	       // ' عزیز محصول
    	   // '.(!empty($o['0']['title'])?$o['0']['title']:'').' 
    	   // به تعداد 
    	   // '.(!empty($b['count']) && intval($b['count'])>1?intval($b['count']):1).'
    	   // عدد به سبد شما اضافه شد نسبت به پرداخت آن اقدام کنید
    	   // ';
    	   // $this->chat_creator_pro_pos(intval($b['userPosId']),0,intval($b['proId']),$text);
                    	    die('11111111111111');
        	            }
    	        }
    	    else
    	        if(($d=$this->Position_model->select_user_where_arr(['position_id'=>intval($b['positionId']),'user_id'=>intval($_SESSION['id']),'status'=>0]))!==false && !empty($d))
	                foreach($d as $e){
        	            if(!empty($e) && !empty($e['id']) && intval($e['id'])>0)
            	            if($this->Position_model->add_order(['position_user_id'=>intval($e['id']),'product_id'=>intval($b['productId'])])){
            	               // $text=(!empty($_SESSION['user_info']['name'])?$_SESSION['user_info']['name']:'').' '.(!empty($_SESSION['user_info']['family'])?$_SESSION['user_info']['family']:'').
	       // ' عزیز محصول
    	   // '.(!empty($o['0']['title'])?$o['0']['title']:'').' 
    	   // به تعداد 
    	   // '.(!empty($b['count']) && intval($b['count'])>1?intval($b['count']):1).'
    	   // عدد به سبد شما اضافه شد نسبت به پرداخت آن اقدام کنید
    	   // ';
    	   // $this->chat_creator_pro_pos(intval($b['userPosId']),0,intval($b['proId']),$text);
                        	    die('11111111111111');
            	            }
        	        }
	            else
                	if(($c=$this->Position_model->add_user_return_id(['position_id'=>intval($b['positionId']),'user_id'=>intval($_SESSION['id'])]))!==false && !empty($c) && intval($c)>0 && $this->Position_model->add_order(['position_user_id'=>intval($c),'product_id'=>intval($b['productId'])])){
                	   // $text=(!empty($_SESSION['user_info']['name'])?$_SESSION['user_info']['name']:'').' '.(!empty($_SESSION['user_info']['family'])?$_SESSION['user_info']['family']:'').
	       // ' عزیز محصول
    	   // '.(!empty($o['0']['title'])?$o['0']['title']:'').' 
    	   // به تعداد 
    	   // '.(!empty($b['count']) && intval($b['count'])>1?intval($b['count']):1).'
    	   // عدد به سبد شما اضافه شد نسبت به پرداخت آن اقدام کنید
    	   // ';
    	   // $this->chat_creator_pro_pos(intval($b['userPosId']),0,intval($b['proId']),$text);
                        die('11111111111111');
                	}
	    }
	    die('0');
    }
    // رزرو جایگاه توسط مشتری
    public function reserve_position(){
        $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !empty($b['positionId']) && intval($b['positionId'])>0 &&
	    $this->Position_model->add_user(['position_id'=>intval($b['positionId']),'user_id'=>intval($_SESSION['id'])])){
	       // $text=(!empty($_SESSION['user_info']['name'])?$_SESSION['user_info']['name']:'').' '.(!empty($_SESSION['user_info']['family'])?$_SESSION['user_info']['family']:'').
	       // ' عزیز محصول
    	   // '.(!empty($o['0']['title'])?$o['0']['title']:'').' 
    	   // به تعداد 
    	   // '.(!empty($b['count']) && intval($b['count'])>1?intval($b['count']):1).'
    	   // عدد به سبد شما اضافه شد نسبت به پرداخت آن اقدام کنید
    	   // ';
    	   // $this->chat_creator_pro_pos(intval($b['userPosId']),0,intval($b['proId']),$text);
            die('11111111111111');
	    }
	    die('0');
    }
	// تغییر زمان ورود به جایگاه توسط کارشناس
    public function change_reserve_time(){
        $company=new Company_handler();
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!is_null($a) && $this->Include_model->chapcha($a) && !is_null($b) &&
	    !empty($b['positionUserId']) && intval($b['positionUserId'])>0 &&
	    !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) &&
	    !empty($_SESSION['comapy_manager_info']['company_user_id']) && intval($_SESSION['comapy_manager_info']['company_user_id'])>0 &&
	    !empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && 
	    !empty($_SESSION['id']) && intval($_SESSION['id'])>0 && 
	    intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) &&
	    !empty($b['h']) && ($c=explode(':',$b['h'])) !==false && !empty($b['d']) && !empty($b['m']) && !empty($b['y']) && 
	    ($d=$this->Include_model->change_to_time($b['d'],$b['m'],$b['y'],$c['0'],$c['1']))!==false && !empty($d))
	    if($d>=(time()-60)){
	        $this->Position_model->edit_user(['date_reserve'=>date('Y-m-d H:i:s', $d)],['id'=>intval($b['positionUserId'])]);
	        // $text=(!empty($_SESSION['user_info']['name'])?$_SESSION['user_info']['name']:'').' '.(!empty($_SESSION['user_info']['family'])?$_SESSION['user_info']['family']:'').
	       // ' عزیز محصول
    	   // '.(!empty($o['0']['title'])?$o['0']['title']:'').' 
    	   // به تعداد 
    	   // '.(!empty($b['count']) && intval($b['count'])>1?intval($b['count']):1).'
    	   // عدد به سبد شما اضافه شد نسبت به پرداخت آن اقدام کنید
    	   // ';
    	   // $this->chat_creator_pro_pos(intval($b['userPosId']),0,intval($b['proId']),$text);
	       // $this->id=intval($_SESSION['id']);
	       // $main=new Main_exploder();
        //     $main->valex_type='manager';
        //     $main->valex_lt=$_SESSION['ln'];
        //     $main->valex_ln=$_SESSION['lt'];
        //     $main->valex_user_id=$this->id;
            // die($this->setting_reserve_handler($main));
            die('111');
        }else{
            die('43');
        }
	    die('0');
    }
    // تعیین زمان خروج توسط مشتری
    public function access_service_time_position(){
        $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) &&
	    !empty($b['h']) && !empty($b['d']) && !empty($b['m']) && !empty($b['y']) && 
	    !empty($b['posUserId']) && intval($b['posUserId'])>0 &&
	    ($c=explode(':',$b['h']))!==false && !empty($c)){
            $d=$this->Include_model->change_to_time($b['d'],$b['m'],$b['y'],(!empty($c['0']) && intval($c['0'])>0?intval($c['0']):0),(!empty($c['1']) && intval($c['1'])>0?intval($c['1']):0));
            if(!empty($d) && ($e=$this->Position_model->select_user_where_arr(['id'=>intval($b['posUserId'])]))!==false && 
            !empty($e) && !empty($e['0']) && !empty($e['0']['date_reserve']) &&
            ($f=$d-strtotime($e['0']['date_reserve']))!==false){
                if($f>0 && $d>=(time()-60)){
                    $g=floor($f/3600);
                    $h=$f%3600;
                    $i=floor($h/60);
                    $j=floor($h%60);
                    $k=(!empty($g) && intval($g)>0?intval($g):0).':'.(!empty($i) && intval($i)>0?intval($i):0).':'.(!empty($j) && intval($j)>0?intval($j):0);
                    if($this->Position_model->edit_user(['time_reserve'=>$k],['id'=>intval($b['posUserId'])]))
                        die('111');
                        // die($this->show_side()."<script>not10();</script>");
                }else{
                    die('43');
                    // die($this->show_side()."<script>not37();</script>");
                }
            }
	    }
	    die('0');
    }
    // تایید یا تغییر زمان ورود به جایگاه توسط مشتری
    public function access_time_position(){
        $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) &&
	    !empty($b['h']) && !empty($b['d']) && !empty($b['m']) && !empty($b['y']) && 
	    !empty($b['posUserId']) && intval($b['posUserId'])>0 &&
	    ($c=explode(':',$b['h']))!==false && !empty($c) &&
        ($d=$this->Include_model->change_to_time($b['d'],$b['m'],$b['y'],(!empty($c['0']) && intval($c['0'])>0?intval($c['0']):0),(!empty($c['1']) && intval($c['1'])>0?intval($c['1']):0)))!==false &&
        !empty($d))
            if($d>=(time()-60)){
                if($this->Position_model->edit_user(['date_reserve'=>date('Y-m-d H:i:s',$d)],['id'=>intval($b['posUserId'])]))
                    die('111');
                die('0');
            }else{
                die('43');
            }
	    die('0');
    }
    // need to send massage
    // انتخاب محصول از طرف مشتری و ارسال به سبد خرید
    public function reserve_product_in_position_user(){
        $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !empty($b['userPosId']) && intval($b['userPosId'])>0 &&
	    !empty($b['proId']) && intval($b['proId'])>0 &&
	    ($o=$this->Product_model->select_product_where_id(intval($b['proId'])))!==false && !empty($o) && !empty($o['0']) &&
	    $this->Position_model->add_order(['count'=>(!empty($b['count']) && intval($b['count'])>1?intval($b['count']):1),'position_user_id'=>intval($b['userPosId']),'product_id'=>intval($b['proId'])])){
	        $text=(!empty($_SESSION['user_info']['name'])?$_SESSION['user_info']['name']:'').' '.(!empty($_SESSION['user_info']['family'])?$_SESSION['user_info']['family']:'').
	        ' عزیز محصول
    	    '.(!empty($o['0']['title'])?$o['0']['title']:'').' 
    	    به تعداد 
    	    '.(!empty($b['count']) && intval($b['count'])>1?intval($b['count']):1).'
    	    عدد به سبد شما اضافه شد نسبت به پرداخت آن اقدام کنید
    	    ';
    	    $this->chat_creator_pro_pos(intval($b['userPosId']),0,intval($b['proId']),$text);
	        die('111');
	    }
	    die('0');
    }
    // تغییر تعداد هر محصول سفارش داده شده
	public function change_count_order(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !empty($b['oId']) && intval($b['oId'])>0 &&
	    ($c=$this->Position_model->select_order_where_id(intval($b['oId'])))!==false && !empty($c) && !empty($c['0']) && 
	    !empty($c['0']['position_user_id']) && intval($c['0']['position_user_id'])>0 &&
	    !empty($c['0']['product_id']) && intval($c['0']['product_id'])>0 &&
	    ($o=$this->Product_model->select_product_where_id(intval($c['0']['product_id'])))!==false && !empty($o) && !empty($o['0']))
	        if(!empty($b['count']) && intval($b['count'])>0){
	            if($this->Position_model->edit_order(
	                ['count'=>(!empty($b['count']) && intval($b['count'])>1?intval($b['count']):1)],
	                ['id'=>intval($b['oId'])])){
    	            $text=(!empty($_SESSION['user_info']['name'])?$_SESSION['user_info']['name']:'').' '.(!empty($_SESSION['user_info']['family'])?$_SESSION['user_info']['family']:'').
    	            ' عزیز تعداد سفارش محصول
    	            '.(!empty($o['0']['title'])?$o['0']['title']:'').'
    	            به 
    	            '.(!empty($b['count']) && intval($b['count'])>1?intval($b['count']):1).'
    	            عدد در سبد خرید شما تغییر یافت نسبت به پرداخت آن اقدام کنید
    	            ';
    	            $this->chat_creator_pro_pos(intval($c['0']['position_user_id']),0,(!empty($c['0']['product_id']) && intval($c['0']['product_id'])>0?intval($c['0']['product_id']):0),$text);
    	            die('ok');
	            }else{
	                die('0');
	            }
	        }else{
                if($this->Position_model->remove_order(intval($b['oId']))){
                    $text=(!empty($_SESSION['user_info']['name'])?$_SESSION['user_info']['name']:'').' '.(!empty($_SESSION['user_info']['family'])?$_SESSION['user_info']['family']:'').
                    ' عزیز شما محصول  
                    '.(!empty($o['0']['title'])?$o['0']['title']:'').'
                    را از سبد خرید خود حذف کردید اگر دلیل خاصی وجود دارد لطفا آن را به اشتراک بگذارید ';
    	            $this->chat_creator_pro_pos(intval($c['0']['position_user_id']),0,(!empty($c['0']['product_id']) && intval($c['0']['product_id'])>0?intval($c['0']['product_id']):0),$text);
                    die('ok');
                }else{
                    die('0');
                }
	        }
        else
    	    die('0');
	}
    // پرداخت هزینه ی جایگاه توسط مشتری
    public function pay_position_reserve(){
        $r=[];
        $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) &&
	    !empty($b['userPosId']) && intval($b['userPosId'])>0 &&
	    !empty($b['posId']) && intval($b['posId'])>0 && ($c=$this->Position_model->select_where_id(intval($b['posId'])))!==false && !empty($c) && !empty($c['0'])
	    && ($d=$this->Position_model->select_user_where_arr(['id'=>intval($b['userPosId'])]))!==false && !empty($d) && !empty($d['0'])){
	        $f=$this->Position_model->select_company_where_position_id(intval($b['posId']));
    	    $h=0;
    	    $date=new JDF();
    	    foreach($f as $g){
    	        if(!empty($g) && !empty($g['company_id']) && intval($g['company_id'])>0){
    	            $h=intval($g['company_id']);
    	            break;
    	        }
    	    }
    	    if(!empty($h) && intval($h)>0){
    	        $i=$this->Roles_model->select_company_role_where_array(['company_id'=>intval($h),'role_id'=>8]);
    	        if(!(!empty($i) && !empty($i['0']) && !empty($i['0']['id']) && intval($i['0']['id'])>0)){
    	            $i=$this->Roles_model->select_company_role_where_array(['company_id'=>intval($h),'role_id'=>1]);
    	        }
    	        if(!empty($i) && !empty($i['0']) && !empty($i['0']['id']) && intval($i['0']['id'])>0){
    	            $j=$this->Roles_model->select_company_user_where_company_role_id(intval($i['0']['id']));
    	            if(!empty($j) && !empty($j['0']) && !empty($j['0']['user_id']) && intval($j['0']['user_id'])>0){
            	        $price=$this->position_total_price((!empty($d['0']['time_reserve']) && $d['0']['time_reserve'] !== '00:00:00'?
            	        $d['0']['time_reserve']:0),(!empty($c['0']['price']) && intval($c['0']['price'])>0?intval($c['0']['price']):0));
            	        if(!empty($price) && intval($price)>0){
                	        if(($e=$this->Order_model->select_wallet_where_user_id(intval($_SESSION['id'])))!==false && !empty($e) && !empty(end($e))) $e=end($e);
                	        if(!empty($e) && !empty($e['value']) && intval($e['value'])>0){
                	            if(intval($e['value'])>intval($price)){
                	                $asli=$price*10/11;
            	                    $malyat=$price-$asli;
        	                        $k=$this->Order_model->add_payment_return_id([
            	                        'user_id_buier'=>intval($_SESSION['id']),
            	                        'user_id_seller'=>intval($j['0']['user_id']),
            	                        'pay_value'=>intval($price),
            	                        'factor_api_token'=>'ok',
            	                        'status'=>1
            	                    ]);
        	                        if(!empty($k) && intval($k)>0 && ($p=$this->Order_model->add_wallet_return_id([
    	                                'user_id'=>intval($_SESSION['id']),
    	                                'change_value'=>-intval($price),
    	                                'value'=>intval($e['value']-$price),
    	                                'old_value'=>intval($e['value'])
    	                            ]))!==false &&
    	                            ($m=$this->Order_model->select_wallet_where_user_id(intval($j['0']['user_id'])))!==false &&
    	                            !empty($m) && !empty(end($m)) && ($m=end($m))!==false && !empty($m) &&
    	                            ($o=(!empty($m['value']) && intval($m['value'])>0?$m['value']:0))!==false &&
    	                            !empty($p) && intval($p)>0 && ($ass=$this->Order_model->add_wallet_return_id([
    	                                'user_id'=>intval($j['0']['user_id']),
    	                                'change_value'=>intval($asli),
    	                                'value'=>intval($asli+$o),
    	                                'old_value'=>intval($o)
    	                            ]))!==false &&
    	                            ($my=$this->Order_model->select_wallet_where_user_id(1))!==false &&
        	                        !empty($my) && !empty(end($my)) && ($my=end($my))!==false && !empty($my) &&
        	                        ($om=(!empty($my['value']) && intval($my['value'])>0?$my['value']:0))!==false &&
    	                            $this->Order_model->add_wallet([
    	                                'user_id'=>1,
    	                                'change_value'=>intval($malyat),
    	                                'value'=>intval($om+$malyat),
    	                                'old_value'=>intval($om)
    	                            ]) && $this->Order_model->add_wallet_payemt([
    	                                'wallet_id'=>intval($p),
    	                                'seller_wallet_id'=>intval($ass),
    	                                'payment_id'=>intval($k),
    	                                'position_user_id'=>intval($b['userPosId'])]) && 
    	                            $this->Position_model->edit_user(['factor'=>'ok'],['id'=>intval($b['userPosId'])]) && 
    	                            ($x=$this->Order_model->select_wallet_where_user_id(intval($_SESSION['id'])))!==false && !empty($x) && !empty(end($x)) && ($x=end($x))!==false &&
    	                            ($_SESSION['my_wallet']=$x)!==false){
        	                            $p=$this->Users_model->select_info_where_user_id(intval($_SESSION['id']));
    	                                $text=(!empty($p['0']['name'])?$p['0']['name']:'').' '.(!empty($p['0']['family'])?$p['0']['family']:'').'عزیز رزرو جایگاه '.
    	                                (!empty($c['0']['title'])?$c['0']['title']:'').
    	                                'توسط شما به مبلغ '.
    	                                number_format($price).
    	                                'تومان موفق بود برای مشاهده ی اطلاعات به  
    	                                https://www.my-home.ir/chat?type=position&count='.intval($b['posId']).'#chatmodelposition'.intval($b['posId']).'
    	                                بروید.موجودی جدید:'.
    	                                number_format($e['value']-$price).
    	                                ' تومان برای مشاهده ی بیشتر به 
    	                                https://www.my-home.ir/wallet_payment
    	                                بروید';
    	                                $text1='جایگاه '.
    	                                (!empty($c['0']['title'])?$c['0']['title']:'').
    	                                ' توسط '.
    	                                (!empty($p['0']['name'])?$p['0']['name']:'').' '.(!empty($p['0']['family'])?$p['0']['family']:'').'
    	                                به قیمت:'
    	                                .number_format($price).
    	                                'تومان رزرو شده است برای مشاهده ی اطلاعات به  
    	                                https://www.my-home.ir/product_company_order_manager
    	                                بروید.موجودی جدید:'.
    	                                number_format($asli+$o).
    	                                 ' تومان برای مشاهده ی بیشتر به 
    	                                https://www.my-home.ir/chat?type=position&count='.intval($b['posId']).'#chatmodelposition'.intval($b['posId']).'
    	                                بروید';
    	                                $r[]=intval($_SESSION['id']);
        	                            $s=[];
                            	        if(!in_array(intval($j['0']['user_id']),$r)){
            	                            $s=$this->Users_model->select_info_where_user_id(intval($j['0']['user_id']));
                                	        if(!empty($s) && !empty($s['0'])){
                                	            $t=$this->Include_model->send_massage_to_user([
                                	                'position'=>$c['0'],
                                	                'me'=>$p['0'],
                                	                'foroshande'=>$s['0'],
                                	                'price'=>$price,
                                	                'position_user'=>$d['0'],
                                	            ],
                                	            (!empty($s['0']['phone'])?$s['0']['phone']:''),(!empty($s['0']['gmail'])?$s['0']['gmail']:''),
                                	            'includes/email_includes/pay_position_reserve',
                                            	'واریز وجه',
                                	            $text1);
                                	        }
                            	        }
        	                            if(!empty($p) && !empty($p['0'])){
                            	            $q=$this->Include_model->send_massage_to_user([
                                                'position'=>$c['0'],
                                	            'me'=>$p['0'],
                                	            'foroshande'=>(!empty($s) && !empty($s['0'])?$s['0']:[]),
                                	            'price'=>$price,
                                	            'position_user'=>$d['0'],
                            	            ],
                            	            (!empty($p['0']['phone'])?$p['0']['phone']:''),(!empty($p['0']['gmail'])?$p['0']['gmail']:''),
                            	            'includes/email_includes/pay_position_reserve',
                                        	'پرداخت صورتحساب',
                            	            $text);
                            	        }
                            	        $product_chat_text=(!empty($p['0']['name'])?$p['0']['name']:'').' '.(!empty($p['0']['family'])?$p['0']['family']:'').'
                            	        عزیز رزرو جایگاه '.
    	                                (!empty($c['0']['title'])?$c['0']['title']:'').
    	                                (!empty($c['0']['date_reserve'])?'
                	                    در تاریخ 
                	                    '.$date->jdate('Y/m/d',strtotime($d['0']['date_reserve'])).'
                	                    و در ساعت
                                        '.$date->jdate('H:i',strtotime($d['0']['date_reserve']))
                                        :'').'
    	                                به مدت 
    	                                '.(!empty($d['0']['time_reserve']) && $d['0']['time_reserve'] !== '00:00:00'?$d['0']['time_reserve']:' نامعلوم ').'
    	                                به قیمت:'
    	                                .number_format($price).
    	                                'تومان برای شما انجام شده است';
    	                                $x=$this->chat_creator_pro_pos(intval($b['userPosId']),intval($b['posId']),0,$product_chat_text);
    	                                die('111');
    	                            }else{
                	                    die('0');
    	                            }
    	                        }else{
    	                            die('19');
    	                        }
    	                    }else{
    	                        die('19');
    	                    }
            	        }else{
    	                    $r[]=intval($_SESSION['id']);
        	                $p=$this->Users_model->select_info_where_user_id(intval($_SESSION['id']));
            	            $text=(!empty($p['0']['name'])?$p['0']['name']:'').' '.(!empty($p['0']['family'])?$p['0']['family']:'').'عزیز رزرو جایگاه '.
    	                    (!empty($c['0']['title'])?$c['0']['title']:'').
    	                    'توسط شما رایگان بود برای مشاهده ی اطلاعات به  
    	                    https://www.my-home.ir/chat?type=position&count='.intval($b['posId']).'#chatmodelposition'.intval($b['posId']).'
    	                    بروید';
    	                    $text1='جایگاه '.
    	                    (!empty($c['0']['title'])?$c['0']['title']:'').
    	                    ' توسط '.
    	                    (!empty($p['0']['name'])?$p['0']['name']:'').' '.(!empty($p['0']['family'])?$p['0']['family']:'').
    	                    'به صورت رایگان رزرو شده است برای مشاهده ی اطلاعات به  
    	                    https://www.my-home.ir/product_company_order_manager
    	                    بروید';
        	                $s=[];
                            if(!in_array(intval($j['0']['user_id']),$r)){
            	                $s=$this->Users_model->select_info_where_user_id(intval($j['0']['user_id']));
                                if(!empty($s) && !empty($s['0'])){
                                    $t=$this->Include_model->send_massage_to_user([
                                	    'position'=>$c['0'],
                                	    'me'=>$p['0'],
                                	    'foroshande'=>$s['0'],
                                	    'price'=>$price,
                                	    'position_user'=>$d['0'],
                                    ],
                                	(!empty($s['0']['phone'])?$s['0']['phone']:''),(!empty($s['0']['gmail'])?$s['0']['gmail']:''),
                                	'includes/email_includes/pay_position_reserve',
                                    'هدیه دادن جایگاه',
                                	$text1);
                                }
                            }
        	                if(!empty($p) && !empty($p['0'])){
                                $q=$this->Include_model->send_massage_to_user([
                                    'position'=>$c['0'],
                                	'me'=>$p['0'],
                                	'foroshande'=>(!empty($s) && !empty($s['0'])?$s['0']:[]),
                                	'price'=>$price,
                                	'position_user'=>$d['0'],
                                ],
                            	(!empty($p['0']['phone'])?$p['0']['phone']:''),(!empty($p['0']['gmail'])?$p['0']['gmail']:''),
                            	'includes/email_includes/pay_position_reserve',
                                'هدیه گرفتن جایگاه',
                            	$text);
                            }
                	        $this->Position_model->edit_user(['factor'=>'ok'],['id'=>intval($b['userPosId'])]);
                	        $product_chat_text=(!empty($p['0']['name'])?$p['0']['name']:'').' '.(!empty($p['0']['family'])?$p['0']['family']:'').'
                            عزیز رزرو جایگاه '.
    	                    (!empty($c['0']['title'])?$c['0']['title']:'').
    	                    (!empty($c['0']['date_reserve'])?'
    	                    در تاریخ 
    	                    '.$date->jdate('Y/m/d',strtotime($d['0']['date_reserve'])).'
    	                    و در ساعت
                            '.$date->jdate('H:i',strtotime($d['0']['date_reserve']))
                            :'').'
    	                    به مدت 
    	                    '.(!empty($d['0']['time_reserve']) && $d['0']['time_reserve'] !== '00:00:00'?$d['0']['time_reserve']:' نامعلوم ').
    	                    'به عنوان هدیه ای برای شما فعال گردید';
                            $x=$this->chat_creator_pro_pos(intval($b['userPosId']),intval($b['posId']),0,$product_chat_text);
                	        die('111');
                        }
            	    }
    	        }
    	    }
	    }
	    die('0');
    }
    // پرداخت هزینه ی محصول توسط مشتری
    public function pay_product_position_order(){
        $r=[];
        $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) &&
	    !empty($b['posProOrderId']) && intval($b['posProOrderId'])>0 &&
	    ($c=$this->Position_model->select_order_where_id(intval($b['posProOrderId'])))!==false && !empty($c) && !empty($c['0']) &&
	    !empty($c['0']['product_id']) && intval($c['0']['product_id'])>0 && ($d=$this->Product_model->select_product_where_id(intval($c['0']['product_id'])))!==false &&
	    !empty($d) && !empty($d['0']) && !empty($d['0']['id']) && intval($d['0']['id'])>0){
	        $date=new JDF();
	        if(!empty($d['0']['price']) && intval($d['0']['price'])>0){
	            $d['0']['price']=intval($d['0']['price']*(!empty($c['0']['count']) && intval($c['0']['count'])>1?intval($c['0']['count']):1));
	            if(($e=$this->Order_model->select_wallet_where_user_id(intval($_SESSION['id'])))!==false && !empty($e) && !empty(end($e))) $e=end($e);
	            if(!empty($e) && !empty($e['value']) && intval($e['value'])>=0){
	                $price=intval($d['0']['price']*10/11);
	                if(intval($e['value'])>intval($d['0']['price'])){
	                    $f=$this->Product_model->select_category_where_product_id(intval($d['0']['id']));
	                    $h=0;
	                    foreach($f as $g){
	                        if(!empty($g) && !empty($g['company_id']) && intval($g['company_id'])>0){
	                            $h=intval($g['company_id']);
	                            break;
	                        }
	                    }
	                    if(!empty($h) && intval($h)>0){
	                        $i=$this->Roles_model->select_company_role_where_array(['company_id'=>intval($h),'role_id'=>8]);
	                        if(!(!empty($i) && !empty($i['0']) && !empty($i['0']['id']) && intval($i['0']['id'])>0)){
	                            $i=$this->Roles_model->select_company_role_where_array(['company_id'=>intval($h),'role_id'=>1]);
	                        }
	                        if(!empty($i) && !empty($i['0']) && !empty($i['0']['id']) && intval($i['0']['id'])>0){
	                            $j=$this->Roles_model->select_company_user_where_company_role_id(intval($i['0']['id']));
	                            if(!empty($j) && !empty($j['0']) && !empty($j['0']['user_id']) && intval($j['0']['user_id'])>0){
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
    	                                ]) && $this->Order_model->add_wallet_payemt(['wallet_id'=>intval($p),'seller_wallet_id'=>intval($ass),'payment_id'=>intval($k),'position_product_order'=>intval($b['posProOrderId'])]) && 
    	                                $this->Position_model->edit_order(['status'=>1,'payment_id'=>intval($k),'time'=>time()],['id'=>intval($b['posProOrderId'])]) &&
    	                                ($x=$this->Order_model->select_wallet_where_user_id(intval($_SESSION['id'])))!==false && !empty($e) && !empty(end($e)) && ($x=end($x))!==false && !empty($x) &&
    	                                ($_SESSION['my_wallet']=$x)!==false) {
                            	            $a=(($a=$this->Position_model->select_user_where_arr(['id'=>intval($c['0']['position_user_id'])]))!==false && !empty($a) && !empty($a['0']) && !empty($a['0']['position_id']) && intval($a['0']['position_id'])>0?intval($a['0']['position_id']):0);
                            	            $pos_user_id=intval($c['0']['position_user_id']);
                            	            $c['0']=(($c=$this->Position_model->select_where_id(intval($a)))!==false && !empty($c) && !empty($c['0'])?$c['0']:[]);    
                                	        $s=$p=[];
                                    	    if(!in_array($_SESSION['id'],$r)){
                                        	    $r[]=intval($_SESSION['id']);
                                        	    $p=$this->Users_model->select_info_where_user_id(intval($_SESSION['id']));
                                    	    }
                            	            $text=(!empty($p['0']['name'])?$p['0']['name']:'').' '.(!empty($p['0']['family'])?$p['0']['family']:'').
                            	            ' عزیز پرداخت مبلغ '.
                            	            number_format($price).
                            	            'تومان بابت خرید محصول '.
                            	            (!empty($d['0']['title'])?$d['0']['title']:'').
                            	            'در جایگاه '.
                            	            (!empty($c['0']['title'])?$c['0']['title']:'').
                            	            'که قبلا رزرو با موفقیت انجام شد برای مشاهده ی بیشتر به
                            	            https://www.my-home.ir/chat?type=product&count='.intval($d['0']['id']).'#chatmodelproduct'.intval($d['0']['id']).'
                            	            بروید.موجودی جدید:'.
                            	            number_format($e['value']-$d['0']['price']).   
                            	            'تومان برای مشاهده ی جزییات به 
                            	            https://www.my-home.ir/wallet_payment
                            	            بروید';
                                	        $text1='محصول  '.
                                	        (!empty($d['0']['title'])?$d['0']['title']:'').
                                	        ' توسط '.
                            	            (!empty($p['0']['name'])?$p['0']['name']:'').' '.(!empty($p['0']['family'])?$p['0']['family']:'').
                            	            ' به مبلغ '.
                            	            number_format($price).
                            	            'تومان در جایگاه '.
                                	        (!empty($c['0']['title'])?$c['0']['title']:'').
                                	        ' خریداری شده است جهت دریافت اطلاعات بیشتر به
                                	        https://www.my-home.ir/chat?type=product&count='.intval($d['0']['id']).'#chatmodelproduct'.intval($d['0']['id']).'
                                	        بروید.موجودی جدید:'.
                                	        number_format($price+$o).
                                	        'جهت مشاهده ی جزییات به 
                                	        https://www.my-home.ir/wallet_payment
                                	        بروید';
                                            if(!in_array(intval($j['0']['user_id']),$r)){
                                                $r[]=intval($j['0']['user_id']);
                                        	    $s=$this->Users_model->select_info_where_user_id(intval($j['0']['user_id']));
                                            }
                                            if(!empty($s) && !empty($s['0'])){
                                                $t=$this->Include_model->send_massage_to_user([
                                                    'position'=>$c['0'],
                                                    'me'=>$p['0'],
                                                    'foroshande'=>$s['0'],
                                                    'product'=>$d['0'],
                                                    'price'=>$price
                                                ],
                                                (!empty($s['0']['phone'])?$s['0']['phone']:''),(!empty($s['0']['gmail'])?$s['0']['gmail']:''),
                                                'includes/email_includes/pay_product_position_order',
                                                'واریز وجه',
                                                $text1);
                                            }
                                    	    if(!empty($p) && !empty($p['0'])){
                                                $q=$this->Include_model->send_massage_to_user([
                                                    'position'=>$c['0'],
                                                    'me'=>$p['0'],
                                                    'foroshande'=>(!empty($s) && !empty($s['0'])?$s['0']:[]),
                                                    'price'=>$price,
                                                    'product'=>$d['0'],
                                                ],
                                                (!empty($p['0']['phone'])?$p['0']['phone']:''),(!empty($p['0']['gmail'])?$p['0']['gmail']:''),
                                                'includes/email_includes/pay_product_position_order',
                                                'پرداخت صورتحساب',
                                                $text);
                                            }
                                            $product_chat_text=(!empty($_SESSION['user_info']['name'])?$_SESSION['user_info']['name']:'').' '.(!empty($_SESSION['user_info']['family'])?$_SESSION['user_info']['family']:'')
        	                                .' عزیز شما در تاریخ
        	                                '.$date->jdate('Y/m/d',time()).'
        	                                و در ساعت
        	                                '.$date->jdate('H:i',time()).'
        	                                محصول 
        	                                '.(!empty($d['0']['title'])?$d['0']['title']:'').'  
        	                                را به قیمت 
        	                                '.number_format($price).'
        	                                تومان 
        	                                '.(!empty($company_info['title'])?'از '.$company_info['title']:'').'
        	                                بصورت حضوری در جایگاه
        	                                '.(!empty($c['0']['title'])?$c['0']['title']:'').'
        	                                خرید کردید آیا از خرید خود راضی هستید؟';
                                            $x=$this->chat_creator_pro_pos(intval($pos_user_id),intval($a),intval($d['0']['id']),$product_chat_text);
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
	        }else{
	            $a=(($a=$this->Position_model->select_user_where_arr(['id'=>intval($c['0']['position_user_id'])]))!==false && !empty($a) && !empty($a['0']) && !empty($a['0']['position_id']) && intval($a['0']['position_id'])>0?intval($a['0']['position_id']):0);
                $pos_user_id=intval($c['0']['position_user_id']);
                $bb=$this->Position_model->select_company_where_position_id($a);
                $c['0']=(($c=$this->Position_model->select_where_id(intval($a)))!==false && !empty($c) && !empty($c['0'])?$c['0']:[]);
                $text=(!empty($p['0']['name'])?$p['0']['name']:'').' '.(!empty($p['0']['family'])?$p['0']['family']:'').
                ' عزیز محصول '.
                (!empty($d['0']['title'])?$d['0']['title']:'').
                'در جایگاه '.
                (!empty($c['0']['title'])?$c['0']['title']:'').
                'به شما هدیه شد برای مشاهده ی بیشتر به
                https://www.my-home.ir/chat
                بروید';
                $text1='محصول  '.
                (!empty($d['0']['title'])?$d['0']['title']:'').
                ' توسط '.
                (!empty($p['0']['name'])?$p['0']['name']:'').' '.(!empty($p['0']['family'])?$p['0']['family']:'').
                ' در جایگاه '.
                (!empty($c['0']['title'])?$c['0']['title']:'').
                'به صورت رایگان هدیه داده شد جهت دریافت اطلاعات بیشتر به
                https://www.my-home.ir/chat
                بروید';
                $i=$p=[];
                if(!in_array(intval($_SESSION['id']),$r)){
                    $r[]=intval($_SESSION['id']);
                    $p=$this->Users_model->select_info_where_user_id(intval($_SESSION['id']));
                }
                if(!empty($bb)){
                    foreach($bb as $z){
                        $y=$this->Company_model->select_user_product_access_where_company_category_product_and_status($z['id']);
                        foreach($y as $x){
                            $w=$this->Company_model->select_user_where_id($x['company_user_id']);
                            if(!in_array(intval($w['0']['user_id']),$i)){
                                $i[]=intval($w['0']['user_id']);
                                $s=[];
                                if(!in_array(intval($w['0']['user_id']),$r)){
                                    $r[]=intval($w['0']['user_id']);
                                    $s=$this->Users_model->select_info_where_user_id(intval($w['0']['user_id']));
                                }
                                if(!empty($s) && !empty($s['0'])){
                                    $t=$this->Include_model->send_massage_to_user([
                                        'position'=>$c['0'],
                                        'me'=>$p['0'],
                                        'foroshande'=>$s['0'],
                                        'product'=>$d['0'],
                                        'price'=>$price
                                    ],
                                    (!empty($s['0']['phone'])?$s['0']['phone']:''),(!empty($s['0']['gmail'])?$s['0']['gmail']:''),
                                    'includes/email_includes/pay_product_position_order',
                                    'واریز وجه',
                                    $text1);
                                }
                            }
                        }
                    }
                }
                if(!empty($p) && !empty($p['0'])){
                    $q=$this->Include_model->send_massage_to_user([
                        'position'=>$c['0'],
                        'me'=>$p['0'],
                        'foroshande'=>$s['0'],
                        'price'=>$price,
                        'product'=>$d['0'],
                    ],
                    (!empty($p['0']['phone'])?$p['0']['phone']:''),(!empty($p['0']['gmail'])?$p['0']['gmail']:''),
                    'includes/email_includes/pay_product_position_order',
                    'پرداخت صورتحساب',
                    $text);
                }
	            $this->Position_model->edit_order(['status'=>1],['id'=>intval($b['posProOrderId'])]);
	            $product_chat_text=(!empty($_SESSION['user_info']['name'])?$_SESSION['user_info']['name']:'').' '.(!empty($_SESSION['user_info']['family'])?$_SESSION['user_info']['family']:'')
        	    .' عزیز شما در تاریخ
        	    '.$date->jdate('Y/m/d',time()).'
        	    و در ساعت
        	    '.$date->jdate('H:i',time()).'
        	    محصول 
        	    '.(!empty($d['0']['title'])?$d['0']['title']:'').'  
        	    را به صورت هدیه 
        	    '.(!empty($company_info['title'])?'از '.$company_info['title']:'').'
        	    بصورت حضوری در جایگاه
        	    '.(!empty($c['0']['title'])?$c['0']['title']:'').'
        	    دریافت کردید چقدر از خدمات رسانی راضی هستید؟';
                $x=$this->chat_creator_pro_pos(intval($pos_user_id),intval($a),intval($d['0']['id']),$product_chat_text);
    	        die('ok');
	        }
	    }
	    die('0');
    }
    // تایید رسیدن مشتری توسط کارشناس جایگاه
    public function arrived_persent(){
        $r=[];
        $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !empty($b['id']) && intval($b['id'])>0 &&
	    !empty($b['positionId']) && intval($b['positionId'])>0){
	        $date=new JDF();
	        $this->id=intval($_SESSION['id']);
	       // $main=new Main_exploder();
        //     $main->valex_type='manager';
        //     $main->valex_lt=$_SESSION['ln'];
        //     $main->valex_ln=$_SESSION['lt'];
        //     $main->valex_user_id=$this->id;
            if($this->Position_model->edit_user(['status'=>1,'date_reserve'=>date('Y-m-d H:i:s',time())],['id'=>intval($b['id'])]) && 
            $this->Position_model->edit(['status'=>0],['id'=>intval($b['positionId'])])){
                $a=$this->Position_model->select_user_where_arr(['id'=>intval($b['id'])]);
                $c=(!empty($a) && !empty($a['0']) && !empty($a['0']['position_id']) && intval($a['0']['position_id'])>0?intval($a['0']['position_id']):0);
                $f=$this->Position_model->select_where_id($c);
                $pos_user_id=intval($b['id']);
                $b=$this->Position_model->select_company_where_position_id($c);
                $i=$p=[];
                if(!in_array(intval($a['0']['user_id']),$r)){
                    $r[]=intval($a['0']['user_id']);
                    $p=$this->Users_model->select_info_where_user_id(intval($a['0']['user_id']));
                }
                $text=(!empty($p['0']['name'])?$p['0']['name']:'').' '.(!empty($p['0']['family'])?$p['0']['family']:'').
                ' عزیز به جایگاه '. 
                (!empty($f['0']['title'])?$f['0']['title']:'').
                ' خوش آمدید برای سفارشات خود به
                https://www.my-home.ir/position/'.intval($c).'
                بروید';
                $text1='ورود '.
                (!empty($p['0']['name'])?$p['0']['name']:'').' '.(!empty($p['0']['family'])?$p['0']['family']:'').
                ' به جایگاه '. 
                (!empty($f['0']['title'])?$f['0']['title']:'').
                ' تایید شده است برای پیگیری سفارشات مشتری به
                https://www.my-home.ir/chat?type=position&count='.intval($c).'#chatmodelposition'.intval($c).'
                بروید';
                $product_chat_text=(!empty($p['0']['name'])?$p['0']['name']:'').' '.(!empty($p['0']['family'])?$p['0']['family']:'')
        	    .' عزیز شما در تاریخ
        	    '.$date->jdate('Y/m/d',time()).'
        	    و در ساعت
        	    '.$date->jdate('H:i',time()).'
        	    به جایگاه 
        	    وارد شدید و تا زمان
        	    '.(!empty($a['0']['time_reserve'])&&$a['0']['time_reserve'] !== '00:00:00'?$a['0']['time_reserve']:' نا معلوم ').'
        	    میتوانید از خدمات این جایگاه بهره مند شوید شما می توانید از خدمت رسانی این جایگاه میزان رضایت خود را اعلام کنید';
                foreach($b as $z){
                    $y=$this->Company_model->select_user_product_access_where_company_category_product_and_status($z['id']);
                    foreach($y as $x){
                        $w=$this->Company_model->select_user_where_id($x['company_user_id']);
                        if(!in_array(intval($w['0']['user_id']),$i)){
                            $i[]=intval($w['0']['user_id']);
                            $s=[];
                            if(!in_array(intval($w['0']['user_id']),$r)){
                                $r[]=intval($w['0']['user_id']);
                                $s=$this->Users_model->select_info_where_user_id(intval($w['0']['user_id']));
                            }
                            if(!empty($s) && !empty($s['0'])){
                                $t=$this->Include_model->send_massage_to_user([
                                    'position'=>(!empty($f) && !empty($f['0'])?$f['0']:[]),
                                    'moshtary'=>(!empty($p) && !empty($p['0'])?$p['0']:[]),
                                ],
                                (!empty($s['0']['phone'])?$s['0']['phone']:''),(!empty($s['0']['gmail'])?$s['0']['gmail']:''),
                                'includes/email_includes/arrived_persent',
                                'ورود مشتری به جایگاه',
                                $text1);
                            }
                        }
                    }
                }
                if(!empty($p) && !empty($p['0'])){
                    $q=$this->Include_model->send_massage_to_user([
                        'position'=>(!empty($f) && !empty($f['0'])?$f['0']:[]),
                        'moshtary'=>(!empty($p) && !empty($p['0'])?$p['0']:[]),
                    ],
                    (!empty($p['0']['phone'])?$p['0']['phone']:''),(!empty($p['0']['gmail'])?$p['0']['gmail']:''),
                    'includes/email_includes/arrived_persent',
                    'حضور در جایگاه',
                    $text);
                }
                $x=$this->chat_creator_pro_pos(intval($pos_user_id),intval($a['0']['position_id']),0,$product_chat_text);
                // die($this->setting_reserve_handler($main));
                die('111');
            }
	    }
	    die('0');
    }
    // پایان خدمات رسانی جایگاه توسط کارشناس
    public function end_service(){
        $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !empty($b['id']) && intval($b['id'])>0 &&
	    ($a=$this->Position_model->select_user_where_arr(['id'=>intval($b['id'])]))!==false && !empty($a) && !empty($a['0']) &&
	    !empty($b['positionId']) && intval($b['positionId'])>0){
	        $date=new JDF();
	        $this->id=intval($_SESSION['id']);
	       // $main=new Main_exploder();
        //     $main->valex_type='manager';
        //     $main->valex_lt=$_SESSION['ln'];
        //     $main->valex_ln=$_SESSION['lt'];
        //     $main->valex_user_id=$this->id;
            $where=[];
            $where['status']=6;
            if(!empty($a['0']['date_reserve'])){
                if(!empty($a['0']['time_reserve']) && $a['0']['time_reserve'] !== '00:00:00'){
                    $pos=new Position_handler();
                    $pos_end_time=$pos->calender_calcolate(strtotime($a['0']['date_reserve']),$a['0']['time_reserve']);
                    if($pos_end_time>time()){
                        die('42');
                    }
                }else{
                    $xp_time=time()-strtotime($a['0']['date_reserve']);
                    $hours=floor($xp_time/3600);
                    $hours_handler=($xp_time%=3600);
                    $mins=floor($hours_handler/60);
                    $secounds=floor($hours_handler%=60);
                    $where['time_reserve']=$hours.':'.$mins.':'.$secounds;
                }
            }
            if($this->Position_model->edit_user($where,['id'=>intval($b['id'])]) && 
            $this->Position_model->edit_order(['status'=>1],['position_user_id'=>intval($b['id'])]) &&
            $this->Position_model->edit(['status'=>1],['id'=>intval($b['positionId'])])){
                $r=[];
                $c=(!empty($a['0']['position_id']) && intval($a['0']['position_id'])>0?intval($a['0']['position_id']):0);
                $f=$this->Position_model->select_where_id($c);
                $pos_user_id=intval($b['id']);
                $b=$this->Position_model->select_company_where_position_id($c);
                $i=$p=[];
                if(!in_array(intval($a['0']['user_id']),$r)){
                    $r[]=intval($a['0']['user_id']);
                    $p=$this->Users_model->select_info_where_user_id(intval($a['0']['user_id']));
                }
                $text=(!empty($p['0']['name'])?$p['0']['name']:'').' '.(!empty($p['0']['family'])?$p['0']['family']:'').
                ' عزیز حضور شما در جایگاه '.
                (!empty($f['0']['title'])?$f['0']['title']:'').
                ' با آرزوی موفقیت به اتمام رسید از انتخاب شما متشکریم';
                $text1=(!empty($p['0']['name'])?$p['0']['name']:'').' '.(!empty($p['0']['family'])?$p['0']['family']:'').
                ' از جایگاه '.
                (!empty($f['0']['title'])?$f['0']['title']:'').
                ' خارج شد از خدمات شما سپاسگذاریم';
                foreach($b as $z){
                    $y=$this->Company_model->select_user_product_access_where_company_category_product_and_status($z['id']);
                    foreach($y as $x){
                        $w=$this->Company_model->select_user_where_id($x['company_user_id']);
                        if(!in_array(intval($w['0']['user_id']),$i)){
                            $i[]=intval($w['0']['user_id']);
                            $s=[];
                            if(!in_array(intval($w['0']['user_id']),$r)){
                                $r[]=intval($w['0']['user_id']);
                                $s=$this->Users_model->select_info_where_user_id(intval($w['0']['user_id']));
                            }
                            if(!empty($s) && !empty($s['0'])){
                                $t=$this->Include_model->send_massage_to_user([
                                    'position'=>(!empty($f) && !empty($f['0'])?$f['0']:[]),
                                    'moshtary'=>(!empty($p) && !empty($p['0'])?$p['0']:[]),
                                ],
                                (!empty($s['0']['phone'])?$s['0']['phone']:''),(!empty($s['0']['gmail'])?$s['0']['gmail']:''),
                                'includes/email_includes/end_service',
                                'خروج مشتری از جایگاه',
                                $text1);
                            }
                        }
                    }
                }
                if(!empty($p) && !empty($p['0'])){
                    $q=$this->Include_model->send_massage_to_user([
                        'position'=>(!empty($f) && !empty($f['0'])?$f['0']:[]),
                        'moshtary'=>(!empty($p) && !empty($p['0'])?$p['0']:[]),
                    ],
                    (!empty($p['0']['phone'])?$p['0']['phone']:''),(!empty($p['0']['gmail'])?$p['0']['gmail']:''),
                    'includes/email_includes/end_service',
                    'خروج از جایگاه',
                    $text);
                }
                $product_chat_text=(!empty($p['0']['name'])?$p['0']['name']:'').' '.(!empty($p['0']['family'])?$p['0']['family']:'').
                ' عزیز حضور شما در جایگاه '.
                (!empty($f['0']['title'])?$f['0']['title']:'').
                ' با آرزوی موفقیت در زمان 
                '.$date->jdate('Y/m/d',time()).'
                و در ساعت
                '.$date->jdate('H:i',time()).'
                به پایان رسیده است میزان رضایت شما از خدمات رسانی این جایگاه چقدر است؟';
                $x=$this->chat_creator_pro_pos(intval($pos_user_id),intval($a['0']['position_id']),0,$product_chat_text);
                // die($this->setting_reserve_handler($main));
                die('111');
            }
	    }
	    die('0');
    }
    private function show_side(){
        $ret='';
        if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0){
            $position=new Position_handler();
            $position->show_my_position_valex(intval($_SESSION['id']));
            $ret=$this->load->view('users/shop/shop',[
                'info'=>$_SESSION['user_info'],
        	    'my_position'=>(!empty($position->my_position)?1:0),
        		'calendar'=>$position->calendar,
        		'none_position'=>$position->my_position,
                'has_position'=>$position->my_position
            ],true);
        }
        return $ret;
    }
    private function position_total_price($timer,$pos_price){
        $price=0;
        if(!empty($pos_price) && intval($pos_price)>0){
            if(!empty($timer) && $timer!==0 && $timer!=='00:00:00'){
                $ex=explode(':',$timer);
                if(!empty($ex) && is_array($ex)){
                    $price+=(!empty($ex['0']) && intval($ex['0'])>0?intval($ex['0']*$pos_price):0);
                    $sum_min=intval($pos_price/60);
                    $sum_sec=intval($pos_price/3600);
                    $price+=(!empty($ex['1']) && intval($ex['1'])>0?intval($sum_min*$ex['1']):0);
                    $price+=(!empty($ex['2']) && intval($ex['2'])>0?intval($sum_sec*$ex['2']):0);
                }
            // }else{
            //     $price=0; 
            }
        // }else{
        //     $price=(!empty($pos_price) && intval($pos_price)>0?intval($pos_price):0);
        }
        // return $price;
        return $price+($price/10);
        
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
    public function all_reserves_info(){
        $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !empty($b['send']) && $b['send']=='ok'){
	        $this->id=intval($_SESSION['id']);
	        $main=new Main_exploder();
            $main->valex_type='manager';
            $main->valex_lt=$_SESSION['ln'];
            $main->valex_ln=$_SESSION['lt'];
            $main->valex_user_id=$this->id;
            die($this->setting_reserve_handler($main));
	    }
	    die('0');
    }
	public function position_products(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !empty($b['cId']) && intval($b['cId'])>0 &&
	    !empty($b['proId']) && intval($b['proId'])>0 &&
	    !empty($b['posId']) && intval($b['posId'])>0 &&
	    !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
	    !empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && 
	    !empty($_SESSION['id']) && intval($_SESSION['id'])>0 && 
	    intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id'])){
	        $c=$this->Position_model->select_company_where_arr(['product_id'=>intval($b['proId']),'company_id'=>intval($b['cId']),'position_id'=>intval($b['posId'])]);
	        if(!empty($c)){
	            if(!(!empty($b['s']) && intval($b['s'])>0)){
	                $d=$this->Position_model->select_company_where_arr(['product_id'=>intval($b['proId'])]);
	                $d=(!empty($d) && !empty($d['0']) && !empty($d['0']['id']) && intval($d['0']['id'])>0?intval($d['0']['id']):0);
	                $e=$this->Position_model->select_company_where_arr(['product_id'=>0,'position_id'=>intval($b['posId'])]);
	                $e=(!empty($e) && !empty($e['0']) && !empty($e['0']['id']) && intval($e['0']['id'])>0?intval($e['0']['id']):0);
	                foreach($c as $f){
	                    if(!empty($f) && !empty($f['id']) && intval($f['id'])>0){
	                        if(intval($e)>0) 
	                            $this->Company_model->edit_access_weher_arr(['company_category_product'=>intval($e)],['is_position'=>1,'company_category_product'=>intval($f['id'])]);
	                        if(intval($d)>0) 
	                            $this->Company_model->edit_access_weher_arr(['company_category_product'=>intval($d)],['is_position'=>0,'company_category_product'=>intval($f['id'])]);       
        	                $this->Position_model->remove_company(intval($f['id']));
	                    }
	                }
	                die('ok');
	            }
	        }else{
	            $c_id=$this->position_category_finder(intval($b['posId']));
	            if(!empty($b['s']) && intval($b['s'])>0 && 
	            $this->Position_model->add_company_category([
	                'category_id'=>$c_id,
	                'product_id'=>intval($b['proId']),
	                'company_id'=>intval($b['cId']),
	                'position_id'=>intval($b['posId'])
	            ]))
                    die('ok');
	        }
	    }
	    die('0');
	}
	private function position_category_finder($id){
	    if(!empty($id) && intval($id)>0 && 
        ($a=$this->Position_model->select_company_where_position_id($id))!==false && !empty($a))
    	    foreach($a as $b){
    	        if(!empty($b) && !empty($b['category_id']) && intval($b['category_id'])>0) return intval($b['category_id']);
    	    }
	    return 0;
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
        $this->Position_model->remove_map(intval($b['id'])))die('111');
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
        $this->Position_model->add_map(['position_id'=>intval($b['id']),'lat'=>$b['lat'],'lng'=>$b['lon'],'title'=>$b['title']]))die('111');
        die('0');
	}
	public function add_video(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !empty($b['i']) && !empty($b['pId']) && intval($b['pId'])>0 &&
	    !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
	    !empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && 
	    !empty($_SESSION['id']) && intval($_SESSION['id'])>0 && 
	    intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && 
	    !empty($_SESSION['comapy_manager_info']['company_user_id']) && intval($_SESSION['comapy_manager_info']['company_user_id'])>0 &&
	    !empty($_SESSION['comapy_manager_info']['role_id']) && intval($_SESSION['comapy_manager_info']['role_id'])>0 && 
	    !empty($_SESSION['comapy_manager_info']['company_id']) && intval($_SESSION['comapy_manager_info']['company_id'])>0 &&
        $this->Position_model->add_video(['address'=>$b['i'],'position_id'=>intval($b['pId'])]))die('111');
        die('0');
	}
    public function remove_video(){
        $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !empty($b['id']) && intval($b['id'])>0 &&
	    !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
	    !empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && 
	    !empty($_SESSION['id']) && intval($_SESSION['id'])>0 && 
	    intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && 
	    !empty($_SESSION['comapy_manager_info']['company_user_id']) && intval($_SESSION['comapy_manager_info']['company_user_id'])>0 &&
	    !empty($_SESSION['comapy_manager_info']['role_id']) && intval($_SESSION['comapy_manager_info']['role_id'])>0 && 
	    !empty($_SESSION['comapy_manager_info']['company_id']) && intval($_SESSION['comapy_manager_info']['company_id'])>0 &&
        ($c=$this->Position_model->select_video_where_id(intval($b['id'])))!==false && !empty($c) && !empty($c['0']) && !empty($c['0']['address']) &&
        $this->Position_model->remove_video(intval($b['id'])) && $this->Include_model->remove_file('./assets/video/position/'.$c['0']['address'])) die('11');
        die('0');
    }
    public function add_image(){
        $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !empty($b['i']) && !empty($b['pId']) && intval($b['pId'])>0 &&
	    !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
	    !empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && 
	    !empty($_SESSION['id']) && intval($_SESSION['id'])>0 && 
	    intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && 
	    !empty($_SESSION['comapy_manager_info']['company_user_id']) && intval($_SESSION['comapy_manager_info']['company_user_id'])>0 &&
	    !empty($_SESSION['comapy_manager_info']['role_id']) && intval($_SESSION['comapy_manager_info']['role_id'])>0 && 
	    !empty($_SESSION['comapy_manager_info']['company_id']) && intval($_SESSION['comapy_manager_info']['company_id'])>0 &&
        $this->Position_model->add_image(['address'=>$b['i'],'position_id'=>intval($b['pId'])]))die('111');
        die('0');
    }
    public function remove_image(){
        $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !empty($b['id']) && intval($b['id'])>0 &&
	    !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
	    !empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && 
	    !empty($_SESSION['id']) && intval($_SESSION['id'])>0 && 
	    intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && 
	    !empty($_SESSION['comapy_manager_info']['company_user_id']) && intval($_SESSION['comapy_manager_info']['company_user_id'])>0 &&
	    !empty($_SESSION['comapy_manager_info']['role_id']) && intval($_SESSION['comapy_manager_info']['role_id'])>0 && 
	    !empty($_SESSION['comapy_manager_info']['company_id']) && intval($_SESSION['comapy_manager_info']['company_id'])>0 &&
        ($c=$this->Position_model->select_image_where_id(intval($b['id'])))!==false && !empty($c) && !empty($c['0']) && !empty($c['0']['address']) &&
        $this->Position_model->remove_image(intval($b['id'])) && $this->Include_model->remove_file('./assets/pic/position/'.$c['0']['address'])) die('11');
        die('0');
    }
    public function add(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !empty($b['t']) && !empty($b['d']) && 
	    !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
	    !empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && 
	    !empty($_SESSION['id']) && intval($_SESSION['id'])>0 && 
	    intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && 
	    !empty($_SESSION['comapy_manager_info']['company_user_id']) && intval($_SESSION['comapy_manager_info']['company_user_id'])>0 &&
	    !empty($_SESSION['comapy_manager_info']['role_id']) && intval($_SESSION['comapy_manager_info']['role_id'])>0 && 
	    !empty($_SESSION['comapy_manager_info']['company_id']) && intval($_SESSION['comapy_manager_info']['company_id'])>0){
	        $company=new Company_handler();
    	    $p_id=$this->Position_model->add_position_return_id([
                'title'=>$b['t'],	
                'icon'=>(!empty($b['i'])?$b['i']:''),	
                'description'=>$b['d'],	
                'position_type'=>(!empty($b['pt'])?$b['pt']:0),	
                'price'=>(!empty($b['p'])?$b['p']:''),	
                'status'=>1
    	    ]);
    	    $this->Position_model->edit(['qr_code'=>$this->generate_qrcode(base_url('position/'.$p_id))],['id'=>$p_id]);
            $ccpp_id=$this->Position_model->add_company_category_return_id([
                'product_id'=>0,
                'company_id'=>intval($_SESSION['comapy_manager_info']['company_id']),	
                'position_id'=>intval($p_id),	
                'category_id'=>(!empty($b['c']) && intval($b['c'])>0?intval($b['c']):0),
            ]);
            $this->Company_model->add_access([
                'company_user_id'=>intval($_SESSION['comapy_manager_info']['company_user_id']),	
                'company_category_product'=>intval($ccpp_id),	
                'is_position'=>1,	
                'status'=>1
            ]);
	        die($this->load->view('company/position/index',[
                'category'=>$this->Category_model->select_where_status(),
            	'role_id'=>intval($_SESSION['comapy_manager_info']['role_id']),
            	'company_id'=>intval($_SESSION['comapy_manager_info']['company_id']),
            	'position_logo_uploader'=>$this->load->view('includes/uploader',['url'=>'assets---svg---position','type'=>'image'],true),
            	'data'=>$company->user_company_action(intval($_SESSION['comapy_manager_info']['company_id']),intval($_SESSION['comapy_manager_info']['company_user_id']))
            ],true));
	    }
	    die('0');
    }
    public function edit(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !empty($b['t']) && !empty($b['d']) && 
	    !empty($b['id']) && intval($b['id'])>0 && 
	    !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
	    !empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && 
	    !empty($_SESSION['id']) && intval($_SESSION['id'])>0 && 
	    intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && 
	    !empty($_SESSION['comapy_manager_info']['company_user_id']) && intval($_SESSION['comapy_manager_info']['company_user_id'])>0 &&
	    !empty($_SESSION['comapy_manager_info']['role_id']) && intval($_SESSION['comapy_manager_info']['role_id'])>0 && 
	    !empty($_SESSION['comapy_manager_info']['company_id']) && intval($_SESSION['comapy_manager_info']['company_id'])>0 && 
	    !empty($_SESSION['position_id']) && intval($_SESSION['position_id'])>0)
	        if(intval($_SESSION['position_id'])===intval($b['id'])){
    	        $company=new Company_handler();
                $data=[];
                $data['title']=$b['t'];
                $data['description']=$b['d'];	
                if(!empty($b['i'])){
                    $data['icon']=$b['i'];
                }
                $data['qr_code']=$this->generate_qrcode(base_url('position/'.intval($_SESSION['position_id']))); 
                $data['position_type']=(!empty($b['pt'])?$b['pt']:0);	
                $data['price']=(!empty($b['p'])?$b['p']:null);
    	        if($this->Position_model->edit($data,['id'=>intval($_SESSION['position_id'])]) &&
                $this->Position_model->edit_company(['category_id'=>(!empty($b['c']) && intval($b['c'])>0?intval($b['c']):0)],['position_id'=>intval($_SESSION['position_id'])]))
    	            if(!empty($b['stayPage']) && intval($b['stayPage'])>0){
        	            die($this->load->view('company/position/one_manage',[
                    	    'position_id'=>intval($_SESSION['position_id']),
                    	    'category'=>$this->Category_model->select_where_status(),
                    	    'category_selected'=>$this->Position_model->select_company_where_position_id(intval($_SESSION['position_id'])),
                    	    'role_id'=>intval($_SESSION['comapy_manager_info']['role_id']),
                    	    'company_id'=>intval($_SESSION['comapy_manager_info']['company_id']),
                    	    'uploader'=>$this->load->view('includes/uploader',['url'=>'assets---svg---position','type'=>'image'],true),
                    	    'data'=>$this->Position_model->select_where_id(intval($_SESSION['position_id']))
                        ],true));
    	            }else{
    	                die('11111111111111111');
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
	    !empty($b['tel']) && !empty($b['des']) && 
	    !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
	    !empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && 
	    !empty($_SESSION['id']) && intval($_SESSION['id'])>0 && 
	    intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && 
	    !empty($_SESSION['comapy_manager_info']['company_user_id']) && intval($_SESSION['comapy_manager_info']['company_user_id'])>0 &&
	    !empty($_SESSION['comapy_manager_info']['role_id']) && intval($_SESSION['comapy_manager_info']['role_id'])>0 && 
	    !empty($_SESSION['comapy_manager_info']['company_id']) && intval($_SESSION['comapy_manager_info']['company_id'])>0 && 
	    !empty($_SESSION['position_id']) && intval($_SESSION['position_id'])>0 &&
	    $this->Position_model->add_tel(['position_id'=>intval($_SESSION['position_id']),'tel'=>$b['tel'],'description'=>$b['des']])){
	        die('111');
	    }
	    die('0');
    }
    public function disable_tel(){
        $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !empty($b['id']) && intval($b['id'])>0 && 
	    !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
	    !empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && 
	    !empty($_SESSION['id']) && intval($_SESSION['id'])>0 && 
	    intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && 
	    !empty($_SESSION['comapy_manager_info']['company_user_id']) && intval($_SESSION['comapy_manager_info']['company_user_id'])>0 &&
	    !empty($_SESSION['comapy_manager_info']['role_id']) && intval($_SESSION['comapy_manager_info']['role_id'])>0 && 
	    !empty($_SESSION['comapy_manager_info']['company_id']) && intval($_SESSION['comapy_manager_info']['company_id'])>0 && 
	    !empty($_SESSION['position_id']) && intval($_SESSION['position_id'])>0 &&
	    $this->Position_model->edit_tel(['status'=>0],['id'=>intval($b['id'])])){
	        die('ok');
	    }
	    die('0');
    }
    public function enable_tel(){
        $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !empty($b['id']) && intval($b['id'])>0 && 
	    !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
	    !empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && 
	    !empty($_SESSION['id']) && intval($_SESSION['id'])>0 && 
	    intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && 
	    !empty($_SESSION['comapy_manager_info']['company_user_id']) && intval($_SESSION['comapy_manager_info']['company_user_id'])>0 &&
	    !empty($_SESSION['comapy_manager_info']['role_id']) && intval($_SESSION['comapy_manager_info']['role_id'])>0 && 
	    !empty($_SESSION['comapy_manager_info']['company_id']) && intval($_SESSION['comapy_manager_info']['company_id'])>0 && 
	    !empty($_SESSION['position_id']) && intval($_SESSION['position_id'])>0 &&
	    $this->Position_model->edit_tel(['status'=>1],['id'=>intval($b['id'])])){
	        die('ok');
	    }
	    die('0');
    }
	public function position_company_manager(){
	    if(!empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
	    !empty($_SESSION['comapy_manager_info']['company_user_id']) && intval($_SESSION['comapy_manager_info']['company_user_id'])>0 &&
	    !empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && 
	    !empty($_SESSION['id']) && intval($_SESSION['id'])>0 && 
	    intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && 
	    !empty($_SESSION['comapy_manager_info']['role_id']) && intval($_SESSION['comapy_manager_info']['role_id'])>0 && 
	    !empty($_SESSION['comapy_manager_info']['company_id']) && intval($_SESSION['comapy_manager_info']['company_id'])>0){
            $category=new Category_handler();
        	$company=new Company_handler();
        	$role=new Role_handler();
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
                	'title'=>'مدیریت جایگاه ها'
                ],true).
            	$this->load->view('company/position/index',[
            	    'category'=>$this->Category_model->select_where_status(),
            	    'role_id'=>intval($_SESSION['comapy_manager_info']['role_id']),
            	    'company_id'=>intval($_SESSION['comapy_manager_info']['company_id']),
            	    'position_logo_uploader'=>$this->load->view('includes/uploader',['url'=>'assets---svg---position','type'=>'image'],true),
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
    public function management(){
        $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !empty($b['t']) && !empty($b['i']) && intval($b['i'])>0 && 
	    !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
	    !empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && 
	    !empty($_SESSION['id']) && intval($_SESSION['id'])>0 && 
	    intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id'])){
	        $_SESSION['position_id']=intval($b['i']);
	        if($b['t']=='d'){
	            die('1111111111');
	        }elseif($b['t']=='m'){
	            die('11111111111');
	        }
	    }
	    die('0');
    }
    public function one(){
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 &&
	    !empty($_SESSION['comapy_manager_info']) && is_array($_SESSION['comapy_manager_info']) && 
	    !empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 && 
	    !empty($_SESSION['id']) && intval($_SESSION['id'])>0 && 
	    intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && !empty($_SESSION['position_id']) && intval($_SESSION['position_id'])>0){
	        $category=new Category_handler();
        	$company=new Company_handler();
        	$role=new Role_handler();
        	$position=new Position_handler();
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
                	'title'=>'مشخصات جایگاه'
                ],true).
            	$this->load->view('company/position/one_manage',[
            	    'position_id'=>intval($_SESSION['position_id']),
            	    'category'=>$this->Category_model->select_where_status(),
            	    'category_selected'=>$this->Position_model->select_company_where_position_id(intval($_SESSION['position_id'])),
            	    'role_id'=>intval($_SESSION['comapy_manager_info']['role_id']),
            	    'company_id'=>intval($_SESSION['comapy_manager_info']['company_id']),
            	    'uploader'=>$this->load->view('includes/uploader',['url'=>'assets---svg---position','type'=>'image'],true),
            	    'data'=>$this->Position_model->select_where_id(intval($_SESSION['position_id']))
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
	    intval($_SESSION['comapy_manager_info']['user_id'])==intval($_SESSION['id']) && !empty($_SESSION['position_id']) && intval($_SESSION['position_id'])>0){
	        $category=new Category_handler();
	        $main=new Main_exploder();
        	$company=new Company_handler();
        	$role=new Role_handler();
        	$position=new Position_handler();
        	if(($this->id=intval($_SESSION['id']))!== false && ($a=$this->Users_model->select_where_id($this->id))!==false && !empty($a) && !empty($a['0']) &&($b=$this->Users_model->select_info_where_user_id(intval($this->id)))!==false && !empty($b) && !empty($b['0'])){
                if(($c=$this->Order_model->select_wallet_where_user_id(intval($this->id)))!==false && !empty($c) && !empty(end($c))) $_SESSION['my_wallet']=end($c);
                $_SESSION['my_company']=$role->show_my_company_valex(intval($this->id));    
                if(!isset($_SESSION['user_info']) || empty($_SESSION['user_info'])) $_SESSION['user_info']=['image'=>(!empty($b['0']['image'])?$b['0']['image']:''),'name'=>(!empty($b['0']['name'])?$b['0']['name']:''),'family'=>(!empty($b['0']['family'])?$b['0']['family']:''),'role'=>''];
                $has_auth_info_error=(!empty($b['0']['cart_mely_picture']) && !empty($b['0']['mely_code'])?false:true);
                $main->valex_type='manager';
            	$main->valex_lt=$_SESSION['ln'];
            	$main->valex_ln=$_SESSION['lt'];
                $main->valex_user_id=$this->id;
                $d=$company->company_product_list(intval($_SESSION['comapy_manager_info']['company_id']));
                $g=[];
                foreach($d as $e){
                    if(!empty($e) && intval($e)>0 && ($f=$main->valex_product_info(intval($e)))!==false && !empty($f) && !empty($f['info']))
                        $g[]=$f['info'];
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
                	'title'=>'تنظیمات جایگاه'
                ],true).
            	$this->load->view('company/position/setting',[
            	    'category'=>$this->Category_model->select_where_status(),
            	    'role_id'=>intval($_SESSION['comapy_manager_info']['role_id']),
            	    'company_id'=>intval($_SESSION['comapy_manager_info']['company_id']),
            	    'p_id'=>intval($_SESSION['position_id']),
            	    'uploader'=>$this->load->view('includes/uploader',['url'=>'assets---svg---position','type'=>'image'],true),
            	    'data'=>$main->valex_position_info(intval($_SESSION['position_id'])),
            	    'company_product'=>$g,
            	    'position_form_question'=>$this->Position_model->position_form_question_where_position_id_and_status(intval($_SESSION['position_id'])),
            	    'position_product'=>$position->position_product_list(intval($_SESSION['position_id'])),
            	    'reserve'=>$this->setting_reserve_handler($main)
                ],true).
            	$this->load->view('footer',[
            	    'add_map_id'=>intval($_SESSION['position_id']),
            	    'add_map'=>'position',
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
    public function side(){
        $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !empty($b['send']) && $b['send']=='ok'){
            die($this->show_side());
	    }
	    die('0');
    }
    public function disable(){
        $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])==1 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !empty($b['id']) && intval($b['id'])>0 && 
        $this->Position_model->edit(['status'=>0],['id'=>intval($b['id'])]))die('ok');
        die('0');
    }
    public function enable(){
        $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])==1 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !empty($b['id']) && intval($b['id'])>0 && 
	    $this->Position_model->edit(['status'=>1],['id'=>intval($b['id'])]))die('ok');
	    die('0');
    }
    public function disable_manager(){
        $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])==1 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !empty($b['id']) && intval($b['id'])>0 && 
        $this->Position_model->edit(['deleted_at'=>date("Y-m-d H:i:s")],['id'=>intval($b['id'])]))die('ok');
        die('0');
    }
    public function enable_manager(){
        $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])==1 && !is_null($a) && $this->Include_model->chapcha($a) && 
	    !empty($b['id']) && intval($b['id'])>0 && 
	    $this->Position_model->edit(['deleted_at'=>null],['id'=>intval($b['id'])]))die('ok');
	    die('0');
    }
}