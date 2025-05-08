<?php
class User extends MY_Controller
{
	public function __construct(){
		parent::__construct();
	}
	public function index(){
	    if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
	        $x='';
            $num=1;
            $id=
	        $a=$this->User_model->s_u_a();
            if(!empty($a)){
                foreach($a as $val){
                    if($val['id'] != $id){   
                        $x.="<tr><th scope='row'>". $num ."</th><td>";
            			$x.=(!empty($val['name'])?$val['name']:'-');
            			$x.="</td><td>";
            			$x.=(!empty($val['family'])?$val['family']:'-');
            			$x.="</td><td>";
            			$x.=(!empty($val['code_mely'])?$val['code_mely']:'-');
            			$x.="</td><td>";
            			$x.='<img class="card-img-top w-100" style="height:100px; width:100px;" src="'.base_url().'assets/img/faces/';
            			$x.=(!empty($val['pic'])?$val['pic'].'" alt="user picture">':'1.png" alt="user picture">');
            			$x.="</td><td>";
            			$x.=(!empty($val['parent_name'])?$val['parent_name']:'-');
            			$x.="</td><td>";
            			$x.=(!empty($val['phone'])?$val['phone']:'-');
            			$x.="</td><td>";
            			$x.=(!empty($val['birthday_place'])?$val['birthday_place']:'-');
            			$x.="</td><td>";
            			$x.=(!empty($val['birthday'])?$val['birthday']:'-');
            			$x.="</td><td>";
            			$x.=(!empty($val['role'])?$val['role']:'-');
            			$x.="</td><td><a class='btn btn-danger-gradient pd-x-25 rounded-10 box-shadow-pink ml-1' href='". base_url()."user".DS."del".DS.$val['id']."'>حذف</a><a class='btn btn-info-gradient pd-x-25 rounded-10 box-shadow-primary' href='". base_url()."user".DS."edit".DS.$val['id']."'>ویرایش</a></td></tr>";
            		    $num++;
                    }
               }
	        }   
	        echo $this->Page_model->render_page('مدیریت کاربران','panel'.DS.'user', ['x'=>$x]);
	    }else{
	        header('Location :'.base_url().'err'.DS.'no_access');
		    exit();
	    }
    }
	
	public function del($id){
	    if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
    	    if (is_numeric($id) && !empty($id)) {
    	        $inf=$this->User_model->s_u_w_i($id);
    	        if($inf['0']['role'] == 'admin'){
    	            $p='?err=del';
    	        }else{
                    $p=($this->User_model->del($id)?'?success=del':'?err=del');
    	        }
                header('Location :'.base_url().'user'.$p);
                exit();
            } else {
                header('Location : ' . base_url() . 'err' . DS . 'not_found');
                exit();
            }   
	    }else{
	        header('Location :'.base_url().'err'.DS.'no_access');
		    exit();  
	    }
	}
	
	public function edit($id){
	    if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
	        if(is_numeric($id) && !empty($id)){
	            $info=$this->User_model->s_u_w_i($id);
	            $n=['name'=>'name',
                    'class'=>'form-control rounded-5',
                    'id'=>'name',
                    'value'=>(!empty($info['0']['name'])?$info['0']['name']:""),
                    'placeholder'=>'نام',
                    'type'=>'text'];
	            $f=['name'=>'family',
                    'class'=>'form-control rounded-5',
                    'id'=>'family',
                    'value'=>(!empty($info['0']['family'])?$info['0']['family']:''),
                    'placeholder'=>'نام خانوادگی',
                    'type'=>'text'];
	            $c=['name'=>'code',
                    'class'=>'form-control rounded-5',
                    'id'=>'code',
                    'value'=>(!empty($info['0']['code_mely'])?$info['0']['code_mely']:''),
                    'placeholder'=>'کد ملی',
                    'type'=>'text'];
                $p=['name'=>'par',
                    'class'=>'form-control rounded-5',
                    'id'=>'par',
                    'value'=>(!empty($info['0']['parent_name'])?$info['0']['parent_name']:''),
                    'placeholder'=>'نام پدر',
                    'type'=>'text'];
                $b_p=['name'=>'b_p',
                    'class'=>'form-control rounded-5',
                    'id'=>'b_p',
                    'value'=>(!empty($info['0']['birthday_place'])?$info['0']['birthday_place']:''),
                    'placeholder'=>'محل تولد',
                    'type'=>'text'];
                $e=['name'=>'email',
                    'class'=>'form-control rounded-5',
                    'id'=>'email',
                    'value'=>(!empty($info['0']['email'])?$info['0']['email']:''),
                    'placeholder'=>'ایمیل',
                    'type'=>'text'];
                $ph=['name'=>'phone',
                    'class'=>'form-control rounded-5',
                    'id'=>'phone',
                    'value'=>(!empty($info['0']['phone'])?$info['0']['phone']:''),
                    'placeholder'=>'شماره همراه',
                    'type'=>'text'];
                $ad=['name'=>'address',
                    'class'=>'form-control rounded-5',
                    'id'=>'address',
                    'value'=>(!empty($info['0']['address'])?$info['0']['address']:''),
                    'placeholder'=>'آدرس',
                    'type'=>'text'];
                $c_p=['name'=>'c_p',
                    'class'=>'form-control rounded-5',
                    'id'=>'c_p',
                    'value'=>(!empty($info['0']['code_posty'])?$info['0']['code_posty']:''),
                    'placeholder'=>'کد پستی',
                    'type'=>'text'];
	            if($info['0']['role'] != 'admin'){
	                $ro=[
	                    '1'=>'کاربر معمولی',
	                    '2'=>'نویسنده',
	                    '3'=>'آدمین'
	                ];
                    $rol=($info['0']['role'] == 'writer'?'2':'1');
                    $role=form_dropdown("role",$ro,$rol,array('class'=>'rounded-5 SlectBox form-control','id'=>'role'));
	            }else{
	                $role='admin';
	            }
                $br=['name' => 'datepicker1',
                    'class' => 'form-control rounded-5',
                    'id' => 'datepicker1',
                    'value' => (!empty($info['0']['birthday']) ? set_value('datepicker1', date('Y-m-d', strtotime($info['0']['birthday']))) : set_value('datepicker1')),
                    'placeholder' => 'مدت زمان',
                    'type' => 'text'];
            
                $pic=$info['0']['pic'];
	            $data=['n'=>$n,'f'=>$f,'c'=>$c,'p'=>$p,'b_p'=>$b_p,'e'=>$e,'ph'=>$ph,'ad'=>$ad,'c_p'=>$c_p,'role'=>$role,'br'=>$br,'pic'=>$pic,'id'=>$id,'ot'=>''];
	            echo $this->Page_model->render_page('ویرایش حساب کاربران','panel'.DS.'user_edit',$data);
	        }else{
	            header('Location :'.base_url().'err'.DS.'not_found');
		        exit();     
	        }
	    }else{
	        header('Location :'.base_url().'err'.DS.'no_access');
		    exit();
	    }
	}
	
	public function edit_me(){
	    if(isset($_SESSION['id']) || $_SESSION['role'] == 'user_reg'){
	        $info=(isset($_SESSION['id'])?$this->User_model->s_u_w_i($_SESSION['id']):$this->User_model->s_u_w_c($_SESSION['code_mely']));
	        $_SESSION['id']=$info['0']['id'];
	        $n=['name'=>'name',
                'class'=>'form-control rounded-5',
                'id'=>'name',
                'value'=>(!empty($info['0']['name'])?$info['0']['name']:""),
                'placeholder'=>'نام',
                'type'=>'text'];
	        $f=['name'=>'family',
                'class'=>'form-control rounded-5',
                'id'=>'family',
                'value'=>(!empty($info['0']['family'])?$info['0']['family']:''),
                'placeholder'=>'نام خانوادگی',
                'type'=>'text'];
	        $c=['name'=>'code',
                'class'=>'form-control rounded-5',
                'id'=>'code',
                'value'=>(!empty($info['0']['code_mely'])?$info['0']['code_mely']:''),
                'placeholder'=>'کد ملی',
                'type'=>'text'];
            $p=['name'=>'par',
                'class'=>'form-control rounded-5',
                'id'=>'par',
                'value'=>(!empty($info['0']['parent_name'])?$info['0']['parent_name']:''),
                'placeholder'=>'نام پدر',
                'type'=>'text'];
            $b_p=['name'=>'b_p',
                'class'=>'form-control rounded-5',
                'id'=>'b_p',
                'value'=>(!empty($info['0']['birthday_place'])?$info['0']['birthday_place']:''),
                'placeholder'=>'محل تولد',
                'type'=>'text'];
            $e=['name'=>'email',
                'class'=>'form-control rounded-5',
                'id'=>'email',
                'value'=>(!empty($info['0']['email'])?$info['0']['email']:''),
                'placeholder'=>'ایمیل',
                'type'=>'text'];
            $ph=['name'=>'phone',
                'class'=>'form-control rounded-5',
                'id'=>'phone',
                'value'=>(!empty($info['0']['phone'])?$info['0']['phone']:''),
                'placeholder'=>'شماره همراه',
                'type'=>'text'];
            $ad=['name'=>'address',
                'class'=>'form-control rounded-5',
                'id'=>'address',
                'value'=>(!empty($info['0']['address'])?$info['0']['address']:''),
                'placeholder'=>'آدرس',
                'type'=>'text'];
            $c_p=['name'=>'c_p',
                'class'=>'form-control rounded-5',
                'id'=>'c_p',
                'value'=>(!empty($info['0']['code_posty'])?$info['0']['code_posty']:''),
                'placeholder'=>'آدرس',
                'type'=>'text'];
            $br=['name' => 'datepicker1',
                'class' => 'form-control rounded-5',
                'id' => 'datepicker1',
                'value' => (!empty($info['0']['birthday']) ? set_value('datepicker1', date('Y-m-d', strtotime($info['0']['birthday']))) : set_value('datepicker1')),
                'placeholder' => 'مدت زمان',
                'type' => 'text'];
            $pic=$info['0']['pic'];
            $id=(isset($_SESSION['id']) ? $_SESSION['id']: $info['0']['id'] );
	        $data=['n'=>$n,'f'=>$f,'c'=>$c,'p'=>$p,'b_p'=>$b_p,'e'=>$e,'ph'=>$ph,'ad'=>$ad,'c_p'=>$c_p,'br'=>$br,'pic'=>$pic,'role'=>'admin','id'=>$id,'ot'=>'ot'];
	        echo $this->Page_model->render_page('ویرایش حساب کاربری من','panel'.DS.'user_edit',$data);
	    }else{
	        header('Location :'.base_url().'err'.DS.'no_access');
		    exit();
	    }
	}
	
	public function check_edit(){
	    if(!empty($_POST['send']) && $_POST['send'] == 'send'){
	        if(!empty($_POST['n']) && !empty($_POST['f']) && !empty($_POST['c']) && !empty($_POST['p']) && !empty($_POST['bp']) && !empty($_POST['ph']) && !empty($_POST['a']) && !empty($_POST['dp']) &&!empty($_POST['id'])){
	            if($_POST['role'] != '0'){
    	            $data=[
    	                'name'=>$this->check_xss($_POST['n']),
    	                'family'=>$this->check_xss($_POST['f']),
    	                'code_mely'=>$this->check_xss($_POST['c']),
    	                'parent_name'=>$this->check_xss($_POST['p']),
    	                'birthday_place'=>$this->check_xss($_POST['bp']),
    	                'phone'=>$this->check_xss($_POST['ph']),
    	                'address'=>$this->check_xss($_POST['a']),
    	                'birthday'=>$this->check_xss($_POST['dp']),
    	                'email'=>$this->check_xss($_POST['e']),
    	                'code_posty'=>$this->check_xss($_POST['cp']),
    	                'pic'=>$this->check_xss($_POST['pi']),
    	                'role'=>$this->check_xss($_POST['role'])
    	            ];
	            }else{
	                $data=[
    	                'name'=>$this->check_xss($_POST['n']),
    	                'family'=>$this->check_xss($_POST['f']),
    	                'code_mely'=>$this->check_xss($_POST['c']),
    	                'parent_name'=>$this->check_xss($_POST['p']),
    	                'birthday_place'=>$this->check_xss($_POST['bp']),
    	                'phone'=>$this->check_xss($_POST['ph']),
    	                'address'=>$this->check_xss($_POST['a']),
    	                'birthday'=>$this->check_xss($_POST['dp']),
    	                'email'=>$this->check_xss($_POST['e']),
    	                'code_posty'=>$this->check_xss($_POST['cp']),
    	                'pic'=>$this->check_xss($_POST['pi'])
    	            ];
	            }
	            $id=intval($_POST['id']);
	            echo ($this->User_model->edit($data,$id)?1:0);
	            die();
	        }
	   }
       header('Location :'.base_url().'err'.DS.'not_found');
       exit();
	}
	
	public function change_password(){
	    if(isset($_SESSION['active']) && $_SESSION['active'] == 1){
	        $username=['name'=>'username',
                'class'=>'form-control rounded-5',
                'id'=>'username',
                'value'=>set_value('username'),
                'placeholder'=>'نام کاربری',
                'type'=>'text'];
	        $pass=['name'=>'pass',
                'class'=>'form-control rounded-5',
                'id'=>'pass',
                'value'=>set_value('pass'),
                'placeholder'=>'رمز عبور',
                'type'=>'text'];
	        $password=['name'=>'password',
                'class'=>'form-control rounded-5',
                'id'=>'password',
                'value'=>set_value('password'),
                'placeholder'=>'تکرار رمز عبور',
                'type'=>'text'];
            $data=['username'=>$username,'pass'=>$pass,'password'=>$password];
	        echo $this->Page_model->render_page('تغییر نام و رمز کاربری ','panel'.DS.'edit_pass',$data);
	    }else{
	        header('Location :'.base_url().'err'.DS.'no_access');
		    exit();
	    }
	}
	
	public function check_change_pass(){
	    if(isset($_SESSION['active']) && $_SESSION['active'] == 1){
	        if(!empty($_POST['send']) && $_POST['send'] == 'send'){
	            if(!empty($_POST['pss']) && !empty($_POST['usr'])){
	                $info=$this->User_model->s_u_w_c($_SESSION['code_mely']);
	                $id=(isset($_SESSION['id'])?$_SESSION['id']:$info['0']['id']);
	                $data=['username'=>md5($_POST['usr']),'password'=>md5($_POST['pss'])];
	                echo ($this->User_model->edit($data,$id)?1:0);
	                die();
	            }
	        }
	        header('Location :'.base_url().'err'.DS.'not_found');
		    exit();
	    }else{
	        header('Location :'.base_url().'err'.DS.'no_access');
		    exit();
	    }
	}
	
	public function check_xss($text = ""){
        return empty($text) ? '' : addslashes($text);
    }
	
}