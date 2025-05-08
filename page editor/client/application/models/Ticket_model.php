<?php
class Ticket_model extends CI_Model
{
	public function __construct(){
		parent::__construct();
	}
	
	public function s_t_a(){
	    return $this->db->query("SELECT * FROM chat_tickets")->result_array();
	}
	
	public function stwssi ($id , $id2){
	    if(!empty($id) && is_numeric($id) && !empty($id2) && is_numeric($id2)){
	        $sql="SELECT * FROM `chat_tickets` WHERE (`status`=1 AND `receive_id`=".$id." AND `sender_id`=".$id2.") OR (`status`=1 AND `sender_id`=".$id." AND `receive_id`=".$id2.") ORDER BY `chat_tickets`.`ticket_date` ASC";
	        return $this->db->query($sql)->result_array();
	    }
	    return false;
	}
	
	public function s_t_w_s(){
	    return (isset($_SESSION['id'])?$this->db->get_where("chat_tickets",['receive_id'=>$_SESSION['id'],'status'=>1])->result_array():'');
	}
	
	public function add($data){
	    return (!empty($data) && is_array($data)?$this->db->insert('chat_tickets',$data):false);
	}
	
	public function tic ($id , $url){
	    if(!empty($id) && is_numeric($id) && !empty($url)){
	        $sql="SELECT * FROM `ticket` WHERE (`status`=1 AND `send_me`=1 AND `site_user_id`=".$id." AND `url`=".$url.") OR (`status`=1 AND `send_me`=0 AND `site_user_id`=".$id." AND `url`=".$url.") ORDER BY `ticket`.`time` ASC";
	        return $this->db->query($sql)->result_array();
	    }
	    return false;
	}
	
	public function add_ticket($data){
	    return (!empty($data) && is_array($data)?$this->db->insert('ticket',$data):false);
	}
	
	public function select_data($data){
	    return (!empty($data) && is_array($data)?$this->db->get_where('ticket',$data)->result_array():false);
	}
	
	public function dis_ticket_send($data){
	    return (!empty($data) && is_array($data)?$this->db->update('ticket',['status'=>0],$data):false);
	}
	
	public function edit_ticket($data,$id){
        return (is_numeric($id)&&!empty($data)&&!empty($id)?$this->db->update('ticket',$data,['id'=>$id]):false);
    }

	public function edit($data,$id){
        return (is_numeric($id)&&!empty($data)&&!empty($id)&&is_array($data)?$this->db->update('chat_tickets',$data,['id'=>$id]):false);
    }
    
    public function del($id){
        return (is_numeric($id)&&!empty($id)?$this->db->delete('chat_tickets',['id'=>$id]):false);
    }

    public function dis($id){
        return (is_numeric($id) && !empty($id)?$this->edit(['status'=>0],$id):false);
    }

    public function disable($id){
         return (is_numeric($id) && !empty($id)?$this->db->update('chat_tickets',['status'=>0],['id'=>$id]):false);
    }

    public function en($id){
        return (is_numeric($id) && !empty($id)?$this->edit(['status'=>1],$id):false);
    }
    
    public function ticket_html(){
        $a=$this->s_t_w_s();
        $d='';
        $num=0;
        if(!empty($a)){
		    foreach($a as $c){					    
		    	$d.='<a href="#" class="p-3 d-flex border-bottom"><div class="drop-img  cover-image" data-image-src="'.base_url().'assets/img/faces/'.(!empty($c['sender_pic'])?$c['sender_pic']:'1.png').'"><span class="avatar-status bg-teal"></span></div><div class="wd-90p"><div class="d-flex"><h5 class="mb-1 name">'.(!empty($c['sender_name'])?$c['sender_name']:'-').'</h5></div><p class="mb-0 desc">'.(!empty($c['ticket_title'])?$c['ticket_title']:'-').'</p><p class="time mb-0 text-left float-right mr-2 mt-2">'.$c['ticket_date'].'</p></div></a>';
	    		$num++;
    		}
        }
        $b=(!empty($a)?'<span class=" pulse-danger"></span></a><div class="dropdown-menu" style="margin-left: -15px;margin-top: 5px;"><div class="menu-header-content bg-primary text-right"><div class="d-flex"><h6 class="dropdown-title mb-1 tx-15 text-white font-weight-semibold">پیام ها</h6><span class="badge badge-pill badge-warning mr-auto my-auto float-left">علامت گذاری همه</span></div><p class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 "> شما '.$num.' پیام خوانده نشده دارید</p></div><div class="main-message-list chat-scroll" style="overflow-y:auto;">':'</a>');
		if(!empty($a)){
		    $b.=$d;
		}
		if(!empty($a)){
		    $b.='</div><div class="text-center dropdown-footer"><a href="'.base_url().'ticket'.'">مشاهده همه</a></div></div>';
		}
	    return $b;	    
	}
}