<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Email extends MY_Controller
{
	public function __construct(){
		parent::__construct();
	}
    public function send($to,$title,$body){
        if(!empty($to) && is_string($to)){
            $this->load->library('email');
            $this->email->from('info@my-home.ir', 'my home');
            $this->email->to($to);
            $title=(!empty($title) && is_string($title)?$title:'');
            $this->email->subject($title);
            $body=(!empty($body) && is_string($body)?$body:'');
            $this->email->message($body);
            $this->email->send();
            return true;
        }
        return false;
    }	
}