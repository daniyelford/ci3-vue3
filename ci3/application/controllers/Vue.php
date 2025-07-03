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
	private function generate_api_key_file() {
		if ($this->session->has_userdata('api_key_file')) {
			$oldPath = $this->session->userdata('api_key_file');
			if (file_exists($oldPath)) {
				@unlink($oldPath);
			}
		}
		$key = $this->generate_random_string(32);
		$keyBack = $this->generate_random_string(32);
		$hashName = sha1($this->generate_random_string(32) . microtime(true));
	    $filePath = APPPATH . "config/token/api_keys_$hashName.php";
		$content = "<?php\n";
		$content .= "defined('BASEPATH') OR exit('No direct script access allowed');\n\n";
		$content .= "const API_KEY = '$key';\n";
		$content .= "const API_KEY_BACK = '$keyBack';\n";
		file_put_contents($filePath, $content);
		$this->session->set_userdata('api_key_file', $filePath);
		return true;
	}
	public function index(){
		$this->generate_api_key_file();
		$apiKeyFile = $this->session->userdata('api_key_file');
    	require_once($apiKeyFile);
		echo $this->load->view('dist/vue',[],true).$this->load->view('vue_data',['api_key'=>API_KEY],true);
	}
}
