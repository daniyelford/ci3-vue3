<?php
//  $a=$this->Include_model->send_whatsapp_massage('+989336160295','hi it is a test');
//  $b=$this->Include_model->send_email($to,'title','hi it is a test');
//  $c=$this->Include_model->send_sms('hi it is a test',['9336160295']);
//  $this->Include_model->send_massage_to_user(['data'=>'this is a test text example'],'09336160295','29danialfrd69gmail.com','includes/email','test','text test')
class Include_model extends CI_Model
{
    public function __construct(){
		parent::__construct();
	}
	public function send_whatsapp_massage($phone_number,$message_text){
	    if(!empty($phone_number)){
            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => "https://api.ultramsg.com/instance96188/messages/chat",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => http_build_query(['token' => '0eli8g3zrgymqcx7','to' => $phone_number,'body' => (!empty($message_text)?$message_text:'')]),
                CURLOPT_HTTPHEADER => ["content-type: application/x-www-form-urlencoded"]
            ]);
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            // var_dump($err);
            return $err?false:$response;
	    }
        return false;
	}
	public function wallet_send_two_selection($token,$url,$data){
	    $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $headers = [];
        $headers[] = 'Content-Type:application/json';
        $headers[] = "Authorization: Bearer ".$token;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
	private $tbl="site_api";
	private $click='click_action';
	public function remove_file($str){
	    return (!empty($str) && is_string($str) && unlink($str));
	}
// 	other
	public function resive_data_only($url){
	    if(!empty($url) && is_string($url)){
    		$client = curl_init($url);
    		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
    		$response = curl_exec($client);
    		curl_close($client);
    		return $response;
	    }else{
	        return false;
	    }
	}
	public function send_data_and_resive_data($url, $array){
        if(!empty($url) && is_string($url) && !empty($array) && is_array($array)){
            $client = curl_init($url);
            curl_setopt($client, CURLOPT_POST, true);
            curl_setopt($client, CURLOPT_POSTFIELDS, $array);
            curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($client);
            curl_close($client);
            return $response;
        }else{
            return false;
        }
    }
    public function send_json_data_and_resive_data($url, $str){
        if(!empty($url) && is_string($url) && !empty($array) && is_array($array)){
            $client = curl_init($url);
            curl_setopt($client, CURLOPT_POST, true);
            curl_setopt($client, CURLOPT_POSTFIELDS, json_encode($array));
            curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($client);
            curl_close($client);
            return $response;
        }else{
            return false;
        }
    }
    public function send_text_json_data_and_resive_data($url, $str){
        if(!empty($url) && is_string($url) && !empty($str) && is_string($str)){
            $client = curl_init($url);
            curl_setopt($client, CURLOPT_POST, true);
            curl_setopt($client, CURLOPT_POSTFIELDS, $str);
            curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($client);
            curl_close($client);
            return $response;
        }else{
            return false;
        }
    }
    public function map_distance($lat, $lon) {
        if(!empty($lat) && !empty($lon) && ($a=$this->ip_handler())!==false && !empty($a) && !empty($a['lat']) && !empty($a['lon']))
            return $this->map_distance_four_param($lat,$a['lat'],$lon,$a['lon']);
        return 0;
	}
	public function map_distance_four_param($lt1,$ln2,$ln1,$lt2){
	    $a=0;
	    if (!empty($lt1) && !empty($lt2) && !empty($ln1) && !empty($ln2) && (($lt1 != $lt2) || ($ln1 != $ln2))) {
            $theta = $ln1 - $ln2;
            $dist = sin(deg2rad($lt1)) * sin(deg2rad($lt2)) +  cos(deg2rad($lt1)) * cos(deg2rad($lt2)) * cos(deg2rad($theta));
            $dist = rad2deg(acos($dist));
            $a= $dist * 60 * 1.1515 *1.609344;
        }
        return round($a,3);
	}
	public function ip_handler(){
        $a=$this->resive_data_only("http://ip-api.com/php/".$_SERVER['REMOTE_ADDR']."?fields=country,city,lat,lon,timezone");
        if(!empty($a))
            return $this->exploder_ip_response($a);
    }
    private function exploder_ip_response($str){
	    $c=[];
	    if(!empty($str) && is_string($str) && ( $a=explode('s:',$str) ) !== FALSE && !empty($a))
	        for ($b=1; $b <= count($a) -1; $b++) {
	            if(($d=explode(':',$a[$b]))!==false && !empty($d) && is_array($d) && ($e=end($d))!==FALSE && !empty($e) && ($f=str_replace(['"',"'",';','}','{']," ",$e))!==false && !empty($f))
	                $c[]=$f;
            }
	    return (!empty($c) && !empty($c['1']) && !empty($c['3']) && !empty($c['4']) && !empty($c['5'])?['contry'=>trim($c['1']),'city'=>trim($c['3']),'lat'=>trim($c['4']),'lon'=>trim($c['5'])]:[]);
	}
	public function change_to_time ($d,$m,$y,$h=0,$min=0){
        $date=new Jdf();
        return (!empty($d) && !empty($m) && !empty($y) && intval($d)>0 && intval($m)>0 && intval($y)>0 && ($a=$date->jmktime((!empty($h)?$h:'0'), (!empty($min)?$min:'0'), '0', $m , $d, $y , '', 'Asia/Tehran'))!==false && !empty($a) ? $a:false);
    }
    public function weather_finder(){
	    return (($a=$this->ip_handler())!==false && !empty($a) && !empty($a['lat']) && !empty($a['lon']) && ($b=$this->Send_model->resive_data_only('https://weather.visualcrossing.com/VisualCrossingWebServices/rest/services/timeline/'.$a['lat'].','.$a['lon'].'?key='.WEATHER_API))!==false && !empty($b) && ($c=json_decode($b,true))!==false && !empty($c) && !empty($c['days']) && !empty($c['days']['0']) && !empty($c['days']['0']['description']) && !empty($c['days']['0']['temp'])?['temp'=>$c['days']['0']['temp'],'desc'=>$c['days']['0']['description']]:[]);
	}
	public function money_price_finder($base,$convert,$number){
	    $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.apilayer.com/fixer/convert?to={$base}&from={$convert}&amount={$number}",
          CURLOPT_HTTPHEADER => array(
            "Content-Type: text/plain",
            "apikey: VxXok9NmJBnkCP6dM5SUfybMPpa0pFKw"
          ),
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET"
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        return json_decode($response, true);
	}
	public function chapcha($token){
        // 
        // if(ENVIRONMENT=='development') return true;
	    return (!empty($token) && is_string($token) && 
        ($a = json_decode(@file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . SECRET_KEY . "&response=" . $token . "&remoteip=" . $_SERVER['REMOTE_ADDR'], FILE_TEXT, stream_context_create(['ssl' =>['verify_peer' => false,'verify_peer_name' => false]]))))!==false && 
        !empty($a) && $a->success);
	}
// 	other
    // site_api
    public function all(){
        return $this->db->query("SELECT * FROM ".$this->tbl)->result_array();
    }
    public function select_where_company_id($id){
        return (!empty($id) && intval($id)>0?$this->db->get_where($this->tbl,['company_id'=>intval($id)])->result_array():false);
    }
    public function select_where_key_and_status($key){
        return (!empty($key) && is_string($key)>0?$this->db->get_where($this->tbl,['api_key'=>addslashes(strip_tags($key)),'status'=>1])->result_array():false);
    }
    // site_api
    public function add_click($arr){
        return (!empty($arr) && is_array($arr) && $this->db->insert($this->click,$arr));
    }
    public function send_massage_to_user($data,$phone,$gmail,$email_url,$title,$text){
        if(is_string($text) && is_array($data)){
            if(!empty($phone) && !empty($text)){
                $a=$this->send_whatsapp_massage($phone,$text);
                $b=$this->send_sms($text,[$phone]);
            }
            if(!empty($gmail) && (!empty($data)||!empty($text))){
                $c=$this->send_email($gmail,$title,$this->load->view((!empty($email_url)?$email_url:'includes/email'),['data'=>(!empty($data)?$data:[]),'text'=>$text],true));
            }
            return true;
        }
        return false;
    }
    public function send_email($to,$title,$data){
        if(!empty($to) && is_string($to)){
            $title=(!empty($title) && is_string($title)?$title:'');
            $config['mailtype'] = 'html';    
            $this->load->library('email');         
            $this->email->from(SITEMAIL, 'my home'); 
            $this->email->to($to);
            $this->email->set_header('Content-Type', 'text/html');
            $this->email->subject($title); 
            $this->email->message($this->load->view('includes/email',['x'=>$data],true));   
            if($this->email->send()) return true;
        }
        return false;
    }
    public function send_sms($str,$to=[]){
        $date=new JDF();
        if(!empty($str) && is_string($str) && !empty($to)){
            ini_set("soap.wsdl_cache_enabled", "0");
            try {
            	$client = new SoapClient("https://ippanel.com/class/sms/wsdlservice/server.php?wsdl");
                $fromNum = "+983000505";
            	$op  = "send";
            	$time = $date->jdate('Y/m/d',time()+300);
                return $client->SendSMS($fromNum,$to,$str,SMSUSER,SMSPASS,$time,$op);

            } catch (SoapFault $ex) {
                return $ex->faultstring;
            }
        }
        return false;
    }
    public function send_sms_force_one($str,$to=[]){
        if(!empty($str) && is_string($str) && !empty($to)){
            foreach($to as $t){
                if(!empty($t)){
                    $curl = curl_init();
                    curl_setopt_array ( $curl,[
                        CURLOPT_URL => 'https://rest.payamakapi.ir/api/v1/SMS/Send',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => " ",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => '{
                            "UserName":"'.WEBONEUSER.'",
                            "Password":"'.WEBONEPASS.'",
                            "From":"'.WEBONEFROM.'",
                            "To":"'.$t.'",
                            "Message":"'.$str.'"
                        }',
                        CURLOPT_HTTPHEADER => [
                            'Content-Type: application/json'
                        ]
                    ]);
                    $response = curl_exec ($curl);
                    curl_close ($curl);
                    var_dump(json_decode($response,true));
                    
                }
            }
        }
    }
    public function send_sms_force_two($str,$to){
        if(!empty($str) && (is_string($str)||is_numeric($str)) && !empty($to) && is_string($to)){
            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://api.sms.ir/v1/send/verify',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS =>'{
                    "mobile": "'.$to.'",
                    "templateId": '.SMSIRTEMPID.',
                    "parameters": [
                        {
                            "name": "CODE",
                            "value": "'.$str.'"
                        }
                    ]
                }',
                CURLOPT_HTTPHEADER => [
                    'Content-Type: application/json',
                    'Accept: text/plain',
                    'x-api-key: '.SMSIRKEY
                ]
            ]);
            $response = curl_exec($curl);
            curl_close($curl);
            $response=json_decode($response,true);
            if(!empty($response) && !empty($response['status']) && intval($response['status'])===1) return true;
        }
        return false;
    }
}