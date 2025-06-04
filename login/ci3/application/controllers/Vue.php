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
	public function index(){
		$this->session->set_userdata('api_key',$this->generate_random_string(32));
		$this->session->set_userdata('api_key_back',$this->generate_random_string(32));
		echo $this->load->view('dist/vue',[],true).$this->load->view('vue_data',['api_key'=>$this->session->userdata('api_key')],true);
	}
}
