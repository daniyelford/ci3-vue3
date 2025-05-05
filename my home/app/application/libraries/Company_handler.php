<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Company_handler{
    private $CI;
    public function __construct(){
		$this->CI =& get_instance();
		$this->CI->load->helper('url');
        $this->CI->load->library('session');
        $this->CI->config->item('base_url');
	}
	public function show_my_compny_task($c_u_id){
        $arr=['my_task'=>[],'other_task'=>[]];
        if(!empty($c_u_id) && intval($c_u_id)>0){
            if(($a=$this->CI->Company_model->select_task_user_where_request_company_user_id(intval($c_u_id)))!==false && !empty($a))
                foreach($a as $b){
                    if(!empty($b['id']) && intval($b['id'])>0 &&
                    !empty($b['company_task_id']) && intval($b['company_task_id'])>0 && 
                    !empty($b['from_company_user_id']) && intval($b['from_company_user_id'])>0 && 
                    ($re=$this->CI->Roles_model->select_company_user_where_id(intval($b['from_company_user_id'])))!==false && 
                    !empty($re) && !empty($re['0']) && !empty($re['0']['user_id']) && intval($re['0']['user_id'])>0 &&  
                    ($requerst=$this->CI->Users_model->select_info_where_user_id(intval($re['0']['user_id'])))!==false && 
                    !empty($requerst) && !empty($requerst['0']) &&
                    ($c=$this->CI->Company_model->select_task_where_id(intval($b['company_task_id'])))!==false && !empty($c) && !empty($c['0']))
                        $arr['other_task'][]=[
                            'from_company_user_id'=>intval($b['from_company_user_id']),
                            'from_user_id'=>intval($re['0']['user_id']),
                            'from_user_info'=>$requerst['0'],
                            'from_company_role_id'=>(!empty($re['0']['company_role_id']) && intval($re['0']['company_role_id'])>0?intval($re['0']['company_role_id']):0),
                            'from_company_role_parent_id'=>(!empty($re['0']['company_role_parent_id']) && intval($re['0']['company_role_parent_id'])>0?intval($re['0']['company_role_parent_id']):0),
                            'from_user_parent_info'=>(!empty($re['0']['company_role_parent_id']) && intval($re['0']['company_role_parent_id'])>0 &&
                                ($p=$this->CI->Roles_model->select_company_user_where_company_role_id_and_status(intval($re['0']['company_role_parent_id'])))!==false && 
                                !empty($p) && !empty($p['0']) && !empty($p['0']['user_id']) && intval($p['0']['user_id'])>0 &&
                                ($p_u=$this->CI->Users_model->select_info_where_user_id(intval($p['0']['user_id'])))!==false && !empty($p_u) && !empty($p_u['0'])?$p_u['0']
                            :[]),
                            'time'=>$b['time'],
                            'user_task_id'=>intval($b['id']),
                            'suggest_time'=>(!empty($b['suggest_time'])?$b['suggest_time']:''),
                            'run_time'=>(!empty($b['run_time'])?$b['run_time']:''),
                            'task_id'=>intval($b['company_task_id']),
                            'status'=>$b['status'],
                            'info'=>$c['0']
                        ];
                }
            if(($d=$this->CI->Company_model->select_task_user_where_from_company_user_id(intval($c_u_id)))!==false && !empty($d))
                foreach($d as $e){
                    if(!empty($e['id']) && intval($e['id'])>0 && 
                    !empty($e['company_task_id']) && intval($e['company_task_id'])>0 && 
                    !empty($e['request_company_user_id']) && intval($e['request_company_user_id'])>0 && 
                    ($re=$this->CI->Roles_model->select_company_user_where_id(intval($e['request_company_user_id'])))!==false && 
                    !empty($re) && !empty($re['0']) && !empty($re['0']['user_id']) && intval($re['0']['user_id'])>0 &&  
                    ($requerst=$this->CI->Users_model->select_info_where_user_id(intval($re['0']['user_id'])))!==false && 
                    !empty($requerst) && !empty($requerst['0']) &&
                    ($f=$this->CI->Company_model->select_task_where_id(intval($e['company_task_id'])))!==false &&!empty($f) && !empty($f['0']))
                        $arr['my_task'][]=[
                            'request_user_id'=>intval($re['0']['user_id']),
                            'request_user_info'=>$requerst['0'],
                            'request_user_company_id'=>intval($e['request_company_user_id']),
                            'request_company_role_id'=>(!empty($re['0']['company_role_id']) && intval($re['0']['company_role_id'])>0?intval($re['0']['company_role_id']):0),
                            'request_company_role_parent_id'=>(!empty($re['0']['company_role_parent_id']) && intval($re['0']['company_role_parent_id'])>0?intval($re['0']['company_role_parent_id']):0),
                            'request_user_parent_info'=>(!empty($re['0']['company_role_parent_id']) && intval($re['0']['company_role_parent_id'])>0 &&
                                ($p=$this->CI->Roles_model->select_company_user_where_company_role_id_and_status(intval($re['0']['company_role_parent_id'])))!==false && 
                                !empty($p) && !empty($p['0']) && !empty($p['0']['user_id']) && intval($p['0']['user_id'])>0 &&
                                ($p_u=$this->CI->Users_model->select_info_where_user_id(intval($p['0']['user_id'])))!==false && !empty($p_u) && !empty($p_u['0'])?$p_u['0']
                            :[]),
                            'time'=>$e['time'],
                            'user_task_id'=>intval($e['id']),
                            'suggest_time'=>(!empty($e['suggest_time'])?$e['suggest_time']:''),
                            'run_time'=>(!empty($e['run_time'])?$e['run_time']:''),
                            'task_id'=>intval($e['company_task_id']),
                            'task_user_id'=>intval($e['id']),
                            'status'=>$e['status'],
                            'info'=>$f['0']
                        ];
                }
	    }
        return $arr;
    }
    public function show_my_order_valex($arr){
        $ret=$suggest=[];
        if(!empty($arr) && is_array($arr))
            foreach ($arr as $a) {
                if(!empty($a['role_id']) && intval($a['role_id'])>0 && (intval($a['role_id'])==1||intval($a['role_id'])==8) && !empty($a['company_info']) && is_array($a['company_info']) &&  ($b=$a['company_info'])!==false && !empty($b['id']) && intval($b['id'])>0 &&  ($c=$this->CI->Order_model->select_package_order_where_company_id(intval($b['id'])))!==false && !empty($c))
                    foreach ($c as $d) {
                        if(!empty($d) && !empty($d['package']) && intval($d['package'])>0 && ($e=$this->CI->Order_model->select_package_where_id(intval($d['package'])))!==false && !empty($e) && !empty($e['0']))
                            $ret[]=['company_info'=>$b,'order_info'=>$d,'package'=>$e['0']];
                    }
            }
        return ['info'=>$ret];
    }
    public function show_compny_meet($c_id){
        $d=$id=[];
        if(!empty($c_id) && intval($c_id)>0 && ($a=$this->users($c_id))!==false && !empty($a) && is_array($a))
            foreach($a as $b){
                if(!empty($b) && !empty($b['company_user_id']) && intval($b['company_user_id'])>0 && !in_array(intval($b['company_user_id']),$id) && ($id[]=intval($b['company_user_id']))!==false &&
                ($c=$this->show_my_compny_meet(intval($b['company_user_id'])))!==false && !empty($c) && (!empty($c['other'])||!empty($c['my'])))
                    $d[]=['user'=>$b,'meet'=>$c];
            }
        return $d;
    }
    public function show_my_compny_meet($c_u_id){
	    if(!empty($c_u_id) && intval($c_u_id)>0){
	        $my_meet=$other_meet=[];
            if(($a=$this->CI->Company_model->select_meet_user_where_request_company_user_id(intval($c_u_id)))!==false && !empty($a))
                foreach($a as $b){
                    if(!empty($b['from_company_user_id']) && intval($b['from_company_user_id'])>0 && 
                    ($fr=$this->CI->Roles_model->select_company_user_where_id(intval($b['from_company_user_id'])))!==false &&
                    !empty($fr) && !empty($fr['0']) && !empty($fr['0']['user_id']) && intval($fr['0']['user_id'])>0 && 
                    ($from=$this->CI->Users_model->select_info_where_user_id(intval($fr['0']['user_id'])))!==false && 
                    !empty($from) && !empty($from['0']))
                        $other_meet[]=[
                            'meet_user_id'=>$b['id'],
                            'time'=>$b['time'],
                            'run_time'=>(!empty($b['run_time'])?$b['run_time']:''),
                            'from_company_user_id'=>intval($b['from_company_user_id']),
                            'from_user_id'=>intval($fr['0']['user_id']),
                            'from_company_role_id'=>(!empty($fr['0']['company_role_id']) && intval($fr['0']['company_role_id'])>0?intval($fr['0']['company_role_id']):0),
                            'from_company_role_parent_id'=>(!empty($fr['0']['company_role_parent_id']) && intval($fr['0']['company_role_parent_id'])>0?intval($fr['0']['company_role_parent_id']):0),
                            'from_user_info'=>$from['0'],
                            'from_user_parent_info'=>(!empty($fr['0']['company_role_parent_id']) && intval($fr['0']['company_role_parent_id'])>0 &&
                                ($p=$this->CI->Roles_model->select_company_user_where_company_role_id_and_status(intval($fr['0']['company_role_parent_id'])))!==false && 
                                !empty($p) && !empty($p['0']) && !empty($p['0']['user_id']) && intval($p['0']['user_id'])>0 &&
                                ($p_u=$this->CI->Users_model->select_info_where_user_id(intval($p['0']['user_id'])))!==false && !empty($p_u) && !empty($p_u['0'])?$p_u['0']
                            :[]),
                            'status'=>$b['status'],
                            'info'=>(!empty($b['company_meet_id']) && intval($b['company_meet_id'])>0 && 
                                ($c=$this->CI->Company_model->select_meet_where_id(intval($b['company_meet_id'])))!==false && 
                                !empty($c)&&!empty($c['0'])?$c['0']:[])
                            ];
                }
            if(($d=$this->CI->Company_model->select_meet_user_where_from_company_user_id(intval($c_u_id)))!==false && !empty($d))
                foreach($d as $e){
                    if(!empty($e['request_company_user_id']) && intval($e['request_company_user_id'])>0 && 
                    ($re=$this->CI->Roles_model->select_company_user_where_id(intval($e['request_company_user_id'])))!==false && 
                    !empty($re) && !empty($re['0']) && !empty($re['0']['user_id']) && intval($re['0']['user_id'])>0 &&  
                    ($requerst=$this->CI->Users_model->select_info_where_user_id(intval($re['0']['user_id'])))!==false && 
                    !empty($requerst) && !empty($requerst['0']))
                        $my_meet[]=[
                            'meet_user_id'=>$e['id'],
                            'time'=>$e['time'],
                            'run_time'=>(!empty($e['run_time'])?$e['run_time']:''),
                            'request_user_id'=>intval($re['0']['user_id']),
                            'request_user_company_id'=>intval($e['request_company_user_id']),
                            'request_company_role_id'=>(!empty($re['0']['company_role_id']) && intval($re['0']['company_role_id'])>0?intval($re['0']['company_role_id']):0),
                            'request_company_role_parent_id'=>(!empty($re['0']['company_role_parent_id']) && intval($re['0']['company_role_parent_id'])>0?intval($re['0']['company_role_parent_id']):0),
                            'request_user_info'=>$requerst['0'],
                            'request_user_parent_info'=>(!empty($re['0']['company_role_parent_id']) && intval($re['0']['company_role_parent_id'])>0 &&
                                ($p=$this->CI->Roles_model->select_company_user_where_company_role_id_and_status(intval($re['0']['company_role_parent_id'])))!==false && 
                                !empty($p) && !empty($p['0']) && !empty($p['0']['user_id']) && intval($p['0']['user_id'])>0 &&
                                ($p_u=$this->CI->Users_model->select_info_where_user_id(intval($p['0']['user_id'])))!==false && !empty($p_u) && !empty($p_u['0'])?$p_u['0']
                            :[]),
                            'status'=>$e['status'],
                            'info'=>(!empty($e['company_meet_id']) && intval($e['company_meet_id'])>0 && 
                                ($f=$this->CI->Company_model->select_meet_where_id(intval($e['company_meet_id'])))!==false &&
                                !empty($f)&&!empty($f['0'])?$f['0']:[])
                            ];
                }
	    }
    	return ['my'=>$my_meet,'other'=>$other_meet];
	}
	public function users($c_id){
	    $arr=[];
	    if(!empty($c_id) && intval($c_id)>0 && ($a=$this->CI->Roles_model->select_company_role_where_company_id(intval($c_id)))!==false && !empty($a))
	        foreach($a as $b){
	            if(!empty($b) && !empty($b['id']) && intval($b['id'])>0 && !empty($b['role_id']) && intval($b['role_id'])>0 &&
	            ($c=$this->CI->Roles_model->select_company_user_where_company_role_id(intval($b['id'])))!==false && !empty($c) &&
	            ($d=$this->CI->Roles_model->select_where_id_and_status(intval($b['role_id'])))!==false && !empty($d) && !empty($d['0']) && !empty($d['0']['title']))
	                foreach($c as $e){
	                    if(!empty($e) && !empty($e['id']) && intval($e['id'])>0 && is_null($e['deleted_at']) && !empty($e['user_id']) && intval($e['user_id'])>0 && ($f=$this->CI->Users_model->select_info_where_user_id(intval($e['user_id'])))!==false && !empty($f) && !empty($f['0']))
	                        $arr[]=[
	                            'status'=>(!empty($e['status']) && intval($e['status'])>0?intval($e['status']):0),
	                            'company_role_id'=>intval($b['id']),
	                            'user_info'=>$f['0'],
	                            'user_id'=>intval($e['user_id']),
	                            'role'=>$d['0']['title'],
	                            'company_user_id'=>intval($e['id'])
	                        ];
	                }
	        }
	    return $arr;
	}
	public function children_users($c_r_id){
	    $arr=[];
	    if(!empty($c_r_id) && intval($c_r_id)>0 && ($a=$this->CI->Roles_model->select_company_user_where_company_role_parent_id_and_status(intval($c_r_id)))!==false && !empty($a))
	        foreach($a as $b){
	            if(!empty($b) && !empty($b['id']) && intval($b['id'])>0 && 
	            !empty($b['user_id']) && intval($b['user_id'])>0 &&
	            !empty($b['company_role_id']) && intval($b['company_role_id'])>0 &&
	            ($c=$this->CI->Users_model->select_info_where_user_id(intval($b['user_id'])))!==false && !empty($c) && !empty($c['0']) &&
	            ($d=$this->CI->Roles_model->select_company_role_where_id(intval($b['company_role_id'])))!==false && !empty($d) && !empty($d['0']) &&
	            !empty($d['0']['role_id']) && intval($d['0']['role_id'])>0 && 
	            ($e=$this->CI->Roles_model->select_where_id_and_status(intval($d['0']['role_id'])))!==false && !empty($e) && !empty($e['0']) && !empty($e['0']['title']))
	                $arr[]=[
	                    'company_role_id'=>intval($c_r_id),
	                    'user_info'=>$c['0'],
	                    'user_id'=>intval($b['user_id']),
	                    'role'=>$e['0']['title'],
	                    'company_user_id'=>intval($b['id'])
	                ];
	        }
	    return $arr;
	}
	private function position_user_handler($id){
	    $arr=[];
	    if(!empty($id) && !empty($_SESSION['id']) && intval($_SESSION['id'])>0){
	        $data=$this->CI->Position_model->select_user_where_position_id($id);
            foreach($data as $a){
                $c=[];
                if(!empty($a) && !empty($a['id']) && intval($a['id'])>0 && !empty($a['user_id']) && intval($a['user_id'])>0 && 
                ($d=$this->CI->Users_model->select_info_where_user_id(intval($a['user_id'])))!==false && !empty($d) && !empty($d['0'])){
                    $c['info']=$a;
                    $c['user']=$d['0'];
                    $b=$this->CI->Position_model->select_order_where_position_user_id(intval($a['id']));
                    if(!empty($b) && !empty($b['0']))
                        $c['order']=$b['0'];
                }
                if(!empty($c))$arr[]=$c;
            }
	    }
        return $arr;
	}
	private function product_order_handler($id){
	    $arr=[];
	    if(!empty($id) && !empty($_SESSION['id']) && intval($_SESSION['id'])>0){
            $data=$this->CI->Position_model->select_order_where_product_id($id);
            foreach($data as $a){
                $c=[];
                if(!empty($a) && !empty($a['id']) && intval($a['id'])>0 && !empty($a['position_user_id']) && intval($a['position_user_id'])>0){
                    $c['order']=$a;
                    $b=$this->CI->Position_model->select_user_where_arr(['id'=>intval($a['position_user_id'])]);
                    if(!empty($b) && !empty($b['0']) && !empty($b['0']['user_id']) && intval($b['0']['user_id'])>0 && 
                    ($d=$this->CI->Users_model->select_info_where_user_id(intval($b['0']['user_id'])))!==false && !empty($d) && !empty($d['0'])){
                        $c['info']=$b['0'];
                        $c['user']=$d['0'];
                        if(!empty($b['0']['position_id']) && intval($b['0']['position_id'])>0 && 
                        ($e=$this->CI->Position_model->select_where_id(intval($b['0']['user_id'])))!==false && !empty($e) && !empty($e['0'])){
                            $c['position']=$e['0'];
                        }
                    }
                }
                if(!empty($c))$arr[]=$c;
            }
	    }
        return $arr;
	}
	public function user_company_action($company_id,$company_user_id){
        $main=new Main_exploder();
        $main->valex_type='manager';
	    if(!empty($company_id) && intval($company_id)>0 && 
	    !empty($company_user_id) && intval($company_user_id)>0){
	        $pos_id_array=$position_id_arr=$pro_id_array=$product_id_arr=[];
	        $c=$i=['pos'=>[],'pro'=>[]];
            if(($a=$this->CI->Company_model->select_user_product_access_where_company_user_id_and_status(intval($company_user_id)))!==false && 
            !empty($a) && is_array($a))
                foreach($a as $b){
                    if(!empty($b) && !empty($b['company_category_product']) && 
                    intval($b['company_category_product'])>0 && 
                    !empty($b['id']) && intval($b['id'])>0 &&
                    ($z=$this->CI->Company_model->select_category_product_where_id(intval($b['company_category_product'])))!==false && 
                    !empty($z) && !empty($z['0']) && ($z=$z['0'])!==false)
                        if(!empty($b['is_position']) && intval($b['is_position'])>0){
                            if(!empty($z["position_id"])&&intval($z["position_id"])>0 && !in_array(intval($z["position_id"]),$position_id_arr)){
                                $position_id_arr[]=intval($z["position_id"]);
                    	        $c['pos'][]=[
                    	            'company_category_product_position_id'=>intval($b['company_category_product']),
                        	        'position_id'=>intval($z["position_id"]),
                        	        'position_user'=>$this->position_user_handler(intval($z['position_id'])),
                        	        'position_info'=>$main->valex_position_info_manager(intval($z["position_id"])),
                        	        'access_id'=>intval($b['id']),
                        	    ];
                            }
                    	}else{
                    	    if(!empty($z["product_id"]) && intval($z["product_id"])>0 && !in_array(intval($z["product_id"]),$product_id_arr)){
                    	        $product_id_arr[]=intval($z["product_id"]);
                                $c['pro'][]=[
                            	    'company_category_product_position_id'=>intval($b['company_category_product']),
                            	    'product_id'=>intval($z["product_id"]),
                            	    'product_order'=>$this->product_order_handler(intval($z['product_id'])),
                            	    'product_info'=>$main->valex_product_info_manager(intval($z["product_id"])),
                            	    'access_id'=>intval($b['id'])
                            	];
                    	    }
                        }
                }
            $d=$this->CI->Company_model->select_category_product_where_company_id_and_status(intval($company_id));
            $e=$this->CI->Company_model->select_meet_user_where_from_company_user_id(intval($company_user_id));
            $f=$this->CI->Company_model->select_meet_user_where_request_company_user_id(intval($company_user_id));
            $g=$this->CI->Company_model->select_task_user_where_from_company_user_id(intval($company_user_id));
            $h=$this->CI->Company_model->select_task_user_where_request_company_user_id(intval($company_user_id));
            if(!empty($d))
                foreach($d as $j){
                    if(!empty($j) && !empty($j['id']) && intval($j['id'])>0)
                        if(!empty($j['position_id']) && intval($j['position_id'])>0 && !in_array(intval($j['position_id']),$pos_id_array) && ($pos_id_array[]=intval($j['position_id']))!==false)
                            $i['pos'][]=[
                                'position_info'=>$main->valex_position_info_manager(intval($j['position_id'])),
                                'position_id'=>intval($j['position_id']),
                                'position_user'=>$this->position_user_handler(intval($j['position_id'])),
                                'company_category_product_position_id'=>intval($j['id'])
                            ];
                        if(!empty($j['product_id']) && intval($j['product_id'])>0 && !in_array(intval($j['product_id']),$pro_id_array) && ($pro_id_array[]=intval($j['product_id']))!==false)
                            $i['pro'][]=[
                                'product_info'=>$main->valex_product_info_manager(intval($j['product_id'])),
                                'product_id'=>intval($j['product_id']),
                                'product_order'=>$this->product_order_handler(intval($j['product_id'])),
                                'company_category_product_position_id'=>intval($j['id'])
                            ];
                }
            return [
                'products'=>['access'=>$c['pro'],'all'=>$i['pro']],
                'positions'=>['access'=>$c['pos'],'all'=>$i['pos']],
            	'meets'=>['from_user'=>$e,'from_other'=>$f],
            	'tasks'=>['from_user'=>$g,'from_other'=>$h]
            ];
	    }
	    return [];
	}
	public function company_product_list($c_id){
        $arr=[];
	    if(!empty($c_id) && intval($c_id)>0 && ($a=$this->CI->Company_model->select_category_product_where_company_id(intval($c_id)))!==false && !empty($a))
    	    foreach($a as $b){
                if(!empty($b) && !empty($b['product_id']) && intval($b['product_id'])>0 && !in_array(intval($b['product_id']),$arr))
                    $arr[]=intval($b['product_id']);
            }
        return $arr;
	}
	public function company_position_list($c_id){
        $arr=[];
	    if(!empty($c_id) && intval($c_id)>0 && ($a=$this->CI->Company_model->select_category_product_where_company_id(intval($c_id)))!==false && !empty($a))
    	    foreach($a as $b){
                if(!empty($b) && !empty($b['position_id']) && intval($b['position_id'])>0 && !in_array(intval($b['position_id']),$arr))
                    $arr[]=intval($b['position_id']);
            }
        return $arr;
	}
}