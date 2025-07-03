<?php

class Wallet_model extends CI_Model
{
    public function __construct()
	{
		parent::__construct();
	}
	private $tbl="payment";
	private $info='user_info';
	private $cart="user_cart";
	private $account_withdraws ='user_account_withdraws';
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
}