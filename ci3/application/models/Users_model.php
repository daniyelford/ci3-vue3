<?php

class Users_model extends CI_Model
{
    public function __construct()
	{
		parent::__construct();
	}
	private $tbl="users";
	private $mobile='user_mobile';
	private $info='user_info';
	private $cart="user_cart";
	private $account='user_account';
	private $account_withdraws ='user_account_withdraws';
	private $address='user_address';
	private $credential='user_credentials';
	private function select_where_array_table($tbl,$arr){
	    return (!empty($tbl) && is_string($tbl) && !empty($arr) && is_array($arr)?$this->db->get_where($tbl,$arr)->result_array():false);
	}
	private function select_where_id_table($tbl,$id){
	    return (!empty($tbl) && is_string($tbl) && !empty($id) && intval($id)>0?$this->select_where_array_table($tbl,['id'=>intval($id)]):false);
	}
    private function select_where_in_array_table(String $tbl,String $key,Array $arr){
        if (!empty($tbl) && is_string($tbl) && !empty($arr) && is_array($arr) && !empty($key) && is_string($key)){
            $this->db->where_in($key, $arr);
            return $this->db->get($tbl)->result_array();
        }
        return [];
    }
    private function add_to_table($tbl,$arr){
        return (!empty($tbl) && is_string($tbl) && !empty($arr) && is_array($arr) && $this->db->insert($tbl,$arr));
    }
    private function add_to_table_return_id($tbl,$arr){
        return (!empty($tbl) && is_string($tbl) && !empty($arr) && is_array($arr) && $this->db->insert($tbl,$arr)?$this->db->insert_id():false);
    }
    private function edit_table($tbl,$arr,$where){
        return (!empty($tbl) && is_string($tbl) && !empty($arr) && is_array($arr) && !empty($where) && is_array($where) && $this->db->update($tbl,$arr,$where));
    }
    private function remove_where_array_in_table($tbl,$arr){
        return (!empty($tbl) && is_string($tbl) && !empty($arr) && is_array($arr) && $this->db->delete($tbl, $arr));
    }
    // costum 
    public function select_address_where_news(){
	    return $this->select_where_array_table($this->address,['status'=>'news']);
	}
	public function select_address_where_user_account_id($id){
	    return (!empty($id) && intval($id)?$this->select_where_array_table($this->address,['user_account_id '=>intval($id)]):false);
	}
    public function select_where_id($id){
	    return (!empty($id) && intval($id)?$this->select_where_id_table($this->tbl,intval($id)):false);
	}
    public function select_mobile_where_id($id){
	    return (!empty($id) && intval($id)?$this->select_where_id_table($this->mobile,intval($id)):false);
	}
    public function select_mobile($str){
        return (!empty($str) && is_string($str)?$this->select_where_array_table($this->mobile,['phone'=>$str]):false);
	}
    public function select_account_where_id($id){
	    return (!empty($id) && intval($id)?$this->select_where_id_table($this->account,intval($id)):false);
	}
    public function select_account_where_mobile_id($id){
	    return (!empty($id) && intval($id)?$this->select_where_array_table($this->account,['user_mobile_id'=>intval($id)]):false);
	}
    public function select_account_where_category_ids_array($arr){
	    return (!empty($arr) && is_array($arr)?$this->select_where_in_array_table($this->account,'category_id',$arr):false);
	}
    public function credential_where_user_mobile_id($id){
	    return (!empty($id) && intval($id)?$this->select_where_array_table($this->credential,['user_mobile_id'=>intval($id)]):false);
	}
    public function credential_where_credential_id($id){
	    return (!empty($id) && is_string($id)?$this->select_where_array_table($this->credential,['credential_id'=>$id]):false);
	}
    public function add_return_id($arr){
        return (!empty($arr) && is_array($arr)?$this->add_to_table_return_id($this->tbl,$arr):false);
    }
    public function add_address_return_id($arr){
        return (!empty($arr) && is_array($arr)?$this->add_to_table_return_id($this->address,$arr):false);
    }
    public function add_address($arr){
        return (!empty($arr) && is_array($arr) && $this->add_to_table($this->address,$arr));
    }
    public function add_credential($arr){
        return (!empty($arr) && is_array($arr) && $this->add_to_table($this->credential,$arr));
    }
    public function add_account_return_id($arr){
        return (!empty($arr) && is_array($arr)?$this->add_to_table_return_id($this->account,$arr):false);
    }
    public function add_mobile_return_id($arr){
        return (!empty($arr) && is_array($arr)?$this->add_to_table_return_id($this->mobile,$arr):false);
    }
    public function edit_weher_id($arr,$id){
        return (!empty($id) && intval($id)>0 && !empty($arr) && is_array($arr) && $this->edit_table($this->tbl,$arr,['id'=>intval($id)]));
    }
    public function edit_mobile_weher_id($arr,$id){
        return (!empty($id) && intval($id)>0 && !empty($arr) && is_array($arr) && $this->edit_table($this->mobile,$arr,['id'=>intval($id)]));
    }
    public function edit_credential_where_id($arr,$id){
        return (!empty($id) && intval($id)>0 && !empty($arr) && is_array($arr) && $this->edit_table($this->credential,$arr,['id'=>intval($id)]));
    }
    public function change_address_to_news_where_id($id){
        return (!empty($id) && intval($id)>0 && $this->edit_table($this->address,['status'=>'news'],['id'=>intval($id)]));
    }
}