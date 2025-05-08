<?php
header('Access-Control-Allow-Origin: *');
class Pic extends My_Controller{
    
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
    
    public function pic_upload(){
        $y=explode('.',$_FILES["image_file"]['name']);
        $x=end($y);
        $new_name=rand(1,999).'.'.$x;
        $config['upload_path']="./pic/";
        $config['allowed_types']='gif|jpg|png';
        $config['file_name'] = $new_name;
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload',$config);
        if($this->upload->do_upload("image_file")){
            $data = array('image_file' => $this->upload->data());
            $image= $data['image_file']['file_name'];
            $result= $this->Pic_model->img_create(['name'=>$image]);
            echo json_decode($result);
            die();
        }else{
            echo 1;
            die();
        }
 
    }
    
    public function pic_upload_user(){
        $y=explode('.',$_FILES["image_file"]['name']);
        $x=end($y);
        $new_name=rand(1,999).'.'.$x;
        $config['upload_path']="./assets/img/faces/";
        $config['allowed_types']='gif|jpg|png';
        $config['file_name'] = $new_name;
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload',$config);
        if($this->upload->do_upload("image_file")){
            $data = array('image_file' => $this->upload->data());
            $image= $data['image_file']['file_name'];
            echo ($this->Pic_model->img_create_user(['name'=>$image])?$image:0);
            die();
        }else{
            echo 0;
            die();
        }
 
    }
    
    public function pic_logo(){
        $y=explode('.',$_FILES["image_file"]['name']);
        $x=end($y);
        $new_name=rand(1,999).'.'.$x;
        $config['upload_path']="./assets/img/brand/";
        $config['allowed_types']='gif|jpg|png';
        $config['file_name'] = $new_name;
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload',$config);
        if($this->upload->do_upload("image_file")){
            $data = array('image_file' => $this->upload->data());
            $image= $data['image_file']['file_name'];
            echo ($this->Pic_model->img_create_user(['name'=>$image])?$image:0);
            die();
        }else{
            echo 0;
            die();
        }
    }
    
    public function all_pic(){
            
        if( $_POST['xa'] == 'ok' && !empty($_POST['xa']) ){
            $pictures = $this->Pic_model->all_pictures();
            $a='';
            if(!empty($pictures)){
                $a.='<div style="height:353px;background-color:white;margin-top: 1px;overflow-y: auto;overflow-x:hidden;">
                                			    
            <div class="m-2" style="position: absolute;left: 3px;top: -3px;">
<a id="rola" title="افزودن عکس" style="color:grey;" class="pull-left" href="#">
                        			        <i class="fa fa-plus"></i>
                        			        </a>
            </div>
        <div class="row mt-3 px-2  pt-2 mx-auto text-center" id="bit-pic" style="padding-right: 10px;padding-left:10px;width:100%;">';
				foreach($pictures as $pic){
					$a .= "<div class='col-md-4 my-1 picture-div'><input class='pic-id' type='hidden' value='".$pic['id']."' /><div class='card text-center'>
                                        		                <img class='card-img-top w-100' src='".base_url().'pic'.DS.$pic['name']."'></div></div>";
			    }
			    $a.='</div></div>';
			    $a.="<script>
			        function komeil(a, b) {
        let check_id = $(a).val().split(',');
        let id;
        var rn = 1 + Math.floor(Math.random() * 6);
        if ($.inArray(b, check_id, 2)) {
            id = b + ':' + rn;
        } else {
            id = b;
        }
        return id;
    }
                Array.prototype.remove = function() {
            var what, a = arguments, L = a.length, ax;
            while (L && this.length) {
                what = a[--L];
                while ((ax = this.indexOf(what)) !== -1) {
                    this.splice(ax, 1);
                }
            }
            return this;
        };
        function removeA(arr) {
            var what, a = arguments, L = a.length, ax;
            while (L > 1 && arr.length) {
                what = a[--L];
                while ((ax= arr.indexOf(what)) !== -1) {
                    arr.splice(ax, 1);
                }
            }
            return arr;
        }
			            $(document).ready(function (){
                           $('.picture-div').on('click',function(){
            if( $(this).hasClass('rounded-10 box-shadow-primary pt-2') ){
                $(this).removeClass('rounded-10 box-shadow-primary pt-2');
                $(this).addClass('rounded-10 box-shadow-danger pt-2');
            }else{
                $(this).addClass('rounded-10 box-shadow-primary pt-2');
            }
            idsss=$(this).children( '.post-id' ).val();
            id=komeil('#pi',idsss);";
            $ccccc='"+id+"';
            $configi="class='post-id' type='hidden' value='".$ccccc."'";
            $a.='ht="<input '.$configi.' />"+$(this).children(".card").html();';
        $a.="fh='<li>'+ht+'</li>';
            
            as=$('#pi').val();
            asi=as+','+id;
            $('#pi').val(asi);
            $('#pic_select').html($('#pic_select').html()+fh);
            ul = $('#pic_select'); // your parent ul element
            ul.children().each(function(i,li){ul.prepend(li)})
        });
                                        
        $('#pic_select').on('click','li',function(){
            rmid=$(this).children('.post-id').val();
            ids=$('#pi').val().split(',');
            for(i=1;i<=ids.length;i++){
                if(rmid==ids[i]){
                    ids = jQuery.grep(ids, function(value) {
                        return value != rmid;
                    });
                }
            }
            $('#pi').val(ids.join(','));
            $(this).remove();
            mhd=rmid.split(':');";
            $bbbb='"+mhd[0]+"';
            $a.= "if($('.picture-div').find('input[value=".$bbbb."]').parent().hasClass('rounded-10 pt-2 box-shadow-primary')){
                $('.picture-div').find('input[value=".$bbbb."]').parent().removeClass('rounded-10 pt-2 box-shadow-primary');
            }
            if($('.picture-div').find('input[value=".$bbbb."]').parent().hasClass('rounded-10 box-shadow-primary pt-2')){
                $('.picture-div').find('input[value=".$bbbb."]').parent().removeClass('rounded-10 box-shadow-primary pt-2');
            }
            if($('.picture-div').find('input[value=".$bbbb."]').parent().hasClass('rounded-10 box-shadow-danger pt-2')){
                $('.picture-div').find('input[value=".$bbbb."]').parent().removeClass('box-shadow-danger');
                $('.picture-div').find('input[value=".$bbbb."]').parent().addClass('box-shadow-primary');
            }
        });

        $('#rola').on('click',function (){
            $('.modal').modal('show');
        });
                        })
                </script>";
			}else{
				$a.='<div class="m-auto text-center alert alert-danger rounded-10 box-shadow-pink" id="pictures">
				<div class="m-2" style="position: absolute;left:7px;top:7px;"><a id="rola" title="افزودن عکس" style="color:grey;" class="pull-left" href="#"><i class="fa fa-plus"></i></a></div> 
				عکسی وجود ندارد ابتدا عکس اضافه کنید</div>';
				$a.="<script>
			            $(document).ready(function (){
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
			}
			echo $a;
			die();
        }else{
            header('Location :' .base_url().'err'.DS.'not_found');
            exit();
        }
    }

    public function music_upload()
    {
        $config['upload_path']          = './assets/music';
        $config['allowed_types']        = 'mp3';
        $config['max_size']             = 20;
        $this->load->library('upload', $config);
        $this->upload->do_upload('play_list_audio');
        $up_file = $this->upload->data();
        $up_audio=$up_file['file_name'];
        $data = array("play_list_audio"=>$up_audio);
        $this->Model->AudioInsertdata($data);

        
    }


    public function video_uplaod(){
        $y=explode('.',$_FILES["image_file"]['name']);
        $x=end($y);
        $new_name=rand(1,999).'.'.$x;
        $config['upload_path']="./pic/";
        $config['allowed_types']='gif|jpg|png';
        $config['file_name'] = $new_name;
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload',$config);
        if($this->upload->do_upload("image_file")){
            $data = array('image_file' => $this->upload->data());
            $image= $data['image_file']['file_name'];
            $result= $this->Pic_model->img_create(['name'=>$image]);
            echo json_decode($result);
            die();
        }else{
            echo 1;
            die();
        }
 
    }
}