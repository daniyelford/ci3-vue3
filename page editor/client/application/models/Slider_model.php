<?php
class Slider_model extends CI_Model
{
	public function __construct(){
		parent::__construct();
	}

    public function slider($id){
        return (is_numeric($id) && !empty($id)?$this->db->get_where('slider',['id'=>$id])->result_array():false);
    }

    public function s_s(){
        return $this->db->query("SELECT * FROM slider")->result_array();
    }

    public function edit($data,$id){
        return (is_numeric($id)&&!empty($data)&&!empty($id)?$this->db->update('slider',$data,['id'=>$id]):false);
    }
    
    public function add($data){
        return (!empty($data)?$this->db->insert('slider',$data):false);
    }
    
    public function del($id){
        return (is_numeric($id)&&!empty($id)?$this->db->delete('slider',['id'=>$id]):false);
    }
      
    public function dis($id){
        return (is_numeric($id) && !empty($id)?$this->edit(['status'=>0],$id):false);
    }

    public function en($id){
        return (is_numeric($id) && !empty($id)?$this->edit(['status'=>1],$id):false);
    }	
      
    public function pic($id){
        return (is_numeric($id) && !empty($id)?$this->db->get_where('pic',['id'=>$id])->result_array():false);
    }
	
	public function pics(){
        return $this->db->query("SELECT * FROM pic")->result_array();
    }

}