<?php
header('Access-Control-Allow-Origin: *');
class Icon extends My_Controller{
    
    public function __construct()
    {
        parent::__construct();
    }
 
    //xss cleaner
    
    public function direction_check($text=''){
        return empty($text)?'':strip_tags($text, '<p><a>'); 
    }    
    
    public function check_xss($text=""){
        return empty($text)?'':addslashes($text);
    }
    
    public function index(){
        if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
	    $data=$this->Icon_model->icons();
		echo $this->Page_model->render_page('	مدیریت آیکون ها ','panel'.DS.'show_icons.php',['data'=>$data]);
        }else{
          header('Location :'.base_url().'err'.DS.'no_access');
            exit();   
        }
    }

    public function edit_icon_check(){
        if(isset($_POST['send']) && $_POST['send']=="ok"){
            if(!empty($_POST['id']) && is_numeric($_POST['id'])){
                $id=$_POST['id'];
            }else{
                header('Location : '.base_url().'err'.DS.'not_found');
                exit();
            }
            if(isset($_POST['title']) && !empty($_POST['title'])){
                $a= $this->check_xss($_POST['title']);
            }else{
                echo 0;
                die();
            }
            $b=$c='';
            if(isset($_POST['iconClass']) && !empty($_POST['iconClass'])){
                $b=$this->direction_check($_POST['iconClass']);
            }elseif(isset($_POST['shrtcd']) && !empty($_POST['shrtcd'])){
                $c=$this->direction_check($_POST['shrtcd']);
            }else{
                echo 0;
                die();
            }
            $data=['title' => $a ,'class' => $b,'shrtcd'=>$c];
            echo $this->Icon_model->edit($data,$id)?1:0;
        }else{
            header('Location : '.base_url().'err'.DS.'not_found');
            exit();
        }
    }
    
    public function edit_icon($id){
        if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
        if(is_numeric($id)&&!empty($id)){
            $edit="run";
            $info_side=$this->Icon_model->s_i_i($id);
            $e=['name'=>'title',
                'class'=>'form-control rounded-5',
                'id'=>'title',
                'value'=>$info_side['0']['title'],
                'placeholder'=>'عنوان آیکون',
                'type'=>'text'];
            $f=['name'=>'class',
                'class'=>'form-control rounded-5',
                'id'=>'class',
                'value'=>$info_side['0']['class'],
                'placeholder'=>'class آیکون',
                'type'=>'text'];
            $g=['name'=>'shrtcd',
                'class'=>'form-control rounded-5',
                'id'=>'shrtcd',
                'value'=>$info_side['0']['shrtcd'],
                'placeholder'=>'svg code آیکون',
                'type'=>'text'];
            $a=[
                'none'=>'انتخاب کنید',
                '0'=>'افزودن بر اساس html',
                '1'=>'افزودن بر اساس class'
            ];    
            $b=(!empty($info_side['0']['shrtcd'])?'0':'1');
            $h=form_dropdown('as', $a,$b , array('class' => 'rounded-5 SlectBox form-control', 'id' => 'as'));
            $data=['h'=>$h,'g'=>$g,'f'=>$f,'e'=>$e,'edit'=>$id];
            echo $this->Page_model->render_page('ویرایش آیکون','panel'.DS.'add_icon.php',$data); 
        }else{
		    header('Location : '.base_url().'err'.DS.'not_found');
            exit();
		}
        }else{
          header('Location :'.base_url().'err'.DS.'no_access');
            exit();   
        }
    }
    
    public function check_add_icon(){
        if(isset($_POST['send']) && $_POST['send']="ok"){
            if(isset($_POST['title']) && !empty($_POST['title'])){
                $a= $this->check_xss($_POST['title']);
            }else{
                echo 0;
                die();
            }
            $c=$b='';
            if(isset($_POST['shrtcd']) && !empty($_POST['shrtcd'])){
                $c=$this->direction_check($_POST['shrtcd']);
            }elseif(isset($_POST['iconClass']) && !empty($_POST['iconClass'])){
                $b=$this->direction_check($_POST['iconClass']);
            }else{
                echo 0;
                die();
            }
            $abas = $this->Icon_model->s_i_w($a,$c,$b);
            if(empty($abas)){
                $data=['title' => $a ,'class' => $b,'shrtcd'=>$c];
                echo $this->Icon_model->add($data)?1:0;
            }else{
                echo 0;
                die();
            }
        }else{
            header('Location : '.base_url().'err'.DS.'not_found');
            exit();
        }
    }
    
    public function add_icon(){
        if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
        $e=['name'=>'title',
            'class'=>'form-control rounded-5',
            'id'=>'title',
            'value'=>set_value('title'),
            'placeholder'=>'عنوان آیکون',
            'type'=>'text'];
        $g=['name'=>'shrtcd',
            'class'=>'form-control rounded-5',
            'id'=>'shrtcd',
            'value'=>set_value('shrtcd'),
            'placeholder'=>'کد svg آیکون',
            'type'=>'text'];
        $a=[
            'none'=>'انتخاب کنید',
            '0'=>'افزودن بر اساس html',
            '1'=>'افزودن بر اساس class'
            ];
        $f=['name'=>'class',
            'class'=>'form-control rounded-5',
            'id'=>'class',
            'value'=>set_value('class'),
            'placeholder'=>'class آیکون',
            'type'=>'text'];
        $h=form_dropdown('as', $a,'none' , array('class' => 'rounded-5 SlectBox form-control', 'id' => 'as'));
        $data=['h'=>$h,'g'=>$g,'f'=>$f,'e'=>$e];
        echo $this->Page_model->render_page('افزودن آیکون','panel'.DS.'add_icon.php',$data);
        }else{
          header('Location :'.base_url().'err'.DS.'no_access');
            exit();   
        }
    }
    
    public function delete_icon($id)
    {
        if (is_numeric($id) && !empty($id)) {
            $p=($this->Icon_model->del($id)?'?success=del':'?err=del');
            header('Location :'.base_url().'icon'.$p);
            exit();
        } else {
            header('Location : ' . base_url() . 'err' . DS . 'not_found');
            exit();
        }
    }
    
    public function disable_icon($id){
        if (is_numeric($id) && !empty($id)) {
            if ($this->Icon_model->dis($id)) {
                header('location :' . base_url() . 'icon');
                exit();
            }
        }
        return false;
    }
    
    public function enable_icon($id){
        if (is_numeric($id) && !empty($id)) {
            if ($this->Icon_model->en($id)) {
                header('location :' . base_url() . 'icon');
                exit();
            }
        }
        return false;
    }
    

}