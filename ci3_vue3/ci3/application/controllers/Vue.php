<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vue extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->library('Api_handler');
	}
	private function generate_random_string($length = 32) {
    	return bin2hex(random_bytes($length / 2));
	}
	private function get_json_post_data() {
		return json_decode(file_get_contents("php://input"), true);
	}
	public function index(){
		$this->session->set_userdata('api_key',$this->generate_random_string(32));
		$this->session->set_userdata('api_key_back',$this->generate_random_string(32));
		echo $this->load->view('dist/vue',[],true).$this->load->view('vue_data',['api_key'=>$this->session->userdata('api_key')],true);
	}
	public function create_token() {
		$headers = apache_request_headers();
		$apiKey = $headers['X-API-KEY'] ?? '';
		if (!$this->session->has_userdata('api_key_back') || !$this->session->has_userdata('api_key') || empty($this->session->userdata('api_key')) || empty($this->session->userdata('api_key_back')) || $this->session->userdata('api_key') !== $apiKey) {
			http_response_code(403);
			echo json_encode(['error' => 'دسترسی غیرمجاز']);
			return;
		}
		$token = bin2hex(random_bytes(32));
		$this->session->set_userdata('token',$token);
		echo json_encode(['token' => $token]);
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
		$providedKey = $headers['X-API-KEY'] ?? '';
		if (!$this->session->has_userdata('api_key') || !$this->session->has_userdata('api_key_back') || !$this->session->has_userdata('token') || empty($this->session->userdata('api_key')) || empty($this->session->userdata('api_key_back')) || empty($this->session->userdata('token')) || $this->session->userdata('token') !== $token || $this->session->userdata('api_key') !== $providedKey) {
			http_response_code(401);
			echo json_encode(['status' => 'error', 'message' => 'توکن نامعتبر است']);
			return;
		}
		$handler = new Api_handler();
		$handler->handler($data['data']);
	}
}
