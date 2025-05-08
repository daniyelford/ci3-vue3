<?php
class User_model extends CI_Model
{
	public function __construct(){
		parent::__construct();
	}
	
	public function s_u_w_i($id){
	    return (is_numeric($id) && !empty($id)?$this->db->get_where('users',['id'=>$id])->result_array():false);
	}
	
	public function s_u_w_c($id){
	    return (is_numeric($id) && !empty($id)?$this->db->get_where('users',['code_mely'=>$id])->result_array():false);
	}
	
	public function u_a(){
	    return $this->db->get_where('users',['role'=>'admin'])->result_array();
	}
	
	public function s_u_a(){
	    return $this->db->query("SELECT * FROM users")->result_array();
	}
	
	public function edit($data,$id){
        return (is_numeric($id)&&!empty($data)&&is_array($data)&&!empty($id)?$this->db->update('users',$data,['id'=>$id]):false);
    }
    
    public function del($id){
        return (is_numeric($id)&&!empty($id)?$this->db->delete('users',['id'=>$id]):false);
    }

    public function dis($id){
        return (is_numeric($id) && !empty($id)?$this->edit(['status'=>0],$id):false);
    }

    public function en($id){
        return (is_numeric($id) && !empty($id)?$this->edit(['status'=>1],$id):false);
    }
    
}