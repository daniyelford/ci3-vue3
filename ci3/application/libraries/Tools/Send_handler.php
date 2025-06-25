<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Send_handler
{
    // TODO: بعد از اتمام پروژه، Ubuntu نصب شود و Photon راه‌اندازی شود
    private $fack_ip_used=true;
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
        return ($this->fack_ip_used?'185.107.56.33':trim($ip));
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
            'address'=>$this->get_full_address($data['lat'] ?? '',$data['lon'] ?? ''),
        ];
    }
    private function get_full_address($lat, $lng) {
        if(!empty($lat) && !empty($lng)){
            $url = "https://nominatim.openstreetmap.org/reverse?lat=$lat&lon=$lng&format=json";
            $opts = [
                "http" => [
                    "header" => "User-Agent: MyApp/1.0 (29danialfrd69@gmail.com)\r\n"
                ]
            ];
            $context = stream_context_create($opts);
            $response = @file_get_contents($url, false, $context);
            if ($response === FALSE) {
                return '';
            }
            $data = json_decode($response, true);
            return $data['display_name'] ?? '';
        }
        return '';
    }

}