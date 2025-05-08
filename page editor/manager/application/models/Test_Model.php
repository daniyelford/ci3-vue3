<?php
class Test_Model extends CI_Model{
    function __construct()
    {
        parent::__construct();
    }
    public function select($table)
    {
        return $query=$this->db->get($table)->result_array();
    }
    public function select_where($table,$condition)
    {
        return $query=$this->db->get_where($table,$condition)->result_array();
    }
    public function update($table,$data,$condition)
    {
        $this->db->update($table,$data,$condition);
    }
    public function insert($table,$data)
    {
        $ins=$this->db->insert($table,$data);
        return $ins;
    }
    public function delete($table,$shart)
    {
        $this->db->delete($table,$shart);
    }
    public function myquery($query)
    {
        return $this->db->query($query);
    }
}