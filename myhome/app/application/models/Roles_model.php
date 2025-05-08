<?php

class Roles_model extends CI_Model
{
    public function __construct()
	{
		parent::__construct();
	}
	private $tbl='roles';
	private $company_role='company_role';
	private $company_user='company_user';
    // selects
	private function select_where_array_table($tbl,$arr){
	    return (!empty($tbl) && is_string($tbl) && !empty($arr) && is_array($arr)?$this->db->get_where($tbl,$arr)->result_array():false);
	}
	private function select_where_id_table($tbl,$id){
	    return (!empty($tbl) && is_string($tbl) && !empty($id) && intval($id)>0?$this->select_where_array_table($tbl,['id'=>intval($id)]):false);
	}
	private function select_where_id_and_status_table($tbl,$id){
	    return (!empty($tbl) && is_string($tbl) && !empty($id) && intval($id)>0?$this->select_where_array_table($tbl,['id'=>intval($id),'status'=>1]):false);
	}
	private function select_where_status_table($tbl){
	    return (!empty($tbl) && is_string($tbl)?$this->select_where_array_table($tbl,['status'=>1]):false);
	}
    // end of selects
    // inserts
    private function add_to_table($tbl,$arr){
        return (!empty($tbl) && is_string($tbl) && !empty($arr) && is_array($arr) && $this->db->insert($tbl,$arr));
    }
    private function add_to_table_return_id($tbl,$arr){
        return (!empty($tbl) && is_string($tbl) && !empty($arr) && is_array($arr) && $this->db->insert($tbl,$arr)?$this->db->insert_id():false);
    }
    // end of inserts
    // updates
    private function edit_table($tbl,$arr,$where){
        return (!empty($tbl) && is_string($tbl) && !empty($arr) && is_array($arr) && !empty($where) && is_array($where) && $this->db->update($tbl,$arr,$where));
    }
    // end of updates
    // deletes
    private function remove_where_array_in_table($tbl,$arr){
        return (!empty($tbl) && is_string($tbl) && !empty($arr) && is_array($arr) && $this->db->delete($tbl, $arr));
    }
    // end of deletes
    // select
    public function all_user(){
        return $this->db->query("SELECT * FROM ".$this->user)->result_array();
    }
    public function all_where_status(){
        return $this->select_where_status_table($this->tbl);
    }
    public function select_where_id_and_status($id){
        return (!empty($id)&&intval($id)>0?$this->select_where_id_and_status_table($this->tbl,intval($id)):false);
    }
    public function select_company_user_where_status(){
        return $this->select_where_status_table($this->company_user);
    }
    public function select_company_user_where_array($arr){
        return (!empty($arr) && is_array($arr)?$this->select_where_array_table($this->company_user,$arr):false);
    }
    public function select_company_user_where_id($id){
        return (!empty($id) && intval($id)>0?$this->select_where_id_and_status_table($this->company_user,intval($id)):false);
    }
    public function select_company_user_where_user_id($id){
        return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->company_user,['user_id'=>intval($id)]):false);
    }
    public function select_company_user_where_user_id_and_status($id){
        return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->company_user,['user_id'=>intval($id),'status'=>1]):false);
    }
    public function select_company_user_where_company_role_parent_id_and_status($id){
        return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->company_user,['company_role_parent_id'=>intval($id),'status'=>1]):false);
    }
    public function select_company_user_where_company_role_id($id){
        return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->company_user,['company_role_id'=>intval($id)]):false);
    }
    public function select_company_user_where_company_role_id_and_status($id){
        return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->company_user,['company_role_id'=>intval($id),'status'=>1]):false);
    }
    public function select_company_role_where_array($arr){
        return (!empty($arr) && is_array($arr)?$this->select_where_array_table($this->company_role,$arr):false);
    }
    public function select_company_role_where_company_id($id){
        return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->company_role,['company_id'=>intval($id),'status'=>1]):false);
    }
    public function select_company_role_where_id($id){
        return (!empty($id) && intval($id)>0?$this->select_where_id_and_status_table($this->company_role,intval($id)):false);
    }
    //select
    // insert
    public function add_company_role_return_id($arr){
        return (!empty($arr)&&is_array($arr)?$this->add_to_table_return_id($this->company_role,$arr):false);
    }
    public function add_company_user($arr){
        return (!empty($arr)&&is_array($arr)&&$this->add_to_table($this->company_user,$arr));
    }
    // insert
    // update
    public function edit_company_user_where_id($arr,$id){
        return (!empty($arr) && is_array($arr) && !empty($id) && intval($id)>0 && $this->db->update($this->company_user,$arr,['id'=>intval($id)]));
    }
    
    
}