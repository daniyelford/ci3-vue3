<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Send_handler
{
    private $CI;
    public function __construct(){
		$this->CI =& get_instance();
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
    public function weather_finder(){
	    return (($a=$this->ip_handler())!==false && !empty($a) && !empty($a['lat']) && !empty($a['lon']) && ($b=$this->resive_data_only('https://weather.visualcrossing.com/VisualCrossingWebServices/rest/services/timeline/'.$a['lat'].','.$a['lon'].'?key='.WEATHER_API))!==false && !empty($b) && ($c=json_decode($b,true))!==false && !empty($c) && !empty($c['days']) && !empty($c['days']['0']) && !empty($c['days']['0']['description']) && !empty($c['days']['0']['temp'])?['temp'=>$c['days']['0']['temp'],'desc'=>$c['days']['0']['description']]:[]);
	}
    private function getClientIp() {
        $ip = $_SERVER['HTTP_CLIENT_IP']
            ?? $_SERVER['HTTP_X_FORWARDED_FOR']
            ?? $_SERVER['HTTP_X_FORWARDED']
            ?? $_SERVER['HTTP_FORWARDED_FOR']
            ?? $_SERVER['HTTP_FORWARDED']
            ?? $_SERVER['REMOTE_ADDR']
            ?? 'UNKNOWN';
        if (strpos($ip, ',') !== false) {
            $ip = explode(',', $ip)[0];
        }
        return trim($ip);
    }
    public function ip_handler(){
        $response = $this->resive_data_only("http://ip-api.com/php/" . $this->getClientIp() . "?fields=country,regionName,city,lat,lon,currency,mobile,proxy");
        if (!$response) return [];
        $data = @unserialize($response);
        if (!is_array($data)) return [];
        return [
            'country' => $data['country'] ?? '',
            'regionName' => $data['regionName'] ?? '',
            'city' => $data['city'] ?? '',
            'lat' => $data['lat'] ?? '',
            'lon' => $data['lon'] ?? '',
            'currency' => $data['currency'] ?? '',
            'mobile' => $data['mobile'] ?? '',
            'proxy' => $data['proxy'] ?? '',
        ];
    }
}