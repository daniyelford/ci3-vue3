<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Click_actions
{
    private $CI;
	public function __construct(){
		$this->CI =& get_instance();
		$this->CI->load->helper('url');
	    $this->CI->load->library('session');
        $this->CI->config->item('base_url');
	}
    private $url_array=[
        'page'=>[
            'function_name'=>'changePage',
            'click_function_name'=>'changePageClick',
            'prop'=>[
                'home'=>['query'=>1,'data'=>'home','url'=>'home','title'=>'صفحه نخست'],
                'add-user'=>['query'=>1,'data'=>'add-user','url'=>'add-user','title'=>'ایجاد کاربر'],
                'costum-login'=>['query'=>1,'data'=>'costum-login','url'=>'costum-login','title'=>'ورود'],
            ]
        ],
        'category'=>[
            'function_name'=>'showCategory',
            'click_function_name'=>'changeCategory',
            'prop'=>[
                'main-category'=>['query'=>2,'type'=>'category','url'=>'main-category'],
            ]
        ],
        'category_in_map'=>[
            'function_name'=>'showCategoryInMap',
            'click_function_name'=>'changeCategoryInMap',
            'prop'=>[
                'main-category-in-map'=>['query'=>2,'type'=>'category_in_map','url'=>'main-category-in-map'],
            ]
        ],
        'category_in_category'=>[
            'function_name'=>'showCategoryInnerCategory',
            'click_function_name'=>'changeCategoryInnerCategory',
            'prop'=>[
                'sub-category'=>['query'=>3,'type'=>'category_in_category','url'=>'sub-category'],
            ]
        ],
        'company_in_category'=>[
            'function_name'=>'showCompanyDescriptionInCategoryInCategory',
            'click_function_name'=>'clickCompanyDescription',
            'prop'=>[
                'main-category-company'=>['query'=>3,'type'=>'company_in_category','url'=>'main-category-company'],
                'category-company'=>['query'=>4,'type'=>'company_in_category','url'=>'category-company'],
            ]
        ],
        'product_in_company_in_category'=>[
            'function_name'=>'showProductCompany',
            'click_function_name'=>'clickProductCompany',
            'prop'=>[
                'company-product'=>['query'=>4,'type'=>'product_in_company_in_category','url'=>'company-product','handler'=>'products'],
                'category-company-product'=>['query'=>5,'type'=>'product_in_company_in_category','url'=>'category-company-product','handler'=>'products'],
            ]
        ],
        'position_in_company_in_category'=>[
            'function_name'=>'PositionCompanyShower',
            'click_function_name'=>'clickPositionCompany',
            'prop'=>[
                'company-position'=>['query'=>4,'type'=>'position_in_company_in_category','url'=>'company-position','handler'=>'position'],
            ]
        ],
        'product_in_company_in_category_information'=>[
            'function_name'=>'showCompanyProductWithType',
            'click_function_name'=>'clickShowCompanyProductWithType',
            'prop'=>[
                'company-product-info'=>['query'=>5,'type'=>'product_in_company_in_category_information','url'=>'company-product-info','handler'=>['info','tel','video','map','chat']],
                'category-company-product-info'=>['query'=>6,'type'=>'product_in_company_in_category_information','url'=>'category-company-product-info','handler'=>['info','tel','video','map','chat']],
            ]
        ],        
    ];
    private $url_user_array=[
        'page'=>[
            'function_name'=>'changePage',
            'click_function_name'=>'changePageClick',
            'prop'=>[
                'user-setting'=>['query'=>1,'data'=>'user-setting','url'=>'user-setting','title'=>'حساب کاربری'],
                'company-info'=>['query'=>1,'data'=>'company-info','url'=>'company-info','title'=>'کسب وکار'],
                'dashbord'=>['query'=>1,'data'=>'dashbord','url'=>'dashbord','title'=>'داشبورد'],
                'add-company'=>['query'=>1,'data'=>'add-company','url'=>'add-company','title'=>'ایجاد کسب و کار'],
            ]
        ],
        'category'=>[
            'function_name'=>'showCategory',
            'click_function_name'=>'changeCategory',
            'prop'=>[
                'main-category'=>['query'=>2,'type'=>'category','url'=>'main-category'],
            ]
        ],
        'category_in_map'=>[
            'function_name'=>'showCategoryInMap',
            'click_function_name'=>'changeCategoryInMap',
            'prop'=>[
                'main-category-in-map'=>['query'=>2,'type'=>'category_in_map','url'=>'main-category-in-map'],
            ]
        ],
        'category_in_category'=>[
            'function_name'=>'showCategoryInnerCategory',
            'click_function_name'=>'changeCategoryInnerCategory',
            'prop'=>[
                'sub-category'=>['query'=>3,'type'=>'category_in_category','url'=>'sub-category'],
            ]
        ],
        'company_in_category'=>[
            'function_name'=>'showCompanyDescriptionInCategoryInCategory',
            'click_function_name'=>'clickCompanyDescription',
            'prop'=>[
                'main-category-company'=>['query'=>3,'type'=>'company_in_category','url'=>'main-category-company'],
                'category-company'=>['query'=>4,'type'=>'company_in_category','url'=>'category-company'],
            ]
        ],
        'product_in_company_in_category'=>[
            'function_name'=>'showProductCompany',
            'click_function_name'=>'clickProductCompany',
            'prop'=>[
                'company-product'=>['query'=>4,'type'=>'product_in_company_in_category','url'=>'company-product','handler'=>'products'],
                'category-company-product'=>['query'=>5,'type'=>'product_in_company_in_category','url'=>'category-company-product','handler'=>'products'],
            ]
        ],
        'product_in_company_in_category_information'=>[
            'function_name'=>'showCompanyProductWithType',
            'click_function_name'=>'clickShowCompanyProductWithType',
            'prop'=>[
                'company-product-info'=>['query'=>5,'type'=>'product_in_company_in_category_information','url'=>'company-product-info','handler'=>['info','tel','video','map','chat']],
                'category-company-product-info'=>['query'=>6,'type'=>'product_in_company_in_category_information','url'=>'category-company-product-info','handler'=>['info','tel','video','map','chat']],
            ]
        ],      
    ];
	// 
// check


    public function url_action_checker($url){
	    $ret=[];
	    $data=(!empty($_SESSION['id']) && intval($_SESSION['id'])>0?$this->url_user_array:$this->url_array);
	    foreach($data as $a=>$b){
	        if(!empty($a) && !empty($b) && is_array($b) && !empty($b['prop']) && is_array($b['prop']))
    	        foreach($b['prop'] as $c=>$d){
    	            if($d['url']==$url) $ret[][$a]=$c;
    	        }
	    }
	    return $ret;
	}

	public function url_action_checker_two_arg($url,$prop){
	    $ret=[];
	    $data=(!empty($_SESSION['id']) && intval($_SESSION['id'])>0?$this->url_user_array:$this->url_array);
	    foreach($data as $a=>$b){
	        if(!empty($a) && !empty($b) && is_array($b) && !empty($b['prop']) && is_array($b['prop']))
    	        foreach($b['prop'] as $c=>$d){
    	            if($d['url']==$this->url_return($url) && $d['query']==2)
    	                switch($d['type']){
    	                    case 'category':
    	                        $ret[][$a]=(
    	                            ($e=$this->CI->Category_model->select_where_title_and_status(trim($this->url_return($prop))))!==false && 
    	                            !empty($e) && !empty($e['0']) && !empty($e['0']['id']) && intval($e['0']['id'])>0?
    	                                [$c=>intval($e['0']['id'])]
    	                                :null);
    	                   case 'category_in_map':
    	                        $ret[][$a]=(
    	                            ($e=$this->CI->Category_model->select_where_title_and_status(trim($this->url_return($prop))))!==false && 
    	                            !empty($e) && !empty($e['0']) && !empty($e['0']['id']) && intval($e['0']['id'])>0?
    	                                [$c=>intval($e['0']['id'])]
    	                                :null);
    	                        break;
    	                }
    	        }
	    }
        return $ret;
	}
	public function url_action_checker_three_arg($url,$prop,$cat){
	    $ret=[];
	    $data=(!empty($_SESSION['id']) && intval($_SESSION['id'])>0?$this->url_user_array:$this->url_array);
	    foreach($data as $a=>$b){
	        if(!empty($a) && !empty($b) && is_array($b) && !empty($b['prop']) && is_array($b['prop']))
    	        foreach($b['prop'] as $c=>$d){
    	            if($d['url']==$this->url_return($url) && $d['query']==3)
    	                switch($d['type']){
    	                    case 'category_in_category':
    	                        $ret[][$a]=(($e=$this->CI->Category_model->select_where_title_and_status(trim($this->url_return($prop))))!==false&& !empty($e) && !empty($e['0']) && !empty($e['0']['id']) && intval($e['0']['id'])>0 && ($f=$this->CI->Category_model->select_where_title_and_status(trim($this->url_return($cat))))!==false && !empty($f) && !empty($f['0']) && !empty($f['0']['id']) && intval($f['0']['id'])>0?[$c=>['p_p'=>intval($e['0']['id']),'p'=>intval($f['0']['id'])]]:null);
    	                        break;
    	                    case 'company_in_category':
    	                        $ret[][$a]=(($e=$this->CI->Category_model->select_where_title_and_status(trim($this->url_return($prop))))!==false&& !empty($e) && !empty($e['0']) && !empty($e['0']['id']) && intval($e['0']['id'])>0 && ($f=$this->CI->Company_model->select_company_where_title_and_status(trim($this->url_return($cat))))!==false && !empty($f) && !empty($f['0']) && !empty($f['0']['id']) && intval($f['0']['id'])>0?[$c=>['p_p'=>intval($e['0']['id']),'c'=>intval($f['0']['id'])]]:null);
    	                        break;
    	                    default:
    	                        $ret=[];
    	                        break;
    	                }
    	        }
	    }
        return $ret;
	}
	public function url_action_checker_four_arg($url,$prop,$cat,$com){
	    $ret=[];
	    $data=(!empty($_SESSION['id']) && intval($_SESSION['id'])>0?$this->url_user_array:$this->url_array);
	    foreach($data as $a=>$b){
	        if(!empty($a) && !empty($b) && is_array($b) && !empty($b['prop']) && is_array($b['prop']))
    	        foreach($b['prop'] as $c=>$d){
    	            if($d['url']==$this->url_return($url) && $d['query']==4)
    	                switch($d['type']){
    	                    case 'company_in_category':
    	                        $ret[][$a]=(($e=$this->CI->Category_model->select_where_title_and_status(trim($this->url_return($prop))))!==false&& !empty($e) && !empty($e['0']) && !empty($e['0']['id']) && intval($e['0']['id'])>0 && ($f=$this->CI->Category_model->select_where_title_and_status(trim($this->url_return($cat))))!==false && !empty($f) && !empty($f['0']) && !empty($f['0']['id']) && intval($f['0']['id'])>0 &&($g=$this->CI->Company_model->select_company_where_title_and_status(trim($this->url_return($com))))!==false && !empty($g) && !empty($g['0']) && !empty($g['0']['id']) && intval($g['0']['id'])>0?[$c=>['p_p'=>intval($e['0']['id']),'p'=>intval($f['0']['id']),'c'=>intval($g['0']['id'])]]:null);
    	                        break;
   	                        case 'product_in_company_in_category':
    	                        $ret[][$a]=(trim($com)==$d['handler'] && ($e=$this->CI->Category_model->select_where_title_and_status(trim($this->url_return($prop))))!==false&& !empty($e) && !empty($e['0']) && !empty($e['0']['id']) && intval($e['0']['id'])>0 && ($f=$this->CI->Company_model->select_company_where_title_and_status(trim($this->url_return($cat))))!==false && !empty($f) && !empty($f['0']) && !empty($f['0']['id']) && intval($f['0']['id'])>0?[$c=>['p_p'=>intval($e['0']['id']),'c'=>intval($f['0']['id']),'h'=>trim($com)]]:null);
    	                        break;
   	                        
   	                        case 'position_in_company_in_category':
    	                        $ret[][$a]=(trim($com)==$d['handler'] && 
    	                        ($e=$this->CI->Category_model->select_where_title_and_status(trim($this->url_return($prop))))!==false
    	                        && !empty($e) && !empty($e['0']) && !empty($e['0']['id']) &&
    	                        intval($e['0']['id'])>0 && 
    	                        ($f=$this->CI->Company_model->select_company_where_title_and_status(trim($this->url_return($cat))))!==false && !empty($f) && !empty($f['0']) && 
    	                        !empty($f['0']['id']) && intval($f['0']['id'])>0?
    	                        [$c=>['p_p'=>intval($e['0']['parent_id']),'p'=>intval($e['0']['id']),'c'=>intval($f['0']['id']),'h'=>trim($com)]]:null);
    	                        break;
    	                    
    	                    default:
    	                        $ret=[];
    	                        break;
    	               }
    	        }
	    }
        return $ret;
	}
	public function url_action_checker_five_arg($url,$prop,$cat,$com,$han){
	    $ret=[];
	    $data=(!empty($_SESSION['id']) && intval($_SESSION['id'])>0?$this->url_user_array:$this->url_array);
	    foreach($data as $a=>$b){
	        if(!empty($a) && !empty($b) && is_array($b) && !empty($b['prop']) && is_array($b['prop']))
    	        foreach($b['prop'] as $c=>$d){
    	            if($d['url']==$this->url_return($url) && $d['query']==5)
    	                switch($d['type']){
    	                    case 'product_in_company_in_category':
    	                        $ret[][$a]=($d['handler']==trim($han) &&($e=$this->CI->Category_model->select_where_title_and_status(trim($this->url_return($prop))))!==false&& !empty($e) && !empty($e['0']) && !empty($e['0']['id']) && intval($e['0']['id'])>0 && ($f=$this->CI->Category_model->select_where_title_and_status(trim($this->url_return($cat))))!==false && !empty($f) && !empty($f['0']) && !empty($f['0']['id']) && intval($f['0']['id'])>0 &&($g=$this->CI->Company_model->select_company_where_title_and_status(trim($this->url_return($com))))!==false && !empty($g) && !empty($g['0']) && !empty($g['0']['id']) && intval($g['0']['id'])>0?[$c=>['p_p'=>intval($e['0']['id']),'p'=>intval($f['0']['id']),'c'=>intval($g['0']['id']),'h'=>$han]]:null);
    	                        break;
    	                    case 'product_in_company_in_category_information':
    	                        $ret[][$a]=(!empty($d['handler']) && in_array(trim($han),$d['handler']) &&($e=$this->CI->Category_model->select_where_title_and_status(trim($this->url_return($prop))))!==false&& !empty($e) && !empty($e['0']) && !empty($e['0']['id']) && intval($e['0']['id'])>0 && ($f=$this->CI->Company_model->select_company_where_title_and_status(trim($this->url_return($cat))))!==false && !empty($f) && !empty($f['0']) && !empty($f['0']['id']) && intval($f['0']['id'])>0 &&($g=$this->CI->Product_model->select_product_where_key(trim($this->url_return($com))))!==false && !empty($g) && !empty($g['0']) && !empty($g['0']['id']) && intval($g['0']['id'])>0?[$c=>['p_p'=>intval($e['0']['id']),'c'=>intval($f['0']['id']),'pro'=>intval($g['0']['id']),'h'=>$han]]:null);
    	                        break;
    	                    default:
    	                        $ret=[];
    	                        break;
    	                }
    	        }
	    }
        return $ret;
	}
	public function url_action_checker_six_arg($url,$prop,$cat,$com,$han,$opt){
	    $ret=[];
	    $data=(!empty($_SESSION['id']) && intval($_SESSION['id'])>0?$this->url_user_array:$this->url_array);
	    foreach($data as $a=>$b){
	        if(!empty($a) && !empty($b) && is_array($b) && !empty($b['prop']) && is_array($b['prop']))
    	        foreach($b['prop'] as $c=>$d){
    	            if($d['url']==$this->url_return($url) && $d['query']==6)
    	                switch($d['type']){
    	                    case 'product_in_company_in_category_information':
    	                        $ret[][$a]=(in_array(trim($opt),$d['handler']) &&($e=$this->CI->Category_model->select_where_title_and_status(trim($this->url_return($prop))))!==false&& !empty($e) && !empty($e['0']) && !empty($e['0']['id']) && intval($e['0']['id'])>0 && ($f=$this->CI->Category_model->select_where_title_and_status(trim($this->url_return($cat))))!==false && !empty($f) && !empty($f['0']) && !empty($f['0']['id']) && intval($f['0']['id'])>0 &&($g=$this->CI->Company_model->select_company_where_title_and_status(trim($this->url_return($com))))!==false && !empty($g) && !empty($g['0']) && !empty($g['0']['id']) && intval($g['0']['id'])>0 &&($h=$this->CI->Product_model->select_product_where_key(trim($this->url_return($han))))!==false && !empty($h) && !empty($h['0']) && !empty($h['0']['id']) && intval($h['0']['id'])>0?[$c=>['p_p'=>intval($e['0']['id']),'p'=>intval($f['0']['id']),'c'=>intval($g['0']['id']),'pro'=>intval($h['0']['id']),'h'=>$opt]]:null);
    	                        break;
    	                    default:
    	                        $ret=[];
    	                        break;
    	                }
    	        }
	    }
        return $ret;
	}

	//check

	public function action_click($a,$b){
	    $ret=[];
	    $data=(!empty($_SESSION['id']) && intval($_SESSION['id'])>0?$this->url_user_array:$this->url_array);
        if(!empty($a)&&!empty($b))
	        foreach($data as $c=>$d){
	            if($d['click_function_name']==$a)
	                foreach($d['prop'] as $e=>$f){
	                    if($f['query']==1){
	                        if($f['data']==$b)$ret[]=['status'=>true,'url'=>base_url($f['url']),'title'=>$f['title']];
	                    }elseif($f['query']==2){
	                        switch($f['type']){
	                            case 'category':
	                                $ret[]=(($g=$this->CI->Category_model->select_where_id(intval($b)))!==false && !empty($g) && !empty($g['0']) && !empty($g['0']['title'] && $this->CI->Include_model->add_click(['ip_address'=>$_SERVER['REMOTE_ADDR'],'type'=>$f['url'].DS.$g['0']['title']]))?['status'=>true,'url'=>base_url($this->url_control($f['url']).DS.$this->url_control($g['0']['title'])),'title'=>$g['0']['title']]:[]);
	                                break;
	                            case 'category_in_map':
	                                $ret[]=(($g=$this->CI->Category_model->select_where_id(intval($b)))!==false && !empty($g) && !empty($g['0']) && !empty($g['0']['title'] && $this->CI->Include_model->add_click(['ip_address'=>$_SERVER['REMOTE_ADDR'],'type'=>$f['url'].DS.$g['0']['title']]))?['status'=>true,'url'=>base_url($this->url_control($f['url']).DS.$this->url_control($g['0']['title'])),'title'=>$g['0']['title']]:[]);
	                                break;
	                            default:
	                                $ret=[];
	                                break;
	                        }
	                    }elseif($f['query']==3){
	                        switch($f['type']){
	                            case 'category_in_category':
	                                if(($h=explode('|',$b))!==false && !empty($h) && !empty($h['0']) && !empty($h['1']) && intval($h['0'])>0 && intval($h['1'])>0) $ret[]=(($i=$this->CI->Category_model->select_where_id(intval($h['0'])))!==false && ($j=$this->CI->Category_model->select_where_id(intval($h['1'])))!==false && !empty($i) && !empty($i['0']) && !empty($i['0']['title']) && !empty($j) && !empty($j['0']) && !empty($j['0']['title']) && $this->CI->Include_model->add_click(['ip_address'=>$_SERVER['REMOTE_ADDR'],'type'=>$f['url'].DS.$i['0']['title'].DS.$j['0']['title']])?['status'=>true,'url'=>base_url($this->url_control($f['url']).DS.$this->url_control($i['0']['title']).DS.$this->url_control($j['0']['title'])),'title'=>$j['0']['title']]:[]);
	                                break;
	                            case 'company_in_category':
	                                if(($h=explode('|',$b))!==false && !empty($h) && !empty($h['0']) && !empty($h['1']) && intval($h['0'])>0 && intval($h['1'])>0 && intval($h['2'])==0) 
	                                $ret[]=(($i=$this->CI->Category_model->select_where_id(intval($h['1'])))!==false && 
	                                ($j=$this->CI->Company_model->select_company_where_id_and_status(intval($h['0'])))!==false && !empty($i) && !empty($i['0']) && !empty($i['0']['title']) 
	                                && !empty($j) && !empty($j['0']) && !empty($j['0']['title']) &&
	                                $this->CI->Include_model->add_click(['ip_address'=>$_SERVER['REMOTE_ADDR'],'type'=>$f['url'].DS.$i['0']['title'].DS.$j['0']['title']])?
	                                ['status'=>true,
	                               'url'=>base_url($this->url_control($f['url']).DS.$this->url_control($i['0']['title']).DS.$this->url_control($j['0']['title'])),
	                               'title'=>$j['0']['title']]:[]);
	                                break;
	                            default:
	                                $ret=[];
	                                break;
	                        }
	                    }elseif($f['query']==4){
	                        switch($f['type']){
	                            case 'company_in_category':
	                                if(($h=explode('|',$b))!==false && !empty($h) && !empty($h['0']) && !empty($h['1']) && !empty($h['2']) && intval($h['0'])>0 && intval($h['1'])>0 && intval($h['2'])>0) $ret[]=(($i=$this->CI->Category_model->select_where_id(intval($h['0'])))!==false && !empty($i) && !empty($i['0']) && !empty($i['0']['title']) &&($j=$this->CI->Category_model->select_where_id(intval($h['1'])))!==false &&!empty($j) && !empty($j['0']) && !empty($j['0']['title']) && ($k=$this->CI->Company_model->select_company_where_id_and_status(intval($h['2'])))!==false &&!empty($k) && !empty($k['0']) && !empty($k['0']['title']) && $this->CI->Include_model->add_click(['ip_address'=>$_SERVER['REMOTE_ADDR'],'type'=>$f['url'].DS.$i['0']['title'].DS.$j['0']['title'].DS.$k['0']['title']])?['status'=>true,'url'=>base_url($this->url_control($f['url']).DS.$this->url_control($i['0']['title']).DS.$this->url_control($j['0']['title']).DS.$this->url_control($k['0']['title'])),'title'=>$k['0']['title']]:[]);
	                                break;
	                            case 'product_in_company_in_category':
	                                if(($h=explode('|',$b))!==false && !empty($h) && !empty($h['0']) && !empty($h['1']) && intval($h['0'])>0 && intval($h['1'])>0 && intval($h['2'])==0 && !empty($h['3'])) $ret[]=(trim($h['3'])==$f['handler'] &&($i=$this->CI->Company_model->select_company_where_id_and_status(intval($h['0'])))!==false && !empty($i) && !empty($i['0']) && !empty($i['0']['title'])&&($j=$this->CI->Category_model->select_where_id(intval($h['1'])))!==false &&!empty($j) && !empty($j['0']) && !empty($j['0']['title'])&&$this->CI->Include_model->add_click(['ip_address'=>$_SERVER['REMOTE_ADDR'],'type'=>$f['url'].DS.$j['0']['title'].DS.$i['0']['title'].DS.$f['handler']])?['status'=>true,'url'=>base_url($this->url_control($f['url']).DS.$this->url_control($j['0']['title']).DS.$this->url_control($i['0']['title']).DS.$this->url_control($f['handler'])),'title'=>$i['0']['title']]:[]);
	                                break;
	                            
	                            case 'position_in_company_in_category':
	                               // 0|1|1|position
	                                if(($h=explode('|',$b))!==false && !empty($h) && !empty($h['1']) && intval($h['1']) > 0 && intval($h['2']) > 0 && !empty($h['3'])) 

	                                $ret[]=
	                                (trim($h['3'])==$f['handler'] 
	                                &&
	                                ($i=$this->CI->Company_model->select_company_where_id_and_status(intval($h['2'])))!==false &&
	                                !empty($i) && !empty($i['0']) && !empty($i['0']['title'])&&
	                                ($j=$this->CI->Category_model->select_where_id(intval($h['1'])))!==false &&
	                                !empty($j) && !empty($j['0']) && !empty($j['0']['title'])&&
	                                $this->CI->Include_model->add_click(['ip_address'=>$_SERVER['REMOTE_ADDR'],'type'=>$f['url'].DS.$j['0']['title'].DS.$i['0']['title'].DS.$f['handler']])?['status'=>true,'url'=>base_url($this->url_control($f['url']).DS.$this->url_control($j['0']['title']).DS.$this->url_control($i['0']['title']).DS.$this->url_control($f['handler'])),'title'=>$i['0']['title']]:[]);
	                                break;
	                            default:
	                                $ret=[];
	                                break;
	                        }
	                    }elseif($f['query']==5){
	                        switch($f['type']){
	                            case 'product_in_company_in_category':
	                                if(($h=explode('|',$b))!==false && !empty($h) && !empty($h['0']) && !empty($h['1']) && !empty($h['2']) && intval($h['0'])>0 && intval($h['1'])>0 && intval($h['2'])>0 && !empty($h['3'])) $ret[]=(trim($h['3'])==$f['handler'] &&($i=$this->CI->Category_model->select_where_id(intval($h['0'])))!==false && !empty($i) && !empty($i['0']) && !empty($i['0']['title']) &&($j=$this->CI->Category_model->select_where_id(intval($h['1'])))!==false &&!empty($j) && !empty($j['0']) && !empty($j['0']['title']) && ($k=$this->CI->Company_model->select_company_where_id_and_status(intval($h['2'])))!==false &&!empty($k) && !empty($k['0']) && !empty($k['0']['title']) && $this->CI->Include_model->add_click(['ip_address'=>$_SERVER['REMOTE_ADDR'],'type'=>$f['url'].DS.$i['0']['title'].DS.$j['0']['title'].DS.$k['0']['title'].DS.$h['3']])?['status'=>true,'url'=>base_url($this->url_control($f['url']).DS.$this->url_control($i['0']['title']).DS.$this->url_control($j['0']['title']).DS.$this->url_control($k['0']['title']).DS.$this->url_control($h['3'])),'title'=>$k['0']['title']]:[]);
	                                break;
	                            case 'product_in_company_in_category_information':
	                                if(($h=explode('|',$b))!==false && !empty($h) && !empty($h['0']) && !empty($h['1']) && !empty($h['2']) && intval($h['0'])==0 && intval($h['1'])>0 && intval($h['2'])>0 && intval($h['3'])>0 && !empty($h['3']) && !empty($h['4']))$ret[]=(in_array(trim($h['4']),$f['handler']) && ($i=$this->CI->Category_model->select_where_id(intval($h['1'])))!==false && !empty($i) && !empty($i['0']) && !empty($i['0']['title']) && ($j=$this->CI->Company_model->select_company_where_id_and_status(intval($h['2'])))!==false &&!empty($j) && !empty($j['0']) && !empty($j['0']['title']) && ($k=$this->CI->Product_model->select_product_where_id_and_status(intval($h['3'])))!==false &&!empty($k) && !empty($k['0']) && !empty($k['0']['key']) && $this->CI->Include_model->add_click(['ip_address'=>$_SERVER['REMOTE_ADDR'],'type'=>$f['url'].DS.$i['0']['title'].DS.$j['0']['title'].DS.$k['0']['title'].DS.$h['4']])?['status'=>true,'url'=>base_url($this->url_control($f['url']).DS.$this->url_control($i['0']['title']).DS.$this->url_control($j['0']['title']).DS.$this->url_control($k['0']['title']).DS.$this->url_control($h['4'])),'title'=>(!empty($k['0']['title'])?$k['0']['title']:$k['0']['key'])]:[]);
	                                break;	                           
	                            default:
	                                $ret=[];
	                                break;
	                        }
	                    }elseif($f['query']==6){
	                        switch($f['type']){
	                            case 'product_in_company_in_category_information':
	                                if(($h=explode('|',$b))!==false && !empty($h) && !empty($h['0']) && !empty($h['1']) && !empty($h['2']) && intval($h['0'])>0 && intval($h['1'])>0 && intval($h['2'])>0 && intval($h['3'])>0 && !empty($h['3']) && !empty($h['4'])) $ret[]=(in_array(trim($h['4']),$f['handler']) && ($l=$this->CI->Category_model->select_where_id(intval($h['0'])))!==false && !empty($l) && !empty($l['0']) && !empty($l['0']['title']) && ($i=$this->CI->Category_model->select_where_id(intval($h['1'])))!==false && !empty($i) && !empty($i['0']) && !empty($i['0']['title']) && ($j=$this->CI->Company_model->select_company_where_id_and_status(intval($h['2'])))!==false &&!empty($j) && !empty($j['0']) && !empty($j['0']['title']) && ($k=$this->CI->Product_model->select_product_where_id_and_status(intval($h['3'])))!==false &&!empty($k) && !empty($k['0']) && !empty($k['0']['key']) && $this->CI->Include_model->add_click(['ip_address'=>$_SERVER['REMOTE_ADDR'],'type'=>$f['url'].DS.$l['0']['title'].DS.$i['0']['title'].DS.$j['0']['title'].DS.$k['0']['key'].DS.$h['4']])?['status'=>true,'url'=>base_url($this->url_control($f['url']).DS.$this->url_control($l['0']['title']).DS.$this->url_control($i['0']['title']).DS.$this->url_control($j['0']['title']).DS.$this->url_control($k['0']['key']).DS.$this->url_control($h['4'])),'title'=>(!empty($k['0']['title'])?$k['0']['title']:$k['0']['key'])]:[]);
	                                break;	                           
	                            default:
	                                $ret=[];
	                                break;
	                        }
	                    }
	                }
	        }
	    return $ret;
	}
	
	// inner footer users js
    private function action_function($data,$page){
	    $ret='';
	    if(!empty($page) && is_array($page))
	        foreach($page as $p){
                foreach($p as $a=>$b){
                    if(in_array($a,array_keys($data)))
                        if(is_array($b)&&!is_string($b)){
                            if($a=='category'){
                                foreach($b as $c=>$d){
                                    $e=(($f=$this->CI->Category_model->select_where_id(intval($d)))!==false&&!empty($f) && !empty($f['0']) && !empty($f['0']['title'])?$f['0']['title']:null);
                                    $ret.=$data[$a]['function_name'].'("'.intval($d).'");'."processAjaxData('".$e."',$('#content').html(),'".base_url($this->url_control($c).DS.$this->url_control($e))."');";
                                }
                            }elseif($a=='category_in_category'){
                                foreach($b as $c=>$d){
                                    $h=$this->CI->Category_model->select_where_id(intval($d['p_p']));
                                    $g=(!empty($h) && !empty($h['0']) && !empty($h['0']['title'])?$h['0']['title']:null);
                                    $j=$this->CI->Category_model->select_where_id(intval($d['p']));
                                    $i=(!empty($j) && !empty($j['0']) && !empty($j['0']['title'])?$j['0']['title']:null);
                                    $ret.=$data[$a]['function_name'].'('.intval($d['p']).','.intval($d['p_p']).');'."processAjaxData('".$i."',$('#content').html(),'".base_url($this->url_control($c).DS.$this->url_control($g).DS.$this->url_control($i))."');";
                                }
                                
                            }elseif($a=='company_in_category'){
                                foreach($b as $c=>$d){
                                    $g=(($h=$this->CI->Category_model->select_where_id(intval($d['p_p'])))!==false&&!empty($h) && !empty($h['0']) && !empty($h['0']['title'])?$h['0']['title']:null);
                                    if(!empty($d['p'])){
                                        $i=(($j=$this->CI->Category_model->select_where_id(intval($d['p'])))!==false&&!empty($j) && !empty($j['0']) && !empty($j['0']['title'])?$j['0']['title']:null);
                                    }
                                    $k=(($l=$this->CI->Company_model->select_company_where_id_and_status(intval($d['c'])))!==false&&!empty($l) && !empty($l['0']) && !empty($l['0']['title'])?$l['0']['title']:null);
                                    $ret.=$data[$a]['function_name'].'('.intval($d['c']).','.(!empty($d['p'])?intval($d['p']):0).','.intval($d['p_p']).');'."processAjaxData('".(!empty($i)?$i:$k)."',$('#content').html(),'".(!empty($i)?base_url($this->url_control($c).DS.$this->url_control($g).DS.$this->url_control($i).DS.$this->url_control($k)):base_url($this->url_control($c).DS.$this->url_control($g).DS.$this->url_control($k)))."');";
                                }
                            }elseif($a=='product_in_company_in_category'){
                                foreach($b as $c=>$d){
                                    $g=(($h=$this->CI->Category_model->select_where_id(intval($d['p_p'])))!==false&&!empty($h) && !empty($h['0']) && !empty($h['0']['title'])?$h['0']['title']:null);
                                    if(!empty($d['p'])){
                                        $i=(($j=$this->CI->Category_model->select_where_id(intval($d['p'])))!==false&&!empty($j) && !empty($j['0']) && !empty($j['0']['title'])?$j['0']['title']:null);
                                    }
                                    $k=(($l=$this->CI->Company_model->select_company_where_id_and_status(intval($d['c'])))!==false&&!empty($l) && !empty($l['0']) && !empty($l['0']['title'])?$l['0']['title']:null);
                                    $ret.=$data[$a]['function_name'].'('.intval($d['c']).','.(!empty($d['p'])?intval($d['p']):0).','.intval($d['p_p']).');'."processAjaxData('".(!empty($i)?$i:$k)."',$('#content').html(),'".
                                    (!empty($i)?base_url($this->url_control($c).DS.$this->url_control($g).DS.$this->url_control($i).DS.$this->url_control($k).DS.$this->url_control($d['h'])):base_url($this->url_control($c).DS.$this->url_control($g).DS.$this->url_control($k).DS.$this->url_control($d['h'])))."');";
                                }
                            }elseif($a=='position_in_company_in_category'){
                                foreach($b as $c=>$d){
                                    $g=(($h=$this->CI->Category_model->select_where_id(intval($d['p_p'])))!==false&&!empty($h) && !empty($h['0']) && !empty($h['0']['title'])?$h['0']['title']:null);
                                    if(!empty($d['p'])){
                                        $i=(($j=$this->CI->Category_model->select_where_id(intval($d['p'])))!==false&&!empty($j) && !empty($j['0']) && !empty($j['0']['title'])?$j['0']['title']:null);
                                    }
                                    $k=(($l=$this->CI->Company_model->select_company_where_id_and_status(intval($d['c'])))!==false&&!empty($l) && !empty($l['0']) && !empty($l['0']['title'])?$l['0']['title']:null);
                                    $ret.=$data[$a]['function_name'].'('.intval($d['p_p']).','.intval($d['p']).','.intval($d['c']).');'."processAjaxData('".(!empty($i)?$i:$k)."',$('#content').html(),'".
                                    (!empty($i)?
                                    base_url($this->url_control($c).$this->url_control($g).DS.$this->url_control($i).DS.$this->url_control($k).DS.$this->url_control($d['h'])):
                                        base_url($this->url_control($c).$this->url_control($g).DS.$this->url_control($k).DS.$this->url_control($d['h'])))."');";
                                }
                            }elseif($a=='product_in_company_in_category_information'){
                                foreach($b as $c=>$d){
                                    $g=(($h=$this->CI->Category_model->select_where_id(intval($d['p_p'])))!==false&&!empty($h) && !empty($h['0']) && !empty($h['0']['title'])?$h['0']['title']:null);
                                    if(!empty($d['p'])){
                                        $i=(($j=$this->CI->Category_model->select_where_id(intval($d['p'])))!==false&&!empty($j) && !empty($j['0']) && !empty($j['0']['title'])?$j['0']['title']:null);
                                    }
                                    $k=(($l=$this->CI->Company_model->select_company_where_id_and_status(intval($d['c'])))!==false&&!empty($l) && !empty($l['0']) && !empty($l['0']['title'])?$l['0']['title']:null);
                                    $q=$this->CI->Product_model->select_product_where_id_and_status(intval($d['pro']));
                                    $r=(!empty($q) && !empty($q['0']) && !empty($q['0']['key'])?$q['0']['key']:null);
                                    $ret.=$data[$a]['function_name'].'('.intval($d['p_p']).','.(!empty($d['p'])?intval($d['p']):0).','.intval($d['c']).','.intval($d['pro']).',"'.$d['h'].'");'."processAjaxData('".(!empty($q['0']['title'])?$q['0']['title']:$r)."',$('#content').html(),'".(!empty($i)?base_url($this->url_control($c).DS.$this->url_control($g).DS.$this->url_control($i).DS.$this->url_control($k).DS.$this->url_control($r).DS.$this->url_control($d['h'])):base_url($this->url_control($c).DS.$this->url_control($g).DS.$this->url_control($k).DS.$this->url_control($k).DS.$this->url_control($d['h'])))."');";
                                }
                            }
                        }elseif(is_string($b)&&in_array($b,array_keys($data[$a]['prop']))){
                            $ret.=$data[$a]['function_name'].'("'.$data[$a]['prop'][$b]['data'].'");'."processAjaxData('".$data[$a]['prop'][$b]['title']."',$('#content').html(),'".base_url($data[$a]['prop'][$b]['url'])."');";
                        }
                }
	        }
	    return $ret;
	}

	// check

	public function action($page){
	    $ret = $this->action_function($this->url_array,$page);
	    return (!empty($ret)?$ret:"processAjaxData('خانه',$('#content').html(),'".base_url('home')."');");
	}
	public function user_action($page){
        $ret = $this->action_function($this->url_user_array,$page);
        return (!empty($ret)?$ret:"processAjaxData('داشبورد',$('#content').html(),'".base_url('dashbord')."');");
	}
	
	
	// inner footer users js
	private function url_control($str){
	    return (!empty($str)&&is_string($str)?str_replace(' ','--',$str):'');
	}
	private function url_return($str){
	    return (!empty($str)&&is_string($str)?str_replace('--',' ',$str):'');
	}
}