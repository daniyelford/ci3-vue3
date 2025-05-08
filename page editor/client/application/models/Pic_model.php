<?php

class Pic_model extends CI_Model
{
	public function __construct(){
		parent::__construct();
	}
    public function all_pictures(){
       return $this->db->query("SELECT * FROM pic")->result_array();
    }
    
    public function img_create($data){
        return (!empty($data)?$this->db->insert('pic',$data):false);
    }
    
    public function img_create_user($data){
        return (!empty($data)?$this->db->insert('pic_user',$data):false);
    }
}