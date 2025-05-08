<?php

class MY_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Insert_Model');
		$this->load->model('Select_Model');
		$this->load->model('Update_Model');
		$this->load->model('Delete_Model');
	}
}

//class User_Controller extends MY_Controller{
//    function __construct()
//    {
//        parent::__construct();
//        if($this->session->userdata('logged_in')!=TRUE){
//            redirect('login/index');
//        }
//    }
//}

class Admin_Controller extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
//		if ($this->session->userdata('logged_in') != TRUE || $this->session->userdata('role') != 'admin') {
//			redirect('login/index');
//		}
	}
}

?>
   
