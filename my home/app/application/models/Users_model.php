<?php

class Users_model extends CI_Model
{
    public function __construct()
	{
		parent::__construct();
	}
	private $tbl="users";
	private $auth='user_auth_info';
	private $info='user_info';
	private $login='user_login';
	private $wallet="wallet";
	private $cart="user_cart";
	private $chat="user_chat";
	private $resume='user_resume';
	private $resume_company_role_request="user_resume_company_role_request";
    public function xss_cleaner($x){
        return (!empty($x)?sha1(addslashes(strip_tags($x))):null);
    }
	// selects
	private function select_where_array_table($tbl,$arr){
	    return (!empty($tbl) && is_string($tbl) && !empty($arr) && is_array($arr)?$this->db->get_where($tbl,$arr)->result_array():false);
	}
	private function select_where_id_table($tbl,$id){
	    return (!empty($tbl) && is_string($tbl) && !empty($id) && intval($id)>0?$this->select_where_array_table($tbl,['id'=>$id]):false);
	}
	private function select_where_id_and_status_table($tbl,$id){
	    return (!empty($tbl) && is_string($tbl) && !empty($id) && intval($id)>0?$this->select_where_array_table($tbl,['id'=>intval($id),'status'=>1]):false);
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
    // costum select
    public function all_info(){
	    return $this->db->query("SELECT * FROM ".$this->info)->result_array();
	}
	public function select_info_where_user_id($id){
	    return (!empty($id) && intval($id)>0 && ($a=$this->select_where_id_and_status_table($this->tbl,intval($id)))!==false && !empty($a) && !empty($a['0']) && !empty($a['0']['user_info_id']) && intval($a['0']['user_info_id'])>0?$this->select_info_where_id(intval($a['0']['user_info_id'])):false);
	}
	public function auth_where_username($u){
	    return (!empty($u) && is_string($u) && ($a=$this->xss_cleaner($u))!==false && !empty($a) && is_string($a)?$this->select_where_array_table($this->auth,['username'=>$a]):false);
	}
	public function auth_costum_and_return_user_id($u,$p){
	    return (!empty($u) && is_string($u) && ($a=$this->xss_cleaner($u))!==false && !empty($a) && is_string($a) && !empty($p) && is_string($p) && ($b=$this->xss_cleaner($p))!==false && !empty($b) && is_string($b) && ($c=$this->select_where_array_table($this->auth,['username'=>$a,'password'=>$b])) !== false && !empty($c) && !empty($c['0']) && !empty($c['0']['id']) && intval($c['0']['id'])>0 && ($d=$this->select_where_array_table($this->tbl,['auth_info_id'=>intval($c['0']['id']),'status'=>1])) !== false && !empty($d) && !empty($d['0']) && !empty($d['0']['id']) && intval($d['0']['id'])>0?intval($d['0']['id']):false);
	}
    public function select_info_where_id($id){
	    return (!empty($id) && intval($id)?$this->select_where_id_table($this->info,intval($id)):false);
	}
	public function select_info_where_array($arr){
	    return (!empty($arr) && is_array($arr)?$this->select_where_array_table($this->info,$arr):false);
	}
	public function select_info_where_gmail($str){
	    return (!empty($str) && is_string($str)?$this->select_where_array_table($this->info,['gmail'=>$str]):false);
	}
	public function select_info_where_phone($str){
	    return (!empty($str) && is_string($str)?$this->select_where_array_table($this->info,['phone'=>$str]):false);
	}
	public function select_where_id($id){
	    return (!empty($id) && intval($id)?$this->select_where_id_and_status_table($this->tbl,intval($id)):false);
	}
	public function select_where_info_id($id){
	    return (!empty($id) && intval($id)?$this->select_where_array_table($this->tbl,['user_info_id'=>intval($id)]):false);
	}
	public function select_where_gmail_user_id($str){
	    return (!empty($str) && is_string($str)?$this->select_where_array_table($this->tbl,['gmail_user_id'=>$str]):false);
	}
	public function select_where_gmail_user_id_and_status($str){
	    return (!empty($str) && is_string($str)?$this->select_where_array_table($this->tbl,['gmail_user_id'=>$str,'status'=>1]):false);
	}
	public function select_login_where_user_id($id){
	    return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->login,['user_id'=>intval($id)]):false);
	}
	public function all_user(){
	    return $this->db->query("SELECT * FROM ".$this->tbl)->result_array();
	}
	public function all_resume(){
	    return $this->db->query("SELECT * FROM ".$this->resume)->result_array();
	}
	public function chat_where_user_id_no_status($id){
	    return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->chat,['user_reciver_id'=>intval($id),'status'=>0]):false);
	}
	public function chat_where_user_reciver_id($id){
	    return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->chat,['user_reciver_id'=>intval($id)]):false);
	}
	public function all_my_chat($id){
	    return (!empty($id) && intval($id)>0?$this->db->query("SELECT * FROM $this->chat WHERE `user_reciver_id`= $id OR `user_sender_id`= $id")->result_array():false);
	}
	public function all_support_chat(){
	    return $this->db->query("SELECT * FROM $this->chat WHERE `user_reciver_id` IS NULL OR `user_sender_id` IS NULL")->result_array();
	}
	public function chat_where_user_sender_id($id){
	    return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->chat,['user_sender_id'=>intval($id)]):false);
	}
	public function select_wallet_where_user_id($id){
	    return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->wallet,['user_id'=>intval($id)]):false);
	}
	public function select_cart_where_id($id){
	    return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->cart,['id'=>intval($id)]):false);
	}
	public function select_cart_where_user_id($id){
	    return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->cart,['user_id'=>intval($id)]):false);
	}
	public function select_resume_where_id($id){
	    return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->resume,['id'=>intval($id)]):false);
	}
	public function select_resume_where_user_id($id){
	    return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->resume,['user_id'=>intval($id)]):false);
	}
	public function select_resume_company_role_request_where_user_resume_id($id){
	    return (!empty($id) && intval($id)>0?$this->select_where_array_table($this->resume_company_role_request,['user_resume_id'=>intval($id)]):false);
	}
    // costum select
    // costum add
    public function add_login($arr){
        return (!empty($arr) && is_array($arr) && $this->add_to_table($this->login,$arr));
    }
    public function add_user_return_id($arr){
        return (!empty($arr) && is_array($arr)?$this->add_to_table_return_id($this->tbl,$arr):false);
    }
    private function add_profile($arr){
        if(!empty($arr) && is_array($arr) && ($a=$this->add_to_table_return_id($this->info,$arr))!==false && !empty($a) && intval($a)>0) 
            return intval($a);
        return false;
    }
    public function add_wallet($arr){
        return (!empty($arr) && is_array($arr) && $this->add_to_table($this->wallet,$arr));
    }
    public function add_info_return_id($arr){
        return (!empty($arr) && is_array($arr)?$this->add_profile($arr):false);
    }
    public function add_auth_return_id($u,$p){
        return (!empty($u) && is_string($u) && !empty($p) && is_string($p)?$this->add_to_table_return_id($this->auth,['username'=>$this->xss_cleaner($u),'password'=>$this->xss_cleaner($p)]):false);
    }
    public function add_chat_return_id($arr){
        return (!empty($arr) && is_array($arr)?$this->add_to_table_return_id($this->chat,$arr):false);
    }
    public function add_cart($arr){
        return (!empty($arr) && is_array($arr) && $this->add_to_table($this->cart,$arr));
    }
    public function add_resume($arr){
        return (!empty($arr) && is_array($arr) && $this->add_to_table($this->resume,$arr));
    }
    public function add_resume_company_role_request($arr){
        return (!empty($arr) && is_array($arr) && $this->add_to_table($this->resume_company_role_request,$arr));
    }
    // costum add
    // costum update
    public function edit($arr,$where){
        return (!empty($arr) && is_array($arr) && !empty($where) && is_array($where) && $this->edit_table($this->tbl,$arr,$where));
    }
    public function edit_info($arr,$where){
        return (!empty($arr) && is_array($arr) && !empty($where) && is_array($where) && $this->edit_table($this->info,$arr,$where));
    }
    public function edit_cart($arr,$where){
        return (!empty($arr) && is_array($arr) && !empty($where) && is_array($where) && $this->edit_table($this->cart,$arr,$where));
    }
    public function edit_auth($arr,$where){
        return (!empty($arr) && is_array($arr) && !empty($where) && is_array($where) && $this->edit_table($this->auth,$arr,$where));
    }
    public function edit_resume($arr,$where){
        return (!empty($arr) && is_array($arr) && !empty($where) && is_array($where) && $this->edit_table($this->resume,$arr,$where));
    }
    // costum update
    
    public function remove_chat_where_id($id){
        return (!empty($id) && intval($id)>0 && $this->remove_where_array_in_table($this->chat,['id'=>intval($id)]));
    }
}