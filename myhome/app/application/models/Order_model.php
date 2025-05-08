<?php

class Order_model extends CI_Model
{
    public function __construct()
	{
		parent::__construct();
	}
	private $wallet="wallet";
    private $tbl="package";
    private $order_package="package_company_order";
    private $pay='payment';
    private $wallet_payment="wallet_payment";
    private function select_where_array_table($tbl,$arr){
	    return (!empty($tbl) && is_string($tbl) && !empty($arr) && is_array($arr)?$this->db->get_where($tbl,$arr)->result_array():false);
	}
	private function edit_table($tbl,$arr,$where){
        return (!empty($tbl) && is_string($tbl) && !empty($arr) && is_array($arr) && !empty($where) && is_array($where) && $this->db->update($tbl,$arr,$where));
    }
	
    public function select_package_where_id($id){
		return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->tbl,['id'=>intval($id)]):false);
	}
    public function all_package_status(){
        return $this->select_where_array_table($this->tbl,['status'=>1]);
    }
	public function select_package_order_where_id($id){
		return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->order_package,['id'=>intval($id)]):false);
	}
	public function select_package_order_where_payment_id($id){
		return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->order_package,['payment'=>intval($id)]):false);
	}
	public function select_package_order_where_company_id($id){
		return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->order_package,['company_id'=>intval($id)]):false);
	}
	public function select_package_order_where_company_id_and_package_id($id,$p_id){
		return (!empty($id) && intval($id)>0 && !empty($p_id) && intval($p_id)>0?$this->select_where_array_table($this->order_package,['company_id'=>intval($id),'package'=>intval($p_id)]):false);
	}
	public function select_payment_where_id($id){
		return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->pay,['id'=>intval($id)]):false);
	}
	public function select_payment_where_user_id_seller($id){
		return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->pay,['user_id_seller'=>intval($id)]):false);
	}
	public function select_wallet_where_id($id){
		return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->wallet,['id'=>intval($id)]):false);
	}
	public function select_wallet_where_user_id($id){
		return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->wallet,['user_id'=>intval($id)]):false);
	}
	public function select_wallet_where_self_wallet_action(){
		return $this->select_where_array_table($this->wallet_payment,['self_wallet_action'=>1]);
	}
	public function select_wallet_where_wallet_id($id){
		return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->wallet_payment,['wallet_id'=>intval($id)]):false);
	}
	public function select_wallet_where_seller_wallet_id($id){
		return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->wallet_payment,['seller_wallet_id'=>intval($id)]):false);
	}
	public function select_wallet_where_payment_id($id){
		return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->wallet_payment,['payment_id'=>intval($id)]):false);
	}
	private function add_to_table($tbl,$arr){
        return (!empty($tbl) && is_string($tbl) && !empty($arr) && is_array($arr) && $this->db->insert($tbl,$arr));
    }
    private function add_to_table_return_id($tbl,$arr){
        return (!empty($tbl) && is_string($tbl) && !empty($arr) && is_array($arr) && $this->db->insert($tbl,$arr)?$this->db->insert_id():false);
    }
	public function add_wallet_payemt($arr){
	    return (!empty($arr) && is_array($arr) && $this->add_to_table($this->wallet_payment,$arr));    
	}	
	public function add_pay($arr){
	    return (!empty($arr) && is_array($arr) && $this->add_to_table($this->pay,$arr));    
	}
    public function add_wallet($arr){
	    return (!empty($arr) && is_array($arr) && $this->add_to_table($this->wallet,$arr));    
	}
	public function add_wallet_return_id($arr){
	    return (!empty($arr) && is_array($arr)?$this->add_to_table_return_id($this->wallet,$arr):false);
	}
	public function add_payment_return_id($arr){
	    return (!empty($arr) && is_array($arr)?$this->add_to_table_return_id($this->pay,$arr):false);
	}
    public function add_order_package($arr){
	    return (!empty($arr) && is_array($arr) && $this->add_to_table($this->order_package,$arr));    
	}
	public function edit_order_package_weher_id($arr,$id){
        return (!empty($id) && intval($id)>0 && !empty($arr) && is_array($arr) && $this->edit_table($this->order_package,$arr,['id'=>intval($id)]));
    }
    public function edit_wallet_payment_weher_id($arr,$id){
        return (!empty($id) && intval($id)>0 && !empty($arr) && is_array($arr) && $this->edit_table($this->wallet_payment,$arr,['id'=>intval($id)]));
    }
    public function edit_pay_weher_id($arr,$id){
        return (!empty($id) && intval($id)>0 && !empty($arr) && is_array($arr) && $this->edit_table($this->pay,$arr,['id'=>intval($id)]));
    }
}