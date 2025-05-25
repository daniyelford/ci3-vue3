<?php

class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('cookie');
        $this->load->library('form_validation');
        $this->load->library('Jdf');
        $this->load->library('OAuth2');
        $this->load->library('Product_handler');
        $this->load->library('Role_handler');
        $this->load->library('Click_actions');
        $this->load->library('Position_handler');
        $this->load->library('Category_handler');
        $this->load->library('Company_handler');
        $this->load->library('Main_exploder');
        $this->load->library('User_handler');
        // $this->load->library('Ciqrcode');
        $this->load->model('Category_model');
        $this->load->model('Company_model');
        $this->load->model('Include_model');
        $this->load->model('Product_model');
        $this->load->model('Roles_model');
        $this->load->model('Users_model');
        $this->load->model('Order_model');
        $this->load->model('Position_model');
        // $this->load->model('Webauthn_model');
        
        // $this->load->model('Notification_model');
    }
}