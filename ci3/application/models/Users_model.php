<?php

class Users_model extends CI_Model
{
    public function __construct()
	{
		parent::__construct();
	}
	private $tbl="users";
	private $mobile='user_mobile';
	private $account='user_account';
	private $address='user_address';
	private $credential='user_credentials';
	private function select_where_array_table($tbl,$arr){
	    return (!empty($tbl) && is_string($tbl) && !empty($arr) && is_array($arr)?$this->db->get_where($tbl,$arr)->result_array():false);
	}
	private function select_where_id_table($tbl,$id){
	    return (!empty($tbl) && is_string($tbl) && !empty($id) && intval($id)>0?$this->select_where_array_table($tbl,['id'=>intval($id)]):false);
	}
    private function select_where_in_array_table(String $tbl,String $key,Array $arr){
        if (!empty($tbl) && is_string($tbl) && !empty($arr) && is_array($arr) && !empty($key) && is_string($key)){
            $this->db->where_in($key, $arr);
            return $this->db->get($tbl)->result_array();
        }
        return [];
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
    public function get_info_user_data_by_account_id($user_account_id){
        if (empty($user_account_id) || !is_numeric($user_account_id)) return false;
        $this->db->select('
            user_account.*,
            user_mobile.phone AS phone,
            user_mobile.image_id AS user_image_id,
            users.name,
            users.family,
            users.status AS user_status,
            media.url AS image
        ');
        $this->db->from('user_account');
        $this->db->join('user_mobile', 'user_account.user_mobile_id = user_mobile.id', 'left');
        $this->db->join('users', 'user_mobile.user_id = users.id', 'left');
        $this->db->join('media', 'user_mobile.image_id = media.id', 'left');
        $this->db->where('user_account.id', $user_account_id);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function get_full_user_data_by_account_id($user_account_id){
        if (empty($user_account_id) || !is_numeric($user_account_id)) return false;
        $this->db->select('
            user_account.*,
            user_mobile.phone AS phone,
            user_mobile.id AS user_mobile_id,
            user_mobile.image_id AS user_image_id,
            users.name,
            users.family,
            users.status AS user_status,
            media.url AS image
        ');
        $this->db->from('user_account');
        $this->db->join('user_mobile', 'user_account.user_mobile_id = user_mobile.id', 'left');
        $this->db->join('users', 'user_mobile.user_id = users.id', 'left');
        $this->db->join('media', 'user_mobile.image_id = media.id', 'left');
        $this->db->where('user_account.id', $user_account_id);
        $query = $this->db->get();
        $result = $query->row_array();
        if (!$result) return false;
        $this->db->from('user_credentials');
        $this->db->where('user_mobile_id', $result['user_mobile_id']);
        $this->db->limit(1);
        $credential_query = $this->db->get();
        $result['has_finger'] = $credential_query->num_rows() > 0;
        return $result;
    }





    public function select_address_where_news(){
	    return $this->select_where_array_table($this->address,['status'=>'news']);
	}
	public function select_address_where_user_account_id($id){
	    return (!empty($id) && intval($id)?$this->select_where_array_table($this->address,['user_account_id '=>intval($id)]):false);
	}
    public function select_where_id($id){
	    return (!empty($id) && intval($id)?$this->select_where_id_table($this->tbl,intval($id)):false);
	}
    public function select_mobile_where_id($id){
	    return (!empty($id) && intval($id)?$this->select_where_id_table($this->mobile,intval($id)):false);
	}
    public function select_mobile($str){
        return (!empty($str) && is_string($str)?$this->select_where_array_table($this->mobile,['phone'=>$str]):false);
	}
    public function select_account_where_id($id){
	    return (!empty($id) && intval($id)?$this->select_where_id_table($this->account,intval($id)):false);
	}
    public function select_account_where_mobile_id($id){
	    return (!empty($id) && intval($id)?$this->select_where_array_table($this->account,['user_mobile_id'=>intval($id)]):false);
	}
    public function select_account_where_category_ids_array($arr){
	    return (!empty($arr) && is_array($arr)?$this->select_where_in_array_table($this->account,'category_id',$arr):false);
	}
    public function credential_where_user_mobile_id($id){
	    return (!empty($id) && intval($id)?$this->select_where_array_table($this->credential,['user_mobile_id'=>intval($id)]):false);
	}
    public function credential_where_credential_id($id){
	    return (!empty($id) && is_string($id)?$this->select_where_array_table($this->credential,['credential_id'=>$id]):false);
	}
    public function add_return_id($arr){
        return (!empty($arr) && is_array($arr)?$this->add_to_table_return_id($this->tbl,$arr):false);
    }
    public function add_address_return_id($arr){
        return (!empty($arr) && is_array($arr)?$this->add_to_table_return_id($this->address,$arr):false);
    }
    public function add_address($arr){
        return (!empty($arr) && is_array($arr) && $this->add_to_table($this->address,$arr));
    }
    public function add_credential($arr){
        return (!empty($arr) && is_array($arr) && $this->add_to_table($this->credential,$arr));
    }
    public function add_account_return_id($arr){
        return (!empty($arr) && is_array($arr)?$this->add_to_table_return_id($this->account,$arr):false);
    }
    public function add_mobile_return_id($arr){
        return (!empty($arr) && is_array($arr)?$this->add_to_table_return_id($this->mobile,$arr):false);
    }
    public function edit_weher_id($arr,$id){
        return (!empty($id) && intval($id)>0 && !empty($arr) && is_array($arr) && $this->edit_table($this->tbl,$arr,['id'=>intval($id)]));
    }
    public function edit_mobile_weher_id($arr,$id){
        return (!empty($id) && intval($id)>0 && !empty($arr) && is_array($arr) && $this->edit_table($this->mobile,$arr,['id'=>intval($id)]));
    }
    public function edit_account_weher_id($arr,$id){
        return (!empty($id) && intval($id)>0 && !empty($arr) && is_array($arr) && $this->edit_table($this->account,$arr,['id'=>intval($id)]));
    }
    public function edit_credential_where_id($arr,$id){
        return (!empty($id) && intval($id)>0 && !empty($arr) && is_array($arr) && $this->edit_table($this->credential,$arr,['id'=>intval($id)]));
    }
    public function change_address_to_news_where_id($id){
        return (!empty($id) && intval($id)>0 && $this->edit_table($this->address,['status'=>'news'],['id'=>intval($id)]));
    }
}