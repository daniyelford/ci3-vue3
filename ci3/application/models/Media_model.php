<?php

class Media_model extends CI_Model
{
    public function __construct(){
		parent::__construct();
	}
    private $tbl='media';
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
    private function edit_array_same_data_table($tbl,$key,$where_keys_value,$arr){
        if(!empty($tbl) && is_string($tbl) && 
        !empty($key) && is_string($key) && 
        !empty($arr) && is_array($arr) && 
        !empty($where_keys_value) && is_array($where_keys_value)){
            $this->db->where_in($key, $where_keys_value);
            $this->db->update($tbl, $arr);
            return true;
        }
        return false;
    }
    private function remove_where_array_in_table($tbl,$arr){
        return (!empty($tbl) && is_string($tbl) && !empty($arr) && is_array($arr) && $this->db->delete($tbl, $arr));
    }
    // costum
    public function select_where_id($id){
	    return (!empty($id) && intval($id)?$this->select_where_id_table($this->tbl,intval($id)):false);
	}
    public function select_where_news_used(){
	    return $this->select_where_array_table($this->tbl,['upload_place'=>'addNews','used_status'=>'used']);
	}
    public function select_where_report_used(){
	    return $this->select_where_array_table($this->tbl,['upload_place'=>'report','used_status'=>'used']);
	}
    public function add($arr){
        return (!empty($arr) && is_array($arr) && $this->add_to_table($this->tbl,$arr));
    }
    public function add_return_id($arr){
        return (!empty($arr) && is_array($arr)?$this->add_to_table_return_id($this->tbl,$arr):false);
    }
    public function edit_weher_id($arr,$id){
        return (!empty($id) && intval($id)>0 && !empty($arr) && is_array($arr) && $this->edit_table($this->tbl,$arr,['id'=>intval($id)]));
    }
    public function change_used_status_where_array_ids($arr){
        return (!empty($arr) && is_array($arr) && $this->edit_array_same_data_table($this->tbl,'id',$arr,['used_status'=>'used']));
    }
    public function remove_where_id($id){
	    return (!empty($id) && intval($id) && $this->remove_where_array_in_table($this->tbl,['id'=>intval($id)]));
	}
	public function remove_file($str){
	    return (!empty($str) && is_string($str) && @unlink($str));
	}
}