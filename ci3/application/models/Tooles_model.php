<?php

class Tooles_model extends CI_Model
{
    public function __construct()
	{
		parent::__construct();
	}
    public $send_sms_example=false;
    public function send_sms_action($str,$to){
        if($this->send_sms_example) return true;
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
    private function resive_data_only($url){
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
    private function exploder_ip_response($str){
	    $c=[];
	    if(!empty($str) && is_string($str) && ( $a=explode('s:',$str) ) !== FALSE && !empty($a))
	        for ($b=1; $b <= count($a) -1; $b++) {
	            if(($d=explode(':',$a[$b]))!==false && !empty($d) && is_array($d) && ($e=end($d))!==FALSE && !empty($e) && ($f=str_replace(['"',"'",';','}','{']," ",$e))!==false && !empty($f))
	                $c[]=$f;
            }
	    return (!empty($c) && !empty($c['1']) && !empty($c['3']) && !empty($c['4']) && !empty($c['5'])?['country'=>trim($c['1']),'city'=>trim($c['3']),'lat'=>trim($c['4']),'long'=>trim($c['5'])]:[]);
	}
    public function weather_finder(){
	    return (($a=$this->ip_handler())!==false && !empty($a) && !empty($a['lat']) && !empty($a['lon']) && ($b=$this->resive_data_only('https://weather.visualcrossing.com/VisualCrossingWebServices/rest/services/timeline/'.$a['lat'].','.$a['lon'].'?key='.WEATHER_API))!==false && !empty($b) && ($c=json_decode($b,true))!==false && !empty($c) && !empty($c['days']) && !empty($c['days']['0']) && !empty($c['days']['0']['description']) && !empty($c['days']['0']['temp'])?['temp'=>$c['days']['0']['temp'],'desc'=>$c['days']['0']['description']]:[]);
	}
    public function ip_handler(){
        // countryCode,region,regionName,zip
        return (!empty($a)?$this->exploder_ip_response($this->resive_data_only("http://ip-api.com/php/".$_SERVER['REMOTE_ADDR']."?fields=country,city,lat,lon,timezone")):[]);
    }
}