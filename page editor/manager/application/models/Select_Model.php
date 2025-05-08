<?php
class Select_Model extends CI_Model{
    function __construct()
    {
        parent::__construct();
    }
    public function run_query($myquery){
        return $this->db->query($myquery)->result_array();
    }
    public function select_where($table,$data){
        return $this->db->get_where($table,$data)->result_array();
    }
    public function get_row($table,$data){
        $query=$this->db->get_where($table,$data);
        $row=$query->num_rows();
        if($row>0){
            return 1;
        }else{
            return 0;
        }
    }
}