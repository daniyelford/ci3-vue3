<?php
class Upload_media extends MY_Controller
{
	public function __construct(){
		parent::__construct();
	}
	private $video_type=[
	    'MP4',
        'AVI',
        'WEBM',
        'AVCHD',
        'FLV',
        'MOV',
        'WMV',
        'MKV'
    ];
	private $image_type=[
	    'JPG',
	    'JPEG',
	    'PNG',
        'BMP',
        'GIF',
        'TIFF',
        'HEIF',
        'RAW',
        'PSD',
        'SVG'
    ];
	private function random_string_creator(){
        $return = '';
        $a = range('a','z');
        $b=join('',$a);
        for ($c = 0; $c < 10; $c++) {
            $return .= $b[rand(0, strlen($b) - 1)];
        }
        return $return;
    }
	public function handler($url,$type){
        if(!empty($_FILES) && !empty($_FILES['file']) && !empty($_FILES['file']["name"]) && !empty($_FILES['file']["type"]) && !empty($_FILES['file']["size"]) && !empty($_FILES['file']["tmp_name"]))
            $b=explode('.',$_FILES["file"]["name"]);
            $c=explode('/',$_FILES['file']["type"]);
            $tt=(!empty($b) && is_array($b) && !empty(end($b))?trim(end($b)):'');
            $t=(!empty($c) && is_array($c) && !empty(end($c))?trim(end($c)):'');
            if(!empty($t) && !empty($tt)){
                $a=(!empty($url) && $url!==0?str_replace('---','/',$url):'');
                $d=$this->random_string_creator();
                if(!empty($type) && $type!==0)
                    if($type=='video'){
                        if(in_array(strtoupper($t),$this->video_type) && in_array(strtoupper($tt),$this->video_type))
                            if(intval($_FILES['file']["size"])>20000000){
                                echo json_encode(['success'=>false,'error'=>'سایز فایل بیشتر از حد مجاز است']);
                                exit();
                            }else{
                                $h=(!empty($a)?$a:'assets/video');
                                $f=$h.'/'.$d.'.'.$tt;
                                $g='video';
                            }
                    }elseif($type=='image'){
                        if(in_array(strtoupper($t),$this->image_type) && in_array(strtoupper($tt),$this->image_type))
                            if(intval($_FILES['file']["size"])>5000000){
                                echo json_encode(['success'=>false,'error'=>'سایز فایل بیشتر از حد مجاز است']);
                                exit();
                            }else{
                                $h=(!empty($a)?$a:'assets/pic');
                                $f=$h.'/'.$d.'.'.$tt;
                                $g='image';
                            }
                    }else{
                        die('type is not valid in platform');
                    }
                else
                    if(in_array(strtoupper($t),$this->video_type) && in_array(strtoupper($tt),$this->video_type)){
                        if(intval($_FILES['file']["size"])>20000000){
                            echo json_encode(['success'=>false,'error'=>'سایز فایل بیشتر از حد مجاز است']);
                            exit();
                        }else{
                            $h=(!empty($a)?$a:'assets/video');
                            $f=$h.'/'.$d.'.'.$tt;
                            $g='video';
                        }
                    }elseif(in_array(strtoupper($t),$this->image_type) && in_array(strtoupper($tt),$this->video_type)){
                        if(intval($_FILES['file']["size"])>5000000){
                            echo json_encode(['success'=>false,'error'=>'سایز فایل بیشتر از حد مجاز است']);
                            exit();
                        }else{
                            $h=(!empty($a)?$a:'assets/pic');
                            $f=$h.'/'.$d.'.'.$tt;
                            $g='image';
                        }
                    }
                
                if(!empty($f) && !empty($g) && !empty($h)){
                    $i=[
                        'upload_path' => $h,
                        'max_size' => '20000000',
                        'allowed_types' => '*',
                        'overwrite' => FALSE,
                        'remove_spaces' => TRUE,
                        'file_name'=>$d
                    ];
                    $this->load->library('upload', $i);
                    $this->upload->initialize($i);
                    if (!$this->upload->do_upload('file'))
                        echo json_encode(['success'=>false,'error'=>$this->upload->display_errors()]);
                    else
                        echo json_encode(['success'=>true,'type'=>$g,'url'=>str_replace('/','---',$f),'name'=>$d.'.'.$tt,'t'=>$_FILES['file']["type"]]);
                    
                    exit();
                }else{
                    echo json_encode(['success'=>false,'error'=>'پسوند فایل لود شده مجاز نیست']);
                    exit();
                }
            }else{
                echo json_encode(['success'=>false,'error'=>'پسوند فایل مشکل دارد']);
            }
        return false;
    }
    public function remove_media(){
        if(!empty($_POST['data']['url']) && is_string($_POST['data']['url']) && 
        !empty($_POST['data']['file']) && is_string($_POST['data']['file']) && 
        !empty($_POST['data']['type']) && is_string($_POST['data']['type']) && 
        ($a=str_replace('---','/',$_POST['data']['url']))!==false && !empty($a) &&
        ($b='./'.$a.'/'.$_POST['data']['file'])!==false &&
        $this->Include_model->remove_file($b))die('11');
        die('0');
    }
}