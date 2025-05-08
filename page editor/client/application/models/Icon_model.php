<?php

class Icon_model extends CI_Model
{
	public function __construct(){
		parent::__construct();
	}
	
    public function icons(){
        return $this->db->query('SELECT * FROM icons')->result_array();
    }
        
    public function edit($data,$id){
        return (is_numeric($id)&&!empty($data)&&!empty($id)?$this->db->update('icons',$data,['id'=>$id]):false);
    }
    
    public function add($data){
        return (!empty($data)?$this->db->insert('icons',$data):false);
    }
    
    public function del($id){
        return (is_numeric($id)&&!empty($id)?$this->db->delete('icons',['id'=>$id]):false);
    }
      
    public function dis($id){
        return (is_numeric($id) && !empty($id)?$this->edit(['status'=>0],$id):false);
    }

    public function en($id){
        return (is_numeric($id) && !empty($id)?$this->edit(['status'=>1],$id):false);
    }
    
    public function s_i_i($id){
        return (is_numeric($id) && !empty($id)?$this->db->get_where('icons',['id'=>$id])->result_array():false);
    }

    public function s_i_w($t,$s,$c){
        return $this->db->get_where('icons',['title'=>$t,'shrtcd'=>$s,'class'=>$c])->result_array();
    }
}