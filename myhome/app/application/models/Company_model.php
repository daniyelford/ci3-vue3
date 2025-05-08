<?php

class Company_model extends CI_Model
{
    public function __construct()
	{
		parent::__construct();
	}
	private $tbl='company';
	private $category_product='company_category_product_position';
	private $chat='position_chat';
	private $image='position_image';
	private $map='company_map';
	private $meet="company_meet";
	private $meet_user="company_meet_user";
    private $position="position";	
    private $position_map="position_map";
	private $position_order="position_product_order";
	private $position_user="position_user";
    private $role = 'company_role';
	private $task='company_task';
	private $task_user="company_task_user";
	private $tel="position_tel";
	private $user = 'company_user';
	private $user_product_access='company_user_access';
	private $video='position_video';
	private $role_request="company_role_request";
	private $user_resume_company_role_request="user_resume_company_role_request";
	// selects
	private function select_where_array_table($tbl,$arr){
	    return (!empty($tbl) && is_string($tbl) && !empty($arr) && is_array($arr)?$this->db->get_where($tbl,$arr)->result_array():false);
	}
	private function select_where_id_table($tbl,$id){
	    return (!empty($tbl) && is_string($tbl) && !empty($id) && intval($id)>0?$this->select_where_array_table($tbl,['id'=>intval($id)]):false);
	}
	private function select_where_status_table($tbl){
	    return (!empty($tbl) && is_string($tbl)?$this->select_where_array_table($tbl,['status'=>1]):false);
	}
    // end of selects
    // inserts
    private function add_to_table($tbl,$arr){
        return (!empty($tbl) && is_string($tbl) && !empty($arr) && is_array($arr) && $this->db->insert($tbl,$arr));
    }
    private function add_to_table_return_id($tbl,$arr){
        return (!empty($tbl) && is_string($tbl) && !empty($arr) && is_array($arr) && $this->db->insert($tbl,$arr)?$this->db->insert_id():false);
    }
    // end of inserts
    // updates
    private function edit_table($tbl,$arr,$where){
        return (!empty($tbl) && is_string($tbl) && !empty($arr) && is_array($arr) && !empty($where) && is_array($where) && $this->db->update($tbl,$arr,$where));
    }
    // end of updates
    // deletes
    private function remove_where_array_in_table($tbl,$arr){
        return (!empty($tbl) && is_string($tbl) && !empty($arr) && is_array($arr) && $this->db->delete($tbl, $arr));
    }
    // end of deletes
    public function all(){
        return $this->db->query("SELECT * FROM ".$this->tbl)->result_array();
    }
    public function all_role_request(){
        return $this->db->query("SELECT * FROM ".$this->role_request)->result_array();
    }
    public function all_user_resume_company_role_request(){
        return $this->db->query("SELECT * FROM ".$this->user_resume_company_role_request)->result_array();
    }
    public function select_user_resume_company_role_request_where_id($id){
        return (!empty($id) && intval($id)>0?$this->select_where_id_table($this->user_resume_company_role_request,intval($id)):false);
    }
    public function all_status(){
        return $this->select_where_status_table($this->tbl);
    }
    public function all_category_product(){
        return $this->db->query("SELECT * FROM ".$this->category_product)->result_array();
    }
    public function select_company_where_id($id){
        return (!empty($id) && intval($id)>0?$this->select_where_id_table($this->tbl,intval($id)):false);
    }
    public function select_company_where_id_and_status($id){
        return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->tbl,['id'=>intval($id),'status'=>1]):false);
    }
    public function select_company_role_request_where_id($id){
        return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->role_request,['id'=>intval($id)]):false);
    }
    public function select_company_role_request_where_company_id($id){
        return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->role_request,['company_id'=>intval($id)]):false);
    }
    public function select_company_where_title($str){
        return (!empty($str) && is_string($str)?$this->select_where_array_table($this->tbl,['title'=>$str]):false);
    }
    public function select_company_where_title_and_status($str){
        return (!empty($str) && is_string($str)?$this->select_where_array_table($this->tbl,['title'=>$str,'status'=>1]):false);
    }
    public function select_map_where_company_id($id){
        return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->map,['company_id'=>intval($id),'status'=>1]):false);
    }
    public function select_category_product_where_status(){
        return $this->select_where_status_table($this->category_product);
    }
    public function select_category_product_where_id($id){
        return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->category_product,['id'=>intval($id)]):false);
    }
    public function select_category_product_where_category_id_and_status($id){
        return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->category_product,['category_id'=>intval($id),'status'=>1]):false);
    }
    public function select_category_product_where_position_id($id){
        return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->category_product,['position_id'=>intval($id)]):false);
    }
    public function select_category_product_where_product_id($id){
        return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->category_product,['product_id'=>intval($id)]):false);
    }
    public function select_category_product_where_company_id($id){
        return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->category_product,['company_id'=>intval($id)]):false);
    }
    public function select_category_product_where_company_id_and_status($id){
        return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->category_product,['company_id'=>intval($id),'status'=>1]):false);
    }
    public function select_category_product_where_category_id_and_company_id_and_status($cat_id,$com_id){
        return (!empty($cat_id) && intval($cat_id)>0 && !empty($com_id) && intval($com_id)>0?$this->select_where_array_table($this->category_product,['category_id'=>intval($cat_id),'company_id'=>intval($com_id),'status'=>1]):false);
    }
    public function select_user_product_access_where_company_user_id_and_status($id){
        return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->user_product_access,['company_user_id'=>intval($id),'status'=>1]):false);
    }
    public function select_user_product_access_where_company_category_product_and_status($id){
        return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->user_product_access,['company_category_product'=>intval($id),'status'=>1]):false);
    }
    public function select_user_product_access_where_arr($arr){
        return (!empty($arr) && is_array($arr)?$this->select_where_array_table($this->user_product_access,$arr):false);
    }
    public function select_user_where_id($id){
        return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->user,['id'=>intval($id)]):false);
    }
    public function select_task_user_where_id($id){
        return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->task_user,['id'=>intval($id)]):false);
    }
    public function select_task_user_where_company_task_id($id){
        return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->task_user,['company_task_id'=>intval($id)]):false);
    }
    public function select_task_user_where_request_company_user_id($id){
        return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->task_user,['request_company_user_id'=>intval($id)]):false);
    }
    public function select_task_user_where_from_company_user_id($id){
        return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->task_user,['from_company_user_id'=>intval($id)]):false);
    }
    public function select_task_where_id($id){
        return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->task,['id'=>intval($id)]):false);
    }
    public function select_meet_user_where_id($id){
        return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->meet_user,['id'=>intval($id)]):false);
    }
    public function select_meet_user_where_request_company_user_id($id){
        return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->meet_user,['request_company_user_id'=>intval($id)]):false);
    }
    public function select_meet_user_where_from_company_user_id($id){
        return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->meet_user,['from_company_user_id'=>intval($id)]):false);
    }
    public function select_meet_user_weher_company_meet_id($id){
        return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->meet_user,['company_meet_id'=>intval($id)]):false);
    }
    public function select_meet_where_id($id){
        return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->meet,['id'=>intval($id)]):false);
    }
    public function select_position_where_company_id($id){
        return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->category_product,['company_id'=>intval($id)]):false);
    }
    public function select_position_map_where_position_id($id){
        return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->position_map,['company_position_id'=>intval($id)]):false);
    }
    
    
    // insert
    public function add($arr){
        return (!empty($arr) && is_array($arr) && $this->add_to_table($this->tbl,$arr));
    }
    public function add_map($arr){
        return (!empty($arr) && is_array($arr) && $this->add_to_table($this->map,$arr));
    }
    public function add_return_id($arr){
        return (!empty($arr) && is_array($arr)?$this->add_to_table_return_id($this->tbl,$arr):false);
    }
    public function add_access($arr){
        return (!empty($arr) && is_array($arr) && $this->add_to_table($this->user_product_access,$arr));
    }
    public function add_meet_return_id($arr){
        return (!empty($arr) && is_array($arr)?$this->add_to_table_return_id($this->meet,$arr):false);
    }
    public function add_meet_user($arr){
        return (!empty($arr) && is_array($arr) && $this->add_to_table($this->meet_user,$arr));
    }
    public function add_task_return_id($arr){
        return (!empty($arr) && is_array($arr)?$this->add_to_table_return_id($this->task,$arr):false);
    }
    public function add_task_user($arr){
        return (!empty($arr) && is_array($arr) && $this->add_to_table($this->task_user,$arr));
    }
    public function add_role_request($arr){
        return (!empty($arr) && is_array($arr) && $this->add_to_table($this->role_request,$arr));
    }
    // insert
    // update
    public function edit_weher_id($arr,$id){
        return (!empty($id) && intval($id)>0 && !empty($arr) && is_array($arr) && $this->edit_table($this->tbl,$arr,['id'=>intval($id)]));
    }
    public function edit_user_resume_company_role_request_weher_id($arr,$id){
        return (!empty($id) && intval($id)>0 && !empty($arr) && is_array($arr) && $this->edit_table($this->user_resume_company_role_request,$arr,['id'=>intval($id)]));
    }
    public function edit_meet_weher_id($arr,$id){
        return (!empty($id) && intval($id)>0 && !empty($arr) && is_array($arr) && $this->edit_table($this->meet,$arr,['id'=>intval($id)]));
    }
    public function edit_meet_user_weher_id($arr,$id){
        return (!empty($id) && intval($id)>0 && !empty($arr) && is_array($arr) && $this->edit_table($this->meet_user,$arr,['id'=>intval($id)]));
    }
    public function edit_meet_user_weher_company_meet_id($arr,$id){
        return (!empty($id) && intval($id)>0 && !empty($arr) && is_array($arr) && $this->edit_table($this->meet_user,$arr,['company_meet_id'=>intval($id)]));
    }
    public function edit_category_product_weher_category_id($arr,$id){
        return (!empty($id) && intval($id)>0 && !empty($arr) && is_array($arr) && $this->edit_table($this->category_product,$arr,['category_id'=>intval($id)]));
    }
    public function edit_access_weher_arr($arr,$where){
        return (!empty($arr) && is_array($arr) && !empty($where) && is_array($where) && $this->edit_table($this->user_product_access,$arr,$where));
    }
    public function edit_task_weher_id($arr,$id){
        return (!empty($id) && intval($id)>0 && !empty($arr) && is_array($arr) && $this->edit_table($this->task,$arr,['id'=>intval($id)]));
    }
    public function edit_task_user_weher_id($arr,$id){
        return (!empty($id) && intval($id)>0 && !empty($arr) && is_array($arr) && $this->edit_table($this->task_user,$arr,['id'=>intval($id)]));
    }
    public function edit_role_request_weher_id($arr,$id){
        return (!empty($id) && intval($id)>0 && !empty($arr) && is_array($arr) && $this->edit_table($this->role_request,$arr,['id'=>intval($id)]));
    }
    //update
    // delete
    public function remove_map_where_id($id){
        return (!empty($id) && intval($id)>0 && $this->remove_where_array_in_table($this->map,['id'=>intval($id)]));
    }
    public function remove_where_id($id){
        $product_ids=[];
        if(!empty($id) && intval($id)>0){
            $this->remove_where_array_in_table($this->tbl,['id'=>intval($id)]);
            $a=$this->select_category_product_where_company_id(intval($id));
            foreach($a as $p){
                if(!empty($p['product_id']) && intval($p['product_id'])>0) $product_ids[]=intval($p['product_id']);
                $this->remove_where_array_in_table('product_meet',['company_category_product_id'=>intval($p['id'])]);
            }
            $this->remove_where_array_in_table($this->category_product,['company_id'=>intval($id)]);
            $this->remove_where_array_in_table($this->chat,['company_id'=>intval($id)]);
            // $this->remove_where_array_in_table($this->image,['company_id'=>intval($id)]);
            $this->remove_where_array_in_table($this->map,['company_id'=>intval($id)]);
            $this->remove_where_array_in_table($this->tel,['company_id'=>intval($id)]);
            // $this->remove_where_array_in_table($this->video,['company_id'=>intval($id)]);
            $b=$this->select_where_array_table($this->role,['company_id'=>$id]);
            foreach($b as $r){
                $c=$this->select_where_array_table($this->user,['company_role_id'=>intval($id)]);
                foreach($c as $u){
                    $d=$this->select_where_array_table($this->meet_user,['request_company_user_id'=>intval($u['id'])]);
                    foreach($d as $m){
                        if(!empty($m['company_meet_id']) && intval($m['company_meet_id'])>0)
                            $this->remove_where_array_in_table($this->meet,['id'=>intval($m['company_meet_id'])]);
                    }
                    $f=$this->select_where_array_table($this->meet_user,['from_company_user_id'=>intval($u['id'])]);
                    foreach($f as $m){
                        if(!empty($m['company_meet_id']) && intval($m['company_meet_id'])>0)
                            $this->remove_where_array_in_table($this->meet,['id'=>intval($m['company_meet_id'])]);
                    }
                    $this->remove_where_array_in_table($this->meet_user,['request_company_user_id'=>intval($u['id'])]);
                    $this->remove_where_array_in_table($this->meet_user,['from_company_user_id'=>intval($u['id'])]);
                    $this->remove_where_array_in_table($this->user_product_access,['company_id'=>intval($u['id'])]);
                    $g=$this->select_where_array_table($this->task_user,['request_company_user_id'=>intval($u['id'])]);
                    foreach($g as $t){
                        if(!empty($t['company_task_id']) && intval($t['company_task_id'])>0)
                            $this->remove_where_array_in_table($this->task,['id'=>intval($t['company_task_id'])]);
                    }
                    $h=$this->select_where_array_table($this->task_user,['from_company_user_id'=>intval($u['id'])]);
                    foreach($h as $t){
                        if(!empty($t['company_task_id']) && intval($t['company_task_id'])>0)
                            $this->remove_where_array_in_table($this->task,['id'=>intval($t['company_task_id'])]);
                    }
                    $this->remove_where_array_in_table($this->task_user,['request_company_user_id'=>intval($u['id'])]);
                    $this->remove_where_array_in_table($this->task_user,['from_company_user_id'=>intval($u['id'])]);
                }
                $this->remove_where_array_in_table($this->user,['company_role_id'=>intval($r['id'])]);
            }
            $this->remove_where_array_in_table($this->role,['company_id'=>intval($id)]);
            $i=$this->select_position_where_company_id(intval($id));
            foreach($i as $p){
                $j=$this->select_where_array_table($this->position_user,['company_position_id'=>intval($p['id'])]);
                foreach($j as $u){
                    $this->remove_where_array_in_table($this->position_order,['company_position_user_id'=>intval($u['id'])]);
                }
                $this->remove_where_array_in_table($this->position_user,['company_position_id'=>intval($p['id'])]);
            }
            // $this->remove_where_array_in_table($this->position,['company_id'=>intval($id)]);
            return $product_ids;
        }
        return false;
    }
    // delete
}