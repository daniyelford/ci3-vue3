<?php
class First extends CI_Controller{
      public function __construct()
    {
        parent::__construct();
    }
	public function checking(){
        if(!empty($_POST['url1'])){
            $url=$_POST['url1'].DS;
            define('BASEURL', $url);
        }
        $dbname=$_POST['dbname'];
        $company=$_POST['com'];
        $username=$_POST['username'];
        $password=$_POST['password'];
        $a=$this->check_database($username,$password,$dbname);
	    if($a){
	        define('COMPANY',$company); 
	        echo 1;
	        die();
	    }else{
	        echo 0;
	        die();
	    }
	}
    public function check_database($x,$y,$z){
        if (isset($x) && !empty($x) && isset($y) && !empty($y) && isset($z) && !empty($z)){
            $_SESSION['username_db']=$x;
            $_SESSION['password_db']=$y;
            $_SESSION['db_name']=$z;
        }
    }
}
?>
