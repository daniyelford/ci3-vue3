<?php
header('Access-Control-Allow-Origin: *');
class Sidebars extends My_Controller{
    
    public function __construct(){
        parent::__construct();
    }
 
    //xss cleaner
    
    public function direction_check($text=''){
        return empty($text)?'':strip_tags($text, '<p><a>'); 
    }    
    
    public function check_xss($text=""){
        return empty($text)?'':addslashes($text);
    }

    //sidebars
    
    public function del_map(){
        if(!empty($_POST['send']) && $_POST['send'] == 'ok'){
            if(!empty($_POST['m'])){
                $ids=explode(',',$_POST['m']);
                if(!empty($ids['0'])){
                    for($x=0;$x<=count($ids) -1;$x++){
                        $a=$this->Map_model->delete_data(['id'=>intval($ids[$x])]);
                        if($a){}else{
                            echo 0;
                            die();
                        }
                    }
                    echo 1;
                    die();
                }else{
                    for($y=1;$y<=count($ids)-1;$y++){
                        $a=$this->Map_model->delete_data(['id'=>intval($ids[$y])]);
                        if($a){}else{
                            echo 0;
                            die();
                        }
                    }
                    echo 1;
                    die();
                }
            }else{
                echo 0;
                die();
            }
        }else{
            header('Location :'.base_url().'err'.DS.'not_found');
            exit();
        }
    }
    
    public function mark_side(){
        if(!empty($_POST['send']) && $_POST['send'] == 'ok'){
            if(!empty($_POST['values'])){
                if(!empty($_POST['map'])){
                    $maps=explode(',',$_POST['map']);
                    for($x=0;$x<=count($maps)-1;$x++){
                        if(!empty($maps[$x])){
                            $a=$this->Map_model->edit(['side_id'=>intval($_POST['values'])],$maps[$x]);
                            if($a){}else{
                                echo 0;
                                die();
                            }
                        }
                    }
                    echo 1;
                    die();
                }else{
                    echo 1;
                    die();
                }
            }else{
                header('Location :'.base_url().'err'.DS.'not_found');
                die();
            }
        }else{
            header('Location :'.base_url().'err'.DS.'not_found');
            die();
        }
    }
    
    public function check_add_side(){
        if(isset($_SESSION['role']) && !empty($_SESSION['role']) && $_SESSION['role'] == 'admin'){
            if(!empty($_POST['send']) && $_POST['send']=="ok"){
                if(isset($_POST['title']) && !empty($_POST['title'])){
                    $a= $this->check_xss($_POST['title']);
                }else{
                    echo 0;
                    die();
                }
                // $logo_id=(!empty($_POST['pic_id'])?$_POST['pic_id']:'');
                $css=(!empty($_POST['css'])?$this->direction_check($_POST['css']):'');
                $b=( !empty($_POST['customHtml']) ?$this->direction_check($_POST['customHtml']):'');
                $c=(!empty($_POST['endCustomHtml'])?$this->direction_check($_POST['endCustomHtml']):'');
                if(empty($_POST['place'])){
                    echo 0;
                    die();
                }else{
                    $data=['btn'=>$this->direction_check($_POST['sideBtn']),'title' => $a ,	'place' => $_POST['place'],	'place_map' => (!empty($_POST['map'])?$_POST['map']:''),'custom_html' => $b ,'end_custom_html'=>$c,'css'=>$css];
                    $abas = $this->Side_model->s_w_s_d($data);
                    $info= (!empty($abas)?0:($this->Side_model->add($data)?$this->Side_model->s_w_s_d($data):0));
                    echo (!empty($info) && $info != 0?$info['0']['id']:0);
                    die();
                }
            }else{
                header('Location :'.base_url().'err'.DS.'not_found');
                die();
            }
        }else{
            header('Location :'.base_url().'err'.DS.'no_access');
		    exit();
        }
    } //checking
    
    public function add_side(){
        if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
        $t=['name'=>'title',
            'class'=>'form-control rounded-5',
            'id'=>'title',
            'value'=>set_value('title'),
            'placeholder'=>'عنوان ساید بار',
            'type'=>'text'];
        $f=[
            'top'=>'بالا',
            'left'=>'دست چپ',
            'right'=>'دست راست',
            'foot'=>'پایین'
            ];
        $p=form_dropdown('place',$f,'top',array('class'=>'rounded-5 SlectBox form-control','id'=>'place'));
        $ar=[
            '1'=>'بدون تغییر',
            '2'=>'افرودن css',
            '3'=>'افزودن نقشه',
            // '4'=>'افزودن عکس'
            ];
        $add=form_dropdown('add',$ar,'1',array('class'=>'rounded-5 SlectBox form-control','id'=>'add'));
        $css=[
            'name'  => 'css',
            'id'    => 'css',
            'value' => set_value(strip_tags('css')),
            'rows'  => '50',
            'cols'  => '10',
            'style' => 'width:100%;height:40px',
            'class' => 'form-control rounded-5']; 
        $hs=['name'  => 'custom_html',
            'id'    => 'custom_html',
            'value' => set_value(strip_tags('custom_html')),
            'rows'  => '50',
            'cols'  => '10',
            'style' => 'width:100%;height:40px',
            'class' => 'form-control rounded-5'];  
        $he=['name'  => 'custom_html_end',
            'id'    => 'custom_html_end',
            'value' =>set_value(strip_tags('custom_html_end')),
            'rows'  => '50',
            'cols'  => '10',
            'style' => 'width:100%;height:40px',
            'class' => 'form-control rounded-5'];
        $btn=['name'  => 'sideBtn',
            'id'    => 'sideBtn',
            'value' =>set_value(strip_tags('sideBtn')),
            'rows'  => '50',
            'cols'  => '10',
            'style' => 'width:100%;height:40px',
            'class' => 'form-control rounded-5'];
		$data=['t'=>$t, 'p'=>$p, 'add'=>$add, 'hs'=>$hs, 'he'=>$he, 'css'=>$css,'btn'=>$btn];
	    echo $this->Page_model->render_page('	افزودن ساید بار ها','panel'.DS.'add_sides.php',$data);
        }else{
            header('Location :'.base_url().'err'.DS.'no_access');
		    exit();
        }
    }

    public function edit_side_check(){
        if(!empty($_POST['send']) && $_POST['send']=="ok"){
            if(!empty($_POST['id'])){
                $id=intval($_POST['id']);
                if(!empty($_POST['title'])){
                    $a= $this->check_xss($_POST['title']);
                }else{
                    echo 0;
                    die();
                }
               
                if(empty($_POST['place'])){
                    echo 0;
                    die();
                }else{
                    $data=[
                        'title' => $a ,
                        'css'=> $this->direction_check($_POST['css']),
                        'place' => $_POST['place'],
                        'place_map' => (!empty($_POST['map'])?$_POST['map']:''),
                        'custom_html' => $this->direction_check($_POST['customHtml']),
                        'end_custom_html'=>$this->direction_check($_POST['endCustomHtml']),
                        'btn'=>$this->direction_check($_POST['sideBtn'])
                        ];
                    echo $this->Side_model->edit($data,$id)?1:0;
                    die();
                }
            }else{
                header('Location :'.base_url().'err'.DS.'no_access');
            exit();
            }
        }else{
            header('Location :'.base_url().'err'.DS.'not_found');
            exit();
        }
    }

    public function edit_side($id){
        if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
        if(!empty($id) && is_numeric($id)){
            $info_side=$this->Side_model->side_w_id($id);
            $s=$info_side['0']['place'];
            $t=['name'=>'title',
                'class'=>'form-control rounded-5',
                'id'=>'title',
                'value'=>$info_side['0']['title'],
                'placeholder'=>'عنوان ساید بار',
                'type'=>'text'];
            $f=[
                'top'=>'بالا',
                'left'=>'دست چپ',
                'right'=>'دست راست',
                'foot'=>'پایین'
                ];
            $p=form_dropdown('place',$f,$s,array('class'=>'rounded-5 SlectBox form-control','id'=>'place'));
            $ar=[
                '1'=>'بدون تغییر',
                '2'=>'افرودن دستیو',
                '3'=>'افزودن نقشه'
            ];
            $add=form_dropdown('add',$ar,'1',array('class'=>'rounded-5 SlectBox form-control','id'=>'add'));
            $hs=['name'  => 'custom_html',
                'id'    => 'custom_html',
                'value' =>  (!empty($info_side['0']['custom_html'])?$this->direction_check($info_side['0']['custom_html']):''),
                'rows'  => '50',
                'cols'  => '10',
                'style' => 'width:100%;height:40px',
                'class' => 'form-control rounded-5'
            ];  
            $he=['name'  => 'custom_html_end',
                'id'    => 'custom_html_end',
                'value' => (!empty($info_side['0']['end_custom_html'])?$this->direction_check($info_side['0']['end_custom_html']):''),
                'rows'  => '50',
                'cols'  => '10',
                'style' => 'width:100%;height:40px',
                'class' => 'form-control rounded-5'
            ];
            $css=[
                'name'  => 'css',
                'id'    => 'css',
                'value' => (!empty($info_side['0']['css'])?$this->direction_check($info_side['0']['css']):''),
                'rows'  => '50',
                'cols'  => '10',
                'style' => 'width:100%;height:40px',
                'class' => 'form-control rounded-5'
            ]; 
            $btn=['name'  => 'sideBtn',
                'id'    => 'sideBtn',
                'value' =>(!empty($info_side['0']['btn'])?$this->direction_check($info_side['0']['btn']):''),
                'rows'  => '50',
                'cols'  => '10',
                'style' => 'width:100%;height:40px',
                'class' => 'form-control rounded-5'];
    		echo $this->Page_model->render_page('ویرایش ساید بار ها','panel'.DS.'add_sides.php', 
    		['map' => $info_side['0']['place_map'],'t'=>$t, 'p'=>$p, 'add'=>$add , 'hs'=>$hs ,'he'=>$he ,'css'=>$css,'edit'=>intval($id),'btn'=>$btn]);
        }else{
            header('Location :'.base_url().'err'.DS.'not_found');
            exit();
        }
        }else{
            header('Location :'.base_url().'err'.DS.'no_access');
		    exit();
        }
    }
    
    public function index(){
        if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
    		$data=$this->Side_model->sides();
    	    echo $this->Page_model->render_page('ساید بار ها','panel'.DS.'show_side.php',['data'=>$data]);
        }else{
            header('Location :'.base_url().'err'.DS.'no_access');
		    exit();
        }
    }
    
    public function disable_side($id){
        if (is_numeric($id) && !empty($id)) {
            if ($this->Side_model->dis($id) && $this->Side_model->dis_m($id)) {
                header('location :' . base_url() . 'sidebars');
                exit();
            }
        }
        return false;
    }

    public function enable_side($id){
        if (is_numeric($id) && !empty($id)) {
            if($this->Side_model->en($id) && $this->Side_model->en_m($id)){
                header('location :' . base_url() . 'sidebars');
                exit();
            }
        }
        return false;
    }
    
    public function delete_side($id){
        if(is_numeric($id) && !empty($id)){
           $p=(!empty($this->Side_model->s_w_m_s_i($id))?'?hasChild=err':($this->Side_model->del_m($id) && $this->Side_model->del($id)?'?del=success':$p='?del=err'));
            redirect(base_url()."sidebars".$p);
            die();
        }else{
             redirect(base_url()."err".DS.'not_found');
             die();
        }
    }
    
}
?>