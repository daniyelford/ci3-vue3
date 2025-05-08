<?php
class Home extends My_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    //$_SESSION['writer_page']='nist';

    public function index(){
        $all_page=$this->Page_model->s_p();
        if(!empty($all_page)){
            $b='';
            foreach($all_page as $aaaa){
                if($aaaa['title'] == 'home' ||  $aaaa['title'] == 'صفحه ی نخست' || $aaaa['title'] == 'خانه' || $aaaa['title'] == 'home page'){
                    $head = [
                        'favicon' => (!empty($aaaa['fav'])?$aaaa['fav']:'logo1.png'),
                        'description' => (!empty($aaaa['des'])?$aaaa['des']:'description'),
                        'keyword' => (!empty($aaaa['keyW'])?$aaaa['keyW']:'keywords'),
                        'page_title' => $aaaa['title']
                    ];
                    $b .= $this->load->view('panel/header.php', $head, true);
                    // $b .= $this->load->view('panel/loader.php', [], true);
                    $b.=$this->show_htmls($aaaa['all_element']);
                    echo $b;
                    exit();
                }
            }
            if(empty($b)){
                $first_page=$this->Page_model->one_row();
                if(!empty($first_page)){
                    $head = [
                        'favicon' => (!empty($first_page['0']['fav'])?$first_page['0']['fav']:'logo1.png'),
                        'description' => (!empty($first_page['0']['des'])?$first_page['0']['des']:'description'),
                        'keyword' => (!empty($first_page['0']['keyW'])?$first_page['0']['keyW']:'keywords'),
                        'page_title' => (!empty($first_page['0']['title'])?$first_page['0']['title']:(!empty($first_page['0']['link'])?$first_page['0']['link']:'صفحه'))
                    ];
                    $b .= $this->load->view('panel/header.php', $head, true);
                    // $b .= $this->load->view('panel/loader.php', [], true);
                    $b.=$this->show_htmls($first_page['0']['all_element']);
                    echo $b;
                    exit();
                }else{
                    header('Location :'.base_url().'err'.DS.'not_found');
                    exit();
                }
            }
        }else{
            if(!empty($_SESSION['role']) && $_SESSION['role'] == 'admin' ){
                $html='<div class="alert alert-danger rounded-10 text-center p-5">صفحه ای موجود نیست ابتدا صفحه ای ایجاد کنید<a class="btn btn-success text-center box-shadow-pink rounded-10 btn-block" href="'.base_url().'page/add">ایجاد صفحه نخست</a></div> ';
                echo $this->Page_model->render_page('صفحه ی نخست','page/html',['x'=>$html]);
                exit();
            }else{
                $html='';
                echo $this->Page_model->render_page('صفحه ی نخست','page/html',['x'=>$html]);
                exit();
            }
        }
    }
    
    public function show_htmls($page_info){
            if(!empty($page_info)){
                $a=$c=$f=$po=$si=[];
                $si_top=$si_left=$si_right= $si_foot=$x=$i=$right_btn=$left_btn='';
                $a=explode(",", $page_info);
                for($b=0;$b<=count($a)-1;$b++){
                    if(!empty($a[$b])){
                        $c[]=explode(":",$a[$b]);
                    }        
                }
                for($e=0;$e<=count($c)-1;$e++){
                    if($c[$e]['0'] == 'side'){
                        $si=$this->Page_model->side($c[$e]['1']);
                        if(!empty($si)){
                            if($si['0']['place']=='top'){
                                $menus=$this->Page_model->s_menus_w_si_p($si['0']['id'],'top',0,$si['0']['custom_html'],$si['0']['end_custom_html']);
                                $si_top.=$this->load->view('page'.DS.'topNavMenuTwo.php', ['data'=>$menus], true);
                            }elseif($si['0']['place']=='left'){
                                $left_btn=(!is_null($si['0']['btn']) &&!empty($si['0']['btn'])?$si['0']['btn']:'<div class="dropdown main-header-message right-toggle">
            						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" id="leftSlider-toggle" style="border: none;background-color: #00008b00;outline: none;">
                                        <svg width="32px" height="32px" viewBox="0 0 32 32" data-name="Layer 2" id="Layer_2" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.43,12.67c3.16,0,6.32,0,9.48,0a1.25,1.25,0,0,0,0-2.5c-3.16,0-6.32,0-9.48,0A1.25,1.25,0,0,0,11.43,12.67Z"/><path d="M11.35,17.23q4.81.11,9.63-.05c1.61-.05,1.62-2.55,0-2.5q-4.82.15-9.63.05A1.25,1.25,0,0,0,11.35,17.23Z"/><path d="M21.06,19q-4.72.21-9.47.35c-1.61.05-1.61,2.55,0,2.5q4.74-.13,9.47-.35C22.67,21.4,22.67,18.9,21.06,19Z"/></svg>
                                    </button>
            					</div>');
                                $left_menus="<style>#sidebar{left: 21px !important;top: 60px !important;position: absolute !important;z-index: 0;height: 94.6%;}</style>";
                                $left_menus.=$this->Page_model->s_menus_w_si_p($si['0']['id'],'left',0,$si['0']['custom_html'],$si['0']['end_custom_html']);
                                $si_left.=$this->load->view('page'.DS.'leftMenu.php', ['data'=>$left_menus], true);
                            }elseif($si['0']['place']=='right'){
                                $right_btn=(!is_null($si['0']['btn']) && !empty($si['0']['btn'])?$si['0']['btn']:'<div class="app-sidebar__toggle" data-toggle="sidebar">
                    					<a class="open-toggle" href="#"><i class="header-icon fe fe-align-left"></i></a>
                    					<a class="close-toggle" href="#"><i class="header-icons fe fe-x"></i></a>
                    				</div>');
                                $right_menus=$this->Page_model->s_menus_w_si_p($si['0']['id'],'right',0,$si['0']['custom_html'],$si['0']['end_custom_html']);
                                $si_right.=$this->load->view('page'.DS.'rightMenu.php', ['data'=>$right_menus], true);
                            }else{
                                $cdn='&copy; <a href="https://openstreetmap.org/copyright">OpenStreetMap contributors</a>';
                                $foot_menu = $this->Page_model->s_menus_w_si_p($si['0']['id'],'foot',0,$si['0']['custom_html'],$si['0']['end_custom_html']);
                                $foot_menu .= (!empty($si['0']['place_map'])?"<div class='col-md-6 mx-auto mg-t-10 mg-md-t-0' style='height:290px;z-index:0' id='map'></div>
                                <script>
                                    function j() {
                                        let aha='".$si['0']['id']."';
                                  	    $.ajax({
                                			method: 'post',
                                			data:{aha:aha},
                                			url: '".base_url()."map/check_marks',
                                			success: function (value) {
                                				if (value) {
                                					marks = value.split(',');
                                					for (i = 0; i <= marks.length; i++) {
                                						mark = marks[i].split('|');
                                						L.marker({lon: parseFloat(mark[0]), lat:parseFloat(mark[1])}).bindPopup(mark[2]+ g(parseFloat(mark[0]), parseFloat(mark[1]))).addTo(map);
                                					}
                                				} 
                                			}
                                		})
                                    }
  
                                    $(document).ready(function () {
                                    	map = L.map('map').setView({lon: 50.615054368972785 , lat: 35.955950233885645}, 13);
                                		j();
                                		L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png'
                                		, {
                                			maxZoom: 19,
                                			attribution: '".$cdn."',
                                		}).addTo(map);
                                		L.control.scale({imperial: true, metric: true}).addTo(map);
                                		popup = L.popup();
                                    })

                                </script></div>":"</div></div></section></div>");
                                $si_foot.=$this->load->view('page'.DS.'footer.php', ['data'=>$foot_menu], true);
                            }
                        }else{
                            $si_top='';
                            $si_left='';
                            $si_right='';
                            $si_foot='';
                        }
                        
                    }
                }
                
                if(!empty($si_right)){
                    $x.=$si_right;
                }
                $top_menu_one = [
                    'rule_users' => $this->session->userdata('role'),
                    'username' => $this->session->userdata('name') ?: 'مهمان',
                    'profilePicture' => $this->session->userdata('pic') ?: '1.png',
                    'exitS' => base_url() . 'auth' . DS . 'logout',
                    'news_html'=>$this->News_model->news_html(),
                    'ticket_html'=>$this->Ticket_model->ticket_html(),
                    'timeNews' => 'friday',
                    'icon1' => (!empty($b['0']['logo'])?$b['0']['logo']:'logo1.png'),
                    'icon2' => (!empty($b['0']['logo'])?$b['0']['logo']:'logo1.png'),
                    'icon3' => (!empty($b['0']['logo'])?$b['0']['logo']:'logo1.png'),
                    'icon4' => (!empty($b['0']['logo'])?$b['0']['logo']:'logo1.png'),
                    'icon1Des' => '',
                    'icon2Des' => '',
                    'icon3Des' => '',
                    'icon4Des' => '',
                    'right_btn'=>$right_btn,
                    'left_btn'=>$left_btn,
                    'country' => array(),
                    'news' => array(),
                    'message' => array()
                ];
                $x .= $this->load->view('panel/topNavMenuOne.php', $top_menu_one, true);
                if(!empty($si_top)){
                    $x.=$si_top;
                }
                // $x.='</div>';
                if(!empty($si_left)){
                    $x.=$si_left;
                }
                
                $x.="<div class='container-fluid' style='min-height:480px;margin-top: 13%;'><div class='row row-sm'>";
                for($d=0;$d<=count($c)-1;$d++){
                    switch($c[$d]['0']){
                        case 'post':
                            $po=$this->Page_model->post($c[$d]['1']);
                            $p=$this->com_pic($po['0']['pic_id']);
                            $x.=$this->load->view('page'.DS.'post.php',['data'=>$po,'pic'=>$p],TRUE);
                            break;
                            
                        case 'content':
                            $co=$this->Page_model->content($c[$d]['1']);
                            $x.="<div class='col-12'><div class='row row-sm'>";
                            $pp=$this->com_pic($co['0']['pic_id']);
                            $x.=$this->load->view('page'.DS.'content.php',['data'=>$co,'pic'=>$pp],TRUE);
                            $x.='</div></div>';
                            break;
                                
                        case 'box':
                            $bo=$this->Page_model->box($c[$d]['1']);
                            $ppp=$this->com_pic($bo['0']['pic']);
                            $x.=$this->load->view('page'.DS.'box.php',['data'=>$bo,'pic'=>$ppp],TRUE);
                            break;    
                                
                        case 'slider':
                            $sl=$this->Page_model->slider($c[$d]['1']);
                            $pppp=$this->com_pic($sl['0']['pic_id']);
                            $x.=$this->load->view('page'.DS.'slider.php',['data'=>$sl,'pic'=>$pppp],TRUE);
                            break;
                    }
                }
                $x.='</div></div><div style="height:750px;width:100%;"></div>';
                if(!empty($si_foot)){
                    $x.=$si_foot;
                }
                $x.='</div>';
                $x.= $this->load->view('page/fot.php',[],true);
                return $x;
            }else{
                echo 0;
                die();
            }
       
    }
    
    public function com_pic($val){
        $z='';
        if(!empty($val)){
            $z.='<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel"><div class="carousel-inner">';
                $a=explode(',',$val);
                if(!empty($a['0'])){
                    $d=explode(':',$a['0']);
                    $f=$this->Slider_model->pic($d['0']);
                    if(!empty($f)){
                        $z.='<div class="carousel-item active"> <img class="card-img-top w-100" src="'.base_url().'pic'.DS.$f['0']['name'].'" alt="picture"/></div>';
                    }
                    for($b=1;$b<=count($a)-1;$b++){
                        $c=explode(':',$a[$b]);   
                        $y=$this->Slider_model->pic($c['0']);
                        if(!empty($y)){
                            $z.='<div class="carousel-item"> <img class="card-img-top w-100" src="'.base_url().'pic'.DS.$y['0']['name'].'" alt="picture"/></div>';
                        }
                    }
                }else{
                    $d=explode(':',$a['1']);
                    $f=$this->Slider_model->pic($d['0']);
                    if(!empty($f)){
                        $z.='<div class="carousel-item active"> <img class="card-img-top w-100" src="'.base_url().'pic'.DS.$f['0']['name'].'" alt="picture"/></div>';
                    }
                    for($b=2;$b<=count($a)-1;$b++){
                        $c=explode(':',$a[$b]);   
                        $y=$this->Slider_model->pic($c['0']);
                        if(!empty($y)){
                            $z.='<div class="carousel-item"> <img class="card-img-top w-100" src="'.base_url().'pic'.DS.$y['0']['name'].'" alt="picture"/></div>';
                        }
                    }
                }
                $z.='</div></div>';
            }
            return $z;
    }
    
    public function show($a){
        if(!empty($a)){
            $b=(!empty($this->Page_model->s_p_t($a,''))?$this->Page_model->s_p_t($a,''):(!empty($this->Page_model->s_p_t('',$a))?$this->Page_model->s_p_t('',$a):null));
            // echo (!empty($b)?$this->Page_model->r_p_d($b):$this->index());
            if(!empty($b)){
                $this->load->driver('cache',['adapter'=>'apc','backup'=>'file','key_prefix'=>'my_']);
                if(!$profile=$this->cache->file->get('pages_'.$b['0']['url'])){
                    if(file_exists('pages_'.$b['0']['url'])){
                        unlink('pages_'.$b['0']['url']);
                    }
                    $head = [
                        'favicon' => (!empty($b['0']['fav'])?$b['0']['fav']:'logo1.png'),
                        'description' => (!empty($b['0']['des'])?$b['0']['des']:'description'),
                        'keyword' => (!empty($b['0']['keyW'])?$b['0']['keyW']:'keywords'),
                        'page_title' => (!empty($b['0']['title'])?$b['0']['title']:(!empty($b['0']['link'])?$b['0']['link']:'صفحه'))
                    ];
                    $profile = $this->load->view('panel/header.php', $head, true);
                    // $c .= $this->load->view('panel/loader.php', [], true);
                    $profile .= $this->show_htmls($b['0']['all_element']);
                    // $this->cache->save('pages_'.$b['0']['title'],$profile,300);
                }else{
                    if(file_exists('pages'.$b['0']['url'])){
                        unlink('pages'.$b['0']['url']);
                    }
                    $profile=$this->cache->file->save('pages_'.$b['0']['url'],$profile,300);
                }
                echo $profile;
                exit();
            }else{
                header('Location :'.base_url().'err'.DS.'not_found');
                exit();
            }
        }else{
            $this->load->driver('cache',['adapter'=>'apc','backup'=>'file','key_prefix'=>'my_']);
            if(!$profile=$this->cache->file->get('first_page')){
                if(file_exists('first_page')){
                    unlink('first_page');
                }
                $profile=$this->index();
                $this->cache->file->save('first_page',$profile,300);
            }else{
                if(file_exists('first_page')){
                    unlink('first_page');
                }
                $profile=$this->cache->file->save('first_page',$profile,300);
            }
            echo $profile;
            exit();
        }
    }
}