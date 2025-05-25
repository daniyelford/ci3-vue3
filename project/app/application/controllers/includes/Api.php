<?php
defined('BASEPATH') or exit('No direct script access allowed');
// header('Access-Control-Allow-Origin: *');
// header("Access-Control-Allow-Methods: GET, OPTIONS");
class Api extends MY_Controller
{
	public function __construct(){
		parent::__construct();
	}
	public function manager(){
	    $arr=[];
	    if(!empty($_POST['token']) && $_POST['token']==='ok'){
	        if(($a=$this->Include_model->all())!==false && !empty($a))
	            foreach($a as $b){
	                if(!empty($b['company_id']) && intval($b['company_id'])>0 && !empty($b['category_id']) && intval($b['category_id'])>0 && ($c=$this->Company_model->select_company_where_id(intval($b['company_id'])))!==false && !empty($c) && !empty($c['0']) && ($d=$this->Category_model->select_where_id(intval($b['category_id'])))!==false && !empty($d) && !empty($d['0'])) $arr[]=['id'=>$b['id'],'status'=>$b['status'],'category'=>$d['0'],'company'=>$c['0'],'url'=>$b['url']];
	            }
            echo $this->load->view('includes/api/manager',['data'=>$arr],true);
	    }else{
	        echo $this->load->view('errors/500',[],true);
	    }
	}
    public function company_manager_show(){
        if(!empty($_POST['company_id']) && intval($_POST['company_id'])>0)
	        echo $this->load->view('includes/api/company_manager_show',['api'=>$this->Include_model->select_where_company_id(intval($_POST['company_id'])),'category'=>$this->Category_model->select_where_status()],true);
	    else
	        echo $this->load->view('errors/500',[],true);
    }
    public function category($key){
        if(!empty($key) && is_string($key) && ($key=str_replace(['and','update','insert','select','delete','"',"'"],'',$key))!==false && ($a=$this->Include_model->select_where_key_and_status($key))!==false && !empty($a) && !empty($a['0']) && !empty($a['0']['category_id']) && intval($a['0']['category_id'])>0)
            echo json_encode($this->category_product_finder($a['0']['category_id']));
        else
            echo $this->load->view('errors/500',[],true);
    }
    private $product_id=[];
    private function category_product_finder($id){
        $ret=$arr=$child=[];
        if(!empty($id) && intval($id)>0 && ($a=$this->Category_model->select_where_id(intval($id)))!==false && !empty($a) && !empty($a['0']) && 
        ($b=$this->Company_model->select_category_product_where_category_id_and_status(intval($id)))!==false && 
        ($c=$this->Product_model->select_category_where_category_id_and_status(intval($id)))!==false){
            foreach($b as $d){
                if(!empty($d['product_id']) && intval($d['product_id'])>0 && !in_array(intval($d['product_id']),$this->product_id) && ($e=$this->product_finder(intval($d['product_id'])))!==false && !empty($e))
                    $arr[]=$e;
            }
            foreach($c as $f){
                if(!empty($f['product_id']) && intval($f['product_id'])>0 && !in_array(intval($f['product_id']),$this->product_id) && ($g=$this->product_finder(intval($f['product_id'])))!==false && !empty($g))
                    $arr[]=$g;
            }
            if(($h=$this->Category_model->select_where_parent_id_and_status(intval($id)))!==false && !empty($h))
                foreach($h as $i){
                    if(!empty($i['id']) && intval($i['id'])>0)
                        $child[]=$this->category_product_finder(intval($i['id']));
                }
            $ret=['name'=>$a['0']['title'],'products'=>$arr,'children'=>$child];
        }    
        return $ret;
    }
    private function product_finder($id){
        $arr=$f=[];
        if(!empty($id) && intval($id)>0 && ($a=$this->Product_model->select_product_where_id_and_status(intval($id)))!==false && !empty($a) && !empty($a['0']) && ($b=$this->Product_model->select_product_key_where_product_id_and_status(intval($id)))!==false && !empty($b) && ($c=$this->Product_model->select_product_value_where_product_id(intval($id)))!==false && !empty($c)){
            $this->product_id[]=intval($id);
            foreach($b as $d){
                if(!empty($d['id']) && intval($d['id'])>0)
                    foreach($c as $e){
                        if(!empty($e['product_key_id']) && intval($d['id'])===intval($e['product_key_id']) && !empty($e['title']))
                            $f[]=['key'=>(!empty($d['title'])?$d['title']:$d['key']),'value'=>$e['title']];
                    }
            }
            $arr[]=['product_name'=>(!empty($a['0']['title'])?$a['0']['title']:$a['0']['key']),'product_info'=>$f];
        }
        return $arr;
    }
    
    
    
    
    // public function test(){
    //     echo 'hi';
    // }
    
}