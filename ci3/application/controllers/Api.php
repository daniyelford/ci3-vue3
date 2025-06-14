<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->library('Api_handler');
	}
	private function get_json_post_data() {
		return json_decode(file_get_contents("php://input"), true);
	}
	public function create_token() {
		$headers = apache_request_headers();
		$apiKey = $headers['X-API-KEY'] ?? '';
		if (!$this->session->has_userdata('api_key_back') || !$this->session->has_userdata('api_key') || empty($this->session->userdata('api_key')) || empty($this->session->userdata('api_key_back')) || $this->session->userdata('api_key') !== $apiKey) {
			echo json_encode(['error' => 'دسترسی غیرمجاز']);
			return;
		}
		$token = bin2hex(random_bytes(32));
		$this->session->set_userdata('token',$token);
		echo json_encode(['token' => $token]);
	}
	public function api() {
		if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
			echo json_encode(['status' => 'error', 'message' => 'روش نادرست']);
			return;
		}
		$data = $this->get_json_post_data();
		$headers = apache_request_headers();
		$token = str_replace('Bearer ', '', $headers['Authorization'] ?? '');
		$providedKey = $headers['X-API-KEY'] ?? '';
		if (!$this->session->has_userdata('api_key') || !$this->session->has_userdata('api_key_back') || !$this->session->has_userdata('token') || empty($this->session->userdata('api_key')) || empty($this->session->userdata('api_key_back')) || empty($this->session->userdata('token')) || $this->session->userdata('token') !== $token || $this->session->userdata('api_key') !== $providedKey) {
			echo json_encode(['status' => 'error', 'message' => 'توکن نامعتبر است']);
			return;
		}
		$handler = new Api_handler();
		$handler->handler($data);
	}
}
