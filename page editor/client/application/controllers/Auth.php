<?php

class Auth extends MY_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->helper('cookie');
	}

	public function index(){
	    if (isset($_POST['btn'])) {
			$username_info = $this->input->post('code_mely', true);
			$password_info = $this->input->post('phone', true);
			if (!empty($username_info) && !empty($password_info)) {
    			$username = md5($username_info);
    			$password = md5($password_info);
    			$result = $this->Auth_model->select_bind_one('username', $username, 'password', $password);
    			if ($result->num_rows() > 0) {
    				$row = $result->row();
    				$data = array(
    					'success' => 'ورود موفقیت آمیز بود',
    					'id' => $row->id,
    					'user_id'=>$row->id,
    					'pic' => $row->pic,
    					'role' => $row->role,
    					'name' => $row->name,
    					'active' => 1,
    					'code_mely'=>$row->code_mely,
    					'username' => $row->name,
    					'ip' => $this->input->ip_address(),
    					'time' => time()
    				);
    				$this->session->set_userdata($data);
    				if (isset($_POST['save'])) {
    					$this->Auth_model->another_method_set_cookie('username', $username_info);
    					$this->Auth_model->another_method_set_cookie('password', $password_info);
                        $this->Auth_model->another_method_set_cookie('forgot', "ok");
    				} else {
    					$this->Auth_model->flash_cookie('username');
    					$this->Auth_model->flash_cookie('password');
    				    $this->Auth_model->flash_cookie('forgot');
    				}
    			    echo $this->Auth_model->s_alert("عملیات موفق بود"," ","success","ورود",base_url().'home');
    			} else {
    				$this->session->set_userdata(array('error_log' => 'اطلاعات اشتباه می باشد'));
    				redirect('auth');
    			}
		    } else {
			    $this->session->set_userdata(array('error_empty' => "فرم ها را پر کنید"));
			    redirect('auth');
		    }
	    }

	//set the forgot password checkbox
	if (isset($_COOKIE['forgot']) && $_COOKIE['forgot']==="ok" && !empty($_COOKIE['forgot'])) {
		$checked = true;
		$forgot_username = $_COOKIE['username'];
		$forgot_password = $_COOKIE['password'];
	} else {
		$checked = false;
		$forgot_username = '';
		$forgot_password = '';
	}
	//end of set the forgot password checkbox

	//send form values
	$username = array('class' => 'form-control rounded-10', 'value' => $forgot_username, 'placeholder' => '', 'type' => 'text', 'name' => 'code_mely');
	$password = array('class' => 'form-control rounded-10', 'placeholder' => '', 'type' => 'password', 'value' => $forgot_password, 'name' => 'phone');
	$checkbox = array('class' => "pt-1", 'name' => "save", 'id' => "save", 'value' => "savePassword", 'checked' => $checked, 'style' => 'position:relative;top: 3px;');
	$btn = array("content" => 'ورود به حساب کاربری', 'class' => 'btn btn-success btn-block mt-4 rounded-10', 'type' => 'submit', 'name' => 'btn');
	//end of send form values

	//get the errors from sessions
	if (!empty($this->session->userdata('error_log'))) {
		$error = array('error' => $this->session->userdata('error_log'));
		$this->session->unset_userdata('error_log');
	} elseif (!empty($this->session->userdata('error_empty'))) {
		$error = array('error' => $this->session->userdata('error_empty'));
		$this->session->unset_userdata('error_empty');
	} else {
		$error = array();
	}
	//end of get the errors from session

	//get the success session
	if (!empty($this->session->userdata('success'))) {
		$success = $this->session->userdata('success');
		$this->session->unset_userdata('success');
	} else {
		$success = '';
	}
	//end of get the success session

	//set vars values for view page

	$header = array('favicon' => 'logo1.png',
		'description' => 'login page',
		'keyword' => 'login page',
		'page_title' => 'login'
	);
	$data=array(
		'username' => $username,
		'password' => $password,
		'btn' => $btn,
		'slider_pic' => ['1.jpeg', '2.jpg', '3.jpg', '4.jpg'],
		'error' => $error,
		'label1'=>'حساب کاربری' ,
		'label2'=>'رمز عبور',
		'success' => $success,
		'forget_url' => 'auth' . DS . 'remember',
		'create_user_url' => 'auth' . DS . 'register',
		'logo' => 'logo1.png',
		'company_name' => 'علاالدین',
		'slider_pic_active' => '3.jpg',
		'slider_pic_one' => '4.jpg',
		'checkbox' => $checkbox
	);
	$footer = array('footer' => "<span>پرتال ساز پردازش هوشمند علاالدین _ پشتیبانی: 02691010197</span>");
	//end of set vars values for view page

	//send vars and show view page
	$a = $this->load->view('panel' . DS . 'header', $header, TRUE);
	$a .= $this->load->view('panel' . DS . 'auth', $data, TRUE);
	$a .= $this->load->view('panel' . DS . 'footer', $footer, TRUE);
	echo $a;
	//end of send vars and show view page
}

	public function register(){
		$n = '<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>';
		$n .= '<script>
			        $(document).ready(function(){
			            $("#cap_err").hide();
			        })
			     </script>';
		$m = '<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>';
		$m .= '	<script>
			        			$(document).ready(function(){
			            			$("#cap_err").show();
			        			})
			     			</script>';
		echo $n;
		if ($this->input->post('send')) {
			$config = array(
				array(
					'field' => 'code_mely',
					'label' => 'code_mely',
					'rules' => 'required|min_length[9]|max_length[12]|is_unique[users.code_mely]|numeric',
					'errors' => array(
						'required' => 'کد ملی را پر کنید',
						'min_length' => 'کد ملی 10 عدد می باشد',
						'is_unique' => 'کد ملی موجود است',
					    'max_length'=>'تعداد ارقام بیشتر از حد مجاز است',
						'numeric' => 'لطفا عدد وارد کنید'
					)
				),
				array(
					'field' => 'phone',
					'label' => 'phone',
					'rules' => 'required|min_length[10]|max_length[14]|numeric',
					'errors' => array(
						'required' => 'شماره موبایل نباید خالی باشد',
						'min_length' => 'شماره موبایل باید 11 عدد باشد',
					    'max_length'=>'تعداد ارقام بیشتر از حد مجاز است',
						 'numeric' => 'لطفا عدد وارد کنید'
					)
				),
				array(
					'field' => 'email',
					'label' => 'email',
					'rules' => 'is_unique[users.email]|valid_email',
					'errors' => array(
						'is_unique' => 'ایمیل تکراری است',
						'valid_email' => 'ایمیل صحیح نمی باشد'
					)
				),
				array(
					'field' => 'code_posty',
					'label' => 'code_posty',
					'rules' => 'required|min_length[9]|max_length[12]|is_unique[users.code_posty]|numeric',
					'errors' => array(
						'required' => 'کد پستی را وارد کنید',
						'min_length' => 'تعداد عدد ها کافی نیست',
                        'max_length'=>'تعداد ارقام بیشتر از حد مجاز است',
						'is_unique' => 'کد  پستی نمی تواند تکراری باشد',
						'numeric' => 'لطفا عدد وارد کنید'
					)
				),
			);
			$this->form_validation->set_rules($config);
			if (!empty($this->input->post('captcha')) && $this->input->post('captcha') == $this->session->userdata('captcha')) {
			    if ($this->form_validation->run() === false) {
				$msg_error_register['code_mely'] = form_error('code_mely');
				$msg_error_register['phone'] = form_error('phone');
				$msg_error_register['email'] = form_error('email');
				$msg_error_register['phone_config'] = form_error('phone_config');
				$msg_error_register['code_posty'] = form_error('code_posty');
			    } else {
					$giveData = array(
						'code_mely' => $this->input->post('code_mely', true),
						'phone' => $this->input->post('phone', true),
						'email' => $this->input->post('email', true),
						'code_posty' => $this->input->post('code_posty', true),
						'role' => 'user',
						'ip_address'=>$this->input->ip_address()
					);
					$ins_user = $this->Auth_model->insert_user($giveData);
					if ($ins_user > 0) {
						$user_info = array(
							'code_mely' => $this->input->post('code_mely',true),
							'phone'=>$this->input->post('phone',true),
							'code_posty'=>$this->input->post('code_posty',true),
							'role' => 'user_reg',
							'active'=>1
						);
						$this->session->set_userdata($user_info);
						echo $this->Auth_model->s_alert("عملیات موفق بود"," ","success","ورود",base_url()."home");
					}
			    }
			} else {
				$this->session->unset_userdata('captcha');
				echo $m;
			}
		}else{
		    echo $n;
		}
		$header = array('favicon' => 'logo1.png',
			'description' => 'register page',
			'keyword' => 'register page',
			'page_title' => 'register');
		$footer = array('footer' => '<span>پرتال ساز پردازش هوشمند علاالدین _ پشتیبانی: 02691010197</span>');
        $data= [
			'code_mely_info' => ['placeholder' => 'کد ملی خود را وارد نمایید','name' => 'code_mely', 'value' => set_value('code_mely'), 'type' => 'text', 'class' => 'form-control rounded-10', 'id' => 'code-mely'],
			'logo'=>'logo1.png',
			'phone_info' => ['placeholder' => 'شماره همراه خود را وارد نمایید', 'class' => 'form-control rounded-10', 'type' => 'text','name' => 'phone','id' => 'phone', 'value' => set_value('phone')],
			'captcha_info' => ['name' => 'captcha','type' => 'number', 'id' => 'cap','placeholder' => 'کد فعال سازی', 'class' => 'form-inter-captcha form-control rounded-10'],
			'email_info' => ['name' => 'email','type' => 'email','id' => 'email', 'value' => set_value('email'),'placeholder' => 'آدرس ایمیل', 'class' => 'form-control rounded-10'],
			'auth'=>'auth',
			'code_posty_info' => ['id' => 'code-posty','name' => 'code_posty','type' => 'text','placeholder' => 'کد پستی خود را وارد نمایید', 'class' => 'form-control rounded-10', 'value' => set_value('code_posty')],
			'btnRegister_info' => ['name' => 'send', 'class' => 'btn btn-success-gradient box-shadow-primary btn-block mt-5 rounded-10','type' => 'submit','content' => 'ثبت نام','value' => 'btnRegister', 'id' => 'btn'],
			'error' => @$msg_error_register,
		];
		$a = $this->load->view('panel' . DS . 'header', $header, TRUE);
		$a .= $this->load->view('panel' . DS . 'reg',$data, TRUE);
		$a .= $this->load->view('panel' . DS . 'footer', $footer, TRUE);
		echo $a;
	}

	public function remember(){
	    ob_start();
	    //unset sessions
// 		if (!empty($this->session->userdata('id'))) {
// 			$data = array(
// 				'id',
// 				'pic',
// 				'role',
// 				'name',
// 				'active',
// 				'username',
// 				'ip',
// 				'time'
// 			);
// 			$this->session->unset_userdata($data);
// 		}
		//end of unset sessions
		
	    if (isset($_POST['btn'])) {
            if($this->input->post('cap_forgot')===$this->session->userdata('captcha_forgot')){
			$username_info = $this->input->post('code_mely', true);
			if (!empty($username_info)) {
// 			$username = md5($username_info);
				$result = $this->Auth_model->select_forgot('code_mely', $username_info, 'phone', $username_info);
				
				if ($result->num_rows()>0) {
					$row = $result->row();
					
			        $phone_info=$row->phone;
			        $step0= strrev($phone_info);
			        $step1=str_split($step0, 10);
			        $step2= strrev($step1['0']);
		            $phones_number=array();
			        array_push($phones_number,$step2);
			        if(!empty($phones_number)){
			         
			        if(!empty($row->username)){
			            $user_new=$row->username;
			        }else{
			            if(empty($row->code_mely)){
			                $this->session->set_userdata(array('not_reg'=>'ok'));
			                return false;
			            }else{
			                $user_new=$row->code_mely;
			            }
			        }
			        $new_pass=$this->Auth_model->create_num();
			        $text='user:'.$user_new."/n".'pass:'.$new_pass;
			       
				    // $this->Auth_model->send_sms($phones_number,$text);
				     $this->Auth_model->new_pass(array('username'=>md5($user_new),'password'=>md5($new_pass)),array('id'=>$row->id));
				    $time=time()+60*2;
					$this->session->set_userdata(array('success_forgot'=>'ok','time_forgot'=>$time));
					$_SESSION['active']=1;
					$_SESSION['id']=$row->id;
					echo $this->Auth_model->s_alert("عملیات موفق بود"," ","success","ورود",base_url().'auth');
                    }else{
                        $this->session->set_userdata(array('valid_phone_num_err'=>'ok'));
                    }
				} else {
					$this->session->set_userdata(array('error_log_num' => 'ok'));
					redirect('auth'.DS.'remember');
				}
			} else {
				$this->session->set_userdata(array('error_empty_forgot' => "ok"));
				redirect('auth'.DS.'remember');
			}
		   
	        }else{
	        $this->session->set_userdata(array('error_cap_forgot'=>'ok'));
	        redirect('auth'.DS.'remember');
	        }
	    }

if(!empty($this->session->userdata('time_forgot')) && $this->session->userdata('time_forgot')===time()){
  $this->session->unset->userdata('time_forgot'); 
}


		//send form values
		$username = array('class' => 'form-control rounded-10', 'value' => '', 'placeholder' => '', 'type' => 'text', 'name' => 'code_mely');
		$password = array();
		$checkbox =array();
		 
		$btn = array("content" => 'بازیابی رمز عبور', 'class' => 'btn btn-success btn-block mt-4 rounded-10', 'type' => 'submit', 'name' => 'btn');
		//end of send form values

		//get the errors from sessions
		if (!empty($this->session->userdata('error_cap_forgot'))) {
			$error = 'کد را به درستی وارد کنید';
			$this->session->unset_userdata('error_cap_forgot');
}elseif (!empty($this->session->userdata('error_empty_forgot'))){
    $error='اطلاعات را وارد کنید';
    $this->session->unset_userdata('error_empty_forgot');
}elseif (!empty($this->session->userdata('error_log_num'))) {
        $error='اطلاعات به درستی وارد نشده است';
    $this->session->unset_userdata('error_log_num');
}elseif (!empty($this->session->userdata('valid_phone_num_err'))) {
        $error='شماره تلفن شما اشتباه می باشد';
    $this->session->unset_userdata('valid_phone_num_err');
}elseif (!empty($this->session->userdata('not_reg'))) {
        $error='ثبت نام شما ناقص بوده';
    $this->session->unset_userdata('not_reg');
}else{
    $error='';
}
		//end of get the errors from session

		//get the success session
		if (!empty($this->session->userdata('success_forgot'))) {
			$success = 'رمز جدید برای شما ارسال شده است';
			$this->session->unset_userdata('success_forgot');
		} else {
			$success = '';
		}
		//end of get the success session

		//set vars values for view page

  		$header = [
  		    'favicon' => 'logo1.png',
			'description' => 'description',
			'keyword' => 'keywords',
			'page_title' => 'forget'
		];
		$data=[
			'username' => $username,
			'password' => $password,
			'btn' => $btn,
			'label4'=>'',
			'auth'=>'auth',
			'slider_pic' => ['1.jpeg', '2.jpg', '3.jpg', '4.jpg'],
			'error' => $error,
			'label3'=>"کد ملی یا شماره همراه خود را وارد کنید",
			'captcha_forgot_info' => ['name' => 'cap_forgot','type' => 'number', 'id' => 'cap','placeholder' => 'کد فعال سازی', 'class' => 'form-inter-captcha form-control rounded-10'],
			'success' => $success,
			'forget_url' => 'auth' . DS . 'remember',
			'create_user_url' => 'auth' . DS . 'register',
			'logo' => 'logo1.png',
			'company_name' => 'علاالدین',
			'slider_pic_active' => '3.jpg',
			'slider_pic_one' => '4.jpg',
			'checkbox' => $checkbox
		];
		$footer = array('footer' => "<span>پرتال ساز پردازش هوشمند علاالدین _ پشتیبانی: 02691010197</span>");
	    $a = $this->load->view('panel'.DS.'header',$header,true);
	    $a.= $this->load->view('panel'.DS.'auth',$data,true);
	    $a.=$this->load->view('panel'.DS.'footer',$footer,true);
        // $a .= $this->s_alert("عملیات موفق بود"," ","success","ورود",base_url()."auth/valid/forgot");
	    echo $a;
	}

	//code captcha create
	public function captcha(){
		header('Content-Type: image/png');
		$img = imagecreatetruecolor('160', '70');
		$bg = imagecolorallocate($img, 255, 255, 255);
		$black = imagecolorallocate($img, 0, 0, 0);
		imagefill($img, 2, 3, $bg);
		$captcha = '';
		for ($i = 1; $i <= 8; $i++) {
			$char = rand(0, 9);
			$captcha .= $char;
			imagestring($img, 15, 10 + ($i * 15), 30, $char, $black);
		}
		$this->session->set_userdata(array('captcha' => $captcha));
		imagepng($img);
		imagedestroy($img);
	}

	//code captcha create
	public function captcha_forgot(){
		header('Content-Type: image/png');
		$img = imagecreatetruecolor('160', '70');
		$bg = imagecolorallocate($img, 255, 255, 255);
		$black = imagecolorallocate($img, 0, 0, 0);
		imagefill($img, 2, 3, $bg);
		$captcha = '';
		for ($i = 1; $i <= 8; $i++) {
			$char = rand(0, 9);
			$captcha .= $char;
			imagestring($img, 15, 10 + ($i * 15), 30, $char, $black);
		}
		$this->session->set_userdata(array('captcha_forgot' => $captcha));
		imagepng($img);
		imagedestroy($img);
	}
		
	public function captcha_first(){
		header('Content-Type: image/png');
		$img = imagecreatetruecolor('160', '70');
		$bg = imagecolorallocate($img, 255, 255, 255);
		$black = imagecolorallocate($img, 0, 0, 0);

		imagefill($img, 2, 3, $bg);
		$captcha = '';
		for ($i = 1; $i <= 8; $i++) {
			$char = rand(0, 9);
			$captcha .= $char;
			imagestring($img, 15, 10 + ($i * 15), 30, $char, $black);
		}
		$this->session->set_userdata(array('captcha_first' => $captcha));
		imagepng($img);
		imagedestroy($img);


	}

    public function ali(){
        return $this->Auth_model->send_sms(array('9123828737'),'test');
    }
	public function logout(){
		session_unset();
		session_destroy();
		redirect('');
	}
	
	public function valid($method){
        
	}

}
?>