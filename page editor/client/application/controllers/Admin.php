<?php
class Admin extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
public function index(){
    if($this->session->userdata('role')==="admin"){
        redirect("admin".DS."admin");
    }elseif($this->session->userdata('role')==="user"){
        redirect("admin".DS.'user');
    }elseif($this->session->userdata('role')==="user_reg"){
        redirect('admin'.DS.'user_reg');
    }else{
        redirect('auth');
    }
}
	public function admin()
	{
		$role = $this->session->userdata('role') === 'admin' ? 'admin' : 'user';
		$name = $this->session->userdata('name') ?: 'مهمان';
		$pic = $this->session->userdata('pic') ?: '1.png';
		$head = array('favicon' => 'logo1.png',
			'description' => 'description',
			'keyword' => 'keywords',
			'page_title' => 'داشبورد');
		$url=base_url().'auth'.DS.'logout';
		$top_menu_one = array(
			'rule_users' => $role,
			'username' => $name,
			'profilePicture' => $pic,
			'exitS' => $url,
			'timeNews' => 'friday',
			'icon1' => 'logo1.png',
			'icon2' => 'logo1.png',
			'icon3' => 'logo1.png',
			'icon4' => 'logo1.png',
			'icon1Des' => '',
			'icon2Des' => '',
			'icon3Des' => '',
			'icon4Des' => '',
			'editProfile' => '#',
			'country' => array(),
			'news' => array(),
			'message' => array()
		);
		$left_menu = array('timeNews' => '30 دقیقه پیش',
			'titleNews' => 'new',
//			'titleNews'=>'saw',
			'contentNews' => 'hi ',
			'userPicTicket' => '12.jpg',
			'usernameTicket' => 'ali',
			'contentTicket' => 'hi',
			'timeTicket' => 'saturday',
			'userPic' => '9.jpg',
			'username' => 'ali',
			'ruleUser' => 'admin',
			'ticketAddress' => '',
			'ticketId' => '');
			
		$right_menu = array(
			'rule_users' => $role,
			'username' => $name,
			'give_right_menu' => array(),
			'profilePicture' => $pic,
			'logoL1' => 'logo1.png',
			'logoD1' => 'logo1.png',
			'logoL2' => 'logo1.png',
			'logoD2' => 'logo1.png',
			'logoL1Des' => '',
			'logoD1Des' => '',
			'logoL2Des' => '',
			'logoD2Des' => ''

		);
		$news=$this->News->get_news();
		$content = array('news' => $news);

		$modal = array(
			'photo_chat' => '6.jpg',
			'photo' => $pic,
			'sender_name' => 'دنیل اسکات',
			'is_online' => 'آنلاین'
		);

		$foot = array('footer' => "<span>پرتال ساز پردازش هوشمند علاءالدین _ پشتیبانی: 02644909</span>");
		$a = $this->load->view('panel/header.php', $head, true);
		$a .= $this->load->view('panel/loader.php', array(), true);
        //  $a .= $this->load->view('panel/setupMenu.php', array(), true);

        //  $a.= $this->Menu->fetch_for_menu('right','rightMenu.php',$right_menu);
        
		$a .= $this->load->view('panel/topNavMenuOne.php', $top_menu_one, true);
	
        $a.= $this->Menu->fetch_for_menu('top','topNavMenuTwo.php');
	
        //  $a.= $this->Menu->fetch_for_menu('left','leftMenu.php',$left_menu);
        
		$a .= $this->load->view('panel/content.php', $content, true);
		
		$a .= $this->load->view('panel/modals.php', $modal, true);
		
		$a.= $this->Menu->fetch_for_menu('footer','footer.php',$foot);
		
		
		echo $a;
	}
	
	
// 	public function news(){
// 	    if(isset($_POST['news'])){
//             $news_paper='<ol>';
//             $newss=$this->News->get_news();
            
//             foreach($newss as $val){
//                 $news_paper.='<li>';
//                 if(!empty($val['title'])){
//                   $news_paper.="<h5>";
//                   $news_paper.=$val['title'];
//                   $news_paper.="</h5>"; 
//                 }
//                 if(!empty($val['content'])){
//                     $news_paper.=$val['content'];
//                 }
//                 $news_paper.='</li>';
//             }
//             $news_paper.='</ol>';
//             echo $news_paper;
//         }
// 	}

    public function user(){
        
      
    }
    public function user_reg(){
        
    }
}