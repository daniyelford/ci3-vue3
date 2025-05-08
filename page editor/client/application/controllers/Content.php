<?php

class Content extends MY_Controller
{


    public function __construct()
    {
        parent::__construct();
    }

    public function check_add(){
        $send=(!empty($_POST['send'])&&isset($_POST['send']) &&$_POST['send']=='send'?TRUE:NULL);
        if(!is_null($send)){
            $title=(!empty($_POST['title']) && isset($_POST['title'])?$this->direction_check($_POST['title']):NULL);
            $content=(!is_null($title)&&isset($_POST['content']) &&!empty($_POST['content'])?$this->direction_check($_POST['content']):NULL);
            $words=str_word_count($content);
            $des=(!is_null($content)&&isset($_POST['des']) &&!empty($_POST['des'])?$this->direction_check($_POST['des']):NULL);
            $style=(!is_null($des)&&isset($_POST['style']) &&!empty($_POST['style'])?$this->direction_check($_POST['style']):NULL);
            $pi= (isset($_POST['pi']) && !empty($_POST['pi'])?$_POST['pi']:NULL);
            if (!empty($pi) && !empty($send)  &&!empty($title)  &&!empty($content) &&!empty($des)) {
                $a=explode(',',$pi);
            $d='';
            for($b=0;$b<=count($a)-1;$b++){
                $c=explode(':',$a[$b]);
                $d.=$c['0'].',';
            }
                $data=[
                    'title'=>$title,
                    'text'=>$content,
                    'pic_id'=>$d,
                    'style'=>$style,
                    'des'=>$des,
                    'user_id'=>(isset($_SESSION['id'])?$_SESSION['id']:0),
                    'words'=>$words,
                    'status'=>0,
                ];
                echo ($this->Content_model->i_c($data)?1:0);    
                die();
            } else {
                echo 0;
                die();
            }
        }else{
            header('Location :'. base_url().'err'.'not_found');
            exit();
        }
    }

    public function check_edit(){
        $send=(!empty($_POST['send'])&&isset($_POST['send']) &&$_POST['send']=='send'?TRUE:NULL);
        $id=(!empty($_POST['id'])&&isset($_POST['id']) && is_numeric($_POST['id']) && !is_null($send)?$_POST['id']:NULL);
        if(!is_null($send)&&!is_null($id)){
            $title=(!empty($_POST['title']) && isset($_POST['title'])?$this->direction_check($_POST['title']):NULL);
            $content=(!is_null($title)&&isset($_POST['content']) &&!empty($_POST['content'])?$this->direction_check($_POST['content']):NULL);
            $words=str_word_count($content);
            $editor=$_POST['editor'].','.$_SESSION['id'];
            $des=(!is_null($content)&&isset($_POST['des']) &&!empty($_POST['des'])?$this->direction_check($_POST['des']):NULL);
            $style=(!is_null($des)&&isset($_POST['style']) &&!empty($_POST['style'])?$this->direction_check($_POST['style']):NULL);
            $pi= (isset($_POST['pi']) && !empty($_POST['pi'])?$_POST['pi']:NULL);
            if ( !empty($send)  &&!empty($title)  &&!empty($content) &&!empty($des) && !empty($pi)) {
                $data=[
                    'title'=>$title,
                    'text'=>$content,
                    'pic_id'=>$pi,
                    'style'=>$style,
                    'des'=>$des,
                    'editor_id'=>$editor,
                    'words'=>$words,
                    'rate'=>($_SESSION['role'] !='admin' ?0:(!empty($_POST['rate'])?$_POST['rate']:0))
                ];
                echo ($this->Content_model->edit($data,$id)?1:0);    
                die();
            } else {
                echo 0;
                die();
            }
        }else{
            header('Location :'. base_url().'err'.'not_found');
            exit();
        }
    }

    public function add_content()
    {
        if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
        $t = ['name' => 'title',
            'class' => 'form-control rounded-5',
            'id' => 'title',
            'value' => set_value('title'),
            'placeholder' => 'عنوان متن را وارد کنید',
            'type' => 'text'];

        $c = ['name' => 'content',
            'class' => 'form-control rounded-5',
            'id' => 'content',
            'value' => set_value('content'),
            'placeholder' => 'متن مورد نظر را وارد کنید',
            'type' => 'text'];

        $s = ['name' => 'style',
            'class' => 'form-control rounded-5 text-start dir-ltr',
            'id' => 'style',
            'value' => set_value('style'),
            'placeholder' => 'استایل css دستی خود را وارد کنید',
            'type' => 'text'];
             $d = ['name' => 'des',
                    'class' => 'form-control rounded-5',
                    'id' => 'des',
                    'value' => set_value('des'),
                    'placeholder' => 'توضیحات مختصری راجب متن وارد کنید',
                    'type' => 'text'];
            
        $pic_info = $this->Post_model->show_pic();
        $data = ['data'=>true,'t' => $t, 'c' => $c, 's' => $s, 'all_pic' => $pic_info,'d'=>$d];
        echo $this->Page_model->render_page('افزودن متن','panel/add_contents.php', $data);
        }else{
          header('Location :'.base_url().'err'.DS.'no_access');
            exit();   
        }
    }

    public function edit_content($id)
    {
        if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
        if (is_numeric($id) && !empty($id)) {
            $pic_info = $this->Post_model->show_pic();
            $info = ($this->Content_model->s_c_i($id) ?: NULL);
            if (!empty($info)) {
                $t = ['name' => 'title',
                    'class' => 'form-control rounded-5',
                    'id' => 'title',
                    'value' => $info['0']['title'],
                    'placeholder' => 'عنوان پست را وارد کنید',
                    'type' => 'text'];

                $c = ['name' => 'content',
                    'class' => 'form-control rounded-5',
                    'id' => 'content',
                    'value' => $info['0']['text'],
                    'placeholder' => 'متن پست خود راوارد کنید',
                    'type' => 'text'];

                $s = ['name' => 'style',
                    'class' => 'form-control rounded-5 text-start dir-ltr',
                    'id' => 'style',
                    'value' => $info['0']['style'],
                    'placeholder' => 'عنوان پست را وارد کنید',
                    'type' => 'text'];
                $d = ['name' => 'des',
                    'class' => 'form-control rounded-5',
                    'id' => 'des',
                    'value' => $info['0']['des'],
                    'placeholder' => 'عنوان پست را وارد کنید',
                    'type' => 'text'];
                $pics = $info['0']['pic_id'];
                $pic_names =$picsss=$all_pics= [];
                $pic_ids = (!empty($pics) ? explode(',', $pics) : NULL);
                if (!is_null($pic_ids)) {
                    for ($majid = 0; $majid <= count($pic_ids) - 1; $majid++) {
                        $pictt=explode(':',$pic_ids[$majid]);
                        if (!empty($pictt['0'])) {
                            $pic_id = (!empty($this->Content_model->s_p_i(intval($pictt['0']))) ?$this->Content_model->s_p_i(intval($pictt['0'])): NULL);
                            $all_pics[$majid]=['id'=>$pic_id['0']['id'],'name'=>$pic_id['0']['name']];
                        }
                    }
                }
                $editors=$info['0']['editor_id'];
                $rate=($_SESSION['role'] =='admin'?true:false);
                $data = ['t' => $t, 'c' => $c, 's' => $s, 'all_pic' => $pic_info,'edit'=>$id,'d'=>$d,'editor'=>$editors,'rate'=>$rate,'pics'=>$all_pics];
                echo $this->Page_model->render_page('ویرایش متن','panel/add_contents.php', $data);
            } else {
                header('Location : ' . base_url() . 'err' . DS . 'not_found');
                exit();
            }
        } else {
            header('Location : ' . base_url() . 'err' . DS . 'not_found');
            exit();
        }
        }else{
          header('Location :'.base_url().'err'.DS.'no_access');
            exit();   
        }
    }

    public function index()
    {
         if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
        $data = $this->Content_model->a_c();
        if (!empty($data)) {
        
            $x = '<div style="height:500px;background-color:white;margin-top: 1px;overflow-y: auto;overflow-x:hidden;"><div class="m-2" style="position: absolute;left:20px;"><a id="rola" title="افزودن متن" style="color:grey;" class="pull-left" href="' . base_url() . 'content' . DS . 'add_content"><i class="fa fa-plus"></i></a></div><div class="row mt-3 px-2  pt-2 mx-auto text-center" id="bit-pic" style="padding-right: 10px;padding-left:10px;width:100%;">';
            $pics = [];
            foreach ($data as $p) {
                $fet=(!empty($p['user_id'])?$this->Content_model->s_u_n_i($p['user_id']):NULL);
                $writer=(!empty($fet) && !empty($fet['0']['name']) && !empty($fet['0']['family'])?$fet['0']['name']." ".$fet['0']['family']:'');
                $i = (!empty($p['pic_id'])?explode(',', $p['pic_id']):NULL);
                if(!is_null($i)){
                    for ($hamid = 0; $hamid <= count($i) -1; $hamid++) {
                        if(!empty($i[$hamid]) && $i[$hamid] != "0"){
                            $abas = $this->Content_model->s_p_i($i[$hamid]);
                            if (!empty($abas)) {
                               $pics[$hamid]= $abas['0']['name'];
                            }
                        }
                    }
            
                }
             
                $x .= "<div class='col-md-4 my-1 picture-div'><input class='post-id' type='hidden' value='" . $p['id'] . "' /><div class='card text-center'>";
                if (!empty($pics)) {
                    $x .= '<div class="carousel slide" data-ride="carousel" id="carouselExampleSlidesOnly"><div class="carousel-inner">';
                    $x .= "<div class='carousel-item active'> <img class='card-img-top w-100' src='" . base_url() . 'pic' . DS . (!empty($pics['0'])?$pics['0']:$pics['1']) . "' alt='تصاویر پست ها'>   </div>";
                    for ($capt = (!empty($pics['0'])?0:1); $capt <= count($pics) - 1; $capt++) {
                        $x .= (!empty($pics[$capt]) ? "<div class='carousel-item'> <img class='card-img-top w-100' src='" . base_url() . 'pic' . DS . $pics[$capt] . "' alt='تصاویر پست ها'>   </div>" : '');
                    }
                    $x .= '</div></div>';
                } else {
                    $x .= "<div class='alert rounded-10 box-shadow-pink text-center '>تصویری انتخاب نشده است</div>";
                }
           
                $x .= "<div class='card-body'><h4 class='card-title mb-3'>" . $p['title'] . "</h4><br><span style='color:blue;'>خلاصه مطلب : " . $p['des'] . " </span>";
                if(!empty($writer)){
                    $x.="<br><span>نویسنده : ".$writer."</span>";
                }
                if(!empty($p['rate'])){    
                    $x.='<div class="rating mb-1">                    <span class="review-no">امتیاز متن</span><div class="stars">';
                        switch($p['rate']){
                            case '1':
                                $x.= '<span class="fa fa-star checked"></span><span class="fa fa-star text-muted"></span><span class="fa fa-star text-muted"></span><span class="fa fa-star text-muted"></span><span class="fa fa-star text-muted"></span>';
                                break;

                            case '2':
                                $x.= '<span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star text-muted"></span><span class="fa fa-star text-muted"></span><span class="fa fa-star text-muted"></span>';
                                break;

                            case '3':
                                $x.= '<span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star text-muted"></span><span class="fa fa-star text-muted"></span>';
                                break;

                            case '4':
                                $x.= '<span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star text-muted"></span>';
                                break;

                            default:
                                $x.= '<span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span>';
                                break;
                        }
                    $x.='</div></div>';
                }  
                $x .= "<br><a class='btn btn-primary-gradient btn-block rounded-10 box-shadow-success' href='" . base_url() . 'content' . DS . 'show_content' . DS . $p['id'] . "'>ادامه مطلب</a></div></div></div>";
            }
          
            $x .= '</div></div>';
            $x .= "<script>
			       $(document).ready(function (){
                            $('.picture-div').on('click',function(){
                                if($('#bit-pic').children().hasClass('rounded-10 box-shadow-primary pt-2')){
                                    $('#bit-pic').children().removeClass('rounded-10 box-shadow-primary pt-2');
                                }
                                if( $(this).hasClass('rounded-10 box-shadow-primary pt-2') ){
                                }else{
                                    $(this).addClass('rounded-10 box-shadow-primary pt-2');
                                }
                                $('#pi').val($(this).children( '.post-id' ).val());
                            });
                            $('#rola').on('click',function (){
                                $(this).addClass('d-none');
                                if( $(this).parents('#pictures').hasClass('d-none') ){
                                    
                                }else{
                                    $('#pictures').addClass('d-none');  
                                }
                                if( $('#localoca').hasClass('d-none') ){
                                   $('#localoca').removeClass('d-none'); 
                                }
                            });
                        })
                </script>";
        } else {
            $x = "<div class='alert alert-danger rounded-10 box-shadow-pink text-center pd-x-25 py-3 mt-5'><p>
    						هیچ متنی وجود ندارد لطفا ابتدا متنی ایجاد کنید</p><br>
    							    <a class='btn btn-block btn-info-gradient rounded-10 box-shadow-primary pd-x-25' href='" . base_url() . "content" . DS . "add_content" . "'>افزودن متن</a>
    							</div>";
        }
        echo $this->Page_model->render_page('نمایش متن ها','panel/content.php', ['x' => $x]);
         }else{
          header('Location :'.base_url().'err'.DS.'no_access');
            exit();   
        }
    }
    
    public function show_content($id)
    {
        if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
        if (is_numeric($id) && !empty($id)) {
            $info = ($this->Content_model->s_c_i($id) ?: NULL);
            if (!empty($info) && !is_null($info)) {
                $writer_id=(!is_null($info['0']['user_id']) && is_numeric($info['0']['user_id']) && !empty($info['0']['user_id']) && $info['0']['user_id']!= '0'?$info['0']['user_id']:NULL);
                $fet=(!is_null($writer_id)?$this->Content_model->s_u_n_i($writer_id):NULL);
                $nameandfa=(!empty($fet)&&!is_null($fet)&&!is_null($fet['0']['name']) && !is_null($fet['0']['family']) && !empty($fet['0']['name']) && !empty($fet['0']['family'])?$fet['0']['name']." ".$fet['0']['family']:'');
                $writer=(!empty($fet) && !is_null($fet)?$nameandfa:'');
                $editors = [];
                $editor_ids = (is_numeric($info['0']['editor_id']) && !empty($info['0']['editor_id']) && $info['0']['editor_id'] != '0' ? $info['0']['editor_id'] : NULL);
                $editor_id = (!is_null($editor_ids) ? explode(',', $editor_ids) : NULL);
                if (!empty($editor_id)) {
                    for ($love = 0; $love <= count($editor_id) - 1; $love++) {
                        if (!empty($editor_id[$love]) && $editor_id[$love] != "0") {
                            $love_ids[] = $this->Content_model->s_u_n_i($editor_id[$love]);
                            if (!empty($love_ids)) {
                                $editors[] = (!empty($love_ids[$love]['0']['name']) && !empty($love_ids[$love]['0']['family']) ? $love_ids[$love]['0']['name'] . " " . $love_ids[$love]['0']['family'] : '');
                            }
                        }
                    }
                }
                $i = (!empty($info['0']['pic_id'])&&!is_null($info['0']['pic_id'])?explode(',', $info['0']['pic_id']):NULL);
                $pics = [];
                if(!is_null($i)){
                    for ($hamid = 0; $hamid <= count($i) -1; $hamid++) {
                        $picccc=explode(':',$i[$hamid]);
                        if(!empty($picccc['0']) && $picccc['0'] != "0"){
                            $abas = $this->Content_model->s_p_i($picccc['0']);
                            if (!empty($abas)) {
                               $pics[$hamid]= $abas['0']['name'];
                            }
                        }
                    }
                }
                echo $this->Page_model->render_page('نمایش متن','panel/show_content.php', ['data' => $info,'pics' => $pics,'writer'=>$writer,'editors'=>$editors]);
            }else{
                header('Location : ' . base_url() . 'content');
                exit();
            }
        } else {
            header('Location : ' . base_url() . 'err' . DS . 'not_found');
            exit();
        }
 }else{
          header('Location :'.base_url().'err'.DS.'no_access');
            exit();   
        }
    }

    public function direction_check($text = '')
    {
        return empty($text) ? '' : strip_tags($text, '<p><a>');
    }

    public function check_xss($text = "")
    {
        return empty($text) ? '' : addslashes($text);
    }

    public function disable($id)
    {
        if (is_numeric($id) && !empty($id)) {
            if ($this->Content_model->dis($id)) {
                header('location :' . base_url() . 'content' . DS . 'show_content' . DS . $id);
                exit();
            }
        }
        return false;
    }

    public function enable($id)
    {
        if (is_numeric($id) && !empty($id)) {
            if ($this->Content_model->en($id)) {
                header('location :' . base_url() . 'content' . DS . 'show_content' . DS . $id);
                exit();
            }
        }
        return false;
    }

    public function del()
    {
        if (isset($_POST['send']) && !empty($_POST['send'])) {
            if (is_numeric($_POST['id'])) {
                if (!empty($_POST['id'])) {
                    echo ($this->Content_model->del($_POST['id'])?1:0);
             
                       die();
                    
                } else {
                    echo 0;
                    die();
                }
            } else {
                header('Location : ' . base_url() . 'err' . DS . 'not_found');
                exit();
            }
        } else {
            header('Location : ' . base_url() . 'err' . DS . 'not_found');
            exit();
        }
    }
}