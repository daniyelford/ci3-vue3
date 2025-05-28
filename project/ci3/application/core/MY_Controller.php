<?php

class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Users_model');
        $this->load->model('Media_model');
    }
}
// $this->load->library('form_validation');
// $this->load->model('Notification_model');