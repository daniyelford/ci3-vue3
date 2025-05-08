<?php
class Insert_Model extends CI_Model{
    function __construct()
    {
        parent::__construct();
    }
    public function Insert($table,$data){
        $ins=$this->db->insert($table,$data);
        if($ins){
            return $this->db->insert_id();
        }
    }
}

?>