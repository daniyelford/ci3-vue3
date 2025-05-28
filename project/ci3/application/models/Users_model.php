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
	private function select_where_array_table($tbl,$arr){
	    return (!empty($tbl) && is_string($tbl) && !empty($arr) && is_array($arr)?$this->db->get_where($tbl,$arr)->result_array():false);
	}
	private function select_where_id_table($tbl,$id){
	    return (!empty($tbl) && is_string($tbl) && !empty($id) && intval($id)>0?$this->select_where_array_table($tbl,['id'=>$id]):false);
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
	public function select_mobile($str){
	    return (!empty($str) && is_string($str)?$this->select_where_array_table($this->mobile,['phone'=>$str]):false);
	}
    public function select_account_where_mobile_id($id){
	    return (!empty($id) && intval($id)?$this->select_where_array_table($this->account,['user_mobile_id'=>intval($id)]):false);
	}
    public function add_return_id($arr){
        return (!empty($arr) && is_array($arr)?$this->add_to_table_return_id($this->tbl,$arr):false);
    }
    public function add_account_return_id($arr){
        return (!empty($arr) && is_array($arr)?$this->add_to_table_return_id($this->account,$arr):false);
    }
    public function add_mobile_return_id($arr){
        return (!empty($arr) && is_array($arr)?$this->add_to_table_return_id($this->mobile,$arr):false);
    }
    public function edit_mobile_weher_id($arr,$id){
        return (!empty($id) && intval($id)>0 && !empty($arr) && is_array($arr) && $this->edit_table($this->mobile,$arr,['id'=>intval($id)]));
    }
}