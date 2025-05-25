<?php

class Category_model extends CI_Model
{
    private $tbl = "category";

    public function __construct()
    {
        parent::__construct();
    }

    // Selects
    public function all()
    {
        return $this->db->get($this->tbl)->result_array();
    }

    public function select_where($conditions = [])
    {
        return !empty($conditions) ? $this->db->get_where($this->tbl, $conditions)->result_array() : false;
    }

    public function select_where_status($status = 1)
    {
        return $this->select_where(['status' => $status]);
    }

    public function select_where_parent_id($parent_id)
    {
        return $this->select_where(['parent_id' => $parent_id]);
    }

    public function select_where_id($id)
    {
        return $this->select_where(['id' => $id]);
    }

    public function select_where_title($title)
    {
        return $this->select_where(['title' => $title]);
    }

    // Inserts
    public function add($data)
    {
        return !empty($data) && $this->db->insert($this->tbl, $data);
    }

    public function add_return_id($data)
    {
        return !empty($data) && $this->db->insert($this->tbl, $data) ? $this->db->insert_id() : false;
    }

    // Updates
    public function edit($data, $where)
    {
        return !empty($data) && !empty($where) && $this->db->update($this->tbl, $data, $where);
    }

    // Deletes
    public function remove($id)
    {
        return $this->db->delete($this->tbl, ['id' => $id]);
    }

    // Select Parents
    public function select_parent()
    {
        return $this->select_where(['parent_id' => 0]);
    }

    public function select_parent_where_status($status = 1)
    {
        return $this->select_where(['parent_id' => 0, 'status' => $status]);
    }

    // Custom Selects
    public function select_only_parent_where_child_and_status()
    {
        return $this->select_where(['parent_id !=' => 0, 'status' => 1]);
    }

    public function select_only_parent_where_child()
    {
        return $this->select_where(['parent_id !=' => 0]);
    }

    public function only_parent_id_all_children()
    {
        return $this->db->select('parent_id')->get_where($this->tbl, ['parent_id !=' => 0])->result_array();
    }

    public function only_parent_id_all_children_and_status()
    {
        return $this->db->select('parent_id')->get_where($this->tbl, ['parent_id !=' => 0, 'status' => 1])->result_array();
    }
}

// class Category_model extends CI_Model
// {
//     public function __construct()
// 	{
// 		parent::__construct();
// 	}
	
// 	private $tbl="category";
	
// 	private function select_where_costum_colmn($col,$where){
// 	    return (!empty($col)&&is_string($col)?$this->db->query("SELECT `".$col."` FROM ".$this->tbl.(!empty($where)&&is_string($where)?" WHERE ".$where:''))->result_array():false);
// 	}
// 	// selects
// 	public function all(){
// 	    return $this->db->query("SELECT * FROM ".$this->tbl)->result_array();
// 	}
// 	public function select_only_parent_where_child_and_status(){
// 	    return $this->select_where_costum_colmn('parent_id','`parent_id` != 0 AND `status` = 1');
// 	}
// 	public function select_only_parent_where_child(){
// 	    return $this->select_where_costum_colmn('parent_id','`parent_id` != 0');
// 	}
// 	private function select_where_array($arr){
// 	    return (!empty($arr) && is_array($arr)?$this->db->get_where($this->tbl,$arr)->result_array():false);
// 	}
// 	public function select_where_status(){
// 	    return $this->select_where_array(['status'=>1]);
// 	}
// 	public function select_where_parent_id($id){
// 	    return $this->select_where_array(['parent_id'=>intval($id)]);
// 	}
// 	public function select_where_parent_id_and_status($id){
// 	    return $this->select_where_array(['parent_id'=>intval($id),'status'=>1]);
// 	}
// 	public function select_where_id($id){
// 	    return (!empty($id) && intval($id)>0?$this->select_where_array(['id'=>$id]):false);
// 	}
// 	public function select_where_id_and_status($id){
// 	    return (!empty($id) && intval($id)>0?$this->select_where_array(['id'=>$id,'status'=>1]):false);
// 	}
// 	public function select_where_title($str){
// 	    return (!empty($str) && is_string($str)?$this->select_where_array(['title'=>$str]):false);
// 	}
// 	public function select_where_title_and_status($str){
// 	    return (!empty($str) && is_string($str)?$this->select_where_array(['title'=>$str,'status'=>1]):false);
// 	}
//     // end of selects
//     // inserts
//     public function add($arr){
//         return (!empty($arr) && is_array($arr) && $this->db->insert($this->tbl,$arr));
//     }
//     public function add_return_id($arr){
//         return (!empty($arr) && is_array($arr) && $this->db->insert($this->tbl,$arr)?$this->db->insert_id():false);
//     }
//     // end of inserts
//     // updates
//     public function edit($arr,$where){
//         return (!empty($arr) && is_array($arr) && !empty($where) && is_array($where) && $this->db->update($this->tbl,$arr,$where));
//     }
//     // end of updates
//     // deletes
//     private function remove_where_array_in_table($tbl,$arr){
//         return (!empty($tbl) && is_string($tbl) && !empty($arr) && is_array($arr) && $this->db->delete($tbl, $arr));
//     }
//     public function remove($id){
//         return (!empty($id) && intval($id)>0 && $this->remove_where_array_in_table($this->tbl,['id'=>intval($id)]));
//     }
//     // end of deletes
	
// 	private function select_where_where_string_in_table($tbl,$where){
// 	    return (!empty($tbl) && is_string($tbl) && !empty($where) && is_string($where)?$this->db->query("SELECT * FROM ".$tbl." WHERE ".$where)->result_array():false);
// 	}
// 	private function only_col_all_in_table_where_string($col,$tbl,$where){
// 	    return (!empty($tbl) && is_string($tbl) && !empty($col) && is_string($col) && !empty($where) && is_string($where)?$this->db->query("SELECT ".$col." FROM ".$tbl." WHERE ".$where)->result_array():false);
// 	}	
// 	public function select_parent(){
// 		return $this->select_where_where_string_in_table($this->tbl,"`parent_id` = 0");
// 	}
// 	public function select_parent_where_status(){
// 		return $this->select_where_where_string_in_table($this->tbl,"`parent_id` = 0 AND `status` = 1");
// 	}
// 	public function only_parent_id_all_children(){
// 		return $this->only_col_all_in_table_where_string('parent_id',$this->tbl,"`parent_id` != 0");
// 	}
// 	public function only_parent_id_all_children_and_status(){
// 		return $this->only_col_all_in_table_where_string('parent_id',$this->tbl,"`parent_id` != 0 AND `status` = 1");
// 	}
// }