<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Chat extends MY_Controller
{
// 	sendAjax({id:receveUserId,text:htmlTemplate},baseUrl('chat/chat/forward'),'')
    // private $client;
	public function __construct(){
		parent::__construct();
// 		$client = new SplObjectStorage();
	}
    public function visit($id){
        $_SESSION['visit']='';
        if(!empty($id) && intval($id)>0){
            if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0){
                $this->Users_model->add_chat_return_id(['user_sender_id'=>intval($_SESSION['id']),'user_reciver_id'=>$id,'text'=>'سلام من کارت ویزیت شما را دریافت کردم']);
                header('Location:'.base_url('chat?type=users&count='.$id));die();
            }else{
                $_SESSION['visit']=$id;
                echo $this->load->view('errors/500',['text'=>'ابتدا وارد حساب کاربری خود شوید یا یکی بسازید'],true);
            }
        }else{
            header('Location:'.base_url());
        }
        die();
    }
    
	private function generate_qrcode(){
	    if(!empty($_SESSION['id'])){
    	    if (!file_exists(FCPATH.'assets/qrcode/users/'.$_SESSION['id'].'.png')){
        	    $this->load->library('ciqrcode');
                $params['data'] = base_url('cart_visit/'.$_SESSION['id']);
                $params['level'] = 'H';
                $params['size'] = 10;
                $params['savename'] = FCPATH.'assets/qrcode/users/'.$_SESSION['id'].'.png';
                $this->ciqrcode->generate($params);
    	    }
    	    return base_url('assets/qrcode/users/'.$_SESSION['id'].'.png');
	    }
        return '';
    }
	
	public function new_massage(){
	    $a=$this->massages();
	    if(!empty($a) && !empty($a['data']))
	        echo json_encode($a['data']);
	    else
	        echo 0;
	    die();
	}	
	
	public function forward(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!is_null($a) && $this->Include_model->chapcha($a) && !is_null($b) && !empty($b['text']) && !empty($b['id']) && intval($b['id'])>0 && 
	    $this->Users_model->add_chat_return_id(['user_sender_id'=>$_SESSION['id'],'user_reciver_id'=>$b['id'],'text'=>$b['text']])) die('ok');
	    die('0');
	}
	
	public function check_string($str){
	    return str_replace(["/",'~','`','"',"'",':','#','@','!','|',';','?','<','>','.',',','&','*'],' * ',$str);
	}
	
	private function massages(){
	    $data=$position_id=$position=$product=$product_id=$user_id=$notification=[];
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0){
	        $a=$this->Users_model->all_my_chat(intval($_SESSION['id']));
	        if(!empty($a)){
	            foreach($a as $e){
	                if(!empty($e) && !empty($e['id']) && intval($e['id'])>0 && !empty($e['text']))
                    if(!empty($e['user_sender_id']) && intval($e['user_sender_id'])>0 && intval($e['user_sender_id']) === intval($_SESSION['id'])){
                        if(!empty($e['user_reciver_id']) && intval($e['user_reciver_id'])>0){
                            if(!in_array(intval($e['user_reciver_id']),$user_id)){
                                $user_id[]=intval($e['user_reciver_id']);
                                $f=$this->Users_model->select_info_where_user_id(intval($e['user_reciver_id']));
                                if(!empty($f) && !empty($f['0']))
                                    $data[intval($e['user_reciver_id'])]['user_info']=$f['0'];
                            }
                            $data[intval($e['user_reciver_id'])]['msg'][]=['id'=>intval($e['id']),'text'=>$e['text'],'send'=>true];
                        }elseif(empty($e['user_reciver_id'])||is_null($e['user_reciver_id'])){
                            $data['support'][]=['id'=>intval($e['id']),'text'=>$e['text'],'send'=>true];
                        }
                    }elseif(!empty($e['user_reciver_id']) && intval($e['user_reciver_id'])>0 && 
                    intval($e['user_reciver_id']) === intval($_SESSION['id'])){
                        if(!empty($e['user_sender_id']) && intval($e['user_sender_id'])>0){
                            if(!in_array(intval($e['user_sender_id']),$user_id)){
                                $user_id[]=intval($e['user_sender_id']);
                                $f=$this->Users_model->select_info_where_user_id(intval($e['user_sender_id']));
                                if(!empty($f) && !empty($f['0']))
                                    $data[intval($e['user_sender_id'])]['user_info']=$f['0'];
                            }
                            $data[intval($e['user_sender_id'])]['msg'][]=['id'=>intval($e['id']),'text'=>$e['text'],'send'=>false];
                        }elseif(empty($e['user_sender_id'])||is_null($e['user_sender_id'])){
                            $data['support'][]=['id'=>intval($e['id']),'text'=>$e['text'],'send'=>false];
                        }
                    }
                }
	            
	        }
            $g=$this->Position_model->select_chat_where_user_id(intval($_SESSION['id']));
            if(!empty($g))
                foreach($g as $h){
                    if(!empty($h) && !empty($h['position_id']) && intval($h['position_id'])>0 && !in_array(intval($h['position_id']),$position_id)){
                        $position_id[]=intval($h['position_id']);
                        $info=$this->Position_model->select_where_id(intval($h['position_id']));
                        $chat=$this->return_one_chat(intval($h['position_id']),'position');
                        if(!empty($info) && !empty($info['0']) && !empty($chat))
                            $position[]=['chat'=>$chat,'info'=>$info['0']];
                    }
                }
            $i=$this->Product_model->select_chat_where_user_id(intval($_SESSION['id']));
	        if(!empty($i))
	            foreach($i as $j){
	                if(!empty($j) && !empty($j['product_id']) && intval($j['product_id'])>0 && !in_array(intval($j['product_id']),$product_id)){
	                    $product_id[]=intval($j['product_id']);
	                    $info=$this->Product_model->select_product_where_id(intval($j['product_id']));
	                    $chat=$this->return_one_chat(intval($j['product_id']),'product');
	                    if(!empty($info) && !empty($info['0']) && !empty($chat)){
    	                    $product[]=['chat'=>$chat,'info'=>$info['0']];
	                    }
	                }
	            }
	        $access_chats=$this->show_access_chat($product_id,$position_id);
	        if(!empty($access_chats['position']))$position=array_merge($position,$access_chats['position']);
	        if(!empty($access_chats['product']))$product=array_merge($product,$access_chats['product']);
	        if(!empty($access_chats['not']))$notification=$access_chats['not'];
	        return ['product'=>$product,'position'=>$position,'data'=>$data,'noficication'=>$notification];
	    }
	    return [];
	}
	
	private function show_access_chat($product_id,$position_id){
	    $arr=['product'=>[],'position'=>[],'not'=>[]];
        $company=new Company_handler();
	    if(!empty($_SESSION['my_company']) && !empty($_SESSION['id']) && intval($_SESSION['id'])>0){
	        foreach($_SESSION['my_company'] as $a){
	            if(!empty($a) && is_array($a) && !empty($a['company_user_id']) && intval($a['company_user_id'])>0 && !empty($a['company_info']['id']) && intval($a['company_info']['id'])>0){
                    $ac=$company->user_company_action(intval($a['company_info']['id']),intval($a['company_user_id']));
                    if(!empty($ac)){
                        $arr['not']=array_merge($arr['not'],$this->task_handler($ac));
                        $arr['not']=array_merge($arr['not'],$this->meet_handler($ac));
                        $arr['product']=array_merge($arr['product'],$this->product_access_handler($ac,$product_id));
                        $arr['position']=array_merge($arr['position'],$this->position_access_handler($ac,$position_id));
                    }
	            }
	        }
	        $arr['not']=array_merge($arr['not'],$this->wallet_handler());
	    }
	    return $arr;
	}
	
	private function product_access_handler($ac,$product_id){
	    $arr=[];
	    if(!empty($ac) && !empty($ac['products']) && !empty($ac['products']['access']))
            foreach($ac['products']['access'] as $k){
        	    if(!empty($k) && !empty($k['product_id']) && intval($k['product_id'])>0 && !empty($k['product_info'])&& !in_array(intval($k['product_id']),$product_id)){
            	    $product_id[]=intval($k['product_id']);
            	    if(!empty($k['product_info']['chat'])){
            	        $a['chat']=$k['product_info']['chat'];
            	    }
            	    if(!empty($k['product_info']['info'])){
            	        $a['info']=$k['product_info']['info'];
            	    }
            	    if(!empty($k['product_order'])){
            	        $a['order']=$k['product_order'];
            	    } 
            	    $arr[]=$a;
        	    }
            }
	    return $arr;
	}
	
	private function position_access_handler($ac,$position_id){
	    $arr=[];
	    if(!empty($ac) && !empty($ac['positions']) && !empty($ac['positions']['access']) && !empty($_SESSION['id']) && intval($_SESSION['id'])>0)
            foreach($ac['positions']['access'] as $l){
        	    if(!empty($l) && !empty($l['position_id']) && intval($l['position_id'])>0 && !in_array(intval($l['position_id']),$position_id) && 
        	    !empty($l['position_info'])){
        	        $a=[];
        	        $position_id[]=intval($l['position_id']);
        	        $a['info']=$l['position_info']['info'];
        	        if(!empty($l['position_info']['chat']) && !empty($l['position_info']['info'])){
        	            $a['chat']=$l['position_info']['chat'];
        	        }
        	        if(!empty($l['position_user'])){
        	            $a['order']=$l['position_user'];
        	        }
        	        $arr[]=$a;
        	    }
            }
	    return $arr;
	}
	
	private function meet_handler($ac){
	    $arr=[];
	    if(!empty($ac) && !empty($ac['meets'])){
            if(!empty($ac['meets']['from_user']))
                foreach($ac['meets']['from_user'] as $b){
                    if(!empty($b) && !empty($b['company_meet_id'])){
                        $c=$this->Company_model->select_meet_where_id($b['company_meet_id']);
                        if(!empty($c) && !empty($c['0'])){
                            $d=$this->Company_model->select_user_where_id($b['request_company_user_id']);
            	            if(!empty($d) && !empty($d['0']) && !empty($d['0']['user_id']) && intval($d['0']['user_id'])>0 && intval($d['0']['user_id'])===intval($_SESSION['id'])){
            	                $d=$this->Company_model->select_user_where_id($b['from_company_user_id']);
            	            }
        	                if(!empty($d) && !empty($d['0']) && !empty($d['0']['user_id']) && intval($d['0']['user_id'])>0){
                                $e=$this->Users_model->select_info_where_user_id(intval($d['0']['user_id']));
                                if(!empty($e) && !empty($e['0'])) $arr[]=['req_type'=>'meet','info'=>$c['0'],'user'=>$e['0'],'type'=>'u'];
        	                }
                        }
                    }
                }
            if(!empty($ac['meets']['from_other']))
                foreach($ac['meets']['from_other'] as $b){
                    if(!empty($b) && !empty($b['company_meet_id'])){
                        $c=$this->Company_model->select_meet_where_id($b['company_meet_id']);
                        if(!empty($c) && !empty($c['0'])){
            	            $d=$this->Company_model->select_user_where_id($b['from_company_user_id']);
            	            if(!empty($d) && !empty($d['0']) && !empty($d['0']['user_id']) && intval($d['0']['user_id'])>0 && intval($d['0']['user_id'])===intval($_SESSION['id'])){
                                $d=$this->Company_model->select_user_where_id($b['request_company_user_id']);
            	            }
        	                if(!empty($d) && !empty($d['0']) && !empty($d['0']['user_id']) && intval($d['0']['user_id'])>0){
                                $e=$this->Users_model->select_info_where_user_id(intval($d['0']['user_id']));
                                if(!empty($e) && !empty($e['0'])) $arr[]=['req_type'=>'meet','info'=>$c['0'],'user'=>$e['0'],'type'=>'o'];
        	                }
                        }
                    }
                }
    	}
    	return $arr;
	}
	
	private function task_handler($ac){
	    $arr=[];
	    if(!empty($ac) && !empty($ac['tasks'])){
	        if(!empty($ac['tasks']['from_user']))
                foreach($ac['tasks']['from_user'] as $b){
                    if(!empty($b) && !empty($b['company_task_id'])){
                        $c=$this->Company_model->select_task_where_id($b['company_task_id']);
        	            if(!empty($c) && !empty($c['0'])){
            	            $d=$this->Company_model->select_user_where_id($b['request_company_user_id']);
            	            if(!empty($d) && !empty($d['0']) && !empty($d['0']['user_id']) && intval($d['0']['user_id'])>0 && intval($d['0']['user_id'])===intval($_SESSION['id'])){
            	                $d=$this->Company_model->select_user_where_id($b['from_company_user_id']);
            	            }
        	                if(!empty($d) && !empty($d['0']) && !empty($d['0']['user_id']) && intval($d['0']['user_id'])>0){
                                $e=$this->Users_model->select_info_where_user_id(intval($d['0']['user_id']));
                                if(!empty($e) && !empty($e['0'])) $arr[]=['req_type'=>'task','info'=>$c['0'],'user'=>$e['0'],'type'=>'u'];
        	                }
        	            }
                    }
                }
            if(!empty($ac['tasks']['from_other']))
                foreach($ac['tasks']['from_other'] as $b){
                    if(!empty($b) && !empty($b['company_task_id'])){
                        $c=$this->Company_model->select_task_where_id($b['company_task_id']);
        	            if(!empty($c) && !empty($c['0'])){
            	            $d=$this->Company_model->select_user_where_id($b['from_company_user_id']);
            	            if(!empty($d) && !empty($d['0']) && !empty($d['0']['user_id']) && intval($d['0']['user_id'])>0 && intval($d['0']['user_id'])===intval($_SESSION['id'])){
            	                $d=$this->Company_model->select_user_where_id($b['request_company_user_id']);
            	            }
        	                if(!empty($d) && !empty($d['0']) && !empty($d['0']['user_id']) && intval($d['0']['user_id'])>0){
                                $e=$this->Users_model->select_info_where_user_id(intval($d['0']['user_id']));
                                if(!empty($e) && !empty($e['0'])) $arr[]=['req_type'=>'task','info'=>$c['0'],'user'=>$e['0'],'type'=>'o'];
        	                }
        	            }
                    }
                }
	    }
	    return $arr;
	}
	
	private function wallet_handler(){
	    $detailes=$add_value=[];
	    if(($a=$this->Users_model->select_wallet_where_user_id(intval($_SESSION['id'])))!==false && !empty($a)){
	        foreach($a as $b){
                $l=[];
	            if(!empty($b) && !empty($b['id']) && intval($b['id'])>0){
	                if(($c=$this->Order_model->select_wallet_where_wallet_id(intval($b['id'])))!==false && !empty($c) && !empty($c['0'])){
                        $j=(!empty($c['0']['payment_id']) && intval($c['0']['payment_id'])>0 && ($e=$this->Order_model->select_payment_where_id($c['0']['payment_id']))!==false && !empty($e) && !empty($e['0'])?$e['0']:[]);
                        if(!empty($j)){
                            $l=[
                                'user_id'=>intval($_SESSION['id']),
                                'pay_value'=>(!empty($j['pay_value'])?$j['pay_value']:''), 
                                'factor_api_token'=>(!empty($j['factor_api_token'])?$j['factor_api_token']:''), 
                                'user_id_buier'=>(!empty($j['user_id_buier'])&&intval($j['user_id_buier'])>0&&($m=$this->Users_model->select_info_where_user_id(intval($j['user_id_buier'])))!==false&&!empty($m)&&!empty($m['0'])?['id'=>intval($j['user_id_buier']),'info'=>$m['0']]:[]),
                                'user_id_seller'=>(!empty($j['user_id_seller'])&&intval($j['user_id_seller'])>0&&($n=$this->Users_model->select_info_where_user_id(intval($j['user_id_seller'])))!==false&&!empty($n)&&!empty($n['0'])?['id'=>intval($j['user_id_seller']),'info'=>$n['0']]:[])
                            ];
                        }
                        $detailes[]=[
    	                    'req_type'=>'wallet',
    	                    'type'=>'p',
                            'info'=>$b,
                            'detailes'=>[
        	                    'type'=>(!empty($c['0']['self_wallet_action']) && intval($c['0']['self_wallet_action'])>0?1:0),
                                'cart_info'=>(!empty($c['0']['cart_id']) && intval($c['0']['cart_id'])>0 && ($d=$this->Users_model->select_cart_where_id(intval($c['0']['cart_id'])))!==false && !empty($d) && !empty($d['0'])?$d['0']:[]),
                                'action'=>(!empty($c['0']['cart_action_status']) && intval($c['0']['cart_action_status'])>0?1:0),
                                'payment'=>$l,
                                'product'=>(!empty($c['0']['position_product_order']) && intval($c['0']['position_product_order'])>0 && ($f=$this->Position_model->select_order_where_id(intval($c['0']['position_product_order'])))!==false && !empty($f) &&!empty($f['0']) && !empty($f['0']['product_id']) && intval($f['0']['product_id'])>0 && ($g=$this->Product_model->select_product_where_id(intval($f['0']['product_id'])))!==false && !empty($g) && !empty($g['0'])?$g['0']:[]),
                                'package'=>(!empty($c['0']['package_company_order']) && intval($c['0']['package_company_order'])>0 && ($h=$this->Order_model->select_package_order_where_id(intval($c['0']['package_company_order'])))!==false && !empty($h) && !empty($h['0']) && !empty($h['0']['package']) && intval($h['0']['package'])>0 && ($i=$this->Order_model->select_package_where_id(intval($h['0']['package'])))!==false && !empty($i) && !empty($i['0'])?$i['0']:[]),
                                'position'=>(!empty($c['0']['position_user_id']) && intval($c['0']['position_user_id'])>0 && ($j=$this->Position_model->select_user_where_arr(['id'=>intval($c['0']['position_user_id'])]))!==false && !empty($j) && !empty($j['0']) && !empty($j['0']['position_id']) && intval($j['0']['position_id'])>0 && ($k=$this->Position_model->select_where_id(intval($j['0']['position_id'])))!==false && !empty($k) && !empty($k['0'])?$k['0']:[]),
                            ]
                        ];
	                }elseif(($c=$this->Order_model->select_wallet_where_seller_wallet_id(intval($b['id'])))!==false && !empty($c) && !empty($c['0'])){
                        $j=(!empty($c['0']['payment_id']) && intval($c['0']['payment_id'])>0 && ($e=$this->Order_model->select_payment_where_id($c['0']['payment_id']))!==false && !empty($e) && !empty($e['0'])?$e['0']:[]);
                        if(!empty($j)){
                            $l=[
                                'user_id'=>intval($_SESSION['id']),
                                'pay_value'=>(!empty($j['pay_value'])?$j['pay_value']:''), 
                                'factor_api_token'=>(!empty($j['factor_api_token'])?$j['factor_api_token']:''), 
                                'user_id_buier'=>(!empty($j['user_id_buier'])&&intval($j['user_id_buier'])>0&&($m=$this->Users_model->select_info_where_user_id(intval($j['user_id_buier'])))!==false&&!empty($m)&&!empty($m['0'])?['id'=>intval($j['user_id_buier']),'info'=>$m['0']]:[]),
                                'user_id_seller'=>(!empty($j['user_id_seller'])&&intval($j['user_id_seller'])>0&&($n=$this->Users_model->select_info_where_user_id(intval($j['user_id_seller'])))!==false&&!empty($n)&&!empty($n['0'])?['id'=>intval($j['user_id_seller']),'info'=>$n['0']]:[])
                            ];
                        }
                        $detailes[]=[
    	                    'req_type'=>'wallet',
    	                    'type'=>'p',
                            'info'=>$b,
                            'detailes'=>[
        	                    'type'=>(!empty($c['0']['self_wallet_action']) && intval($c['0']['self_wallet_action'])>0?1:0),
                                'cart_info'=>(!empty($c['0']['cart_id']) && intval($c['0']['cart_id'])>0 && ($d=$this->Users_model->select_cart_where_id(intval($c['0']['cart_id'])))!==false && !empty($d) && !empty($d['0'])?$d['0']:[]),
                                'action'=>(!empty($c['0']['cart_action_status']) && intval($c['0']['cart_action_status'])>0?1:0),
                                'payment'=>$l,
                                'product'=>(!empty($c['0']['position_product_order']) && intval($c['0']['position_product_order'])>0 && ($f=$this->Position_model->select_order_where_id(intval($c['0']['position_product_order'])))!==false && !empty($f) &&!empty($f['0']) && !empty($f['0']['product_id']) && intval($f['0']['product_id'])>0 && ($g=$this->Product_model->select_product_where_id(intval($f['0']['product_id'])))!==false && !empty($g) && !empty($g['0'])?$g['0']:[]),
                                'package'=>(!empty($c['0']['package_company_order']) && intval($c['0']['package_company_order'])>0 && ($h=$this->Order_model->select_package_order_where_id(intval($c['0']['package_company_order'])))!==false && !empty($h) && !empty($h['0']) && !empty($h['0']['package']) && intval($h['0']['package'])>0 && ($i=$this->Order_model->select_package_where_id(intval($h['0']['package'])))!==false && !empty($i) && !empty($i['0'])?$i['0']:[]),
                                'position'=>(!empty($c['0']['position_user_id']) && intval($c['0']['position_user_id'])>0 && ($j=$this->Position_model->select_user_where_arr(['id'=>intval($c['0']['position_user_id'])]))!==false && !empty($j) && !empty($j['0']) && !empty($j['0']['position_id']) && intval($j['0']['position_id'])>0 && ($k=$this->Position_model->select_where_id(intval($j['0']['position_id'])))!==false && !empty($k) && !empty($k['0'])?$k['0']:[]),
                            ]
                        ];
	                }
	            }
	        }
	    }
	    return $detailes;
	}
	
	private function return_one_chat($id,$type){
        $ret='';
	    if(!empty($id) && intval($id)>0 && !empty($type) && is_string($type)){
    	    $main=new Main_exploder();
    	    $main->valex_user_id=(!empty($_SESSION['id']) && intval($_SESSION['id'])>0?intval($_SESSION['id']):0);
    	    $main->date=new JDF();
	        if($type=='position'){
	            $a=$this->Position_model->select_where_id(intval($id));
	            if(!empty($a) && !empty($a['0'])){
	                $ret=$main->valex_position_chat(intval($id),$a['0']);
	            }
	        }elseif($type=='product'){
	            $a=$this->Product_model->select_product_where_id(intval($id));
	            if(!empty($a) && !empty($a['0'])){
	                $ret=$main->valex_product_chat(intval($id),$a['0']);
	            }
	        }
	    }
	    return $ret;
	}	

	private function show_one_chat($id,$type){
        $ret='';
	    if(!empty($id) && intval($id)>0 && !empty($type) && is_string($type)){
    	    $main=new Main_exploder();
    	    $main->valex_user_id=(!empty($_SESSION['id']) && intval($_SESSION['id'])>0?intval($_SESSION['id']):0);
    	    $main->date=new JDF();
	        if($type=='position'){
	            $a=$this->Position_model->select_where_id(intval($id));
	            if(!empty($a) && !empty($a['0'])){
	                $ret=$main->valex_position_chat(intval($id),$a['0']);
	            }
	        }elseif($type=='product'){
	            $a=$this->Product_model->select_product_where_id(intval($id));
	            if(!empty($a) && !empty($a['0'])){
	                $ret=$main->valex_product_chat(intval($id),$a['0']);
	            }
	        }
	    }
	    echo $ret;
	}
	
	public function manager(){
	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0 &&
        ($id=intval($_SESSION['id']))!== false && ($a=$this->Users_model->select_where_id($id))!==false && !empty($a) && !empty($a['0']) && ($b=$this->Users_model->select_info_where_user_id(intval($id)))!==false && !empty($b) && !empty($b['0'])){
    	    $category=new Category_handler();
            $has_auth_info_error=(!empty($b['0']['cart_mely_picture']) && !empty($b['0']['mely_code'])?false:true);
            $a=$this->massages();
            $_SESSION['chat_page_array']=json_encode($a);
    	    echo $this->load->view('header',[
                'has_auth_info_error'=>$has_auth_info_error,
    		    'category'=>$category->valex_show(),
    		    'lang'=>'',
    		    'id'=>intval($_SESSION['id']),
    			'user_info'=>(!empty($_SESSION['user_info'])?$_SESSION['user_info']:[]),
    			'title'=>'پیام ها',
    			'icon'=>'',
    			'chat'=>true
    		],true).
            $this->load->view('users/dashbord/chat',['qr'=>$this->generate_qrcode(),'data'=>$a],true).
            $this->load->view('footer',[
        		'my_company'=>(!empty($_SESSION['my_company'])?$_SESSION['my_company']:[]),
                'lang'=>'fa',
        		'change_lang'=>'true',
        		'id'=>intval($_SESSION['id']),
            ],true);
	    }else{
	        header('Location:'.base_url());
	    }
	}
	
	public function add(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!is_null($a) && $this->Include_model->chapcha($a) && 
	    !is_null($b) && !empty($b['type']) && !empty($b['pId']) && intval($b['pId'])>0 && 
	    !empty($b['uId']) && intval($b['uId'])>0 && !empty($b['text']) && is_string($b['text']) &&
	    ($b['text']=$this->check_string($b['text']))!==false &&
	    ($a=$this->Users_model->select_info_where_user_id(intval($b['uId'])))!==false && !empty($a) && !empty($a['0'])){
	        $text='شما یک پیام جدید از کسب و کار خانه ی من توسط';
            $text.=(!empty($a['0']['name'])?$a['0']['name']:'').' '.(!empty($a['0']['family'])?$a['0']['family']:'');
            $text.=' دارید برای مشاهده به ادرس  ';
	        if($b['type']=='product'){
	            if($this->Product_model->add_chat(['product_id'=>intval($b['pId']),'user_id'=>intval($b["uId"]),'text'=>$b['text'],'parent_id'=>(!empty($b['parentId']) && intval($b['parentId'])>0?intval($b['parentId']):0)])){
	                $i=[];
	                $text.='https://www.my-home.ir/chat?type=product&count='.intval($b['pId']).'#chatmodelproduct'.intval($b['pId']).' بروید';
	                $c=$this->Company_model->select_category_product_where_product_id(intval($b['pId']));
	                if(!empty($c)){
	                    foreach($c as $d){
	                       if(!empty($d) && !empty($d['id']) && intval($d['id'])>0){
	                           $e=$this->Company_model->select_user_product_access_where_company_category_product_and_status($d['id']);
	                           if(!empty($e)){
	                               foreach($e as $f){
	                                   if(!empty($f) && !empty($f['company_user_id']) && intval($f['company_user_id'])>0){
        	                               $g=$this->Company_model->select_user_where_id(intval($f['company_user_id']));
        	                               if(!empty($g) && !empty($g['0']) && !empty($g['0']['user_id']) && intval($g['0']['user_id'])>0 && !in_array(intval($g['0']['user_id']),$i)){
        	                                    $i[]=intval($g['0']['user_id']);
        	                                    $h=$this->Users_model->select_info_where_user_id(intval($g['0']['user_id']));
        	                                    if(!empty($h) && !empty($h['0'])){
        	                                        $q=$this->Include_model->send_massage_to_user([
                                                        'type'=>'product','text'=>$text
                                                    ],
                                                    (!empty($h['0']['phone'])?$h['0']['phone']:''),(!empty($h['0']['gmail'])?$h['0']['gmail']:''),'includes/email_includes/buy_pak',
        	                                        'پیام جدید', 
                                                    $text);
        	                                    }
        	                                }
	                                    }
	                                }
	                            }
	                        }
	                    }
	                }
	                return $this->show_one_chat(intval($b['pId']),'product');
	            }
	        }elseif($b['type']=='position'){
	            if($this->Position_model->add_chat(['position_id'=>intval($b['pId']),'user_id'=>intval($b["uId"]),'text'=>$b['text'],'parent_id'=>(!empty($b['parentId']) && intval($b['parentId'])>0?intval($b['parentId']):0)])){
	                $i=[];
	                $text.='https://www.my-home.ir/chat?type=position&count='.intval($b['pId']).'#chatmodelposition'.intval($b['pId']).' بروید';
	                $c=$this->Company_model->select_category_product_where_position_id(intval($b['pId']));
                    if(!empty($c)){
	                    foreach($c as $d){
	                       if(!empty($d) && !empty($d['id']) && intval($d['id'])>0){
	                           $e=$this->Company_model->select_user_product_access_where_company_category_product_and_status($d['id']);
	                           if(!empty($e)){
	                               foreach($e as $f){
	                                   if(!empty($f) && !empty($f['company_user_id']) && intval($f['company_user_id'])>0){
        	                               $g=$this->Company_model->select_user_where_id(intval($f['company_user_id']));
        	                               if(!empty($g) && !empty($g['0']) && !empty($g['0']['user_id']) && intval($g['0']['user_id'])>0 && !in_array(intval($g['0']['user_id']),$i)){
        	                                    $i[]=intval($g['0']['user_id']);
        	                                    $h=$this->Users_model->select_info_where_user_id(intval($g['0']['user_id']));
        	                                    if(!empty($h) && !empty($h['0'])){
        	                                        $q=$this->Include_model->send_massage_to_user([
                                                        'type'=>'position','text'=>$text
                                                    ],
                                                    (!empty($h['0']['phone'])?$h['0']['phone']:''),(!empty($h['0']['gmail'])?$h['0']['gmail']:''),'includes/email_includes/buy_pak',
        	                                        'پیام جدید', 
                                                    $text);
        	                                    }
        	                                }
	                                    }
	                                }
	                            }
	                        }
	                    }
	                }
	                return $this->show_one_chat(intval($b['pId']),'position');
	            }
	        }
	    }
	    die('0');
	}
	
	public function remove(){
	    $a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_array($_POST['data'])?$_POST['data']:null);
	    if(!is_null($a) && $this->Include_model->chapcha($a) && 
	    !is_null($b) && !empty($b["t"]) && !empty($b['i']) && intval($b['i'])>0){
	        if($b['t']=='product'){
                $a=$this->Product_model->select_chat_where_id(intval($b['i']));
	            if(!empty($a) && !empty($a['0'])){
	                $p=(!empty($a['0']['parent_id']) && intval($a['0']['parent_id'])>0?intval($a['0']['parent_id']):0);
    	            $c=$this->Product_model->select_chat_where_parent_id(intval($b['i']));
    	            if(!empty($c)){
    	                foreach($c as $d){
    	                    if(!empty($d) && !empty($d['id']) && intval($d['id'])>0)
    	                        if(!$this->Product_model->edit_chat(['parent_id'=>intval($p)],['id'=>intval($d['id'])]))die('100');
    	                }
    	            }
                    if($this->Product_model->remove_chat(intval($b['i'])))die('11');
	            }
	        }elseif($b['t']=='position'){
	            $a=$this->Position_model->select_chat_where_id(intval($b['i']));
	            if(!empty($a) && !empty($a['0'])){
	                $p=(!empty($a['0']['parent_id']) && intval($a['0']['parent_id'])>0?intval($a['0']['parent_id']):0);
    	            $c=$this->Position_model->select_chat_where_parent_id(intval($b['i']));
    	            if(!empty($c)){
    	                foreach($c as $d){
    	                    if(!empty($d) && !empty($d['id']) && intval($d['id'])>0)
    	                        if(!$this->Position_model->edit_chat(['parent_id'=>intval($p)],['id'=>intval($d['id'])]))die('100');
    	                }
    	            }
                    if($this->Position_model->remove_chat(intval($b['i'])))die('11');
	            }
	        }
	    }
	    die('0');
	}
	
	public function remove_massage(){
	    if(!empty($_POST['i']) && intval($_POST['i'])>0 && $this->Users_model->remove_chat_where_id(intval($_POST['i'])))die('1');
	    die('0');
	}
	
	public function add_massage(){
	    if(!empty($_POST['t'])){
	        $_POST['t']=$this->check_string($_POST['t']);
    	    if(!empty($_SESSION['id']) && intval($_SESSION['id'])>0)
        	    if(!empty($_POST['i']) && intval($_POST['i'])>0){
        	        if(!empty($_POST['ty']) && $_POST['ty']=='su'){
                        $text1='پاسخ شما توسط پشتیبان داده شده است برای مشاهده به ادرس
                        https://www.my-home.ir/chat?type=support
                        بروید';
                    	$s=$this->Users_model->select_info_where_user_id(intval($_POST['i']));
                        if(!empty($s) && !empty($s['0'])){
                            $t=$this->Include_model->send_massage_to_user([],(!empty($s['0']['phone'])?$s['0']['phone']:''),(!empty($s['0']['gmail'])?$s['0']['gmail']:''),
                            '',
                            'پاسخ پشتیبانی',
                            $text1);
                        }
                        die($this->Users_model->add_chat_return_id(['user_sender_id'=>null,'user_reciver_id'=>intval($_POST['i']),'text'=>$_POST['t']]));
                    }else{
                        die($this->Users_model->add_chat_return_id(['user_sender_id'=>intval($_SESSION['id']),'user_reciver_id'=>intval($_POST['i']),'text'=>$_POST['t']]));
                    }
                }elseif(!empty($_POST['ty']) && $_POST['ty']=='s'){
                        $text1='یه درخواست پشتیبانی جدید به صندوق شما اضافه شد به ادرس
                        https://www.my-home.ir/all_support_manager
                        بروید';
                		$s=$this->Users_model->select_info_where_user_id(1);
                        if(!empty($s) && !empty($s['0'])){
                            $t=$this->Include_model->send_massage_to_user([],(!empty($s['0']['phone'])?$s['0']['phone']:''),(!empty($s['0']['gmail'])?$s['0']['gmail']:''),
                            '',
                            'درخواست پشتیبانی',
                            $text1);
                        }
                    die($this->Users_model->add_chat_return_id(['user_sender_id'=>intval($_SESSION['id']),'user_reciver_id'=>null,'text'=>$_POST['t']]));
                }
            else
        	    die('no');
	    }
	    die('0');
	}
	
}