<?php
defined('BASEPATH') or exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
class Map extends My_Controller
{
	public function __construct()
	{
		parent::__construct();
		 $this->load->library('Leaflet');
		 
	}
	
    public function map(){
        $config = array(
 	        'center'         => '-0.959, 100.39716', // Center of the map
 	        'zoom'           => 12, // Map zoom
 	    );
        $this->leaflet->initialize($config);
        $marker = array(
 	        'latlng' 		=>'-0.959, 100.39716', // Marker Location
 	        'popupContent' 	=> 'Hi, iam a popup!!', // Popup Content
 	    );
 	    $this->leaflet->add_marker($marker);
        $map =  $this->leaflet->create_map();
        echo $this->load->view('panel/map.php',['map'=>$map],true);
    }
	
	public function index(){
		$this->load->view('panel'.DS.'map.php', []);
	}

	public function addMarker(){
		if (isset($_POST['lt'], $_POST['ln']) && !empty($_POST['lt']) && !empty($_POST['ln'])) {
			$lt = $_POST['lt'];
			$ti = $_POST['title'];
			if (!empty($ti) && $ti !== '') {
				$title = $ti;
			} else {
				$title = "empty";
			}
			$ln = $_POST['ln'];
			$data = array(
				//'user_id'=>$this->session->userdata('user_id'),
				'latitude' => $lt, 'title' => $title, 'longitude' => $ln);
			$this->Map_model->insert_data($data);
		} else {
			redirect(base_url() . 'map'.DS.'index');
		}
	}

	public function delMarker(){
		if (isset($_POST['lt'], $_POST['ln']) && !empty($_POST['lt']) && !empty($_POST['ln'])) {
			//$user_id = $this->session->userdata('user_id');
			$lt = $_POST['lt'];
			$ti = $_POST['title'];
			$ln = $_POST['ln'];
			if (!empty($ti) && $ti !== '') {
				$title = $ti;
			} else {
				$title = "empty";
			}
			$data = array(
				//'user_id'=>$this->session->userdata('user_id'),
				'latitude' => $lt, 'longitude' => $ln, 'title' => $title);
			$this->Map_model->delete_data($data);
		} else {
			redirect(base_url() . 'map'.DS.index);
		}
	}

	public function marks()
	{
		$user_id = $this->session->userdata('user_id');
		$datas = $this->Map_model->s_a();
		$a='';
		foreach ($datas as $data) {
			$a .= $data['longitude'] . '|' . $data['latitude'] . '|' . $data['title'] . ',';
		}
		echo $a;
	}

	public function other()
	{
		function repToAmp($url, $pats, $repl = '')
		{
			$content = file_get_contents($url);
			if (is_array($pats)) {
				foreach ($pats as $val => $rpl) {
					echo preg_replace($val, $rpl, $content);
				}
			} elseif (is_string($pats)) {
				echo preg_replace($pats, $repl, $content);
			} else {
				return false;
			}
		}

		$data = array("~<a\s(.+?)>(.+?)<\/a>~" => "<a $1>$2</a>", "~/<img\s\(.+?\)><\/img>~" => "<amp-img ($1)></amp-img>");
		$content = repToAmp('https://stackoverflow.com/questions/5202496/replacing-a-tag-with-b-tag-using-php/5202513', $data);
		$this->load->view('m.php', array('content' => $content));
	}
	
    public function check_marks(){
        if(isset($_POST['aha'])&&!empty($_POST['aha'])){
            if($_POST['aha'] == 'ha'){
                $datas = $this->Map_model->select_where(['side_id'=>'0']);
                $a='';
                if(!empty($datas)){
                    foreach ($datas as $data) {
            			$a .= $data['longitude'] . '|' . $data['latitude'] . '|' . $data['title'] . ',';
            		}
                }
        		echo $a;
        		die();
            }else{
                $side=(!empty($this->Side_model->s_w_s_d(['id'=>intval($_POST['aha'])]))?$this->Side_model->s_w_s_d(['id'=>intval($_POST['aha'])]):null);
                $ids=(!is_null($side)?$side['0']['place_map']:null);
                $id=(!is_null($ids)?explode(',',$ids):null);
                if(!is_null($id)){
                    $a='';
                    for($x=0;$x<=count($id)-1;$x++){
                        if(!empty($id[$x])){
                            $datas = $this->Map_model->select_where(['id'=>intval($id[$x])]);
                            if(!empty($datas)){
                                foreach ($datas as $data) {
                        			$a .= $data['longitude'] . '|' . $data['latitude'] . '|' . $data['title'] . ',';
                        		}
                            }
                        }
                    }
                    echo $a;
                    die();
                }
            }
        }else{
            header('Location :'.base_url().'err'.DS.'not_found');
            exit();
        }
    }
    
    public function add_mark(){
        $t=(isset($_POST['lt'])||!empty($_POST['lt'])?$_POST['lt']:false);
        $n=(isset($_POST['ln'])||!empty($_POST['ln'])?$_POST['ln']:false);
        $title=(isset($_POST['title'])||!empty($_POST['title'])?$_POST['title']:false);
        $data=['title'=>$title,'longitude'=>$n,'latitude'=>$t];
        if($this->Map_model->insert_data($data)){
            $id = (!empty($this->Map_model->get_id($data))?$this->Map_model->get_id($data):null);
            echo (!is_null($id)?intval($id['0']['id']):0);
            exit();
        }else{
            return false;
        }
    }
    
    public function del_mark(){
        $numbers='';
        $ids=(!empty($_POST['idMaps'])?$_POST['idMaps']:null);
        $t=(!empty($_POST['lt'])?$_POST['lt']:null);
        $n=(!empty($_POST['ln'])?$_POST['ln']:null);
        if(!is_null($t) && !is_null($n)){
            $action=(!empty($this->Map_model->get_id(['longitude'=>$n,'latitude'=>$t]))?$this->Map_model->get_id(['longitude'=>$n,'latitude'=>$t]):null);
            $id=(!is_null($action)?intval($action['0']['id']):null);
            $ac=(!is_null($id)?$this->Map_model->delete_data(['id'=>$id]):null);
            if(!is_null($ids)){
                $id_info=(!is_null($ac)?explode(',',$ids):null);
                if(!is_null($id_info) && !empty($id_info)){
                    if (($key = array_search($id, $id_info)) !== false) {
                        unset($id_info[$key]);
                    }
                    for($z=0;$z<=count($id_info)-1;$z++){
                        if(!empty($id_info[$z])){
                            $numbers.=intval($id_info[$z]).',';
                        }
                    }
                }else{
                    $numbers=null;
                }
            }
            echo (!is_null($numbers)?$numbers:'');
            exit();
        }else{
            header('Location :'.base_url().'err'.DS.'not_found');
            die();
        }
    }
    
}

?>