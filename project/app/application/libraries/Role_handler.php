<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Role_handler{
	private $CI;
	private $id=0;
	private $company_role_id=0;
	private $company_user_id=0;
	private $company_id=0;
	private $role_pager=[];
	private $dashbord_page=[];
	public function __construct(){
		$this->CI =& get_instance();
		$this->CI->load->helper('url');
        $this->CI->load->library('session');
        $this->CI->config->item('base_url');
	}
	public $its_me=false;
	public function show_my_company_valex($id){
        $return=[];
        if(!empty($id) && intval($id)>0 && 
        ($a=$this->CI->Roles_model->select_company_user_where_user_id(intval($id)))!==false && 
        ($this->id=intval($id)) !== false){
            if(!empty($a))
    			foreach($a as $b){
    				if(!empty($b) && is_array($b) && !empty($b['id']) && intval($b['id'])>0 &&
    				!empty($b['company_role_id']) && intval($b['company_role_id'])>0 && 
                    ($c=$this->CI->Roles_model->select_company_role_where_id(intval($b['company_role_id'])))!==false && 
                    !empty($c) && !empty($c['0']) && 
                    !empty($c['0']['role_id']) && intval($c['0']['role_id'])>0 && 
                    !empty($c['0']['company_id']) && intval($c['0']['company_id'])>0 && 
                    ($d=$this->CI->Company_model->select_company_where_id(intval($c['0']['company_id'])))!==false &&
                    !empty($d) && !empty($d['0'])){
                        $f=$this->CI->Order_model->select_package_order_where_company_id(intval($c['0']['company_id']));
                        if(!empty($f) && is_array($f)){
                            $test=true;
                            foreach($f as $g){
                                if(!empty($g['end_time']) && strtotime($g['end_time'])>time()) $test=false;
                            }
                            if($test){
                                $this->CI->Company_model->edit_weher_id(['type'=>0],intval($c['0']['company_id']));
                                $d=$this->CI->Company_model->select_company_where_id(intval($c['0']['company_id']));
                            }
                        }
                        if(!empty($d) && !empty($d['0']) && ($e=$this->CI->Roles_model->select_where_id_and_status(intval($c['0']['role_id'])))!==false)
            				$return[]=[
            				    'company_user_id'=>intval($b['id']),
                                'company_role_id'=>intval($b['company_role_id']),
                                'role_id'=>intval($c['0']['role_id']),
                                'role_info'=>(!empty($e) && !empty($e['0']) && !empty($e['0']['title'])?$e['0']['title']:''),
                                'role_status'=>(!empty($c['0']['status']) && intval($c['0']['status'])>0?1:0),
                                'company_info'=>$d['0'],
                                'company_role_parent_id'=>intval($b['company_role_parent_id']),
                                'status'=>(!empty($b['status']) && intval($b['status'])>0?intval($b['status']):0)
                            ];
                    }
                }
            }
    	return $return;
    }
}
// 	public function show($str,$id){
// 		$return=[];
// 		if(!empty($str) && is_string($str) && !empty($id) && intval($id)>0 && 
// 		($a=$this->CI->Roles_model->select_company_user_where_user_id_and_status(intval($id)))!==false && 
// 		($this->id=intval($id)) !== false)
// 		    if(!empty($a)){
//     			foreach($a as $b){
//     				if(!empty($b['company_role_id']) && intval($b['company_role_id'])>0 && ($c=$this->CI->Roles_model->select_company_role_where_id(intval($b['company_role_id'])))!==false 
//     				&& !empty($c) && !empty($c['0']) && !empty($c['0']['role_id']) && intval($c['0']['role_id'])>0 && !empty($c['0']['company_id']) && intval($c['0']['company_id'])>0) 
//     				$return[$str][intval($c['0']['company_id'])]=$this->role_finder(intval($b['company_role_id']),intval($b['id']),intval($c['0']['role_id']),intval($c['0']['company_id']),$str);
//     			}
//     		}else{
//     		    $return[$str]['0']=$this->role_finder(0,0,0,0,$str);
//     		}
// 		return $return;
// 	}
// 	private function role_finder($company_role_id,$company_user_id,$role_id,$company_id,$str){
// 	    $return='';
// 		$this->company_role_id=intval($company_role_id);
// 		$this->company_user_id=intval($company_user_id);
// 		$this->company_id=intval($company_id);
// 		$this->role_pager=[
//     		'admin'=>[
//     			'view'=>'',
//     			'dashbord'=>[
//     				'category'=>['url'=>'category/category/show','data'=>['token'=>'ok']],
//     				'company'=>['url'=>'company/company/show','data'=>['token'=>'ok','id'=>intval($this->id)]],
//     				'products'=>['url'=>'product/product/show','data'=>['token'=>'ok','id'=>intval($this->id)]]
//     			],
//     			'company'=>[
//     				'category'=>['url'=>'category/category/manager','data'=>['token'=>'ok']],
//     				'company'=>['url'=>'company/dashbord/manager','data'=>['token'=>'ok']],
//     				// 'product'=>['url'=>'product/product/manager','data'=>['token'=>'ok']],
//     				// 'position'=>['url'=>'company/position/position/manager','data'=>['token'=>'ok']],
//     				// 'meet'=>['url'=>'company/meet/meet/manager','data'=>['token'=>'ok','company_user_id'=>intval($this->company_user_id)]],
//     				// 'task'=>['url'=>'company/task/task/manager','data'=>['token'=>'ok','company_user_id'=>intval($this->company_user_id)]],
//     				// 'users'=>['url'=>'users/dashbord/manager','data'=>['token'=>'ok']],
//     				// 'api'=>['url'=>'includes/api/manager','data'=>['token'=>'ok']],
//     				// 'chat'=>['url'=>'chat/chat/manager','data'=>['token'=>'ok']]
//     			]
//     		],
//     		'company_admin'=>[
//     			'view'=>'',
//     			'dashbord'=>[
//     				'category'=>['url'=>'category/category/show','data'=>['token'=>'ok']],
//     				'company'=>['url'=>'company/company/show','data'=>['token'=>'ok','id'=>intval($this->id)]],
//     				'products'=>['url'=>'product/product/show','data'=>['token'=>'ok','id'=>intval($this->id)]]
//     			],
//     			'company'=>[
//     				'info'=>['url'=>'company/dashbord/company_manager_info','data'=>['token'=>'ok','company_id'=>intval($this->company_id)]],
//         //             'meet'=>['url'=>'company/meet/meet/manager','data'=>['token'=>'ok','company_user_id'=>intval($this->company_user_id)]],
//                     // 'product_meet'=>['url'=>'product/dashbord/company_meet_product','data'=>['token'=>'ok','company_user_id'=>intval($this->company_user_id)]],
//                     // 'task'=>['url'=>'company/task/task/manager','data'=>['token'=>'ok','company_user_id'=>intval($this->company_user_id)]],
//                     // 'category'=>['url'=>'category/category/company_manager_show','data'=>['token'=>'ok']],
//                     // 'api'=>['url'=>'includes/api/company_manager_show','data'=>['token'=>'ok','company_id'=>intval($this->company_id)]],
//                     // 'product'=>['url'=>'company/company/company_manager_product','data'=>['token'=>'ok','company_id'=>intval($this->company_id)]],
//                     // 'persenel'=>['url'=>'users/dashbord/users_in_company','data'=>['token'=>'ok','company_id'=>intval($this->company_id)]],
//     			]
//     		],
//     		'none_role'=>[
//     			'view'=>'roles/none',
//     			'dashbord'=>[
//     				'category'=>['url'=>'category/category/show','data'=>['token'=>'ok']],
//     				'company'=>['url'=>'company/company/show','data'=>['token'=>'ok','id'=>intval($this->id)]],
//     				'products'=>['url'=>'product/product/show','data'=>['token'=>'ok','id'=>intval($this->id)]]
//     			]
//     		],
//     		'category_manager'=>[
//     			'view'=>'',
//     			'dashbord'=>[
//     				'category'=>['url'=>'category/category/show','data'=>['token'=>'ok']],
//     				'company'=>['url'=>'company/company/show','data'=>['token'=>'ok','id'=>intval($this->id)]],
//     				'products'=>['url'=>'product/product/show','data'=>['token'=>'ok','id'=>intval($this->id)]]
//     			],
//     			'company'=>[
//     				'meet'=>['url'=>'company/meet/meet/company_manager_meet','data'=>['token'=>'ok','company_user_id'=>intval($this->company_user_id)]],
//     				'task'=>['url'=>'company/task/task/company_manager_task','data'=>['token'=>'ok','company_user_id'=>intval($this->company_user_id)]],
//     				'category'=>['url'=>'category/category/manager','data'=>['token'=>'ok']]
//     			]
//     		],
//     		'product_manager'=>[
//     			'view'=>'',
//     			'dashbord'=>[
//     				'category'=>['url'=>'category/category/show','data'=>['token'=>'ok']],
//     				'company'=>['url'=>'company/company/show','data'=>['token'=>'ok','id'=>intval($this->id)]],
//     				'products'=>['url'=>'product/product/show','data'=>['token'=>'ok','id'=>intval($this->id)]]
//     			],
//     			'company'=>[
//     				'meet'=>['url'=>'company/meet/meet/company_manager_meet','data'=>['token'=>'ok','company_user_id'=>intval($this->company_user_id)]],
//                     'task'=>['url'=>'company/task/task/company_manager_task','data'=>['token'=>'ok','company_user_id'=>intval($this->company_user_id)]],
//                     'meet_product'=>['url'=>'product/dashbord/meet_manager','data'=>['token'=>'ok']],
//                     'product'=>['url'=>'product/product/manager','data'=>['token'=>'ok']],
//     			]
//     		],
//     		'company_manager'=>[
//     			'view'=>'',
//     			'dashbord'=>[
//     				'category'=>['url'=>'category/category/show','data'=>['token'=>'ok']],
//     				'company'=>['url'=>'company/company/show','data'=>['token'=>'ok','id'=>intval($this->id)]],
//     				'products'=>['url'=>'product/product/show','data'=>['token'=>'ok','id'=>intval($this->id)]]
//     			],
//     			'company'=>[
//     				'meet'=>['url'=>'company/meet/meet/company_manager_meet','data'=>['token'=>'ok','company_user_id'=>intval($this->company_user_id)]],
//     				'task'=>['url'=>'company/task/task/company_manager_task','data'=>['token'=>'ok','company_user_id'=>intval($this->company_user_id)]],
//     				'company'=>['url'=>'company/dashbord/manager','data'=>['token'=>'ok']]
//     			]
//     		],
//     		'users_manager'=>[
//     			'view'=>'',
//     			'dashbord'=>[
//     				'category'=>['url'=>'category/category/show','data'=>['token'=>'ok']],
//     				'company'=>['url'=>'company/company/show','data'=>['token'=>'ok','id'=>intval($this->id)]],
//     				'products'=>['url'=>'product/product/show','data'=>['token'=>'ok','id'=>intval($this->id)]]
//     			],
//     			'company'=>[
//     				'meet'=>['url'=>'company/meet/meet/company_manager_meet','data'=>['token'=>'ok','company_user_id'=>intval($this->company_user_id)]],
//                     'task'=>['url'=>'company/task/task/company_manager_task','data'=>['token'=>'ok','company_user_id'=>intval($this->company_user_id)]],
//                     'users'=>['url'=>'users/dashbord/user_none_company','data'=>['token'=>'ok']],
//     			]
//     		],
//     		'api_manager'=>[
//     			'view'=>'',
//     			'dashbord'=>[
//     				'category'=>['url'=>'category/category/show','data'=>['token'=>'ok']],
//     				'company'=>['url'=>'company/company/show','data'=>['token'=>'ok','id'=>intval($this->id)]],
//     				'products'=>['url'=>'product/product/show','data'=>['token'=>'ok','id'=>intval($this->id)]]
//     			],
//     			'company'=>[
//     				'meet'=>['url'=>'company/meet/meet/company_manager_meet','data'=>['token'=>'ok','company_user_id'=>intval($this->company_user_id)]],
//                     'task'=>['url'=>'company/task/task/company_manager_task','data'=>['token'=>'ok','company_user_id'=>intval($this->company_user_id)]],
//                     'api'=>['url'=>'includes/api/manager','data'=>['token'=>'ok']],        
//     			]
//     		],
//     		'chat_manager'=>[
//     			'view'=>'',
//     			'dashbord'=>[
//     				'category'=>['url'=>'category/category/show','data'=>['token'=>'ok']],
//     				'company'=>['url'=>'company/company/show','data'=>['token'=>'ok','id'=>intval($this->id)]],
//     				'products'=>['url'=>'product/product/show','data'=>['token'=>'ok','id'=>intval($this->id)]]
//     			],
//     			'company'=>[
//     				'meet'=>['url'=>'company/meet/meet/company_manager_meet','data'=>['token'=>'ok','company_user_id'=>intval($this->company_user_id)]],
//                     'task'=>['url'=>'company/task/task/company_manager_task','data'=>['token'=>'ok','company_user_id'=>intval($this->company_user_id)]],
//                     'chat'=>['url'=>'chat/chat/manager','data'=>['token'=>'ok']],
//     			]
//     		],
//     		'company_section_manager'=>[
//     			'view'=>'',
//     			'dashbord'=>[
//     				'category'=>['url'=>'category/category/show','data'=>['token'=>'ok']],
//     				'company'=>['url'=>'company/company/show','data'=>['token'=>'ok','id'=>intval($this->id)]],
//     				'products'=>['url'=>'product/product/show','data'=>['token'=>'ok','id'=>intval($this->id)]]
//     			],
//     			'company'=>[
//     				'meet'=>['url'=>'company/meet/meet/company_manager_meet','data'=>['token'=>'ok','company_user_id'=>intval($this->company_user_id)]],
//                     'task'=>['url'=>'company/task/task/company_manager_task','data'=>['token'=>'ok','company_user_id'=>intval($this->company_user_id)]],
//                     'product'=>['url'=>'company/company/company_manager_product_access','data'=>['token'=>'ok','company_user_id'=>intval($this->company_user_id)]],
//                     'product_meet'=>['url'=>'product/dashbord/company_meet_product','data'=>['token'=>'ok','company_user_id'=>intval($this->company_user_id)]],
//                     'persenel'=>['url'=>'users/dashbord/section_persenel_manager','data'=>['token'=>'ok','company_role_id'=>intval($this->company_role_id)]],
//     			]
//     		],
//     		'company_product_manager'=>[
//     			'view'=>'',
//     			'dashbord'=>[
//     				'category'=>['url'=>'category/category/show','data'=>['token'=>'ok']],
//     				'company'=>['url'=>'company/company/show','data'=>['token'=>'ok','id'=>intval($this->id)]],
//     				'products'=>['url'=>'product/product/show','data'=>['token'=>'ok','id'=>intval($this->id)]]
//     			],
//     			'company'=>[
//     				'meet'=>['url'=>'company/meet/meet/company_manager_meet','data'=>['token'=>'ok','company_user_id'=>intval($this->company_user_id)]],
//                     'task'=>['url'=>'company/task/task/company_manager_task','data'=>['token'=>'ok','company_user_id'=>intval($this->company_user_id)]],
//                     'product'=>['url'=>'company/company/company_manager_product_access','data'=>['token'=>'ok','company_user_id'=>intval($this->company_user_id)]],
//                     'product_meet'=>['url'=>'product/dashbord/company_meet_product','data'=>['token'=>'ok','company_user_id'=>intval($this->company_user_id)]],
//     			]
//     		],
//     		'company_meet_manager'=>[
//     			'view'=>'',
//     			'dashbord'=>[
//     				'category'=>['url'=>'category/category/show','data'=>['token'=>'ok']],
//     				'company'=>['url'=>'company/company/show','data'=>['token'=>'ok','id'=>intval($this->id)]],
//     				'products'=>['url'=>'product/product/show','data'=>['token'=>'ok','id'=>intval($this->id)]]
//     			],
//     			'company'=>[
//     				'meet'=>['url'=>'company/meet/meet/company_manager_meet','data'=>['token'=>'ok','company_user_id'=>intval($this->company_user_id)]],
//                     'task'=>['url'=>'company/task/task/company_manager_task','data'=>['token'=>'ok','company_user_id'=>intval($this->company_user_id)]],
//                     'product_meet'=>['url'=>'product/dashbord/company_meet_product','data'=>['token'=>'ok','company_user_id'=>intval($this->company_user_id)]],
//                     'persenel'=>['url'=>'users/dashbord/users_in_company','data'=>['token'=>'ok','company_id'=>intval($this->company_id)]],
//     			]
//     		],
//     		'company_content_manager'=>[
//     			'view'=>'',
//     			'dashbord'=>[
//     				'category'=>['url'=>'category/category/show','data'=>['token'=>'ok']],
//     				'company'=>['url'=>'company/company/show','data'=>['token'=>'ok','id'=>intval($this->id)]],
//     				'products'=>['url'=>'product/product/show','data'=>['token'=>'ok','id'=>intval($this->id)]]
//     			],
//     			'company'=>[
//     				'meet'=>['url'=>'company/meet/meet/company_manager_meet','data'=>['token'=>'ok','company_user_id'=>intval($this->company_user_id)]],
//                     'task'=>['url'=>'company/task/task/company_manager_task','data'=>['token'=>'ok','company_user_id'=>intval($this->company_user_id)]],
//                     'product'=>['url'=>'company/company/company_manager_galerry_product_access','data'=>['token'=>'ok','company_user_id'=>intval($this->company_user_id)]],
//     			]
//     		],
//     		'company_persenel_manager'=>[
//     			'view'=>'',
//     			'dashbord'=>[
//     				'category'=>['url'=>'category/category/show','data'=>['token'=>'ok']],
//     				'company'=>['url'=>'company/company/show','data'=>['token'=>'ok','id'=>intval($this->id)]],
//     				'products'=>['url'=>'product/product/show','data'=>['token'=>'ok','id'=>intval($this->id)]]
//     			],
//     			'company'=>[
//     				'meet'=>['url'=>'company/meet/meet/company_manager_meet','data'=>['token'=>'ok','company_user_id'=>intval($this->company_user_id)]],
//                     'task'=>['url'=>'company/task/task/company_manager_task','data'=>['token'=>'ok','company_user_id'=>intval($this->company_user_id)]],
//                     'users'=>['url'=>'users/dashbord/users_in_company','data'=>['token'=>'ok','company_id'=>intval($this->company_id)]],
//     			]
//     		],
//     	];
// 		switch(intval($role_id)){
// 	        case 1:
// 				$return.=$this->page_finder('admin',$str);
// 	            break;
// 	        case 2:
// 				$return.=$this->page_finder('category_manager',$str);
// 	            break;
// 	        case 3:
// 				$return.=$this->page_finder('product_manager',$str);
// 	            break;
// 	        case 4:
// 				$return.=$this->page_finder('company_manager',$str);
// 	            break;
// 	        case 5:
// 				$return.=$this->page_finder('users_manager',$str);
// 	            break;
// 	        case 6:
// 				$return.=$this->page_finder('api_manager',$str);
// 	            break;
// 	        case 7:
// 				$return.=$this->page_finder('chat_manager',$str);
// 	            break;
// 	        case 8:
// 				$return.=$this->page_finder('company_admin',$str);
// 	            break;
// 	        case 9:
// 				$return.=$this->page_finder('company_section_manager',$str);
// 	            break;
// 	        case 10:
// 				$return.=$this->page_finder('company_product_manager',$str);
// 	            break;
// 	        case 11:
// 				$return.=$this->page_finder('company_meet_manager',$str);
// 	            break;
// 	        case 12:
// 				$return.=$this->page_finder('company_content_manager',$str);
// 	            break;
// 	        case 13:
// 				$return.=$this->page_finder('company_persenel_manager',$str);
// 	            break;
// 	        default:
// 	            $return.=$this->page_finder('none_role',$str);
// 	            break;
// 	        }
// 	    return $return;
// 	}
// 	private function page_finder($type,$str){
// 		$data='';
// 		if(!empty($str) && !empty($type) && is_string($str) && is_string($type) && 
// 		in_array($str,array_keys($this->role_pager[$type])))
// 			foreach($this->role_pager[$type][$str] as $a=>$b){
// 			    if($str=='dashbord'){
// 				    if(!in_array($a,$this->dashbord_page)){
// 			            $this->dashbord_page[]=$a;
//     			        $data.= '<div id="'.$a.'">'. $this->CI->Include_model->send_data_and_resive_data(base_url($b['url']),$b['data']).'</div>';
// 				    }
// 				}else{
// 				    $data.= '<div id="'.$str.'-'.$a.'">'. $this->CI->Include_model->send_data_and_resive_data(base_url($b['url']),$b['data']).'</div>';
// 				}
// 			}
			
// 		return $this->CI->load->view(
// 		    (!empty($this->role_pager[$type]['view'])?$this->role_pager[$type]['view']:'roles/main')
// 		    ,['t'=>$str,'section_id'=>$str.' '.$str.'-'.$this->company_id,'data'=>$data],true);
// 	}