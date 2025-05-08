<?php

class Page_model extends CI_Model
{
	public function __construct(){
		parent::__construct();
	}

    public function s_menus_w_si_p($side_id='',$place='',$p_id=0,$customOne='',$endCustomOne='')
    {
        if(!empty($side_id)&&!empty($place)){
            $x= $this->select_where('menu',array('status'=>1,'place'=>$place,'parent_id'=>$p_id,'side_id'=>$side_id));
            if(!empty($x)){
            
                if(!empty($customOne) && !empty($endCustomOne)){
                    $ve=$customOne;
                    $end=$endCustomOne;
                }else{
                    //ui add menu need to check up
                    if(isset($_SESSION['dadash']) && $_SESSION['dadash']=='top'){
                        $ve='';
                        $end='';
                    }else{
                        if($place == 'top'){
                            $ve='<div class="horizontal-main hor-menu clearfix side-header" style="';
                            if(isset($_SESSION['active']) && $_SESSION['active'] == 1 && $_SESSION['role'] == 'admin'){
                                $ve.='position: absolute;top: 59px;height: 63px;line-height: 35px;width: 100%;background-color: #77e3c51f;';
                            }else{
                                $ve.='position: absolute;top: -0.1%;height: 63px;line-height: 35px;width: 100%;background-color: #77e3c51f;';
                            }
                            $ve.='"><div class="horizontal-mainwrapper container clearfix"><nav class="horizontalMenu clearfix"><div class="horizontal-overlapbg"></div><ul class="horizontalMenu-list">';
                            $end='</ul></nav></div></div>'; 
                            $_SESSION['dadash']='top';
                        }
                    }
                    
                    if(isset($_SESSION['dadash']) && $_SESSION['dadash']=='right'){
                        $ve='';
                        $end='';
                    }else{
                        if($place == 'right'){
                            $ve='<aside class="app-sidebar sidebar-scroll" style="top: 62px;right: -1px;z-index: 0;background-color: #e5e5c76b;">
                            <div class="main-sidebar-header active" style="background-color: #ffffff00;"></div>
                            <div class="main-sidemenu">
                                <div class="app-sidebar__user clearfix" style="margin-top:50px">
                    				<div class="dropdown user-pro-body">
                    					<div class="">
                    						<img alt="user-img" class="avatar avatar-xl brround" src="assets/img/faces/'.(!empty($_SESSION['pic'])?$_SESSION['pic']:'1.png').'">
                    					</div>
                    					<div class="user-info">
                    						<h4 class="font-weight-semibold mt-3 mb-0">'.(!empty($_SESSION['name'])?$_SESSION['name']:( !empty($_SESSION['family'])?$_SESSION['family']:'کاربر بدون هویت' )).'</h4>
                    						<span class="mb-0 text-muted">'.(!empty($_SESSION['role'])?$_SESSION['role']:'کاربر').'</span>
                    					</div>
                    				</div>
                    			</div>
            			        <ul class="side-menu">';
                            //li.slide  ul.slide-menu
                            $end='</ul></div></aside>';
                            $_SESSION['dadash']='right';
                        }
                    }
                    
                    if(isset($_SESSION['dadash']) && $_SESSION['dadash']=='left'){
                        $ve='';
                        $end='';
                    }else{
                        if($place == 'left'){
                            $ve='<div id="wrapper" style="margin-top:-13px;" class="marginSide">
                                    <div id="sidebar-wrapper" style="z-index: 0;box-shadow: 0 5px 10px rgb(197 182 189 / 15%);background-color: #cbcfc25c;">
                                        <div class="text-center" style="margin-top: 145px;">
                            				<div>
                            					<div class="text-center">
                            						<img alt="user-img" style="width: 28%;border-radius: 50px;" src="assets/img/faces/'.(!empty($_SESSION['pic'])?$_SESSION['pic']:'1.png').'">
                            					</div>
                            					<div class="user-info">
                            						<h4 class="font-weight-semibold mt-3 mb-0"style="font-size: 15px;">'.(!empty($_SESSION['name'])?$_SESSION['name']:( !empty($_SESSION['family'])?$_SESSION['family']:'کاربر بدون هویت' )).'</h4>
                            						<span class="mb-0">'.(!empty($_SESSION['role'])?$_SESSION['role']:'کاربر').'</span>
                            					</div>
                            				</div>
                            			</div>
                                        <ul class="sidebar-nav nav-pills nav-stacked" id="leftSlider" style="margin-top: 285px;">';
                            $end='</ul></div>
                            <script>
                                $("#leftSlider-toggle").click(function (e) {
                                    e.preventDefault();
                                    $("#wrapper").toggleClass("toggled");
                                });
                                $("#leftSlider-toggle-2").click(function (e) {
                                    e.preventDefault();
                                    $("#wrapper").toggleClass("toggled-2");
                                    $("#leftSlider ul").hide();
                                });
                            
                                function initleftSlider() {
                                    $("#leftSlider ul").hide();
                                    $("#leftSlider ul").children(".current").parent().show();
                                    //$("#leftSlider ul:first").show();
                                    $("#leftSlider li a").click(
                                        function () {
                                            let checkElement = $(this).next();
                                            if ((checkElement.is("ul")) && (checkElement.is(":visible"))) {
                                                return false;
                                            }
                                            if ((checkElement.is("ul")) && (!checkElement.is(":visible"))) {
                                                $("#leftSlider ul:visible").slideUp("normal");
                                                checkElement.slideDown("normal");
                                                return false;
                                            }
                                        }
                                    );
                                }
                            
                                $(document).ready(function () {
                                    initleftSlider();
                                });
                            </script>';
                            $_SESSION['dadash']='left';
                        }
                    }
                    
                    if(isset($_SESSION['dadash']) && $_SESSION['dadash']=='foot'){
                        $ve='';
                        $end='';
                    }else{
                        if($place == 'foot'){
                            $ve='<section id="footer" style="left:0;right:0;padding-top: 25px;padding-bottom: 25px;background-color: #eaeaed;position: absolute;    bottom: 0;
    top: 81%;width: 100%;min-height: 500px;"><div class="container-fluid" style="margin-top: 20px;"><div class="row text-center text-xs-center text-sm-left text-md-left">
                            <div class="col-xs-6 col-sm-6 col-md-6 text-center" style="height:190px;"><h5>پیوند ها</h5>
                            <ul class="list-unstyled quick-links" style="display: inline-flex;flex-wrap: wrap;flex-direction: row;align-content: space-between;justify-content: space-between;align-items: stretch;">';
                            $end='</ul></div>';
                            $_SESSION['dadash']='foot';
                        }
                    }
                }
                
                foreach($x as $value){
                    $y=$this->select_where('menu',array('status'=>1,'place'=>$value['place'],'parent_id'=>$value['id'],'side_id'=>$value['side_id']));
                    if(!empty($y)){
                        $ve.= '<li '.(!empty($value['li_css'])?$value['li_css']:'').'>';
                    }else{
                        if($value['place']=='top'){
                            $ve.='<li>';
                        }elseif($value['place'] == 'right'){
                            $ve.='<li class="slide">';
                        }elseif($value['place'] == 'left'){
                            $ve.='<li style="line-height: 16px;margin-top: 10px;">';
                        }else{
                            $ve.='<li>';
                        }
                    }
                    if(!empty($value['link_css'])){
                        $ve.='<a '.$value['link_css'];
                    }else{
                        if($value['place'] == 'right'){
                            $ve.='<a class="side-menu__item"';
                        }elseif($value['place'] == 'left'){
                            $ve.='<a class="py-3"';
                        }else{
                            $ve.='<a ';
                        }
                    }
                    if(!empty($value['link'])){
                        $ve.= 'href="'.$value['link'].'">';
                    }else{
                        $ve.='href="#">';    
                    }
                    if(!empty($value['icon_name']) && $value['place'] != 'left'){
                        $ve.='<i class="'. $value['icon_name'].' pl-1" aria-hidden="true"></i>';
                    }else{
                        $ve.='';
                    }
                    if(!empty($value['title'])){
                        $ve.=$value['title'];
                    }else{
                        $ve.='';
                    }
                    if(!empty($value['icon_name']) && $value['place'] == 'left'){
                        $ve.='<i class="'. $value['icon_name'].' pl-1" aria-hidden="true"></i>';
                    }else{
                        $ve.='';
                    }
                    $ve.='</a>';
                    if(!empty($y)){
                        if($value['megaMenu'] == 1 && $p_id == 0){
                            $ve.='<div class="horizontal-megamenu clearfix"><div class="container"><div class="mega-menubg hor-mega-menu"><div class="row"><div class="col-lg-12 col-md-12 col-xs-12 link-list">';
                            $endCstm='</div></div></div></div></div>';
                            if(!empty($value['ul_css'])){
                                $ve.='<ul class="'.$value['ul_css'].'">';
                            }else{
                                $ve.="<ul>";
                            }
                        }else{
                            $endCstm='';
                            if(!empty($value['ul_css'])){
                                $ve.='<ul '.$value['ul_css'].'>';
                            }else{
                                if($value['place']=='top'){
                                    $ve.='<ul class="sub-menu"style="background-color: #dff1f58f;border: 0;margin-top: 10px;">';
                                }elseif($value['place']=='left'){
                                    $ve.='<ul class="nav-pills nav-stacked" style="list-style: none;">';    
                                }elseif($value['place'] == 'right'){
                                    $ve.='<ul class="slide-menu>';
                                }else{
                                    $ve.='<ul>';
                                }
                            }
                        }
                        foreach($y as $bin){
                            $vei = $this->s_menus_w_si_p($bin['side_id'],$bin['place'],$bin['parent_id'],$bin['custom_html'],$bin['end_custom_html']);
                        }
                        $ve.=$vei;
                        $ve.="</ul>".$endCstm."</li>";
                    }else{
                        $ve.="</li>";
                    }
                }
                
                $ve.=$end;
                
                return $ve;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function select_where($tbl,$con){
        return (!empty($tbl)&&!empty($con)?$this->db->get_where($tbl,$con)->result_array():false);
    }

    public function one_row(){
        return $this->db->query("SELECT * FROM page LIMIT 1")->result_array();
    }

    public function s_m_w_s_i($id){
        return (is_numeric($id) && !empty($id)?$this->db->get_where('menu',['side_id'=>$id])->result_array():false);
    }

    public function pic(){
        return $this->db->query("SELECT * FROM pic")->result_array();
    }
    
    public function s_p(){
        return $this->db->query("SELECT * FROM page")->result_array();
    }
    
    public function s_p_t($u,$t){
        return (!empty($u) && !empty($t)?$this->select_where('page',['url'=>$u,'title'=>$t]):(!empty($u) && empty($t)?$this->select_where('page',['url'=>$u]):(!empty($t) && empty($u)?$this->select_where('page',['title'=>$t])  :false)));
    }
    
    public function writer_page(){
        return (!empty($this->s_p_t('writer',''))?:false);
    }
    
    public function writer_page1(){
        return (!empty($this->s_p_t('','writer'))?:false);
    }
    
    public function writer_page2(){
        return (!empty($this->s_p_t('','نویسنده'))?:false);
    }
    
    public function render_def(){
        return (!empty($this->s_p_t('',''))?:$this->render_page_user('writer'));
    }

    public function render_home_page(){
        return (!empty($this->s_p_t('',''))?:$this->render_page_user('home'));
    }
    
    public function s_p_i($id){
        return (is_numeric($id) && !empty($id)?$this->db->get_where('page',['id'=>$id])->result_array():false);
    }
    
    public function edit($data,$id){
        return (is_numeric($id)&&!empty($data)&&!empty($id)?$this->db->update('page',$data,['id'=>$id]):false);
    }
    
    public function add($data){
        return (!empty($data)?$this->db->insert('page',$data):false);
    }
    
    public function del($id){
        return (is_numeric($id)&&!empty($id)?$this->db->delete('page',['id'=>$id]):false);
    }
      
    public function dis($id){
        return (is_numeric($id) && !empty($id)?$this->edit(['status'=>0],$id):false);
    }

    public function en($id){
        return (is_numeric($id) && !empty($id)?$this->edit(['status'=>1],$id):false);
    }
    
    public function s_slider(){
        return $this->db->query("SELECT * FROM slider")->result_array();
    }
    
    public function slider($id){
        return (is_numeric($id) && !empty($id)?$this->db->get_where('slider',['id'=>$id])->result_array():false);
    }
    
    public function s_side(){
        return $this->db->query("SELECT * FROM sidebars_place")->result_array();
    }
    
    public function side($id){
        return (is_numeric($id) && !empty($id)?$this->db->get_where('sidebars_place',['id'=>$id])->result_array():false);
    }
    
    public function s_post(){
        return $this->db->query("SELECT * FROM posts")->result_array();
    }
    
    public function post($id){
        return (is_numeric($id) && !empty($id)?$this->db->get_where('posts',['id'=>$id])->result_array():false);
    }
    
    public function s_box(){
        return $this->db->query("SELECT * FROM boxs")->result_array();
    }
    
    public function box($id){
        return (is_numeric($id) && !empty($id)?$this->db->get_where('boxs',['id'=>$id])->result_array():false);
    }
    
    public function s_content(){
        return $this->db->query("SELECT * FROM content")->result_array();
    }
    
    public function content($id){
        return (is_numeric($id) && !empty($id)?$this->db->get_where('content',['id'=>$id])->result_array():false);
    }
    
    public function render_page($title,$path,$info=NULL){
        if(!empty($title)&&!empty($path)){
            $this->load->driver('cache', ['adapter' => 'file', 'backup' => 'file', 'key_prefix' => 'my_']);
            // $this->load->driver('cache',['adapter'=>'apc','backup'=>'file','key_prefix'=>'my_']);
            if(!$profile=$this->cache->file->get('panel'.$title)){
                if(file_exists('panel'.$title)){
                    unlink('panel'.$title);
                }
                $data=(!empty($info)?$info:[]);
                $top_menu_one = [
                    'rule_users' => $this->session->userdata('role'),
                    'username' => $this->session->userdata('name') ?: 'مهمان',
                    'profilePicture' => $this->session->userdata('pic') ?: '1.png',
                    'exitS' => base_url() . 'auth' . DS . 'logout',
                    'news_html'=>$this->News_model->news_html(),
                    'ticket_html'=>$this->Ticket_model->ticket_html(),
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
                ];
                $foot = array('footer' => "<span>پرتال ساز پردازش هوشمند علاءالدین _ پشتیبانی: 02644909</span>");
                $head = array('favicon' => 'logo1.png',
                    'description' => 'description',
                    'keyword' => 'keywords',
                    'page_title' => $title);
                $profile = $this->load->view('panel/header.php', $head, true);
                $profile .= $this->load->view('panel/loader.php', [], true);
                $profile .= $this->load->view('panel/topNavMenuOne.php', $top_menu_one, true);
                // $profile.='</div></div>';
                $profile .= $this->load->view($path, $data, true);
                $profile .= $this->load->view('panel/footer.php', $foot, true);
                $this->cache->save('panel'.$title,$profile,300);
            }else{
                if(file_exists('panel'.$title)){
                    unlink('panel'.$title);
                }
                $profile=$this->cache->file->save('panel'.$title,$profile,300);
            }
            echo $profile;
            die();
        }else{
            header('Location :'.base_url().'err'.DS.'not_found');
            exit();
        }
    }
    
    public function render_page_user($title,$path=NULL,$data=[]){
        $a='';
        $top_menu_one = [
            'rule_users' => $this->session->userdata('role'),
            'username' => $this->session->userdata('name') ?: 'مهمان',
            'profilePicture' => $this->session->userdata('pic') ?: '1.png',
            'exitS' => base_url() . 'auth' . DS . 'logout',
            'news_html'=>$this->News_model->news_html(),
            'ticket_html'=>$this->Ticket_model->ticket_html(),
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
        ];
        $foot = array('footer' => "<span>پرتال ساز پردازش هوشمند علاءالدین _ پشتیبانی: 02644909</span>");
        $head = array('favicon' => 'logo1.png',
            'description' => 'description',
            'keyword' => 'keywords',
            'page_title' => $title);
        $a = $this->load->view('panel/header.php', $head, true);
        // $a .= $this->load->view('panel/loader.php', [], true);
        $a .= $this->load->view('panel/topNavMenuOne.php', $top_menu_one, true);
        $a .= $this->Menu_model->fetch_for_menu('top', 'topNavMenuTwo.php');
        if(!empty($path)){
            $a .= $this->load->view($path, $data, true);
        }
        $a .= $this->Menu_model->fetch_for_menu('footer', 'footer.php', $foot);
        return $a;
    
    }

    //for special user and writer user

    public function r_p_d($data,$t=NULL,$path=NULL){
        if(!empty($data)){
            if($data['0']['status']==1){
                $all=$data['0']['all_element'];
                $top_menu_one = [
                'rule_users' => $this->session->userdata('role'),
                'username' => $this->session->userdata('name') ?: (!is_null($t)?$t:'مهمان'),
                'profilePicture' => $this->session->userdata('pic') ?: '1.png',
                'exitS' => base_url() . 'auth' . DS . 'logout',
                'news_html'=>$this->News_model->news_html(),
                'ticket_html'=>$this->Ticket_model->ticket_html(),
                'timeNews' => 'friday',
                'icon1' => $data['0']['logo'],
                'icon2' => $data['0']['logo'],
                'icon3' => $data['0']['logo'],
                'icon4' => $data['0']['logo'],
                'icon1Des' => '',
                'icon2Des' => '',
                'icon3Des' => '',
                'icon4Des' => '',
                'editProfile' => '#',
                'country' => array(),
                'news' => array(),
                'message' => array()
            ];
            $foot = array('footer' => "<span>پرتال ساز پردازش هوشمند علاءالدین _ پشتیبانی: 02644909</span>");
            $head = array('favicon' => $data['0']['fav'],
                'description' => $data['0']['des'],
                'keyword' => $data['0']['keyW'],
                'page_title' => $data['0']['title']);
            $a = $this->load->view('panel/header.php', $head, true);
            // $a .= $this->load->view('panel/loader.php', [], true);
            $a .= $this->load->view('panel/topNavMenuOne.php', $top_menu_one, true);
            $a .= $this->Menu_model->fetch_for_menu('top', 'topNavMenuTwo.php');
            
            $a .= (!empty($path)?$this->load->view($path, $data, true):'');
            $a .= $this->Menu_model->fetch_for_menu('footer', 'footer.php', $foot);
            return $a;
            }else{
                header('Location :'.base_url().'err'.DS.'not_found');
                exit();    
            }
        }else{
            header('Location :'.base_url().'err'.DS.'not_found');
            exit();
        }
    }
}