<?php

class Site_user_model extends CI_Model
{
	public function __construct(){
		parent::__construct();
	}

    public function dis($id){
        return (is_numeric($id) && !empty($id)?$this->edit(['status'=>0],$id):false);
    }

    public function en($id){
        return (is_numeric($id) && !empty($id)?$this->edit(['status'=>1],$id):false);
    }
    
    public function end($id){
        return (is_numeric($id) && !empty($id)?$this->edit(['status'=>2],$id):false);
    }
    
    public function edit($data,$id){
        return (is_numeric($id)&&!empty($data)&&!empty($id)&&is_array($data)?$this->db->update('site_user',$data,['id'=>$id]):false);
    }
    
    public function del($id){
        return (is_numeric($id)&&!empty($id)?$this->db->delete('site_user',['id'=>$id]):false);
    }
    
    public function add($data){
        return (!empty($data) && is_array($data)?$this->db->insert('site_user',$data):false);
    } 
    
    public function ssuwArr($data){
        return (!empty($data) && is_array($data)?$this->db->get_where('site_user',$data)->result_array():false);
    }
    
    public function s_all(){
        return $this->db->query("SELECT * FROM site_user")->result_array();
    }
    
}