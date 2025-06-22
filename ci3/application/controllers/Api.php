<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// api_key ,api_key_back ,token ,token_created_at

class Api extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->library('Api_handler');
	}
	private function get_json_post_data() {
		return json_decode(file_get_contents("php://input"), true);
	}
	private function get_authorization_header() {
		$headers = apache_request_headers();
		if(empty($headers) || empty($headers['Authorization'])){
			$headers = [];
			foreach ($_SERVER as $key => $value) {
				if (strpos($key, 'HTTP_') === 0) {
					$name = str_replace('_', '-', substr($key, 5));
					$headers[$name] = $value;
				}
			}
		}
        return $headers;
    }
	public function create_token() {
		$headers = apache_request_headers();
		$apiKey = $headers['X-API-KEY'] ?? '';
		if (!$this->session->has_userdata('api_key_back') || !$this->session->has_userdata('api_key') || empty($this->session->userdata('api_key')) || empty($this->session->userdata('api_key_back')) || $this->session->userdata('api_key') !== $apiKey) {
			echo json_encode(['status'=>'error','code' => 401]);
			return;
		}
		$token = bin2hex(random_bytes(32));
		$this->session->set_userdata('token',$token);
		$this->session->set_userdata('token_created_at', time());
		echo json_encode(['status'=>'success','token' => $token]);
	}
	public function api() {
		header('Content-Type: application/json');
		if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
			echo json_encode(['status' => 'error', 'code' => 401]);
			return;
		}
		$data = $this->get_json_post_data();
		$headers = $this->get_authorization_header();
		$token = str_replace('Bearer ', '', $headers['Authorization'] ?? '');
		$providedKey = $headers['X-API-KEY'] ?? '';
		$valid =$this->session->has_userdata('api_key') &&
			$this->session->has_userdata('token') &&
			$this->session->userdata('api_key') === $providedKey &&
			$this->session->userdata('token') === $token;
		$createdAt = $this->session->userdata('token_created_at');
		if (!$valid || !$createdAt || (time() - $createdAt > 120)) {
			echo json_encode(['status' => 'error', 'code' => 401]);
			return;
		}
		$handler = new Api_handler();
		$handler->handler($data);
	}
}
