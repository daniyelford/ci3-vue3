<?php

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function admin_panel()
	{
		$this->template->load('dashboard/admin_panel.php');
	}
	public function index()
	{
		$this->load->view('dashboard/admin_panel.php');
//		$this->template->load('dashboard/user_panel.php');
	}
}

?>
