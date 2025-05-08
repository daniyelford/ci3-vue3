<?php

class Admin extends CI_Controller
{
	public function index()
	{
		$this->load->database();
		$this->load->view('dashboard/admin_panel.php');
	}
}

?>
