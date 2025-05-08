<?php
defined('BASEPATH') OR exut('No direct script access allowed');
class Api_model extends CI_Model
{
    public $table='tbl_sample';
    
    function fetch_all(){
        if($this->table != ''){
            $this->db->order_by('id', 'DESC');
            return $this->db->get($this->table);
        }else{
            return false;
        }
    }
    
    function insert_api($data){
        if($this->table != ''){
            $this->db->insert($this->table, $data);
            return ($this->db->affected_rows() > 0?true:false);
        }else{
            return false;
        }
    }
    
    function fetch_single_user($user_id){
        if($this->table != ''){
            $this->db->where("id", $user_id);
            $query = $this->db->get($this->table);
            return $query->result_array();
        }else{
            return false;
        }
    }
    function update_api($user_id, $data){
        if($this->table != ''){
            $this->db->where("id", $user_id);
            $this->db->update($this->table, $data);
        }else{
            return false;
        }
         
    }
 
    function delete_single_user($user_id){
        if($this->table != ''){
            $this->db->where("id", $user_id);
            $this->db->delete($this->table);
            return ($this->db->affected_rows() > 0?true:false);
        }else{
            return false;
        }
    }
}