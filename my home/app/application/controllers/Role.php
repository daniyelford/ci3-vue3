<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Role extends MY_Controller
{
	public function __construct(){
		parent::__construct();
	}
	private $id='';
	private $lt='';
	private $ln='';
	private $page='';
	private $click='';
	private $pages=[
		'home'=>[
			'url'=>'',
	        'title'=>'خانه',
	        'icon'=>'',
	        'page'=>['category','company','product'],
			'css'=>[''],
	        'js'=>['']
	    ],
		'map'=>[
			'url'=>'',
	        'title'=>'map',
	        'icon'=>'',
	        'page'=>['category','company','product'],
			'css'=>[''],
	        'js'=>['']
	    ],
	    'search'=>[
			'url'=>'',
	        'title'=>'search',
	        'icon'=>'',
	        'page'=>['category','company','product'],
			'css'=>[''],
	        'js'=>['']
	    ],
	];
	private $dashbord_pages=[
		'dashbord'=>[
			'url'=>'dashbord',
	        'title'=>'dashbord',
	        'icon'=>'',
	        'page'=>['dashbord','company'],
			'css'=>[''],
	        'js'=>['']
	    ],
		'company'=>[
			'url'=>'company',
	        'title'=>'company',
	        'icon'=>'',
	        'page'=>['company','dashbord'],
			'css'=>[''],
	        'js'=>['']
	    ]
	];
	public function search(){
	    $this->page=$_SESSION['page']='search';
	    $this->click=new Click_actions();
	    $this->id=(!empty($_SESSION['id']) && intval($_SESSION['id'])>0?intval($_SESSION['id']):0);
        if(($c=$this->Order_model->select_wallet_where_user_id(intval($this->id)))!==false && !empty($c) && !empty(end($c))) $_SESSION['my_wallet']=end($c);
        $category=new Category_handler();
	    $company=new Company_handler();
	    $role=new Role_handler();
	    $this->main=new Main_exploder();
	    $this->main->valex_user_id=intval($this->id);
	    $this->main->valex_lt=$this->lt=(!empty($_SESSION['lt'])?$_SESSION['lt']:'');
        $this->main->valex_ln=$this->ln=(!empty($_SESSION['ln'])?$_SESSION['ln']:'');
        $this->main->valex_category_main_exploder(0);
        $has_auth_info_error=true;
        if(intval($this->id)>0 && 
	    ($a=$this->Users_model->select_where_id($this->id))!==false && !empty($a) && !empty($a['0']) &&
        ($b=$this->Users_model->select_info_where_user_id(intval($this->id)))!==false && !empty($b) && !empty($b['0'])){
            if(($c=$this->Order_model->select_wallet_where_user_id(intval($this->id)))!==false && !empty($c) && !empty(end($c)))
                $_SESSION['my_wallet']=end($c);
            $_SESSION['my_company']=$role->show_my_company_valex(intval($this->id));
            $_SESSION['user_info']=[
                'image'=>(!empty($b['0']['image'])?$b['0']['image']:''),
                'name'=>(!empty($b['0']['name'])?$b['0']['name']:''),
                'family'=>(!empty($b['0']['family'])?$b['0']['family']:''),
                'role'=>''
            ];
            $has_auth_info_error=(!empty($b['0']['cart_mely_picture']) && !empty($b['0']['mely_code'])?false:true);
        }
	    echo $this->load->view('header',[
	        'has_auth_info_error'=>$has_auth_info_error,
		    'category'=>$category->valex_show(),
			'lang'=>'',
			'chat'=>false,
			'id'=>$this->id,
			'user_info'=>(!empty($_SESSION['user_info'])?$_SESSION['user_info']:[]),
			'lat'=>$this->lt,
			'lon'=>$this->ln,
			'map_page'=>null,
			'search'=>'true',
			'title'=>'جستجوکردن',
			'icon'=>$this->pages['search']['icon'],
		    'css'=>$this->pages['search']['css']
	    ],true).
		$this->load->view('search',[
		    'category'=>$this->Category_model->select_where_status(),
            'company'=>$this->Company_model->all_status(),
		    'position'=>array_merge_recursive(array_column(array_values($this->main->valex_show_position_in_category),'position_info'),array_column(array_values($this->main->valex_show_position_in_category_without_product_with_company),'position_info'),array_column(array_values($this->main->valex_show_position_with_company_without_product_in_category),'position_info')),
            'product'=>array_merge_recursive(array_column(array_values($this->main->valex_show_product_in_category),'product_info'),array_column(array_values($this->main->valex_show_product_company_without_position_in_category),'product_info'),array_column(array_values($this->main->valex_show_product_without_company_position_in_category),'product_info')),
            'category_company'=>$this->Product_model->all_category(),
        ],true).
        $this->load->view('footer',[
        	'map_page'=>null,
		    'my_company'=>(!empty($_SESSION['my_company'])?$_SESSION['my_company']:[]),
		    'lang'=>'fa',
		    'change_lang'=>'true',
		    'id'=>$this->id,
		    'map'=>'true',
		    'chart'=>'true',
    		'js'=>$this->pages['search']['js'],
    		'url'=>$this->pages['search']['url'],
    		'timer'=>$this->load->view('includes/timer',['time'=>time()],true)
    	],true);
	}
	public function map(){
	    $this->page=$_SESSION['page']='map';
	    $this->click=new Click_actions();
	    $this->id=(!empty($_SESSION['id']) && intval($_SESSION['id'])>0?intval($_SESSION['id']):0);
	    $this->main=new Main_exploder();
	    $this->main->valex_user_id=intval($this->id);
	    $this->main->valex_lt=$this->lt=(!empty($_SESSION['lt'])?$_SESSION['lt']:'');
        $this->main->valex_ln=$this->ln=(!empty($_SESSION['ln'])?$_SESSION['ln']:'');
        $this->main->valex_category_main_exploder(0);
        $category=new Category_handler();
	    $company=new Company_handler();
	    $role=new Role_handler();
	    $has_auth_info_error=true;
        if(($c=$this->Order_model->select_wallet_where_user_id(intval($this->id)))!==false && !empty($c) && !empty(end($c))) $_SESSION['my_wallet']=end($c);
        if(intval($this->id)>0 && 
	    ($a=$this->Users_model->select_where_id($this->id))!==false && !empty($a) && !empty($a['0']) &&
        ($b=$this->Users_model->select_info_where_user_id(intval($this->id)))!==false && !empty($b) && !empty($b['0'])){
            if(($c=$this->Order_model->select_wallet_where_user_id(intval($this->id)))!==false && !empty($c) && !empty(end($c)))
                $_SESSION['my_wallet']=end($c);
            $_SESSION['my_company']=$role->show_my_company_valex(intval($this->id));
            $_SESSION['user_info']=[
                'image'=>(!empty($b['0']['image'])?$b['0']['image']:''),
                'name'=>(!empty($b['0']['name'])?$b['0']['name']:''),
                'family'=>(!empty($b['0']['family'])?$b['0']['family']:''),
                'role'=>''
            ];
            $has_auth_info_error=(!empty($b['0']['cart_mely_picture']) && !empty($b['0']['mely_code'])?false:true);
        }
	    echo $this->load->view('header',[
	        'has_auth_info_error'=>$has_auth_info_error,
		    'category'=>$category->valex_show(),
			'lang'=>'',
			'chat'=>false,
			'id'=>$this->id,
			'user_info'=>(!empty($_SESSION['user_info'])?$_SESSION['user_info']:[]),
			'lat'=>$this->lt,
			'lon'=>$this->ln,
			'map_page'=>true,
			'title'=>'نقشه',
			'icon'=>$this->pages['map']['icon'],
		    'css'=>$this->pages['map']['css']
	    ],true).
		$this->load->view('includes/map_page',[
            'company_position_product'=>(!empty($this->main->valex_show_product_in_category)?$this->main->valex_show_product_in_category:$this->main->valex_show_position_in_category),
            'company_product'=>(!empty($this->main->valex_show_product_company_without_position_in_category)?$this->main->valex_show_product_company_without_position_in_category:$this->main->valex_show_product_in_category_without_position),
            'company'=>$this->main->valex_show_all_company_in_category,
            'company_position'=>(!empty($this->main->valex_show_position_with_company_without_product_in_category)?$this->main->valex_show_position_with_company_without_product_in_category:$this->main->valex_show_position_in_category_without_product_with_company)
		],true).

		$this->load->view('footer',[
		    'map_page'=>true,
		    'my_company'=>(!empty($_SESSION['my_company'])?$_SESSION['my_company']:[]),
		    'lang'=>'fa',
		    'change_lang'=>'true',
		    'id'=>$this->id,
		    'map'=>'true',
		    'chart'=>'true',
    		'js'=>$this->pages['map']['js'],
    		'url'=>$this->pages['map']['url'],
    		'timer'=>$this->load->view('includes/timer',['time'=>time()],true)
    	],true);
	}
	public function map_category($id){
	    if(!empty($id) && intval($id)>0){
    	    $this->click=new Click_actions();
    	    $a=$this->click->action_click('changeCategoryInMap',intval($id));
    	    $js =(!empty($a)&&!empty($a['0'])&&!empty($a['0']['status'])&&$a['0']['status']&&!empty($a['0']['title'])&&!empty($a['0']['url'])?"processAjaxData('".$a['0']['title']."',$('#content').html(),'".$a['0']['url']."');":'');
    	    $this->main=new Main_exploder();
    	    $this->id=(!empty($_SESSION['id']) && intval($_SESSION['id'])>0?intval($_SESSION['id']):0);
    	    $this->main->valex_user_id=intval($this->id);
    	    $this->main->valex_lt=$this->lt=(!empty($_SESSION['lt'])?$_SESSION['lt']:'');
            $this->main->valex_ln=$this->ln=(!empty($_SESSION['ln'])?$_SESSION['ln']:'');
            $this->main->valex_category_main_exploder(intval($id));
            $category=new Category_handler();
    	    $company=new Company_handler();
    	    $role=new Role_handler();
    	    $has_auth_info_error=true;
            if(intval($this->id)>0 && 
    	    ($a=$this->Users_model->select_where_id($this->id))!==false && !empty($a) && !empty($a['0']) &&
            ($b=$this->Users_model->select_info_where_user_id(intval($this->id)))!==false && !empty($b) && !empty($b['0'])){
                if(($c=$this->Order_model->select_wallet_where_user_id(intval($this->id)))!==false && !empty($c) && !empty(end($c)))
                    $_SESSION['my_wallet']=end($c);
                $_SESSION['my_company']=$role->show_my_company_valex(intval($this->id));
                $_SESSION['user_info']=[
                    'image'=>(!empty($b['0']['image'])?$b['0']['image']:''),
                    'name'=>(!empty($b['0']['name'])?$b['0']['name']:''),
                    'family'=>(!empty($b['0']['family'])?$b['0']['family']:''),
                    'role'=>''
                ];
                $has_auth_info_error=(!empty($b['0']['cart_mely_picture']) && !empty($b['0']['mely_code'])?false:true);
            }
    	    echo $this->load->view('header',[
    	        'has_auth_info_error'=>$has_auth_info_error,
    		    'category'=>$category->valex_show(),
    			'lang'=>'',
    			'id'=>$this->id,
    			'chat'=>false,
    			'user_info'=>(!empty($_SESSION['user_info'])?$_SESSION['user_info']:[]),
    			'lat'=>$this->lt,
    			'lon'=>$this->ln,
    			'title'=>$this->pages['map']['title'],
    			'icon'=>$this->pages['map']['icon'],
    		    'css'=>$this->pages['map']['css'],
    		    'map_page'=>true
    	    ],true).
    		$this->load->view('includes/map_page',[
    		    'company_position_product'=>(!empty($this->main->valex_show_product_in_category)?$this->main->valex_show_product_in_category:$this->main->valex_show_position_in_category),
                'company_product'=>(!empty($this->main->valex_show_product_company_without_position_in_category)?$this->main->valex_show_product_company_without_position_in_category:$this->main->valex_show_product_in_category_without_position),
                'company'=>$this->main->valex_show_all_company_in_category,
                'company_position'=>(!empty($this->main->valex_show_position_with_company_without_product_in_category)?
                $this->main->valex_show_position_with_company_without_product_in_category:
                    $this->main->valex_show_position_in_category_without_product_with_company)
    	    ],true).
    		$this->load->view('footer',[
    		    'map_page'=>true,
    		    'my_company'=>(!empty($_SESSION['my_company'])?$_SESSION['my_company']:[]),
                'lang'=>'fa',
    		    'change_lang'=>'true',
    		    'id'=>$this->id,
    		    'map'=>'true',
    		    'chart'=>'true',
        		'js'=>[$js],
        		'url'=>$this->pages['map']['url'],
        		'timer'=>$this->load->view('includes/timer',['time'=>time()],true)
        	],true);
	    }
	}
	public function exit_page(){
	    $_SESSION['page']='';
	    return $this->index();
	}
	private $main;
	public function index(){
	    $this->page=(!empty($this->page)?$this->page:(!empty($_SESSION['page'])&&is_string($_SESSION['page'])?$_SESSION['page']:''));
	    $this->id=(!empty($_SESSION['id']) && intval($_SESSION['id'])>0?intval($_SESSION['id']):0);
	    if(intval($this->id)>0 && !empty($_SESSION['visit']) && intval($_SESSION['visit'])>0){
            header('Location:'.base_url('cart_visit/'.intval($_SESSION['visit'])));
            exit();
        }
	    if($this->page=='map') return $this->map();
	    if($this->page=='search') return $this->search();
	    $this->click=new Click_actions();
	    $this->main=new Main_exploder();
	    $this->main->valex_user_id=intval($this->id);
	    if(($a=$this->Include_model->ip_handler())!==false && !empty($a) && !empty($a['lat']) && !empty($a['lon'])){
            $this->main->valex_lt=$this->lt=$_SESSION['lt']=$a['lat'];
            $this->main->valex_ln=$this->ln=$_SESSION['ln']=$a['lon'];
        }
        $this->main->valex_category_main_exploder(0);
		if(intval($this->id)>0)
			$this->page_handler_user('dashbord');
		else
			$this->page_handler('home');
	}
	public function set_company_showen($id){
	    $_SESSION['whitch_company']=intval($id);
	    header('location:'.base_url().'company-info');
	}
	private function page_handler_user($page){
	    $category=new Category_handler();
	    $company=new Company_handler();
	    $role=new Role_handler();
	    $_SESSION['user_info']=$_SESSION['my_company']=$_SESSION['my_wallet']=[];
	    if(intval($this->id)>0 && 
	    ($a=$this->Users_model->select_where_id($this->id))!==false && !empty($a) && !empty($a['0']) &&
        ($b=$this->Users_model->select_info_where_user_id(intval($this->id)))!==false && !empty($b) && !empty($b['0'])){
            if(($c=$this->Order_model->select_wallet_where_user_id(intval($this->id)))!==false && !empty($c) && !empty(end($c)))
                $_SESSION['my_wallet']=end($c);
            $_SESSION['my_company']=$role->show_my_company_valex(intval($this->id));
            $_SESSION['user_info']=[
                'image'=>(!empty($b['0']['image'])?$b['0']['image']:''),
                'name'=>(!empty($b['0']['name'])?$b['0']['name']:''),
                'family'=>(!empty($b['0']['family'])?$b['0']['family']:''),
                'role'=>''
            ];
            $has_auth_info_error=(!empty($b['0']['cart_mely_picture']) && !empty($b['0']['mely_code'])?false:true);
    		if(in_array($page,array_keys($this->dashbord_pages)))
    			echo $this->load->view('header',[
    			    'category'=>$category->valex_show(),
    			    'lang'=>'',
    			    'id'=>$this->id,
    			    'user_info'=>$_SESSION['user_info'],
    			    'lat'=>$this->lt,
    			    'lon'=>$this->ln,
    			    'chat'=>false,
    			    'has_auth_info_error'=>$has_auth_info_error,
    			    'title'=>$this->dashbord_pages[$page]['title'],
    			    'icon'=>$this->dashbord_pages[$page]['icon'],
    			    'css'=>$this->dashbord_pages[$page]['css']],true).
    			$this->load->view('index',[
    			    'reserve_timer'=>$this->load->view('includes/timer',[
                        'next_years'=>true,
                        'want_hour'=>true,
                        'time'=>time()
                    ],true),
    			    'wallet'=>$_SESSION['my_wallet'],
                    'id'=>$this->id,
    			    'login'=>true,
    			    'company_position_product'=>$this->main->valex_show_product_in_category,
                    'company_product'=>$this->main->valex_show_product_company_without_position_in_category,
                    'product'=>$this->main->valex_show_product_without_company_position_in_category,
                    'position'=>(!empty($this->main->valex_show_position_with_company_without_product_in_category)?$this->main->valex_show_position_with_company_without_product_in_category:$this->main->valex_show_position_in_category),
    			],true).
    			($this->page=='map'?
        			$this->load->view('footer',[
        			    'map_page'=>true,
        			    'my_company'=>$_SESSION['my_company'],
                        'lang'=>'fa',
        			    'change_lang'=>'true',
        			    'id'=>$this->id,
        			    'map'=>'true',
        			    'chart'=>'true',
            			'click_action'=>$this->click->user_action($this->page),
            			'url'=>$this->dashbord_pages[$page]['url']
            		],true):
            		    $this->load->view('footer',[
        			    'my_company'=>$_SESSION['my_company'],
                        'lang'=>'fa',
        			    'change_lang'=>'true',
        			    'id'=>$this->id,
        			    'map'=>'true',
        			    'chart'=>'true',
            			'click_action'=>$this->click->user_action($this->page),
            			'url'=>$this->dashbord_pages[$page]['url']
            		],true)
        		);
    		else
    			$this->err_404();
        }else{
            $_SESSION['id']=0;
            $this->err_500();
        }
	}
	private function user_compiler($arr){
		$handler=new Role_handler();
		$data=[];
		if(!empty($arr) && is_array($arr)){
		    foreach($arr as $a){
				if(!empty($a) && is_string($a))$data[]=$handler->show($a,$this->id);
		    }
			
		}
		return $this->companies_for_user($data);
	}
	private function companies_for_user($data){
		$return='';
		$company_ids=[];
		if(!empty($data) && is_array($data))
		    foreach($data as $c){
    		    if(!empty($c['company']) && is_array($c['company'])){
    		        if(isset($_SESSION['whitch_company'])&&
    		        !empty($_SESSION['whitch_company']) && 
    		        intval($_SESSION['whitch_company'])>0){
		                foreach($c['company'] as $d=>$e){
		                    if(intval($d)==intval($_SESSION['whitch_company'])) $return.=$e;
		                    if(!in_array(intval($d),$company_ids)) $company_ids[]=intval($d);
		                }
    		        }else{
    		            $company_ids=$f=array_keys($c['company']);
    		            if(!empty($f) && !empty($f['0']) && intval($f['0'])>0){
        		            if(!empty($c['company'][intval($f['0'])])) $_SESSION['whitch_company']=intval($f['0']);
        		            $return .= $c['company'][intval($f['0'])];
        		        }
    		        }
    		    }elseif(!empty($c['dashbord']) && is_array($c['dashbord'])){
    		        foreach ($c['dashbord'] as $g=>$h){
    		            if(!empty($h))$return.=$h;
    		        }
    		    }
		    }
		$ret=(!empty($company_ids)&&!empty($_SESSION['whitch_company'])&&intval($_SESSION['whitch_company'])>0?
		$this->show_companies_handler($company_ids,intval($_SESSION['whitch_company'])):'');
		return $return.$ret;
	}
	private function show_companies_handler($arr,$id){
	    $ret='';
	    $data=[];
	    if(!empty($arr) && is_array($arr) && !empty($id) && intval($id)>0)
	        foreach($arr as $a){
	            if(!empty($a) && intval($a)>0 && ($b=$this->Company_model->select_company_where_id(intval($a)))!==false && !empty($b) && !empty($b['0']))$data[]=$b['0'];
	        }
	   if(!empty($data))
		    $ret=$this->load->view('company/company_selector',['data'=>$data,'id'=>intval($id)],true);
	    return $ret;
	}
	public function page_handler($page){
	    $category=new Category_handler();
	    if(in_array($page,array_keys($this->pages)))
			echo $this->load->view('header',[
    			'category'=>$category->valex_show(),
    			'lang'=>'','lat'=>$this->lt,
    			'lon'=>$this->ln,
    			'title'=>$this->pages[$page]['title'],
    			'icon'=>$this->pages[$page]['icon'],
    			'css'=>$this->pages[$page]['css']
			],true).
			$this->load->view('index',[
			    'company_position_product'=>$this->main->valex_show_product_in_category,
                'company_product'=>$this->main->valex_show_product_company_without_position_in_category,
                'product'=>$this->main->valex_show_product_without_company_position_in_category,
                'position'=>(!empty($this->main->valex_show_position_with_company_without_product_in_category)?$this->main->valex_show_position_with_company_without_product_in_category:$this->main->valex_show_position_in_category),
	            
	        ],true).
	        ($this->page=='map'?
    			$this->load->view('footer',[
    			    'map_page'=>true,
    			    'chart'=>'true',
                    'map'=>'true',
    			    'lang'=>'fa',
    			    'change_lang'=>'true',
    			    'js'=>$this->pages[$page]['js'],
    			    'click_action'=>$this->click->action($this->page),
    			    'url'=>$this->pages[$page]['url'],
    			    'timer'=>$this->load->view('includes/timer',['time'=>time()],true)
    		    ],true):
    		    $this->load->view('footer',[
    			    'chart'=>'true',
                    'map'=>'true',
    			    'lang'=>'fa',
    			    'change_lang'=>'true',
    			    'js'=>$this->pages[$page]['js'],
    			    'click_action'=>$this->click->action($this->page),
    			    'url'=>$this->pages[$page]['url'],
    			    'timer'=>$this->load->view('includes/timer',['time'=>time()],true)
    		    ],true)
    	    );
		else
			$this->err_404();
	}
	public function click_action(){
    	$a = (!empty($_POST['token']) ? trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) : null);
	    $b = (!empty($_POST['data']) && is_string($_POST['data'])?$_POST['data']:null);
	    if(!is_null($a) && !is_null($b) && $this->Include_model->chapcha($a) && ($c=explode(':',$b))!==false&&!empty($c) && !empty($c['0']) && !empty($c['1'])){
    	    $this->click=new Click_actions();
	        $c=$this->click->action_click($c['0'],$c['1']);
	        for($d=0;$d<=count($c)-1;$d++){
	            if(!empty($c[$d]))
        	        echo json_encode($c[$d]);
	        }
            die();
	    }else{
	        echo 'no';
	    }
	}
	public function xss_link($str){
	    return (!empty($str) && is_string($str) && ($a=str_replace(["/",'~','"',"'",':','#','@','!','|',';','?','<','>','.',',','&','*','and','=','%'],'',$str))!==false?$a:'');
	}
	public function url($str){
	    if(!empty($str) && is_string($str) && ($str=$this->xss_link($str))!==false && !empty($str)){
	        $this->click=new Click_actions();
	        $this->page=$this->click->url_action_checker($str);
	        $this->index();
	    }else{
	        $this->load->view('errors/404',[]);
	    }
	}
	public function url_two($str,$pro){
	    if(!empty($pro) && is_string($pro) && ($pro=$this->xss_link(rawurldecode($pro)))!==false && !empty($pro) && !empty($str) && is_string($str) && ($str=$this->xss_link($str))!==false && !empty($str)){
	        $this->click=new Click_actions();
	        $this->page=$this->click->url_action_checker_two_arg($str,$pro);
	        if(!empty($_SESSION['page'])&&$_SESSION['page']=='map' && !empty($this->page) && !empty($this->page['0']) &&
	        !empty($this->page['0']['category_in_map']) && !empty($this->page['0']['category_in_map']['main-category-in-map']) &&
	        intval($this->page['0']['category_in_map']['main-category-in-map'])>0)
                $this->map_category(intval($this->page['0']['category_in_map']['main-category-in-map']));
            else
	            $this->index();
            
	    }else{
	        $this->load->view('errors/404',[]);
	    }
	}
	public function url_three($str,$pro,$cat){
	    if(!empty($cat) && is_string($cat) && ($cat=$this->xss_link(rawurldecode($cat)))!==false && !empty($cat) && !empty($pro) && is_string($pro) && ($pro=$this->xss_link(rawurldecode($pro)))!==false && !empty($pro) && !empty($str) && is_string($str) && ($str=$this->xss_link($str))!==false && !empty($str)){
	        $this->click=new Click_actions();
	        $this->page=$this->click->url_action_checker_three_arg($str,$pro,$cat);
	        $this->index();
	    }else{
	        $this->load->view('errors/404',[]);
	    }
	}
	public function url_four($str,$pro,$cat,$x){
	    if(!empty($x) && is_string($x) && ($x=$this->xss_link(rawurldecode($x)))!==false && 
	    !empty($x) &&!empty($cat) && is_string($cat) && ($cat=$this->xss_link(rawurldecode($cat)))!==false && 
	    !empty($cat) && !empty($pro) && is_string($pro) && ($pro=$this->xss_link(rawurldecode($pro)))!==false &&
	    !empty($pro) && !empty($str) && is_string($str) && ($str=$this->xss_link(rawurldecode($str)))!==false && !empty($str)){
	        $this->click=new Click_actions();
	        $this->page=$this->click->url_action_checker_four_arg($str,$pro,$cat,$x);
	        $this->index();
	    }else{
	        $this->load->view('errors/404',[]);
	    }
	}
	public function url_five($str,$pro,$cat,$x,$y){
	    if(!empty($y) && is_string($y) && ($y=$this->xss_link(rawurldecode($y)))!==false && !empty($y) &&
	    !empty($x) && is_string($x) && ($x=$this->xss_link(rawurldecode($x)))!==false && !empty($x) &&
	    !empty($cat) && is_string($cat) && ($cat=$this->xss_link(rawurldecode($cat)))!==false && !empty($cat) &&
	    !empty($pro) && is_string($pro) && ($pro=$this->xss_link(rawurldecode($pro)))!==false && !empty($pro) &&
	    !empty($str) && is_string($str) && ($str=$this->xss_link($str))!==false && !empty($str)){
	        $this->click=new Click_actions();
	        $this->page=$this->click->url_action_checker_five_arg($str,$pro,$cat,$x,$y);
	        $this->index();
	    }else{
	        $this->load->view('errors/404',[]);
	    }
	}
	public function url_six($str,$pro,$cat,$x,$y,$z){
	    if(!empty($z) && is_string($z) && ($z=$this->xss_link(rawurldecode($z)))!==false && !empty($z) &&
	    !empty($y) && is_string($y) && ($y=$this->xss_link(rawurldecode($y)))!==false && !empty($y) &&
	    !empty($x) && is_string($x) && ($x=$this->xss_link(rawurldecode($x)))!==false && !empty($x) &&
	    !empty($cat) && is_string($cat) && ($cat=$this->xss_link(rawurldecode($cat)))!==false && !empty($cat) &&
	    !empty($pro) && is_string($pro) && ($pro=$this->xss_link(rawurldecode($pro)))!==false && !empty($pro) &&
	    !empty($str) && is_string($str) && ($str=$this->xss_link($str))!==false && !empty($str)){
	        $this->click=new Click_actions();
	        $this->page=$this->click->url_action_checker_six_arg($str,$pro,$cat,$x,$y,$z);
	        $this->index();
	    }else{
	        $this->load->view('errors/404',[]);
	    }
	}
	public function err_404(){
	    $this->load->view('errors/404',[]);
	}
	public function err_500(){
	    $this->load->view('errors/500',[]);
	}
}
	
	
	    // 		$company_page=($this->page=='company_manager'?true:false);
    			 //   'company_page'=>$company_page,
	
	           // $js=($this->page=='company_manager' && !empty($_SESSION['comapy_manager_info']) &&
            // is_array($_SESSION['comapy_manager_info']) &&
            // !empty($_SESSION['comapy_manager_info']['user_id']) && intval($_SESSION['comapy_manager_info']['user_id'])>0 &&
            // intval($_SESSION['comapy_manager_info']['user_id']) == $this->id && !empty($_SESSION['comapy_manager_info']['company_id']) &&
            // intval($_SESSION['comapy_manager_info']['company_id'])>0?
            // "sendAjax({crid: ".(!empty($_SESSION['comapy_manager_info']['company_role_id']) &&
            // intval($_SESSION['comapy_manager_info']['company_role_id'])>0?
            // intval($_SESSION['comapy_manager_info']['company_role_id']):0).",
            // cuid: ".(!empty($_SESSION['comapy_manager_info']['company_user_id']) &&
            // intval($_SESSION['comapy_manager_info']['company_user_id'])>0?
            // intval($_SESSION['comapy_manager_info']['company_user_id']):0).",
            // crpid:".(!empty($_SESSION['comapy_manager_info']['company_role_parent_id']) && 
            // intval($_SESSION['comapy_manager_info']['company_role_parent_id'])>0?
            // intval($_SESSION['comapy_manager_info']['company_role_parent_id']):0).",
            // rid:".(!empty($_SESSION['comapy_manager_info']['role_id']) && 
            // intval($_SESSION['comapy_manager_info']['role_id'])>0?intval($_SESSION['comapy_manager_info']['role_id']):0).",
            // cid:".intval($_SESSION['comapy_manager_info']['company_id'])."},baseUrl('company/company/manage'),'#content');":"");
	
	            // 			'js'=>$js,
            // 			'js'=>$js,
	
	
	