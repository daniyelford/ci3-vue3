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
	private $order="orders";
    private $product='product';
	private $account_withdraws ='user_account_withdraws';
	private function select_where_array_table($tbl,$arr){
	    return (!empty($tbl) && is_string($tbl) && !empty($arr) && is_array($arr)?$this->db->get_where($tbl,$arr)->result_array():false);
	}
	private function select_where_id_table($tbl,$id){
	    return (!empty($tbl) && is_string($tbl) && !empty($id) && intval($id)>0?$this->select_where_array_table($tbl,['id'=>intval($id)]):false);
	}
    private function select_where_or_where_order_table($tbl,$where,$orwhere,$con){
	    if (!empty($tbl) && is_string($tbl) && !empty($where) && is_string($where) && !empty($orwhere) && is_string($orwhere) && !empty($con)){
            $this->db->where($where, $con);
            $this->db->or_where($orwhere, $con);
            return $this->db->order_by('created_at', 'DESC')->get($tbl)->result_array();
        }
        return false;
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
    public function select_payment_info_where_user_account_id($id){
        return (!empty($id) && intval($id)>0 ? $this->select_where_or_where_order_table($this->tbl,'pay_money_user_account_id','give_money_user_account_id', intval($id)) : false);
    }
    public function select_carts_where_id($id){
        return (!empty($id) && intval($id)>0 ? $this->select_where_id_table($this->cart, $id) : false);
    }
    public function select_carts_where_user_id($id){
        return (!empty($id) && intval($id)>0 ? $this->select_where_array_table($this->cart, ['user_id' => $id]) : false);
    }
    public function select_account_withdraws_where_user_account_ids($id){
        return (!empty($id) && intval($id)>0 ? $this->select_where_array_table($this->account_withdraws, ['user_account_id' => $id]) : false);
    }
    public function select_carts_where_in_cart_ids($cart){
        return (!empty($account_ids) && is_array($cart) ? $this->select_where_in_array_table($this->cart, 'id', $cart): []);
    }
    public function add_withdraw($arr){
        return (!empty($arr) && is_array($arr) ? $this->add_to_table($this->account_withdraws, $arr) : false);
    }
    public function add_cart($arr){
        return (!empty($arr) && is_array($arr) && $this->add_to_table($this->cart,$arr));
    }
    public function add_payement($arr){
        return (!empty($arr) && is_array($arr) && $this->add_to_table($this->tbl,$arr));
    }
    public function remove_cart_where_id($id){
	    return (!empty($id) && intval($id) && $this->remove_where_array_in_table($this->cart,['id'=>intval($id)]));
	}

}