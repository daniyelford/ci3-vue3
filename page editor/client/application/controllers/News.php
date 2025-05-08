<?php
class News extends MY_Controller
{
	public function __construct(){
		parent::__construct();
	}

	public function index(){
	    $a=$this->News_model->get_news();
	    $x='';
	    $num=1;
	    if(!empty($a)){
	        foreach($a as $val){
	            $x.="<tr><th scope='row'>". $num ."</th><td>". (!empty($val['title'])?$val['title']:'-') ."</td><td>";
    			$x.=(!empty($val['content'])?$val['content']:'-');
    			$x.="</td><td>";
    			$x.=(!empty($val['end_time'])?date('Y/d/m',strtotime($val['end_time'])):'-');
    			$x.='</td><td>';
    			$site=(!empty($val['site_user'])?$this->Site_user_model->ssuwArr( ['url' => intval( $val['site_user'] ) ] ) : '' );
    			$x.=(!empty($site)?$site['0']['username']:'-');
    			$x.="</td><td>";
    			$x.=($val['status'] == 1?"<a class='btn btn-block btn-warning-gradient pd-x-25 rounded-10 box-shadow-pink' href='". base_url()."news".DS."disable".DS.$val['id']."'>غیر فعال</a>":"<a class='btn btn-block btn-success-gradient pd-x-25 rounded-10 box-shadow-success' href='". base_url()."news".DS."enable".DS.$val['id']."'>فعال</a>");
    			$x.="</td><td><a class='btn btn-primary-gradient pd-x-25 rounded-10 box-shadow-success' href='". base_url()."news".DS."edit".DS.$val['id']."'>ویرایش</a>
    			<a class='btn btn-danger-gradient pd-x-25 rounded-10 box-shadow-primary' href='". base_url()."news".DS."del".DS.$val['id']."'>حذف</a>
    			</td></tr>";
    		    $num++;
	        }
	    }
	    echo $this->Page_model->render_page('پیام ها','panel/news',['x'=>$x]);
	}
	
	public function edit($id){
	    if($_SESSION['role'] == 'admin'){
	        if(!empty($id) && is_numeric($id)){
	            $info=$this->News_model->snwi($id);
    	        $site_users=$this->Site_user_model->s_all();
    	        $sites=['0'=>'انتخاب کنید'];
    	        foreach($site_users as $a){
    	            $sites[$a['url']]=$a['username'];
    	        }
    	        $title=['name'=>'title',
                'class'=>'form-control rounded-5',
                'id'=>'title',
                'value'=>$info['0']['title'],
                'placeholder'=>'عنوان اطلاعیه',
                'type'=>'text'];
                $content=['name'=>'content',
                'class'=>'form-control rounded-5',
                'id'=>'content',
                'value'=>$info['0']['content'],
                'placeholder'=>'متن اطلاعیه',
                'type'=>'text'];
                $e = ['name' => 'datepicker1',
                'class' => 'form-control rounded-5',
                'id' => 'datepicker1',
                'value' => $info['0']['end_time'],
                'placeholder' => 'مدت زمان',
                'type' => 'text'];
                $site=form_dropdown('site',$sites,$info['0']['site_user'],['id'=>'site','class'=>'rounded-5 form-control']);
    	        $data=['t'=>$title,'c'=>$content,'s'=>$site,'e'=>$e,'edit'=>$id];
    	        echo $this->Page_model->render_page('افزودن اطلاعیه','panel/add_news',$data);    
	        }else{
                header('Location :'.base_url().'err'.DS.'not_found');
                exit();    
	        }
	    }else{
	        header('Location :'.base_url().'err'.DS.'no_access');
            exit();
	    }
	}
	
	public function check_edit(){
	    if(!empty($_SESSION['id']) && $_SESSION['role'] == 'admin'){
    	    if(!empty($_POST['send']) && $_POST['send'] == 'ok' && !empty($_POST['id'])){
    	        $date=(!empty($_POST['date'])?$_POST['date']:NULL);
    	        $title=(!empty($_POST['title'])?$this->check_xss($_POST['title']):NULL);
    	        $content=(!empty($_POST['content'])?$this->check_xss($_POST['content']):NULL);
    	        $site=(!empty($_POST['site']) && $_POST['site'] != '0'?$_POST['site']:NULL);
    	        if(!is_null($site) && !is_null($content) && !is_null($title)){
    	            $data=[
    	                'user_id_reporter'=>$_SESSION['id'],
    	                'title'=>$title,
    	                'content'=>$content,
    	                'role_reporter'=>'admin',
    	                'end_time'=>$date,
    	                'site_user'=>$site,
    	            ];
    	            echo ($this->News_model->edit($data,intval($_POST['id']))?1:0);
    	            die();
    	        }else{
    	            echo 0;
    	            die();
    	        }
    	    }else{
    	        header('Location :'.base_url().'err'.DS.'not_found');
                exit(); 
    	    }
	    }else{
	        header('Location :'.base_url().'err'.DS.'no_access');
            exit();
	    }
	}

	public function check_add(){
	    if(!empty($_SESSION['id']) && $_SESSION['role'] == 'admin'){
    	    if(!empty($_POST['send']) && $_POST['send'] == 'ok'){
    	        $date=(!empty($_POST['date'])?$_POST['date']:NULL);
    	        $title=(!empty($_POST['title'])?$this->check_xss($_POST['title']):NULL);
    	        $content=(!empty($_POST['content'])?$this->check_xss($_POST['content']):NULL);
    	        $site=(!empty($_POST['site']) && $_POST['site'] != '0'?$_POST['site']:NULL);
    	        if(!is_null($site) && !is_null($content) && !is_null($title)){
    	            $data=[
    	                'user_id_reporter'=>$_SESSION['id'],
    	                'title'=>$title,
    	                'content'=>$content,
    	                'role_reporter'=>'admin',
    	                'end_time'=>$date,
    	                'site_user'=>$site,
    	            ];
    	            $data22=[
    	                'title'=>$title,
    	                'content'=>$content,
    	                'site_user'=>$site,
    	            ];
    	            $befor=$this->News_model->snwd($data22);
    	            $asss= (!empty($befor) && is_array($befor)?$this->News_model->edit($data,$befor['0']['id']):$this->News_model->add($data));
    	            $again=$this->News_model->snwd($data22);
    	            echo ($asss?$again['0']['id']:0);
    	            $befor=null;
    	            die();
    	        }else{
    	            echo 0;
    	            die();
    	        }
    	    }else{
    	        header('Location :'.base_url().'err'.DS.'not_found');
                exit(); 
    	    }
	    }else{
	        header('Location :'.base_url().'err'.DS.'no_access');
            exit();
	    }
	}
	
	public function add(){
	    if($_SESSION['role'] == 'admin'){
	        $site_users=$this->Site_user_model->s_all();
	        $sites=['0'=>'انتخاب کنید'];
	        foreach($site_users as $a){
	            $sites[$a['url']]=$a['username'];
	        }
	        $title=['name'=>'title',
            'class'=>'form-control rounded-5',
            'id'=>'title',
            'value'=>set_value('title'),
            'placeholder'=>'عنوان اطلاعیه',
            'type'=>'text'];
            $content=['name'=>'content',
            'class'=>'form-control rounded-5',
            'id'=>'content',
            'value'=>set_value('content'),
            'placeholder'=>'متن اطلاعیه',
            'type'=>'text'];
            $e = ['name' => 'datepicker1',
            'class' => 'form-control rounded-5',
            'id' => 'datepicker1',
            'value' => (isset($itemOutData->datepicker1) ? set_value('datepicker1', date('Y-m-d', strtotime($itemOutData->datepicker1))) : set_value('datepicker1')),
            'placeholder' => 'مدت زمان',
            'type' => 'text'];
            $site=form_dropdown('site',$sites,'0',['id'=>'site','class'=>'rounded-5 form-control']);
	        $data=['t'=>$title,'c'=>$content,'s'=>$site,'e'=>$e];
	        echo $this->Page_model->render_page('افزودن اطلاعیه','panel/add_news',$data);
	    }else{
	        header('Location :'.base_url().'err'.DS.'no_access');
            exit();
	    }
	}
	
	public function disable($id){
	   if(!empty($id) && is_numeric($id)){
            $info=$this->News_model->snwi($id);
            if(!empty($info)){
                $a=$this->News_model->dis($id);
                if($a){
                    echo '<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
                    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                    <script>
                        $(document).ready(function(){
                            let id="'.$id.'";
                            let send="ok";
                            let xa="asad";
                            let type="disNews";
                            $.ajax({
                                url:"'.$info['0']['site_user'].'err'.DS.'n_f'.'",
                                data:{id:id,send:send,xa:xa,type:type},
                                method:"POST",
                                success:function(x){
                                    if(x == 1){
                                        window.location.replace("'.base_url().'news");
                                    }else{
                                        alert(x)
                                    }
                                }
                            })
                        })
                    </script>';
                    die();
                }
            }
            $info=$a=null;
        }
        header('Location :'.base_url().'err'.DS.'not_found');
        exit();
	}

    public function enable($id){
        if(!empty($id) && is_numeric($id)){
            $info=$this->News_model->snwi($id);
            if(!empty($info)){
                $a=$this->News_model->en($id);
                if($a){
                    echo '<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
                    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                    <script>
                        $(document).ready(function(){
                            let id="'.$id.'";
                            let send="ok";
                            let xa="asad";
                            let type="enNews";
                            $.ajax({
                                url:"'.$info['0']['site_user'].'err'.DS.'n_f'.'",
                                data:{id:id,send:send,xa:xa,type:type},
                                method:"POST",
                                success:function(x){
                                    if(x == 1){
                                        window.location.replace("'.base_url().'news");
                                    }else{
                                        alert(x)
                                    }
                                }
                            })
                        })
                    </script>';
                    exit();
                }
            }
            $info=$a=null;
        }
        header('Location :'.base_url().'err'.DS.'not_found');
        exit();
    }
    
    public function del($id){
        if(!empty($id) && is_numeric($id)){
            $info=$this->News_model->snwi($id);
            if(!empty($info)){
                $a=$this->News_model->del($id);
                if($a){
                    echo '<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
                    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                    <script>
                        $(document).ready(function(){
                            let id="'.$id.'";
                            let send="ok";
                            let xa="asad";
                            let type="delNews";
                            $.ajax({
                                url:"'.$info['0']['site_user'].'err'.DS.'n_f'.'",
                                data:{id:id,send:send,xa:xa,type:type},
                                method:"POST",
                                success:function(x){
                                    if(x == 1){
                                        window.location.replace("'.base_url().'news");
                                    }else{
                                        alert(x)
                                    }
                                }
                            })
                        })
                    </script>';
                    exit();
                }
            }
            $info=$a=null;
        }
        header('Location :'.base_url().'err'.DS.'not_found');
        exit();
    }
	
	public function direction_check($text=''){
        return empty($text)?'':strip_tags($text, '<p><a>'); 
    }    
    
    public function check_xss($text=""){
        return empty($text)?'':addslashes($text);
    }
}