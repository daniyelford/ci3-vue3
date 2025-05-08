<?php

class Product_model extends CI_Model
{
    public function __construct()
	{
		parent::__construct();
	}
	private $tbl="products";
	private $category="company_category_product_position";
	private $change="product_change_value";
	private $chat="product_chat";
	private $image="product_images";
	private $keys="product_keys";
	private $map="product_map";
	private $tel="product_tel";
	private $value="product_values";
	private $video="product_videos";
	private $relation="product_price_relations";
	
    // select settings
    private function select_all($tbl){
        return (!empty($tbl)&&is_string($tbl)?$this->db->query('SELECT * FROM '.$tbl)->result_array():false);
    }
	private function select_where_array_table($tbl,$arr){
	    return (!empty($tbl) && is_string($tbl) && !empty($arr) && is_array($arr)?$this->db->get_where($tbl,$arr)->result_array():false);
	}
	private function select_where_array_table_order_by_id($tbl,$arr){
	    return (!empty($tbl) && is_string($tbl) && !empty($arr) && is_array($arr)?$this->db->order_by('id', 'DESC')->get_where($tbl,$arr)->result_array():false);
	}
	private function select_where_id_table($tbl,$id){
	    return (!empty($tbl) && is_string($tbl) && !empty($id) && intval($id)>0?$this->select_where_array_table($tbl,['id'=>intval($id)]):false);
	}
	private function select_where_id_and_status_table($tbl,$id){
	    return (!empty($tbl) && is_string($tbl) && !empty($id) && intval($id)>0?$this->select_where_array_table($tbl,['id'=>intval($id),'status'=>1]):false);
	}
	private function select_where_product_id_table($tbl,$id){
	    return (!empty($tbl) && is_string($tbl) && !empty($id) && intval($id)>0?$this->select_where_array_table($tbl,['product_id'=>intval($id)]):false);
	}
	private function select_where_product_id_table_order_by_id($tbl,$id){
	    return (!empty($tbl) && is_string($tbl) && !empty($id) && intval($id)>0?$this->select_where_array_table_order_by_id($tbl,['product_id'=>intval($id)]):false);
	}
	private function select_where_product_id_and_status_table($tbl,$id){
	    return (!empty($tbl) && is_string($tbl) && !empty($id) && intval($id)>0?$this->select_where_array_table($tbl,['product_id'=>intval($id),'status'=>1]):false);
	}
	private function select_where_product_id_and_status_table_order_by_id($tbl,$id){
	    return (!empty($tbl) && is_string($tbl) && !empty($id) && intval($id)>0?$this->select_where_array_table_order_by_id($tbl,['product_id'=>intval($id),'status'=>1]):false);
	}
	private function select_where_key_table($tbl,$key){
	    return (!empty($tbl) && is_string($tbl) && !empty($key) && is_string($key)?$this->select_where_array_table($tbl,['key'=>$key]):false);
	}
	private function select_where_status_table($tbl){
	    return (!empty($tbl) && is_string($tbl)?$this->select_where_array_table($tbl,['status'=>1]):false);
	}
    // end of select settings
    // insert settings
    private function add_to_table($tbl,$arr){
        return (!empty($tbl) && is_string($tbl) && !empty($arr) && is_array($arr) && $this->db->insert($tbl,$arr));
    }
    private function add_to_table_return_id($tbl,$arr){
        return (!empty($tbl) && is_string($tbl) && !empty($arr) && is_array($arr) && $this->db->insert($tbl,$arr)?$this->db->insert_id():false);
    }
    // end of insert settings
    // update settings
    private function edit_table($tbl,$arr,$where){
        return (!empty($tbl) && is_string($tbl) && !empty($arr) && is_array($arr) && !empty($where) && is_array($where) && $this->db->update($tbl,$arr,$where));
    }
    // end of update settings
    // delete settings
    private function remove_where_array_in_table($tbl,$arr){
        return (!empty($tbl) && is_string($tbl) && !empty($arr) && is_array($arr) && $this->db->delete($tbl, $arr));
    }
    // end of delete settings
    // costum select settings
    public function all(){
        return $this->select_all($this->tbl);
    }
    public function all_category(){
        return $this->select_all($this->category);
    }
    // public function all_meet(){
    //     return $this->select_all($this->meet);
    // }
    public function select_change_where_product_id($id){
        return (!empty($id) && intval($id)>0 ?$this->db->query('SELECT * FROM `product_change_value` WHERE `product_id` = '.$id.' ORDER BY `product_change_value`.`time` ASC')->result_array():false);
    }
    public function select_product_where_status(){
        return $this->select_where_status_table($this->tbl);
    }
    public function select_category_where_status(){
        return $this->select_where_status_table($this->category);
    }
    public function select_category_where_id($id){
        return (!empty($id) && intval($id)>0 ?$this->select_where_array_table($this->category,['id'=>intval($id)]):false);
    }
    public function select_category_where_id_and_status($id){
        return (!empty($id) && intval($id)>0 ?$this->select_where_array_table($this->category,['id'=>intval($id),'status'=>1]):false);
    }
    public function select_category_where_product_id($id){
        return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->category,['product_id'=>intval($id)]):false);
    }
    public function select_category_where_product_id_and_status($id){
        return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->category,['product_id'=>intval($id),'status'=>1]):false);
    }
    public function select_category_where_category_id($id){
        return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->category,['category_id'=>intval($id)]):false);
    }
    public function select_category_where_category_id_and_status($id){
        return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->category,['category_id'=>intval($id),'status'=>1]):false);
    }
    public function select_product_where_key($key){
        return (!empty($key) && is_string($key)?$this->select_where_key_table($this->tbl,$key):false);
    }
    public function select_product_where_id($id){
        return (!empty($id) && intval($id)>0?$this->select_where_id_table($this->tbl,intval($id)):false);
    }
    public function select_product_where_id_and_status($id){
        return (!empty($id) && intval($id)>0?$this->select_where_id_and_status_table($this->tbl,intval($id)):false);
    }
    public function select_product_key_where_array($arr){
        return (!empty($arr) && is_array($arr)?$this->select_where_array_table($this->keys,$arr):false);
    }
    public function select_product_key_where_product_id($id){
        return (!empty($id) && intval($id)>0?$this->select_where_product_id_table($this->keys,intval($id)):false);
    }
    public function select_product_key_where_product_id_and_status($id){
        return (!empty($id) && intval($id)>0?$this->select_where_product_id_and_status_table($this->keys,intval($id)):false);
    }
    public function select_map_where_product_id_and_status($id){
        return (!empty($id) && intval($id)>0?$this->select_where_product_id_and_status_table($this->map,intval($id)):false);
    }
    public function select_video_where_product_id($id){
        return (!empty($id) && intval($id)>0?$this->select_where_product_id_table_order_by_id($this->video,intval($id)):false);
    }
    public function select_video_where_product_id_and_status($id){
        return (!empty($id) && intval($id)>0?$this->select_where_product_id_and_status_table_order_by_id($this->video,intval($id)):false);
    }
    public function select_video_where_id($id){
        return (!empty($id) && intval($id)>0 ?$this->select_where_array_table($this->video,['id'=>intval($id)]):false);
    }
    public function select_image_where_id($id){
        return (!empty($id) && intval($id)>0 ?$this->select_where_array_table($this->image,['id'=>intval($id)]):false);
    }
    public function select_image_where_product_id($id){
        return (!empty($id) && intval($id)>0?$this->select_where_product_id_table_order_by_id($this->image,intval($id)):false);
    }
    public function select_image_where_product_id_and_status($id){
        return (!empty($id) && intval($id)>0?$this->select_where_product_id_and_status_table_order_by_id($this->image,intval($id)):false);
    }
    public function select_tel_where_product_id($id){
        return (!empty($id) && intval($id)>0?$this->select_where_product_id_table($this->tel,intval($id)):false);
    }
    public function select_tel_where_product_id_and_status($id){
        return (!empty($id) && intval($id)>0?$this->select_where_product_id_and_status_table($this->tel,intval($id)):false);
    }
    public function select_product_value_where_array($arr){
        return (!empty($arr) && is_array($arr)?$this->select_where_array_table($this->value,$arr):false);
    }
    public function select_product_value_where_product_id($id){
        return (!empty($id) && intval($id)>0?$this->select_where_product_id_table($this->value,intval($id)):false);
    }
    public function select_chat_where_product_id($id){
        return (!empty($id) && intval($id)>0?$this->select_where_product_id_table($this->chat,intval($id)):false);
    }
    public function select_chat_where_id($id){
        return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->chat,['id'=>intval($id)]):false);
    }
    public function select_chat_where_user_id($id){
        return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->chat,['user_id'=>intval($id)]):false);
    }
    public function select_chat_where_parent_id($id){
        return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->chat,['parent_id'=>intval($id)]):false);
    }
    public function select_product_relation_where_array($arr){
        return (!empty($arr) && is_array($arr)?$this->select_where_array_table($this->relation,$arr):false);
    }
    // end of costum select settings
    // costum insert settings
    public function add_return_id($arr){
        return (!empty($arr) && is_array($arr)?$this->add_to_table_return_id($this->tbl,$arr):false);
    }
    public function add_product_return_id($key){
        return (!empty($key) && is_string($key)?$this->add_to_table_return_id($this->tbl,['key'=>$key]):false);
    }
    public function add_product_key_return_id($arr){
        return (!empty($arr) && is_array($arr)?$this->add_to_table_return_id($this->keys,$arr):false);
    }
    public function add_product_category($arr){
        return (!empty($arr) && is_array($arr) && $this->add_to_table($this->category,$arr));
    }
    public function add_product_tel($arr){
        return (!empty($arr) && is_array($arr) && $this->add_to_table($this->tel,$arr));
    }
    public function add_product_value($arr){
        return (!empty($arr) && is_array($arr) && $this->add_to_table($this->value,$arr));
    }
    public function add_product_change_value($arr){
        return (!empty($arr) && is_array($arr) && $this->add_to_table($this->change,$arr));
    }
    public function add_chat($arr){
        return (!empty($arr) && is_array($arr) && $this->add_to_table($this->chat,$arr));
    }
    public function add_image($arr){
        return (!empty($arr) && is_array($arr) && $this->add_to_table($this->image,$arr));
    }
    public function add_video($arr){
        return (!empty($arr) && is_array($arr) && $this->add_to_table($this->video,$arr));
    }
    public function add_map($arr){
        return (!empty($arr) && is_array($arr) && $this->add_to_table($this->map,$arr));
    }
    public function add_relation($arr){
        return (!empty($arr) && is_array($arr) && $this->add_to_table($this->relation,$arr));
    }
    public function add_relation_return_id($arr){
        return (!empty($arr) && is_array($arr)?$this->add_to_table_return_id($this->relation,$arr):false);
    }
    // end of costum insert settings
    // costum update settings
    public function edit($arr,$where){
        return (!empty($arr) && is_array($arr) && !empty($where) && is_array($where) && $this->edit_table($this->tbl,$arr,$where));
    }
    public function edit_tel($arr,$where){
        return (!empty($arr) && is_array($arr) && !empty($where) && is_array($where) && $this->edit_table($this->tel,$arr,$where));
    }
    public function edit_product_key($arr,$where){
        return (!empty($arr) && is_array($arr) && !empty($where) && is_array($where) && $this->edit_table($this->keys,$arr,$where));
    }
    public function edit_product_value($arr,$where){
        return (!empty($arr) && is_array($arr) && !empty($where) && is_array($where) && $this->edit_table($this->value,$arr,$where));
    }
    public function edit_category_weher_category_id($arr,$id){
        return (!empty($id) && intval($id)>0 && !empty($arr) && is_array($arr) && $this->edit_table($this->category,$arr,['category_id'=>intval($id)]));
    }
    public function edit_chat($arr,$where){
        return (!empty($arr) && is_array($arr) && !empty($where) && is_array($where) && $this->edit_table($this->chat,$arr,$where));
    }
    public function edit_relation($arr,$where){
        return (!empty($arr) && is_array($arr) && !empty($where) && is_array($where) && $this->edit_table($this->relation,$arr,$where));
    }
    // end of costum update settings
    // costum delete settings
    public function remove_chat($id){
        return (!empty($id) && intval($id)>0 && $this->remove_where_array_in_table($this->chat,['id'=>intval($id)]));
    }
    public function remove_image($id){
        return (!empty($id) && intval($id)>0 && $this->remove_where_array_in_table($this->image,['id'=>intval($id)]));
    }
    public function remove_video($id){
        return (!empty($id) && intval($id)>0 && $this->remove_where_array_in_table($this->video,['id'=>intval($id)]));
    }
    public function remove_map($id){
        return (!empty($id) && intval($id)>0 && $this->remove_where_array_in_table($this->map,['id'=>intval($id)]));
    }
    public function remove_relation($id){
        return (!empty($id) && intval($id)>0 && $this->remove_where_array_in_table($this->relation,['id'=>intval($id)]));
    }
    public function remove_key($id){
        return (!empty($id) && intval($id)>0 && $this->remove_where_array_in_table($this->keys,['id'=>intval($id)]) && $this->remove_where_array_in_table($this->value,['product_key_id'=>intval($id)]));
    }
    public function remove($id){
        if(!empty($id) && intval($id)>0){
            $this->remove_where_array_in_table($this->tbl,['id'=>intval($id)]);
            $a=$this->select_category_where_product_id(intval($id));
            // foreach($a as $b){
            //     $this->remove_where_array_in_table($this->meet,['product_category_id'=>intval($b['id'])]);  
            // }
            $this->remove_where_array_in_table($this->category,['product_id'=>intval($id)]);        
            $this->remove_where_array_in_table($this->change,['product_id'=>intval($id)]);
            $this->remove_where_array_in_table($this->chat,['product_id'=>intval($id)]);
            $this->remove_where_array_in_table($this->image,['product_id'=>intval($id)]);
            $this->remove_where_array_in_table($this->keys,['product_id'=>intval($id)]);
            $this->remove_where_array_in_table($this->map,['product_id'=>intval($id)]);
            $this->remove_where_array_in_table($this->tel,['product_id'=>intval($id)]);
            $this->remove_where_array_in_table($this->value,['product_id'=>intval($id)]);
            $this->remove_where_array_in_table($this->video,['product_id'=>intval($id)]);
            die('1');
        }
        die('0');
    }
    
    // end of costum delete settings
}