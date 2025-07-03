<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Api_handler{
    private $CI;
    private $handlers=[];
    public function __construct(){
		$this->CI =& get_instance();
        $this->CI->load->library('Tools/Upload_handler');
        $this->CI->load->library('Tools/Security_handler');
        $this->CI->load->library('Main/Login/Login_handler');
        $this->CI->load->library('Main/Dashboard/User_handler');
        $this->CI->load->library('Main/Dashboard/News_handler');
        $this->CI->load->library('Main/Dashboard/Wallet_handler');
        $this->handlers = [
            'upload'    => new Upload_handler(),
            'security'  => new Security_handler(),
            'login'     => new Login_handler(),
            'user'      => new User_handler(),
            'news'      => new News_handler(),
            'wallet'    => new Wallet_handler(),
        ];
	}
    public function handler($data){
        header('Content-Type: application/json');
        if (!empty($data) && !empty($data['control']) && !empty($data['action'])) {
            $control = strtolower(trim($data['control']));
            $action = trim($data['action']);
            if (!array_key_exists($control,$this->handlers) || !isset($this->handlers[$control])) exit(json_encode(['status' => 'error', 'message' => 'ماژول یافت نشد']));
            $handler = $this->handlers[$control];
            if (!method_exists($handler, $action)) exit(json_encode(['status' => 'error', 'message' => "متد «{$action}» در ماژول «{$control}» وجود ندارد"]));
            $method = new ReflectionMethod($handler, $action);
            $numParams = $method->getNumberOfRequiredParameters();
            try {
                exit(json_encode($numParams > 0? $handler->{$action}($data['data']??null): $handler->{$action}()));
            } catch (Exception $e) {
                exit(json_encode(['status' => 'error', 'message' => $e->getMessage()]));
            }
        }
        exit(json_encode(['status' => 'error', 'message' => 'کنترل یا اکشن خالی است']));
    }
}