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
	private function generate_api_token_file() {
		if ($this->session->has_userdata('api_token_file')) {
			$oldPath = $this->session->userdata('api_token_file');
			if (file_exists($oldPath)) {
				@unlink($oldPath);
			}
		}
		$token = bin2hex(random_bytes(32));
		$time=time();
		$hashName = sha1(bin2hex(random_bytes(32)) . microtime(true));
	    $filePath = APPPATH . "config/token/api_token_$hashName.php";
		$content = "<?php\n";
		$content .= "defined('BASEPATH') OR exit('No direct script access allowed');\n\n";
		$content .= "const API_TOKEN = '$token';\n";
		$content .= "const API_TOKEN_TIME = '$time';\n";
		file_put_contents($filePath, $content);
		$this->session->set_userdata('api_token_file', $filePath);
		return $token;
	}
	public function create_token() {
		$apiKeyFile = $this->session->userdata('api_key_file');
		if (!$apiKeyFile || !file_exists($apiKeyFile)) {
			echo json_encode(['status' => 'error', 'code' => 401, 'message' => 'No key file']);
			return;
		}
	    require_once($apiKeyFile);
		$token=$this->generate_api_token_file();
		$headers = apache_request_headers();
		$apiKey = $headers['X-API-KEY'] ?? '';
		if ($apiKey !== API_KEY) {
			echo json_encode(['status'=>'error','code' => 401,'massage'=>'1']);
			return;
		}
		echo json_encode(['status'=>'success','token' => $token ,'key'=>API_KEY_BACK]);
	}
	public function api() {
		header('Content-Type: application/json');
		if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
			echo json_encode(['status' => 'error', 'code' => 401,'massage'=>'2']);
			return;
		}
		$data = $this->get_json_post_data();
		$headers = $this->get_authorization_header();
		$token = str_replace('Bearer ', '', $headers['Authorization'] ?? '');
		$apiKey = $headers['X-API-KEY'] ?? '';
		$apiKeyBack = $headers['X-API-KEY-BACK'] ?? '';
		$apiKeyFile = $this->session->userdata('api_key_file');
		$apiTokenFile = $this->session->userdata('api_token_file');
		if (!$apiKeyFile || !$apiTokenFile ||
		!file_exists($apiKeyFile) ||
		!file_exists($apiTokenFile)) {
			echo json_encode(['status' => 'error', 'code' => 401, 'message' => 'Session invalid']);
			return;
		}
		require_once($apiKeyFile);
		require_once($apiTokenFile);
		$valid=(($apiKey === API_KEY) && ($apiKeyBack === API_KEY_BACK) && ($token === API_TOKEN) && (time() - API_TOKEN_TIME <= 120));
		if (!$valid) {
			echo json_encode(['status' => 'error', 'code' => 401, 'data' => [
				'valid_key'=>($apiKey === API_KEY),
				'valid_key_back'=>($apiKeyBack === API_KEY_BACK),
				'valid_token'=>($token === API_TOKEN),
				'valid_token_time'=>(time() - API_TOKEN_TIME <= 120),
				'error'=>[
					'a'=>$token,
					'b'=>API_TOKEN,
				]
			]]);
			return;
		}
		$handler = new Api_handler();
		$handler->handler($data);
	}
}