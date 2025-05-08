<?php

class Content_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function i_c($data){
        return (!empty($data)?$this->db->insert('content',$data):false);
    }
    
    public function s_p_i($id){
        return (is_numeric($id) && !empty($id) ? $this->db->get_where('pic',['id' => $id ])->result_array():false);
    }
    
    public function s_u_n_i($id){
        return (!empty($id) && is_numeric($id) ? $this->db->get_where('users',['id'=>$id])->result_array():false);
    }

    public function a_c()
    {
        return ($this->db->query("SELECT * FROM content")->result_array() ?: false);
    }

    public function s_c_i($id)
    {
        return (!empty($id) && is_numeric($id) ? $this->db->get_where('content', ['id' => $id])->result_array() : false);
    }
      public function dis($id){
        return (is_numeric($id) && !empty($id)?$this->edit(['status'=>0],$id):false);
    }

    public function en($id){
        return (is_numeric($id) && !empty($id)?$this->edit(['status'=>1],$id):false);
    }
    public function edit($data,$id){
        return (is_numeric($id)&&!empty($data)&&!empty($id)?$this->db->update('content',$data,['id'=>$id]):false);
    }
    
    public function del($id){
        return (is_numeric($id)&&!empty($id)?$this->db->delete('content',['id'=>$id]):false);
    }
}