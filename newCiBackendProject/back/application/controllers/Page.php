<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {
	public function index(){
		$this->load->view('page');
	}
	public function users()
    {
        header('Content-Type: application/json');
        $users = [
            ['id' => 1, 'name' => 'Ali'],
            ['id' => 2, 'name' => 'Sara'],
        ];
        echo json_encode($users);
    }
}
