<?php
class Ticket extends MY_Controller
{
	public function __construct(){
		parent::__construct();
	}
	
	public function ins(){
	    $send=(!empty($_POST['send']) && $_POST['send'] == 'ok'?$_POST['send']:null);
	    if(!is_null($send)){
    	    $ins=(!empty($_POST['ins'])?$_POST['ins']:null);
    	    $url=(!empty($_POST['dom'])?$_POST['dom']:null);
    	    $title=(!empty($_POST['title'])?$_POST['title']:null);
    	    $content=(!empty($_POST['content'])?$_POST['content']:null);
    	    $values=(!empty($_POST['values'])?$_POST['values']:null);
    	    if(!is_null($content) && !is_null($title) && !is_null($values)){
    	        $a=[
    	            'url'=>$url ,
    	            'title'=>$title ,
    	            'content'=>$content ,
    	            'site_user_id'=> $values
    	        ];
    	        $get=$this->Ticket_model->select_data($a);
    	        if(!empty($get)){
    	            $data=['site_ticket_id'=>$ins];
    	            echo ($this->Ticket_model->edit_ticket($data,$get['0']['id'])?1:0);
    	            die();
    	        }
    	        echo 0;
    	        die();
    	    }
    	    echo 0;
    	    die();
	    }else{
	        
	    }
	}
	
	public function index(){
        if(isset($_SESSION['active']) && $_SESSION['active'] == '1'){
    	    $y=$this->Ticket_model->s_t_w_s();
    	    $x=$this->User_model->s_u_a();
    	    $z=$this->Site_user_model->s_all();
    	    echo $this->Page_model->render_page('پیام ها','panel'.DS.'ticket',['sites'=>$z,'users'=>$x,'tickets'=>$y]);
	    }else{
            header('Location :'.base_url().'err'.DS.'no_access');
            exit();
        }
	}
	
	public function send($id){
	    if(!empty($id) && is_numeric($id)){
	        $user_info=$this->User_model->s_u_w_i($id);
	        $pic=(!empty($user_info['0']['pic'])?$user_info['0']['pic']:'1.png');
    	    $name=(!empty($user_info['0']['name']) && !empty($user_info['0']['family'])?$user_info['0']['name'].' '.$user_info['0']['family']:(!empty($user_info['0']['family']) && empty($user_info['0']['name'])?$user_info['0']['family']:(empty($user_info['0']['family'] && !empty($user_info['0']['name'])?$user_info['0']['name'] :'کاربر')) ));
	        $a=$this->ticket_hmtl($id);
    	    $x =[
    			'name' => 'chatContent',
	    		'id' => 'chatContent',
			    'value' => '',
		    	'class' => 'formGroup form-control',
			    'placeholder' => 'متن پیام'
		    ];
    	    $data=['pic'=>$pic,'name'=>$name,'c'=>$a,'data'=>$x,'id'=>$id];
    	    echo $this->Page_model->render_page('ارسال پیام','panel'.DS.'send_ticket',$data);
	    }else{
            header('Location :'.base_url().'err'.DS.'no_access');
            exit();
        }
	}
	
	public function check_send(){
	    if(isset($_SESSION['active']) && isset($_SESSION['role'])){
			if(!empty($_POST['send']) && $_POST['send'] == 'send'){
				if(!empty($_POST['res_id'])){
					if(!empty($_POST['content'])){
					    if(isset($_SESSION['id'])){
					        $id=intval($_SESSION['id']);
					    }else{
					        $inf=$this->User_model->s_u_w_c($_SESSION['code_mely']);
					        $id=intval($inf['0']['id']);
					    }
					   
						$data=[
						    'sender_name'=>(!empty($_SESSION['name'])?$_SESSION['name']:'کاربر'),
						    'sender_pic'=>(isset($_SESSION['pic'])?$_SESSION['pic']:'1.png'),
						    'role'=>$_SESSION['role'],
						    'sender_id'=>$id,
						    'receive_id'=>$_POST['res_id'],
						    'ticket_content'=>$this->check_xss($_POST['content'])
					    ];
						echo ($this->Ticket_model->add($data)?$this->ticket_hmtl($_POST['res_id']):'0');
						die();
					}
				}
			}
			header('Location :'.base_url().'err'.DS.'not_found');
		exit();
		}
		header('Location :'.base_url().'err'.DS.'no_access');
		exit();
	}
	
	public function del_server(){
	    if(!empty($_POST['send']) && $_POST['send'] == 'ok'){
			if(!empty($_POST['id'])){
				$i=intval($_POST['id']);
				$c=$this->Ticket_model->select_data(['id'=>$i]);
				$a=(!empty($c)?$this->Ticket_model->dis_ticket_send(['id'=>$i]):false);
			    echo ($a?$c['0']['site_ticket_id']:0);
				die();
			}else{
				header('Location :'.base_url().'err'.DS.'not_found');
				exit();
			}
		}else{
			header('Location :'.base_url().'err'.DS.'not_found');
			exit();
		}
	}
	
	public function del(){
	    if(!empty($_POST['send']) && $_POST['send'] == 'send'){
			if(!empty($_POST['id']) && !empty($_POST['res_id'])){
				$i=intval($_POST['id']);
				$a=$this->Ticket_model->disable($i);
				if($a){
				    $res=$this->ticket_hmtl(intval($_POST['res_id']));
				    echo $res;
				    die();
				}
			
				// echo ($this->Ticket_model->dis($i)?$this->ticket_hmtl(intval($_POST['res_id'])):0);
				die();
			}else{
				header('Location :'.base_url().'err'.DS.'not_found');
				exit();
			}
		}else{
			header('Location :'.base_url().'err'.DS.'not_found');
			exit();
		}
	}
	
	public function ticket_hmtl($id){
	    if(isset($_SESSION['code_mely']) || isset($_SESSION['id'])){
		$inf=(isset($_SESSION['code_mely'])?$this->User_model->s_u_w_c($_SESSION['code_mely']):$this->User_model->s_u_w_i(intval($_SESSION['id'])));
	    $id2=(isset($_SESSION['id'])?intval($_SESSION['id']):intval($inf['0']['id']));
	    $user_info=$this->User_model->s_u_w_i($id);
	    $info=$this->Ticket_model->stwssi(intval($id),$id2);
    	$pic=(!empty($user_info['0']['pic'])?$user_info['0']['pic']:'1.png');
    	$name=( !empty($user_info['0']['name']) && !empty($user_info['0']['family']) ? $user_info['0']['name'].' '.$user_info['0']['family'] : ( !empty($user_info['0']['family']) && empty($user_info['0']['name']) ? $user_info['0']['family'] : ( empty($user_info['0']['family']) && !empty($user_info['0']['name']) ? $user_info['0']['name'] :'کاربر' ) ) );
    	$a='';
    	if(!empty($info)){
    	    foreach($info as $b){
    	        if ($b['receive_id'] != $id2) {
		            $a.='<div class="media flex-row-reverse"><div class="main-img-user"><img alt="" src="'.base_url().'assets/img/faces/'.(!empty($inf['0']['pic'])?$inf['0']['pic']:'1.png').'"></div><div class="media-body"><div class="main-msg-wrapper right">'.$b['ticket_content'].'</div><div><a class="nav-link del-t" data-toggle="tooltip" href="#" title="زباله ها"><i class="icon ion-md-trash"></i> <input type="hidden" value="'.$b['id'].'"></a> <span>'.$b['ticket_date'].'</span></div></div></div>';
    	        } else {
				    $a.='<div class="media"><div class="main-img-user"><img alt="" src="'.base_url().'assets/img/faces/'.$pic.'"></div><div class="media-body"><div class="main-msg-wrapper left">'.$b['ticket_content'].'</div><div><a class="nav-link del-t" data-toggle="tooltip" href="#" title="زباله ها"> <input type="hidden" value="'.$b['id'].'"><i class="icon ion-md-trash"></i></a> <span>'.$b['ticket_date'].'</span></div></div></div>';
			    }
    	    }
        }
    	return $a;
	    }
	    return false;
	}
	
	public function send_server($id){
	    if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
	        $z=$this->Site_user_model->ssuwArr(['id'=>intval($id)]);
	        if(!empty($z)){
	            $inf=$this->Ticket_model->select_data(['url'=>$z['0']['url'],'send_me'=>1,'status'=>1]);
            	$data=['info'=>$inf,'pic'=>'1.png'];
        	    echo $this->Page_model->render_page('ارسال پیام به سرور','panel'.DS.'send_ticket_server',$data);
	        }
	    }else{
	        header('Location :'.base_url().'err'.DS.'no_access');
		    exit();
	    }
	}
	
	public function ticket_html_site($id){
	    if(!empty($id) && is_numeric($id)){
	        if(!empty($_SESSION['role']) && $_SESSION['role'] == 'admin'){
	            $info=$this->Ticket_model->select_data(['id'=>$id]);
	            if(!empty($info)){
	               // $tickets=$this->Ticket_model->tic($info['0']['site_user_id'],$info['0']['url']);
	               $tickets=$this->Ticket_model->select_data(['url'=>$info['0']['url'],'site_user_id'=>$info['0']['site_user_id'],'status'=>1]);
	                $a='';
                	if(!empty($tickets)){
                	    $a.='<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script><script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
    	        
                	    foreach($tickets as $b){
                	        if ($b['send_me'] == '0') {
            				    $a.='<div class="media"><div class="main-img-user"><img alt="" src="'.base_url().'assets/img/faces/'.(!empty($_SESSION['pic'])?$_SESSION['pic']:'1.png').'"></div>
            				    <h3 style="margin:7px 20px 7px 0px;">'.(!empty($b['title'])?$b['title']:'').'</h3>
            				    <div class="media-body">
            				    <div class="main-msg-wrapper left">'.$b['content'].'</div><div><a class="nav-link del-t" data-toggle="tooltip" href="#" title="زباله ها"> 
            				    <input type="hidden" value="'.$b['id'].'"><i class="icon ion-md-trash"></i></a> <span>'.date('y/m/d',strtotime($b['time'])).'</span></div></div></div>';
                	        } elseif($b['send_me'] == '1') {
            		            $a.='<div class="media flex-row-reverse"><div class="main-img-user"><img alt="" src="'.base_url().'assets/img/faces/1.png"></div>
            		            <h3 style="margin:7px 0px 7px 20px;">'.(!empty($b['title'])?$b['title']:'').'</h3>
            		            <div class="media-body"><div class="main-msg-wrapper right">'.$b['content'].'</div><div><a class="nav-link del-t" data-toggle="tooltip" href="#" title="زباله ها"><i class="icon ion-md-trash"></i>
            		            <input type="hidden" value="'.$b['id'].'"></a> <span>'.date('Y/m/d',strtotime($b['time'])).'</span></div></div></div>';
            			    }else{
            			        $a.='';
            			    }
                	    }
                	    $a.="<script>
                            $(document).ready(function (){
                                $('.del-t').click(function (){
                                    let id=$(this).children('input').val();
                                    let send='ok';
                                    $.ajax({
                                        method:'post',
                                        url:'". base_url()."ticket/del_server',
                                        data:{send:send,id:id},
                                        success:function (values){
                                            if(values == 0){
                                                swal({
                                                    title: '',
                                                    text:'خطا',
                                                    icon: 'error',
                                                    button: 'متوجه شدم'
                                                }).then(function(){
                                                    window.location.reload(); 
                                                });
                                            }else{
                            	                let xa ='asad';
                            	                let type='delTicket';
                                                $.ajax({
                                                    method:'post',
                                                    url:'".$info['0']['url']."err/n_f',
                                                    data:{send:send,xa:xa,type:type,values:values},
                                                    success:function (x){
                                                        if(x == 0){
                                                            swal({
                                                                title: '',
                                                                text: 'اشکال از سرور',
                                                                icon: 'error',
                                                                button: 'متوجه شدم'
                                                            }).then(function(){
                                                                window.location.reload();
                                                            });
                                                        }else{
                                                            window.location.reload();
                                                        }
                                                    },errors:function(){
                                                        swal({
                                                            title: '',
                                                            text: 'اشکال در اتصال به سرور',
                                                            icon: 'error',
                                                            button: 'متوجه شدم'
                                                        }).then(function(){
                                                            window.location.reload();
                                                        });
                                                    }
                                                });
                                            }    
                                        }
                                    });
                                })
                            })
                        </script>";
                    }
                	return $a;
	            }
	            return false;
	        }else{
	       	    header('Location :'.base_url().'err'.DS.'no_access');
		        exit();
	        }
	    }else{
    	    header('Location :'.base_url().'err'.DS.'not_found');
    	    exit(); 
	    }
	}
	
	public function send_site($id){
	    if(!empty($id) && is_numeric($id)){
	        $inf=$this->Ticket_model->select_data(['id'=>$id]);
	        if(!empty($inf)){
	            $name=(!empty($inf['0']['name'])?$inf['0']['name']:'آدمین '.$inf['0']['url']);
	            $x=[
        	        'name' => 'title',
        	    	'id' => 'title',
        			'value' => '',
        		    'class' => 'formGroup form-control pd-x-5',
        			'placeholder' => 'عنوان پیام'
        	    ];
            	$y =[
            		'name' => 'chatContent',
        	    	'id' => 'chatContent',
        			'value' => '',
        		    'class' => 'formGroup form-control',
        			'placeholder' => 'متن پیام'
        	    ];
        	    $con=$this->ticket_html_site($id);
        	    $data=['url'=>$inf['0']['url'],'id'=>$id,'name'=>$name,'data'=>$y,'data1'=>$x,'c'=>$con];
        	    echo $this->Page_model->render_page('ارسال پیام به سرور','panel'.DS.'send_ticket_site',$data);
	        }
	        header('Location :'.base_url().'ticket');
	        exit();
	    }
	    header('Location :'.base_url().'err'.'not_found');
	    exit();
	}
	
	public function check_send_server(){
	    if(!empty($_POST['send']) && $_POST['send'] == 'ok'){
	        if(!empty($_SESSION['role']) && $_SESSION['role'] == 'admin'){
    	        if(!empty($_SESSION['id'])){
    	           if(!empty($_POST['title']) && !empty($_POST['content'])){
    	               $site_info=$this->Ticket_model->select_data(['id'=>intval($_POST['id'])]);
    	               if(!empty($site_info)){
        	               $data=[
        	                    'url'=>$site_info['0']['url'],
        	                    'title'=>$this->check_xss($_POST['title']),
        	                    'content'=>$this->check_xss($_POST['content']),
        	                    'site_user_id'=>$site_info['0']['site_user_id'],
        	                    'site_ticket_id'=>$site_info['0']['site_ticket_id'],
        	                    'name'=>$site_info['0']['name'],
        	               ];
        	               $a=$this->Ticket_model->add_ticket($data);
        	               if($a){
        	                   $b=$this->Ticket_model->select_data($data);
        	                   if(!empty($b)){
        	                       echo $b['0']['site_user_id'];
        	                       die();
        	                   }
        	                   echo 0;
        	                   die();
        	               }
    	                    echo 0;
    	                    die();
    	               }
    	               echo 0;
    	               die();
    	           } 
    	           echo 0;
    	           die();
    	        }
    	        echo 0;
    	        die();
	        }
	        header('Location :'.base_url().'err'.DS.'no_access');
		    exit();
	    }
	    header('Location :'.base_url().'err'.DS.'not_found');
	    exit();
	}
	
	public function check_xss($text = ""){
        return empty($text) ? '' : addslashes($text);
    }
	
}