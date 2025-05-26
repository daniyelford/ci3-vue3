<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vue extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		$this->load->view('dist/vue');
	}
	private function get_json_post_data() {
    	return json_decode(file_get_contents("php://input"), true);
	}
	public function api() {
		if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
			http_response_code(405);
			echo json_encode(['status' => 'error', 'message' => 'روش نادرست']);
			return;
		}
		$data = $this->get_json_post_data();
		$headers = apache_request_headers();
		$token = str_replace('Bearer ', '', $headers['Authorization'] ?? '');
		if (!$this->session->has_userdata('token') || $this->session->userdata('token') !== $token) {
			http_response_code(401);
			echo json_encode(['status' => 'error', 'message' => 'توکن نامعتبر است']);
			return;
		}
		$this->handler($data['data']);
	}
	public function create_token() {
		$token = bin2hex(random_bytes(32));
		$this->session->set_userdata('token',$token);
		echo json_encode(['token' => $token]);
	}
	private function handler($data){
		echo json_encode([
			'status' => 'ok',
			'message' => 'درخواست معتبر است'
		]);
	}
}
