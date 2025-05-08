<?php
class Auth_model extends CI_Model{

    public function __construct(){
        parent::__construct();
    }

    public function insert_user($data){
        return $this->db->insert('users',$data);
    }

    public function send_curl($url, $params){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
        ]);
        $res = curl_exec($ch);
        curl_close($ch);

        return $res;
    }
    
    public function c_send($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        curl_close($ch);
        return $res;
    }

    public function new_send($data=array(),$runfile){
        $contentType = 'application/x-www-form-urlencoded';
        $HTTPCustomHeaders[] = 'Content-Type: '.trim($contentType);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $runfile);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $HTTPCustomHeaders);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $content = curl_exec ($ch);
        curl_close ($ch); 
        echo $content;
    }

    public function send_sms($phone,$text){
// turn off the WSDL cache
// ini_set('soap.wsdl_cache_enabled',0);
//   try {
	$user = "m_borji";
	$pass = "8981";
    $line_num="10003894";
    // $url="http://panel.aladdinsms.ir/post/IncomingMessages.asmx?wsdl";
    $url2="http://87.107.121.52/post/sendsms.ashx?from=".$line_num."&to=".$phone."&text=".$text."&password=".$pass."&username=".$user;
    
    // $url1=" http://87.107.121.52/post/sendsms.ashx?";
//     $params= array(
// 		'from' => $line_num,
// 		'to' => $phone,
// 		'text' => 'hi',
// 		'password' => $pass,
// 		'username' => $user,
// 	);
    
    // $this->send_curl($url1,$params);
    
    header($url2);
    
    
    // return $this->c_send($url2);
//     $client = new SoapClient($url);
// 	$getcredit_parameters = array(
// 		"username"=>$user,
// 		"password"=>$pass
// 	);
// 	$credit = $client->GetCredit($getcredit_parameters)->GetCreditResult;
// 	echo "Credit: ".$credit."<br />";
// 	$encoding = "UTF-8";//CP1256, CP1252
// 	$textMessage = iconv($encoding, 'UTF-8//TRANSLIT',$text);

// 	$sendsms_parameters = array(
// 		'username' => $user,
// 		'password' => $pass,
// 		'from' => $line_num,
// 		'to' => $phone,
// 		'text' => $textMessage,
// 		'isflash' => false,
// 		'udh' => "",
// 		'recId' => array(0),
// 		'status' => 0
// 	);

// 	$status = $client->SendSms($sendsms_parameters)->SendSmsResult;
	
// 	switch($status){
// 	    case 1:
// 	            echo "ok";
// 	        break;
	
// 	    default:
// 	        echo "no";
// 	        break;
// 	}
	
	
// 	echo "Status: ".$status."<br />";

// 	$getnewmessage_parameters = array(
// 		"username"=>$user,
// 		"password"=>$pass,
// 		"from"=>$line_num
// 	);
// 	$incomingMessagesClient = new SoapClient($url);
// 	$res = $incomingMessagesClient->GetNewMessagesList($getnewmessage_parameters);
//     $res->GetNewMessagesAResult->Message;

    //  }catch (SoapFault $ex) {
    //     echo $ex->faultstring;
    // }
}

    public function s_alert($title,$text,$method,$btn,$url,$bgcos='#e6e9e6',$bgcis='',$bxsc='#e5d6f1'){
    	return '<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    	        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    	        <style>
    	            .swal-button-container {
                        width: 98%;
                    }
    	            .swal-overlay {
                        background-color: '.$bgcos.';
                    }
                    .swal-modal {
                        background-color: '.$bgcis.';
                        border: 3px solid white;
                        box-shadow: 2px 3px 60px '.$bxsc.';
                        border-radius:10px;
                    }
                </style>
                <script>
                $(document).ready(function(){
                  	swal({
                            title: "'.$title.'",
                            text: "'.$text.'",
                            icon: "'.$method.'",
                            button: {
                             text:"'.$btn.'",className:"btn btn-block btn-success-gradient box-shadow-pink rounded-10"
                            }
                        }).then(function(){
                             window.location.replace("'.$url.'"); 
                        });
                        // $(".swal-button").addClass("")
                })
				</script>';
			
    }
    
    //cookies
	public function another_method_set_cookie($name, $value){
		return setcookie($name, $value, time() + 2 * 24 * 60 * 60);
	}

	public function flash_cookie($name){
		return setcookie($name, '');
	}

	//end of cookies

	//selecting data for login
	public function select_bind_one($field, $field_value, $compile_field, $compile_field_value){
		if (!empty($field) && !empty($field_value) && !empty($compile_field) && !empty($compile_field_value)) {
			$sql = "select * from users where $field=? and $compile_field=?";
			$bind = array($field_value, $compile_field_value);
			return $this->db->query($sql, $bind);
		}else{
		    return false;
		}
	}
	
	public function select_forgot($field1,$con1,$field2,$con2){
	    if(!empty($field1) && !empty($con1) && !empty($field2) && !empty($con2)){
	    $sql="SELECT * FROM users WHERE status=1 AND $field1=? OR $field2=?";
	    $bind=array($con1,$con2);
	    return $this->db->query($sql,$bind);
	}else{
	    return false;
	}
	}
	
	public function select_bind_two($field, $field_value, $compile_field, $compile_field_value, $field_two , $field_two_value , $compile_field_two , $compile_field_two_value ){
		if (!empty($field_two) && !empty($field_two_value) && !empty($compile_field_two) && !empty($compile_field_two_value) && !empty($field) && !empty($field_value) && !empty($compile_field) && !empty($compile_field_value)) {
			$sql = "select * from users where $field=? and $compile_field=? or $field_two=? and $compile_field_two=?";
			$bind = array($field_value, $compile_field_value, $field_two_value, $compile_field_two_value);
			return $this->db->query($sql, $bind);
		}else{
		    return false;
		}
	}

    public function new_pass($new_data,$where){
        return $this->db->update('users',$new_data,$where);
    }

    public function create_num(){
        $new_num = '';
		for ($i = 1; $i <= 8; $i++) {
			$char = rand(0, 9);
			$new_num .= $char;
		}
		return $new_num;
    }

}
?>