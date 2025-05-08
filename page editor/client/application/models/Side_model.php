<?php

class Side_model extends CI_Model
{
	public function __construct(){
		parent::__construct();
	}

   public function select_row_where($tbl,$row='',$con=''){
        if(!empty($tbl)){
            if(empty($row))$row="*";
            return (empty($con))?$this->db->query("select $row from $tbl where status=1")->result_array():$this->db->query("select $row from $tbl where status=1 and $con")->result_array();
        }
        return false;
    }
	
	public function sides(){
	    return $this->db->query("SELECT * FROM sidebars_place")->result_array();
	}
    
    public function side_w_id($id){
        return $this->s_w_s_d(['id'=>$id]);
    }
    
    public function fetch_id_sides($place='',$a='*'){
        if(!empty($place)){
            return $this->select_row_where('sidebars_place',$a,"place = '$place'");
        }
        return $this->select_row_where('sidebars_place',$a);
    }
        
    public function set_foot_loc($data,$con1,$con2){
        $s=$this->s_w_s_d($data); 
        $foot_id=$s['0']['id'];
        return $this->db->query();
        
    }
    
    public function s_w_s_d($data){
        return (!empty($data)?$this->db->get_where('sidebars_place',$data)->result_array():false);
    }
    
    public function s_w_m_s_i($id){
        return (!empty($data)?$this->db->get_where('menu',['side_id'=>$id,'status'=>1])->result_array():false);
    }
    
    public function edit($data,$id){
        return (is_numeric($id)&&!empty($data)&&!empty($id)?$this->db->update('sidebars_place',$data,['id'=>$id]):false);
    }
    
    public function edit_m($data,$id){
        return (is_numeric($id)&&!empty($data)&&!empty($id)?$this->db->update('menu',$data,['side_id'=>$id]):false);
    }
    
    public function add($data){
        return (!empty($data)?$this->db->insert('sidebars_place',$data):false);
    }
    
    public function del($id){
        return (is_numeric($id)&&!empty($id)?$this->db->delete('sidebars_place',['id'=>$id]):false);
    }
      
    public function dis_m($id){
        return (is_numeric($id) && !empty($id)?$this->edit_m(['status'=>0],$id):false);
    }
      
    public function dis($id){
        return (is_numeric($id) && !empty($id)?$this->edit(['status'=>0],$id):false);
    }

    public function en_m($id){
        return (is_numeric($id) && !empty($id)?$this->edit_m(['status'=>1],$id):false);
    }

    public function en($id){
        return (is_numeric($id) && !empty($id)?$this->edit(['status'=>1],$id):false);
    }
    
     public function del_m($id){
        return (is_numeric($id)&&!empty($id)?$this->db->delete('menu',['side_id'=>$id]):false);
    }
    
}