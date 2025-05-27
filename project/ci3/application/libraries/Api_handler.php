<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Api_handler{
    private $CI;

    public function __construct(){
		$this->CI =& get_instance();
        $this->CI->load->library('Tools/Upload_handler');
	}
    public function handler($data){
        $upload=new Upload_handler();
        if(!empty($data))
            if(!empty($data['action']))
                switch ($data['action']) {
                    case 'upload_single_image':
                        $url=(!empty($data['url'])?$data['url']:'');
                        $upload->upload_single_image($data['data'],$url);
                        break;

                    case 'upload_many_images':
                        $url=(!empty($data['url'])?$data['url']:'');
                        $upload->upload_many_images($data['data'],$url);
                        break;
                    
                    case 'upload_single_video':
                        $url=(!empty($data['url'])?$data['url']:'');
                        $upload->upload_single_video($data['data'],$url);
                        break;

                    case 'upload_many_videos':
                        $url=(!empty($data['url'])?$data['url']:'');
                        $upload->upload_many_videos($data['data'],$url);
                        break;

                    case 'upload_single_pdf':
                        $url = (!empty($data['url']) ? $data['url'] : '');
                        $upload->upload_single_pdf($data['data'], $url);
                        break;

                    case 'upload_many_pdfs':
                        $url = (!empty($data['url']) ? $data['url'] : '');
                        $upload->upload_many_pdfs($data['data'], $url);
                        break;

                    default:
                        echo json_encode($data);
                        break;
                }
            else
                echo json_encode($data);
        else
			echo json_encode(['status' => 'error', 'message' => 'توکن نامعتبر است']);
    }
}