<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Loader extends CI_Loader
{
    public Category_model $category_model;
    public Media_model $media_model;
    public News_model $news_model;
    public Notification_model $notification_model;
    public Users_model $users_model;
    public Wallet_model $wallet_model;
    public Send_handler $send_handler;
    public Functions_handler $functions_handler;
    public Security_handler $security_handler;
    public Finger_print $finger_print;
    public Upload_handler $upload_handler;
    public Login_handler $login_handler;
    public User_handler $user_handler;
    public News_handler $news_handler;
    public Wallet_handler $wallet_handler;
    public Api_handler $api_handler;
    public function __construct()
    {
        parent::__construct();
        $CI =& get_instance();
        require_once(APPPATH . 'libraries/Tools/Send_handler.php');
        require_once(APPPATH . 'libraries/Tools/Functions_handler.php');
        require_once(APPPATH . 'libraries/Tools/Security_handler.php');
        require_once(APPPATH . 'libraries/Main/Login/Finger_print.php');
        require_once(APPPATH . 'libraries/Tools/Upload_handler.php');
        require_once(APPPATH . 'libraries/Main/Login/Login_handler.php');
        require_once(APPPATH . 'libraries/Main/Dashboard/User_handler.php');
        require_once(APPPATH . 'libraries/Main/Dashboard/News_handler.php');
        require_once(APPPATH . 'libraries/Main/Dashboard/Wallet_handler.php');
        require_once(APPPATH . 'libraries/Api_handler.php');
        $this->model('Category_model', 'category_model');
        $this->category_model = $CI->category_model;
        $this->model('Media_model', 'media_model');
        $this->media_model = $CI->media_model;
        $this->model('News_model', 'news_model');
        $this->news_model = $CI->news_model;
        $this->model('Notification_model', 'notification_model');
        $this->notification_model = $CI->notification_model;
        $this->model('Users_model', 'users_model');
        $this->users_model = $CI->users_model;
        $this->model('Wallet_model', 'wallet_model');
        $this->wallet_model = $CI->wallet_model;
        $this->send_handler= new Send_handler();
        $this->security_handler= new Security_handler();
        $this->finger_print= new Finger_print();
        $this->user_handler= new User_handler(
            $this->security_handler,
            $this->users_model,
            $this->media_model,
            $this->notification_model
        );
        $this->functions_handler= new Functions_handler(
            $this->user_handler,
            $this->wallet_model,
            $this->category_model,
            $this->media_model,
            $this->users_model,
            $this->notification_model,
            $this->news_model
        );
        $this->news_handler= new News_handler(
            $this->security_handler,
            $this->user_handler,
            $this->functions_handler,
            $this->category_model,
            $this->news_model,
            $this->notification_model,
            $this->users_model,
            $this->media_model
        );
        $this->wallet_handler= new Wallet_handler(
            $this->security_handler,
            $this->functions_handler,
            $this->user_handler,
            $this->users_model,
            $this->wallet_model,
            $this->notification_model
        );
        $this->upload_handler= new Upload_handler(
            $this->security_handler,
            $this->media_model
        );
        $this->login_handler= new Login_handler(
            $this->send_handler, 
            $this->security_handler, 
            $this->finger_print,
            $this->users_model,
            $this->media_model
        );
        $this->api_handler= new Api_handler(
            $this->upload_handler,
            $this->security_handler,
            $this->login_handler,
            $this->user_handler,
            $this->news_handler,
            $this->wallet_handler
        );
        $CI->category_model=$this->category_model;
        $CI->media_model=$this->media_model;
        $CI->news_model=$this->news_model;
        $CI->notification_model=$this->notification_model;
        $CI->users_model=$this->users_model;
        $CI->wallet_model=$this->wallet_model;
        $CI->send_handler=$this->send_handler;
        $CI->functions_handler=$this->functions_handler;
        $CI->security_handler=$this->security_handler;
        $CI->finger_print=$this->finger_print;
        $CI->upload_handler=$this->upload_handler;
        $CI->login_handler=$this->login_handler;
        $CI->user_handler=$this->user_handler;
        $CI->news_handler=$this->news_handler;
        $CI->wallet_handler=$this->wallet_handler;
        $CI->api_handler=$this->api_handler;
    }
}
