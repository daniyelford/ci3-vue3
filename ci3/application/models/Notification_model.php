<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification_model extends CI_Model
{
    protected $table = 'notifications';

    public function insert_batch($arr){
        return (!empty($arr) && is_array($arr) && $this->db->insert_batch($this->table, $arr));
    }

    public function insert($data){
        return (!empty($data) && is_array($data) && $this->db->insert($this->table, $data));
    }

    public function get_unread_by_user_account_id($user_id){
        return $this->db->where('user_account_id', $user_id)->where('is_read', 'dont')->order_by('created_at', 'DESC')->get($this->table)->result_array();
    }

    public function mark_as_read($id,$user_id){
        return $this->db->where(['id' => $id, 'user_account_id' => $user_id])->update($this->table, [
            'is_read' => 'seen',
            'read_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
