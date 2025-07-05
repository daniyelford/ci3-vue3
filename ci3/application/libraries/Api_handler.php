<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Api_handler{
    private $handlers=[];
    public function __construct(
        Upload_handler $upload,
        Security_handler $security,
        Login_handler $login,
        User_handler $user,
        News_handler $news,
        Wallet_handler $wallet
    ) {
        $this->handlers = [
            'upload'   => $upload,
            'security' => $security,
            'login'    => $login,
            'user'     => $user,
            'news'     => $news,
            'wallet'   => $wallet,
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