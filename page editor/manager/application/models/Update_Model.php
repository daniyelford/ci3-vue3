<?php
class Update_Model extends CI_Model{
    function __construct()
    {
        parent::__construct();
    }
    public function update($table,$data,$condition){
        $this->db->update($table,$data,$condition);
    }


}