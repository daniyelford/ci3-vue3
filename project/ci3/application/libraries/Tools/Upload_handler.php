<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Upload_handler
{
    private $CI;
    public function __construct(){
		$this->CI =& get_instance();
	}
    public function upload_single_image($image,$url){
        $a=$this->upload_image_handler($image,$url);
        if(!empty($a)){
            $a=$a+['status' => 'success'];
            echo json_encode($a);
            return;
        }
        echo json_encode(['status' => 'error', 'message' => 'فرمت تصویر نادرست است']);
    }
    public function upload_many_images($images, $url){
        $result = [];
        if (!is_array($images) || empty($images)) {
            echo json_encode(['status' => 'error', 'message' => 'هیچ تصویری دریافت نشد']);
            return;
        }
        foreach ($images as $image) {
            $a=$this->upload_image_handler($image,$url);
            if(!empty($a)) $result[]=$a;
        }
        if (!empty($result)) {
            echo json_encode([
                'status' => 'success',
                'images' => $result
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'هیچ تصویری ذخیره نشد'
            ]);
        }
    }
    private function upload_image_handler($image,$url){
        $result=[];
        if (!empty($image) && preg_match('/^data:image\/(\w+);base64,/', $image, $type)) {
            $data = substr($image, strpos($image, ',') + 1);
            $data = base64_decode($data);
            $extension = strtolower($type[1]);
            $filename = uniqid() . '.' . $extension;
            $fullPath = FCPATH . 'storage/images/' . $url . $filename;
            $dirPath = dirname($fullPath);
            if (!is_dir($dirPath)) {
                mkdir($dirPath, 0755, true);
            }
            file_put_contents($fullPath, $data);
            $dataInsert = [
                'filename'   => $filename,
                'url'        => base_url('storage/images/' . $url . $filename),
                'type'       => 'image',
                'created_at' => date('Y-m-d H:i:s')
            ];
            $this->CI->db->insert('media', $dataInsert);
            $id = $this->CI->db->insert_id();
            $result = [
                'id'   => $id,
                'url'  => base_url('storage/images/' . $url . $filename),
            ];
        }
        return $result;
    }

    public function upload_single_video($video,$url){
        $a=$this->upload_video_handler($video,$url);
        if(!empty($a)){
            $a=$a+['status' => 'success'];
            echo json_encode($a);
            return;
        }
        echo json_encode(['status' => 'error', 'message' => 'فرمت فیلم نادرست است']);
    }
    public function upload_many_videos($video,$url){
        $result = [];
        if (!is_array($video) || empty($video)) {
            echo json_encode(['status' => 'error', 'message' => 'هیچ فیلمی دریافت نشد']);
            return;
        }
        foreach ($video as $video) {
            $a=$this->upload_video_handler($video,$url);
            if(!empty($a)) $result[]=$a;
        }
        if (!empty($result)) {
            echo json_encode([
                'status' => 'success',
                'videos' => $result
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'هیچ فیلمی ذخیره نشد'
            ]);
        }
    }
    private function upload_video_handler($video, $url) {
        $result = [];
        if (!empty($video) && preg_match('/^data:video\/(\w+);base64,/', $video, $type)) {
            $data = substr($video, strpos($video, ',') + 1);
            $data = base64_decode($data);
            $extension = strtolower($type[1]);
            $filename = uniqid() . '.' . $extension;
            $fullPath = FCPATH . 'storage/videos/' . $url . $filename;
            $dirPath = dirname($fullPath);
            if (!is_dir($dirPath)) {
                mkdir($dirPath, 0755, true);
            }
            file_put_contents($fullPath, $data);
            $dataInsert = [
                'filename'   => $filename,
                'url'        => base_url('storage/videos/' . $url . $filename),
                'type'       => 'video',
                'created_at' => date('Y-m-d H:i:s')
            ];
            $this->CI->db->insert('media', $dataInsert);
            $id = $this->CI->db->insert_id();
            $result = [
                'id'  => $id,
                'url' => base_url('storage/videos/' . $url . $filename),
            ];
        }
        return $result;
    }

    public function upload_single_pdf($pdf, $url) {
        $a = $this->upload_pdf_handler($pdf, $url);
        if (!empty($a)) {
            $a = $a + ['status' => 'success'];
            echo json_encode($a);
            return;
        }
        echo json_encode(['status' => 'error', 'message' => 'فرمت فایل PDF نادرست است']);
    }
    public function upload_many_pdfs($pdfs, $url) {
        $result = [];
        if (!is_array($pdfs) || empty($pdfs)) {
            echo json_encode(['status' => 'error', 'message' => 'هیچ فایلی دریافت نشد']);
            return;
        }
        foreach ($pdfs as $pdf) {
            if(!empty($pdf['content'])) $a = $this->upload_pdf_handler($pdf['content'], $url);
            if (!empty($a)){
                $b=$a+['name'=>(!empty($pdf['name'])?$pdf['name']:'pdf')];
                $result[] = $b;
            }            
        }
        if (!empty($result)) {
            echo json_encode([
                'status' => 'success',
                'pdfs'   => $result
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'هیچ فایل PDF ذخیره نشد'
            ]);
        }
    }
    private function upload_pdf_handler($pdf, $url) {
        $result = [];
        if (!empty($pdf) && preg_match('/^data:application\/pdf;base64,/', $pdf)) {
            $data = substr($pdf, strpos($pdf, ',') + 1);
            $data = base64_decode($data);
            $filename = uniqid() . '.pdf';
            $fullPath = FCPATH . 'storage/pdfs/' . $url . $filename;
            $dirPath = dirname($fullPath);
            if (!is_dir($dirPath)) {
                mkdir($dirPath, 0755, true);
            }
            file_put_contents($fullPath, $data);
            $dataInsert = [
                'filename'   => $filename,
                'url'        => base_url('storage/pdfs/' . $url . $filename),
                'type'       => 'pdf',
                'created_at' => date('Y-m-d H:i:s')
            ];
            $this->CI->db->insert('media', $dataInsert);
            $id = $this->CI->db->insert_id();
            $result = [
                'id'  => $id,
                'url' => base_url('storage/pdfs/' . $url . $filename),
            ];
        }
        return $result;
    }
}