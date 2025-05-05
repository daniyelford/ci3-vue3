<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Includes extends MY_Controller
{
    public function __construct(){
		parent::__construct();
	}
    public function fetch(){
		$this->get_price_url('https://example_price_refrence.com/ajax.json');
        $this->change_product_relation();
    }
    private function change_product_relation(){
	    $a=$this->Product_model->select_product_relation_where_array(['status'=>1]);
	    $c=[];
	    if(!empty($a))
	        foreach($a as $b){
	            if(!empty($b) && !empty($b['product_id']) && intval($b['product_id'])>0 && !in_array(intval($b['product_id']),$c)) $c[]=intval($b['product_id']);
	        }
	    if(!empty($c))
	        foreach($c as $d){
	            if(!empty($d) && intval($d)>0 && ($g=$this->Product_model->select_product_where_id(intval($d)))!==false && !empty($g) && !empty($g['0'])){
	                $price=0;
    	            foreach($a as $e){
    	                if(!empty($e) && !empty($e['zarib']) && !empty($e['product_id']) && intval($e['product_id'])>0 && intval($e['product_id'])===intval($d))
    	                    if(!empty($e['auto_change']) && intval($e['auto_change'])>0 && !empty($e['product_price_id']) && intval($e['product_price_id'])>0 && ($f=$this->Product_model->select_product_where_id(intval($e['product_price_id'])))!==false && !empty($f) && !empty($f['0']) && !empty($f['0']['price'])){
    	                        $price+=$f['0']['price']*$e['zarib'];
    	                    }else{
    	                        if(!empty($e['price'])) $price+=$e['price']*$e['zarib'];
    	                    }
    	            }
	                $price+=$price/10;
	                $this->Product_model->edit(['price'=>$price],['id'=>intval($d)]);
	                $this->Product_model->add_product_change_value(['product_id'=>intval($d),'old_value'=>(!empty($g['0']['price'])?$g['0']['price']:0),'new_value'=>$price]);
	            }
	        }
	}
	private function get_price_url($url){
	    $req=json_decode($this->Include_model->resive_data_only($url));
	    if(is_object($req)){
    	    $a = get_object_vars($req);
    	    if(!empty($a) && is_array($a)){
        	    $b=array_keys((array)$a);
        	    for($c=0;$c<=count($b)-1;$c++){
        	        foreach($a[$b[$c]] as $key=>$value){
                        $d=get_object_vars($value);
                        if(!empty($d) && is_array($d) && !empty($d['p']) && ($e=str_replace(',','',$d['p']))!==false && ($e=$e/10)){
                            if(!empty($key) && is_string($key)){
                                $f=['key'=>$key,'status'=>0,'price'=>$e];
                                unset($d['p'],$d['t'],$d['t_en'],$d['t-g'],$d['ts']);
                                $this->set_products_price($key,$d,$f,$e);
                            }elseif((empty($key)||is_int($key)) && !empty($d['name']) && ($g=$d['name'])!==false){
                	            $f=['title'=>(!empty($d['title'])?$d['title']:null),'key'=>$g,'status'=>0,'price'=>$e];
                	            unset($d['p'],$d['title'],$d['name'],$d['t'],$d['t_en'],$d['created_at'],$d['item_id']);
                	            $this->set_products_price($g,$d,$f,$e);
                	        }
                        }
        	        }
        	    }
    	    }
	    }
	}
	private function set_products_price($title,$array,$set,$price){
    	$a=$this->set_product_name($title,$set,$price);
        if(!empty($a) && intval($a)>0){ 
            $this->set_products_informations(intval($a),$array);
        }
	}
	private function set_product_name($str,$set,$price){
	    if(!empty($str) && is_string($str))
	        if(($a=$this->Product_model->select_product_where_key($str))!==false && 
	        !empty($a) && !empty($a['0']) && !empty($a['0']['id']) && intval($a['0']['id'])>0){
	            if($this->Product_model->edit(['price'=>$price],['id'=>intval($a['0']['id'])]) && 
	            $this->Product_model->add_product_change_value(['product_id'=>intval($a['0']['id']),'old_value'=>(!empty($a['0']['price'])?$a['0']['price']:0),'new_value'=>$price]))
    	            return intval($a['0']['id']);
    	        else
    	            return 0;
	        }else{
	            if(($b=$this->Product_model->add_return_id($set))!==false && !empty($b) && intval($b)>0 && $this->Product_model->add_product_category(['product_id'=>intval($b)])) 
	                return intval($b);
	        }
	   return 0;
	}
	private function set_products_informations($id,$arr){
	    if(!empty($id) && intval($id)>0 && !empty($arr) && is_array($arr))
    	    foreach($arr as $key=>$value){
    	        $a=$this->set_products_key($id,$key);
    	        if(!empty($a)&&intval($a)>0) $this->set_product_value($id,$a,$value);
    	    }
	}
	private function set_products_key($id,$str){
	    if(!empty($str) && is_string($str) && !empty($id) && intval($id)>0)
	        if(($a=$this->Product_model->select_product_key_where_array(['product_id'=>intval($id),'key'=>$str]))!==false && !empty($a) && !empty($a['0']) && !empty($a['0']['id']) && intval($a['0']['id'])>0)
	            return intval($a['0']['id']);
	        else
	            if(($b=$this->Product_model->add_product_key_return_id(['product_id'=>intval($id),'key'=>$str]))!==false && !empty($b) && intval($b)>0) 
	                return intval($b);
	   return 0;
	}
	private function set_product_value($id,$key_id,$str){
	    if(($a=$this->Product_model->select_product_value_where_array(['product_id'=>intval($id),'product_key_id'=>intval($key_id)]))!==false && !empty($a) && !empty($a['0']) && !empty($a['0']['id']) && intval($a['0']['id'])>0)
	        if(!empty($str) && is_string($str) && trim($a['0']['title']) !== trim($str))
    	        return $this->Product_model->edit_product_value(['title'=>$str],['id'=>intval($a['0']['id'])]);
	        else
	            return true;
        else
	        return $this->Product_model->add_product_value(['product_id'=>intval($id),'product_key_id'=>intval($key_id),'title'=>$str]);
	}
    // get money price
    public function price(){
        $a=$this->Include_model->money_price_finder('IRR',"USD",1);
        echo((!empty($a)&&!empty($a['info']) && !empty($a['info']['rate']) && intval($a['info']['rate'])>0?number_format($a['info']['rate']).'تومان':'تعیین نشده'));
    }
    // get money price
}