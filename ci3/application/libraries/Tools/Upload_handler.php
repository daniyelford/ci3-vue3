<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Upload_handler
{
    // url must be have / in the end
    private $CI;
    private Security_handler $security;
    private Media_model $media_model;
    public function __construct(
        Security_handler $security_handler,
        Media_model $media_model
    ){
        $this->CI =& get_instance();
        $this->security = $security_handler;
        $this->media_model = $media_model;

    }
    private function add_retern_id($type,$filename,$url,$to_action){
        $sing='';
        if ($this->CI->session->has_userdata('id') && !empty($this->CI->session->userdata('id'))){
            $sing=json_encode(['id'=>$this->CI->session->userdata('id')]);
        }elseif($this->CI->session->has_userdata('account_id') && !empty($this->CI->session->userdata('account_id'))){
            $sing=json_encode(['account_id'=>$this->CI->session->userdata('account_id')]);
        }elseif($this->CI->session->has_userdata('mobile_id') && !empty($this->CI->session->userdata('mobile_id'))){
            $sing=json_encode(['mobile_id'=>$this->CI->session->userdata('mobile_id')]);
        }
        return $this->media_model->add_return_id(['filename'=>$filename,'url'=>base_url('storage/'.$type.'s/'.$url),'type'=>$type,'user_sign'=>$sing,'upload_place'=>$to_action,'created_at'=>date('Y-m-d H:i:s')]);
    }
    private function upload_image_handler($image,$url,$to_action){
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
            $id=$this->add_retern_id('image',$filename,$url. $filename,$to_action);
            $result = [
                'id'   => $id,
                'url'  => base_url('storage/images/' . $url . $filename),
            ];
        }
        return $result;
    }
    private function upload_video_handler($video, $url,$to_action) {
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
            $id=$this->add_retern_id('video',$filename,$url. $filename,$to_action);
            $result = [
                'id'  => $id,
                'url' => base_url('storage/videos/' . $url . $filename),
            ];
        }
        return $result;
    }
    private function upload_pdf_handler($pdf,$url,$to_action) {
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
            $id=$this->add_retern_id('pdf',$filename,$url. $filename,$to_action);
            $result = [
                'id'  => $id,
                'url' => base_url('storage/pdfs/' . $url . $filename),
            ];
        }
        return $result;
    }
    public function upload_many_media($data){
        if (!empty($data) && !empty($data['data'])) {
            $check = $this->security->check_user_sing();
            if (is_null($check)) {
                $url=(!empty($data['url'])?$this->security->string_security_check($data['url']):'');
                $to_action=(!empty($data['toAction']) ? $this->security->string_security_check($data['toAction']) : '');
                foreach ($data['data'] as $file) {
                    if (preg_match('/^data:image\//', $file)) {
                        $img = $this->upload_image_handler($file, $url, $to_action);
                        if (!empty($img)) $result[] = $img + ['type' => 'image'];
                    } elseif (preg_match('/^data:video\//', $file)) {
                        $vid = $this->upload_video_handler($file, $url, $to_action);
                        if (!empty($vid)) $result[] = $vid + ['type' => 'video'];
                    } elseif (preg_match('/^data:application\/pdf;base64,/', $file)) {
                        $pdf = $this->upload_pdf_handler($file, $url, $to_action);
                        if (!empty($pdf)) $result[] = $pdf + ['type' => 'pdf'];
                    }
                }
                return !empty($result) ? ['status' => 'success', 'data' => $result]: ['status' => 'error', 'message' => 'هیچ فایلی ذخیره نشد'];
            } else {
                return $check;
            }
        }
        return ['status' => 'error', 'message' => 'هیچ داده‌ای ارسال نشد یا فرمت اشتباه بود'];
    }
    public function upload_single_image($data){
        if(!empty($data) && !empty($data['data'])){
            $check=$this->security->check_user_sing();
            if(is_null($check)){
                $url=(!empty($data['url'])?$this->security->string_security_check($data['url']):'');
                $to_action=(!empty($data['toAction']) ? $this->security->string_security_check($data['toAction']) : '');
                $a=$this->upload_image_handler($data['data'],$url,$to_action);
                if(!empty($a)) return $a+['status' => 'success'];
                return ['status' => 'error', 'message' => 'فرمت تصویر نادرست است'];
            }else{
                return $check;
            }
        }else{
            return ['status' => 'error', 'message' => 'هیچ تصویری دریافت نشد'];
        }
    }
    public function upload_many_images($data){
        $result = [];
        if(!empty($data) && !empty($data['data'])){
            $check=$this->security->check_user_sing();
            if(is_null($check)){
                $url=(!empty($data['url'])?$this->security->string_security_check($data['url']):'');
                $to_action=(!empty($data['toAction']) ? $this->security->string_security_check($data['toAction']) : '');
                foreach ($data['data'] as $image) {
                    $a=$this->upload_image_handler($image,$url,$to_action);
                    if(!empty($a)) $result[]=$a;
                }
                return (!empty($result)?['status' => 'success','images' => $result]:['status' => 'error','message' => 'هیچ تصویری ذخیره نشد']);
            }else{
                return $check;
            }
        }else{
            return ['status' => 'error', 'message' => 'هیچ تصویری دریافت نشد'];
        }
    }
    public function upload_single_video($data){
        if(!empty($data) && !empty($data['data'])){
            $check=$this->security->check_user_sing();
            if(is_null($check)){
                $url=(!empty($data['url'])?$this->security->string_security_check($data['url']):'');
                $to_action=(!empty($data['toAction']) ? $this->security->string_security_check($data['toAction']) : '');
                $a=$this->upload_video_handler($data['data'],$url,$to_action);
                if(!empty($a)) return $a+['status' => 'success'];
                return ['status' => 'error', 'message' => 'فرمت فیلم نادرست است'];
            }else{
                return $check;
            }
        }else{
            return ['status'=>'error','message'=>'هیچ فیلمی دریافت نشد'];
        }
    }
    public function upload_many_videos($data){
        $result = [];
        if(!empty($data) && !empty($data['data'])){
            $check=$this->security->check_user_sing();
            if(is_null($check)){
                $url=(!empty($data['url'])?$this->security->string_security_check($data['url']):'');
                $to_action=(!empty($data['toAction']) ? $this->security->string_security_check($data['toAction']) : '');
                foreach ($data['data'] as $video) {
                    $a=$this->upload_video_handler($video,$url,$to_action);
                    if(!empty($a)) $result[]=$a;
                }
                return (!empty($result)?['status' => 'success','videos' => $result]:['status' => 'error','message' => 'هیچ فیلمی ذخیره نشد']);
            }else{
                return $check;
            }
        }else{
            return ['status'=>'error','message'=>'هیچ فیلمی دریافت نشد'];
        }
    }
    public function upload_single_pdf($data) {
        if(!empty($data) && !empty($data['data'])){
            $check=$this->security->check_user_sing();
            if(is_null($check)){
                $url=(!empty($data['url'])?$this->security->string_security_check($data['url']):'');
                $to_action=(!empty($data['toAction']) ? $this->security->string_security_check($data['toAction']) : '');
                $a = $this->upload_pdf_handler($data['data'],$url,$to_action);
                if (!empty($a)) return $a + ['status' => 'success'];
                return ['status' => 'error', 'message' => 'فرمت فایل PDF نادرست است'];
            }else{
                return $check;
            }
        }else{
            return ['status' => 'error', 'message' => 'هیچ فایلی دریافت نشد'];
        }
    }
    public function upload_many_pdfs($data) {
        $result = [];
        if(!empty($data) && !empty($data['data'])){
            $check=$this->security->check_user_sing();
            if(is_null($check)){
                $url=(!empty($data['url'])?$this->security->string_security_check($data['url']):'');
                $to_action=(!empty($data['toAction']) ? $this->security->string_security_check($data['toAction']) : '');
                foreach ($data['data'] as $pdf) {
                    if(!empty($pdf['content'])) $a = $this->upload_pdf_handler($pdf['content'],$url,$to_action);
                    if (!empty($a)){
                        $b=$a+['name'=>(!empty($pdf['name'])?$pdf['name']:'pdf')];
                        $result[] = $b;
                    }            
                }
                return (!empty($result)?['status' => 'success','pdfs'   => $result]:['status' => 'error','message' => 'هیچ فایل PDF ذخیره نشد']);
            }else{
                return $check;
            }
        }else{
            return ['status' => 'error', 'message' => 'هیچ فایلی دریافت نشد'];
        }
    }
    public function delete_media_by_id($data) {
        $id = intval($data['id'] ?? 0);
        if ($id > 0 && 
        ($a = $this->media_model->select_where_id($id))!==false &&
        !empty($a) && !empty(end($a)) && !empty(end($a)['id']) && 
        intval(end($a)['id'])>0 && !empty(end($a)['url']) &&
        @unlink(FCPATH . str_replace(base_url(), '', end($a)['url'])) &&
        $this->media_model->remove_where_id($id)) 
            return ['status' => 'success'];
        return ['status' => 'error', 'message' => 'فایل یافت نشد'];
    }
}