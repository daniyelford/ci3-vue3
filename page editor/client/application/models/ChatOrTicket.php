<?php

class ChatOrTicket extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function select_all($table)
	{
		return $this->db->get($table)->result_array();
	}

	public function select_tbl_where($table, $condition)
	{
		return $this->db->get_where($table, $condition)->result_array();
	}

	public function update_tbl($table, $info, $condition)
	{
		return $this->db->update($table, $info, $condition);
	}

	public function insert_tbl($table, $data)
	{
		return $this->db->insert($table, $data);
	}

	//for this table
	public function select_custom_condition($table, $col, $condition)
	{
		$sql = "select $col from $table where $condition";
		return $this->db->query($sql)->result_array();
	}

	public function select_where($condition)
	{
		return $this->db->get_where('chat_ticket', $condition)->result_array();
	}

	public function insert_data($data)
	{
		return $this->insert_tbl('chat_ticket', $data);
	}

	public function block_user($blocker_id, $block_id, $type)
	{
		return $this->insert_tbl('block', array('blocker_id' => $blocker_id, 'block_id' => $block_id, 'type' => $type));
	}

	public function unblock_user($unblock_id, $user_id, $type)
	{
		return $this->update_tbl('block', array('status' => 0), array('blocker_id' => $unblock_id, 'block_id' => $user_id, 'type' => $type));
	}

	public function check_for_block($user_id, $receiver, $type)
	{
		return empty($this->select_tbl_where('block', array('blocker_id' => $receiver, 'block_id' => $user_id, 'type' => $type, 'status' => 1))) || !empty($this->select_tbl_where('block', array('blocker_id' => $receiver, 'block_id' => $user_id, 'type' => $type, 'status' => 0)));
	}

	public function remove_my_chat_for_other($id, $my_id, $other_id)
	{
		return $this->db->delete('chat_ticket', array('id' => $id, 'user_id' => $my_id, 'receive_id' => $other_id));
	}

	public function remove_other_chat_for_me($condition)
	{
		return $this->update_tbl('chat_tickets', array('close_ticket' => 1),$condition);
	}
}
