<?php
class Delete_Model extends CI_Model{
    function __construct()
    {
        parent::__construct();
    }
    public function delete($table,$con){
        $this->db->delete($table,$con);
    }
}
?>