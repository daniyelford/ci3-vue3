<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vue extends CI_Controller {
	public function index(){
        redirect('front/dist/');
	}
}
