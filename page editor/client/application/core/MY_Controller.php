<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class MY_Controller extends CI_Controller
{
	public function __construct()
	{
	    
		parent::__construct();
// 		$this->lang->load('fa');
		$this->load->model('Ticket_model');
	    $this->load->model('User_model');
		$this->load->model('Page_model');
		$this->load->model('Site_user_model');
		$this->load->model('Content_model');
		$this->load->model('ChatOrTicket');
		$this->load->model('Menu_model');
		$this->load->model('Auth_model');
		$this->load->model('News_model');
		$this->load->model('Map_model');
		$this->load->model('Post_model');
		$this->load->model('Error_model');
		$this->load->model('Box_model');
		$this->load->model('Slider_model');
		$this->load->model('Icon_model');
		$this->load->model('Pic_model');
		$this->load->model('Side_model');
}}