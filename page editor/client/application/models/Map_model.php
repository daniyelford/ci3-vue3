<?php
class Map_model extends CI_Model
{
	public function __construct(){
		parent::__construct();
	}
	
	protected $table = 'map';
	
	public function insert_data($data){
	    return $this->db->insert($this->table,$data);
	}
	
	public function get_id($data){
	    return (!empty($data) && is_array($data)?$this->db->get_where($this->table,$data)->result_array():false);
	}
	
	public function delete_data($data){
	    return (!empty($data) && is_array($data)?$this->db->delete($this->table,$data):false);
	}
	public function select_where($con){
	    return (!empty($con) && is_array($con)?$this->db->get_where($this->table,$con)->result_array():false);
	}
	public function s_a(){
	    return $this->db->query("SELECT * FROM ".$this->table)->result_array();
	}
	
	public function edit($data,$id){
        return (is_numeric($id)&&!empty($data)&&!empty($id)?$this->db->update($this->table,$data,['id'=>$id]):false);
    }
}