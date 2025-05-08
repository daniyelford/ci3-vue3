<?php
class Box_model extends CI_Model
{
	public function __construct(){
		parent::__construct();
	}
	
	public function box($id){
	    return (!empty($id) && is_numeric($id)?$this->db->get_where('boxs',['id'=>$id])->result_array():false);
	}

    public function s_b(){
        return $this->db->query("SELECT * FROM boxs")->result_array();
    }
    
    public function pics(){
        return $this->db->query("SELECT * FROM pic")->result_array();
    }

    public function pic($id){
	    return (!empty($id) && is_numeric($id)?$this->db->get_where('pic',['id'=>$id])->result_array():false);
	}

    public function edit($data,$id){
        return (is_numeric($id)&&!empty($data)&&!empty($id)?$this->db->update('boxs',$data,['id'=>$id]):false);
    }
    
    public function add($data){
        return (!empty($data)?$this->db->insert('boxs',$data):false);
    }
    
    public function del($id){
        return (is_numeric($id)&&!empty($id)?$this->db->delete('boxs',['id'=>$id]):false);
    }
      
    public function dis($id){
        return (is_numeric($id) && !empty($id)?$this->edit(['status'=>0],$id):false);
    }

    public function en($id){
        return (is_numeric($id) && !empty($id)?$this->edit(['status'=>1],$id):false);
    }	
	
}