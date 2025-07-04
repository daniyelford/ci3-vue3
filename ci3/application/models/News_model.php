<?php


class News_model extends CI_Model
{
    public function __construct()
	{
		parent::__construct();
	}
	private $tbl="news";
    private $report="report_list";
    private $category_relation='category_news';
    private function select_where_array_table($tbl,$arr){
	    return (!empty($tbl) && is_string($tbl) && !empty($arr) && is_array($arr)?$this->db->get_where($tbl,$arr)->result_array():false);
	}
	private function select_where_id_table($tbl,$id){
	    return (!empty($tbl) && is_string($tbl) && !empty($id) && intval($id)>0?$this->select_where_array_table($tbl,['id'=>intval($id)]):false);
	}
    private function add_to_table($tbl,$arr){
        return (!empty($tbl) && is_string($tbl) && !empty($arr) && is_array($arr) && $this->db->insert($tbl,$arr));
    }
    private function add_to_table_return_id($tbl,$arr){
        return (!empty($tbl) && is_string($tbl) && !empty($arr) && is_array($arr) && $this->db->insert($tbl,$arr)?$this->db->insert_id():false);
    }
    private function edit_table($tbl,$arr,$where){
        return (!empty($tbl) && is_string($tbl) && !empty($arr) && is_array($arr) && !empty($where) && is_array($where) && $this->db->update($tbl,$arr,$where));
    }
    private function remove_where_array_in_table($tbl,$arr){
        return (!empty($tbl) && is_string($tbl) && !empty($arr) && is_array($arr) && $this->db->delete($tbl, $arr));
    }
    // costum
    public function select_news(){
        return $this->db->get($this->tbl)->result_array();
    }
    public function select_news_where_id($id){
	    return (!empty($id) && intval($id)?$this->select_where_id_table($this->tbl,intval($id)):false);
	}
    public function select_news_where_user_account_id($id){
	    return (!empty($id) && intval($id)?$this->select_where_array_table($this->tbl,['user_account_id'=>intval($id)]):false);
	}
    public function select_news_where_public_status_checking(){
	    return $this->select_where_array_table($this->tbl,['status'=>'checking','privacy'=>'public']);
	}
    public function select_news_where_category_id_status_checking_private($id){
        if (!empty($id) && is_numeric($id)) {
            $news=$this->select_where_array_table($this->category_relation,['category_id'=>$id]);
            $news_array_id=[];
            if(!empty($news))
                foreach($news as $a){
                    if(!empty($a) && !empty($a['news_id']) && intval($a['news_id'])>0)
                        $news_array_id[]=intval($a['news_id']);
                }
            if(!empty($news_array_id)){
                $this->db->from($this->tbl);
                $this->db->group_start();
                $this->db->where('status', 'checking');
                $this->db->where('privacy', 'private');
                $this->db->where_in('id', $news_array_id);
                $this->db->group_end();
                return $this->db->get()->result_array();
            }
        }
        return [];
	}
    public function select_news_where_status_seen(){
	    return $this->select_where_array_table($this->tbl,['status'=>'seen']);
	}
    public function select_report_where_news_id($id){
	    return (!empty($id) && intval($id)?$this->select_where_array_table($this->report,['news_id'=>intval($id)]):false);
	}
    public function select_report_where_user_account_id($id){
	    return (!empty($id) && intval($id)?$this->select_where_array_table($this->report,['user_account_id'=>intval($id)]):false);
	}
    public function get_reports_by_account_or_news_ids($user_account_id, $news_array){
        if (empty($news_array)) {
            $news_array = [0];
        }
        $this->db->from($this->report);
        $this->db->group_start();
        $this->db->where('user_account_id', $user_account_id);
        $this->db->or_where_in('news_id', $news_array);
        $this->db->group_end();
        return $this->db->get()->result_array();
    }
    public function add_report($arr){
        return (!empty($arr) && is_array($arr) && $this->add_to_table($this->report,$arr));
    }
    public function add_report_return_id($arr){
        return (!empty($arr) && is_array($arr)?$this->add_to_table_return_id($this->report,$arr):false);
    }
    public function add_return_id($arr){
        return (!empty($arr) && is_array($arr)?$this->add_to_table_return_id($this->tbl,$arr):false);
    }
    public function seen_weher_id($id){
        return (!empty($id) && intval($id)>0 && $this->edit_table($this->tbl,['status'=>'seen'],['id'=>intval($id)]));
    }
    public function seen_weher_id_and_user_account_id($id,$user_id){
        return (!empty($id) && intval($id)>0 && !empty($user_id) && intval($user_id)>0 && $this->edit_table($this->tbl,['status'=>'seen'],['id'=>intval($id),'user_account_id'=>intval($user_id)]));
    }
    public function checking_weher_id_and_user_account_id($id,$user_id){
        return (!empty($id) && intval($id)>0 && !empty($user_id) && intval($user_id)>0 && $this->edit_table($this->tbl,['status'=>'checking'],['id'=>intval($id),'user_account_id'=>intval($user_id)]));
    }
}