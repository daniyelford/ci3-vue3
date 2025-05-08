<?php

class Post_model extends CI_Model
{
	public function __construct(){
		parent::__construct();
	}

    public function pro($data){
        return (!empty($data) && is_array($data)?$this->db->insert('pro',$data):false);
    }

    public function dis($id){
        return (is_numeric($id) && !empty($id)?$this->edit(['status'=>0],$id):false);
    }

    public function en($id){
        return (is_numeric($id) && !empty($id)?$this->edit(['status'=>1],$id):false);
    }

    public function show_post(){
        return $this->db->query("SELECT * FROM posts")->result_array();
    }
    	
    public function s_p($data){
        return (!empty($data)?$this->db->get_where('posts',$data)->result_array():false);
    }
    
    public function show_pic(){
        return $this->db->query("SELECT * FROM pic")->result_array();
    }
    
    public function add_post($data){
        return (!empty($data)?$this->db->insert('posts',$data):false);
    } 
    
    public function p_s($data){
        return (!empty($data)?$this->db->get_where('pic',$data)->result_array():false);
    }
    
     public function p_s_n($id){
        return $this->db->get_where('pic',['id'=>$id])->result_array();
    }
    
    public function edit($data,$id){
        return (is_numeric($id)&&!empty($data)&&!empty($id)?$this->db->update('posts',$data,['id'=>$id]):false);
    }
    
    public function del($id){
        return (is_numeric($id)&&!empty($id)?$this->db->delete('posts',['id'=>$id]):false);
    }
}