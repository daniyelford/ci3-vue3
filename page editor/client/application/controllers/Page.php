<?php

class Page extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }
    
    // add elements
    
    public function add_menu()
    {
        if(!empty($_POST['se']) && $_POST['se'] == 'se'){
            $p='';
            $q=    ['0'=>'انتخاب کنید'];
            $n=    ['0'=>'انتخاب کنید'];
            $icons=$this->Menu_model->all_icons();
            $sides=$this->Side_model->sides();
            $m=['name'=>'title',
                'class'=>'form-control rounded-5',
                'id'=>'title',
                'value'=>set_value('title'),
                'placeholder'=>'عنوان منو',
                'type'=>'text'];
            foreach($icons as $val){
                $n[$val['class']] = $val['title']." ".$val['shrtcd'];
            }
            $o=['name'=>'link',
                'class'=>'form-control rounded-5',
                'id'=>'link',
                'value'=>set_value('link'),
                'placeholder'=>'https://aseos.ir',
                'type'=>'text'];
            
            foreach ($sides as $value){
                $q[$value['id']] = $value['title'];
            }
            $r=['0'=>'منوی ساده',
                '1'=>'مگا منو'];
            
            $s=['name'=>'list_class',
                'class'=>'form-control rounded-5',
                'id'=>'list_class',
                'value'=>set_value('list_class'),
                'placeholder'=>'(li) class=value',
                'type'=>'text'];
                
            $t=['name'=>'list_attr',
                'class'=>'form-control rounded-5',
                'id'=>'list_attr',
                'value'=>set_value('list_attr'),
                'placeholder'=>'(li) attribute=value',
                'type'=>'text'];
                
            $u=['name'=>'link_class',
                'class'=>'form-control rounded-5',
                'id'=>'link_class',
                'value'=>set_value('link_class'),
                'placeholder'=>'(a) class=value ',
                'type'=>'text'];
            
            $v=['name'=>'link_attr',
                'class'=>'form-control rounded-5',
                'id'=>'link_attr',
                'value'=>set_value('link_attr'),
                'placeholder'=>'(a) attribute=value',
                'type'=>'text'];
                
            $w=['name'=>'ul_child_class',
                'class'=>'form-control rounded-5',
                'id'=>'ul_child_class',
                'value'=>set_value('ul_child_class'),
                'placeholder'=>'(ul) class=value',
                'type'=>'text'];
            
            $x=['name'=>'ul_child_attr',
                'class'=>'form-control rounded-5',
                'id'=>'ul_child_attr',
                'value'=>set_value('ul_child_attr'),
                'placeholder'=>'(ul) attribute=value',
                'type'=>'text'];
                
            $y=['name'=>'custom_html',
                'class'=>'form-control rounded-5',
                'id'=>'custom_html',
                'value'=>set_value('custom_html'),
                'placeholder'=>'<html tags>',
                'type'=>'text'];
                
            $z=['name'=>'end_custom_html',
                'class'=>'form-control rounded-5',
                'id'=>'end_custom_html',
                'value'=>set_value('end_custom_html'),
                'placeholder'=>'</html tags> ',
                'type'=>'text'];

		    echo $this->load->view('panel'.DS.'add_menu_page.php',['m'=>$m,'n'=>$n,'o'=>$o,'p'=>$p,'q'=>$q,'r'=>$r,'s'=>$s,'t'=>$t,'u'=>$u,'v'=>$v,'w'=>$w,'x'=>$x,'y'=>$y,'z'=>$z,'con'=>(!empty($sides)?true:false)],true);
        }else{
            header('Location :'.base_url().'err'.DS.'no_access');
            exit();   
        }
    }

    public function add_con()
    {
        if(!empty($_POST['se']) && $_POST['se']=='se'){
            $t = ['name' => 'title',
                'class' => 'form-control rounded-5',
                'id' => 'title',
                'value' => set_value('title'),
                'placeholder' => 'عنوان متن را وارد کنید',
                'type' => 'text'];
    
            $c = ['name' => 'content',
                'class' => 'form-control rounded-5',
                'id' => 'content',
                'value' => set_value('content'),
                'placeholder' => 'متن مورد نظر را وارد کنید',
                'type' => 'text'];
    
            $s = ['name' => 'style',
                'class' => 'form-control rounded-5 text-start dir-ltr',
                'id' => 'style',
                'value' => set_value('style'),
                'placeholder' => 'استایل css دستی خود را وارد کنید',
                'type' => 'text'];
            
            $d = ['name' => 'des',
                'class' => 'form-control rounded-5',
                'id' => 'des',
                'value' => set_value('des'),
                'placeholder' => 'توضیحات مختصری راجب متن وارد کنید',
                'type' => 'text'];
                
            $pic_info = $this->Page_model->pic();
    
            $data = ['data'=>'true','t' => $t, 'c' => $c, 's' => $s, 'pic_info' => $pic_info,'d'=>$d];
            echo $this->load->view('panel'.DS.'add_content_page.php', $data, TRUE);
        }else{
            header('Location :'.base_url().'err'.DS.'not_found');
            exit();
        }
    }

    public function add_side()
    {
        if(!empty($_POST['se']) && $_POST['se']=='se'){
            $t=['name'=>'title',
                'class'=>'form-control rounded-5',
                'id'=>'title',
                'value'=>set_value('title'),
                'placeholder'=>'عنوان ساید بار',
                'type'=>'text'];
            $f=[
                'top'=>'بالا',
                'left'=>'دست چپ',
                'right'=>'دست راست',
                'foot'=>'پایین'
                ];
            $p=form_dropdown('place',$f,'top',array('class'=>'rounded-5 form-control','id'=>'place'));
            $ar=[
                '1'=>'بدون تغییر',
                '2'=>'افرودن css',
                '3'=>'افزودن نقشه',
                // '4'=>'افزودن عکس'
                ];
            $add=form_dropdown('add',$ar,'1',array('class'=>'rounded-5 form-control','id'=>'add'));
            $css=[
                'name'  => 'css',
                'id'    => 'css',
                'value' => set_value(strip_tags('css')),
                'rows'  => '50',
                'cols'  => '10',
                'style' => 'width:100%;height:40px',
                'class' => 'form-control rounded-5']; 
            $hs=['name'  => 'custom_html',
                'id'    => 'custom_html',
                'value' => set_value(strip_tags('custom_html')),
                'rows'  => '50',
                'cols'  => '10',
                'style' => 'width:100%;height:40px',
                'class' => 'form-control rounded-5'];  
            $he=['name'  => 'custom_html_end',
                'id'    => 'custom_html_end',
                'value' =>set_value(strip_tags('custom_html_end')),
                'rows'  => '50',
                'cols'  => '10',
                'style' => 'width:100%;height:40px',
                'class' => 'form-control rounded-5'];
            $btn=['name'  => 'sideBtn',
                'id'    => 'sideBtn',
                'value' =>set_value(strip_tags('sideBtn')),
                'rows'  => '50',
                'cols'  => '10',
                'style' => 'width:100%;height:40px',
                'class' => 'form-control rounded-5'];
    		$data=['t'=>$t, 'p'=>$p, 'add'=>$add, 'hs'=>$hs, 'he'=>$he, 'css'=>$css,'btn'=>$btn];
            echo $this->load->view('panel'.DS.'add_side_page.php',$data,true);
        }else{
            header('Location :'.base_url().'err'.DS.'not_found');
            exit();
        }
    }

    public function add_box()
    {
        if(!empty($_POST['se']) && $_POST['se']=='se'){
            $t = ['name' => 'title',
                'class' => 'form-control rounded-5',
                'id' => 'title',
                'value' => set_value('title'),
                'placeholder' => 'عنوان جعبه را وارد کنید',
                'type' => 'text'];
        
            $c = ['name' => 'content',
                'class' => 'form-control rounded-5',
                'id' => 'content',
                'value' => set_value('content'),
                'placeholder' => 'متن جعبه را وارد کنید',
                'type' => 'text'];
                    
            $s = ['name' => 'style',
                'class' => 'form-control rounded-5 dir_ltr',
                'id' => 'style',
                'value' => set_value('style'),
                'placeholder' => 'css دلخواه',
                'type' => 'text'];
                
            $l=['name' => 'link',
                'class' => 'form-control rounded-5',
                'id' => 'link',
                'value' => set_value('link'),
                'placeholder' => 'لینک جعبه را وارد کنید',
                'type' => 'text'];
                
            $sh=['name' => 's_h',
                'class' => 'form-control rounded-5 dir_ltr',
                'id' => 's_h',
                'value' => set_value('s_h'),
                'placeholder' => 'تگ های آغاز html دلخواه',
                'type' => 'text'];
                
            $eh=['name' => 'e_h',
                'class' => 'form-control rounded-5 dir_ltr',
                'id' => 'e_h',
                'value' => set_value('e_h'),
                'placeholder' => 'تگ های پایانی html دلخواه',
                'type' => 'text'];
                
            $si=[
                '0'=>'انتخاب کنید',
                '1'=>'خیلی بزرگ',   
                '2'=>'بزرگ',
                '3'=>'نسبتا بزرگ',
                '4'=>'متوسط',
                '5'=>'کوچک',
                '6'=>'خیلی کوچک'
            ];
            
            $size=form_dropdown('size', $si, '0', array('class' => 'rounded-5 SlectBox form-control', 'id' => 'size'));
            
            $pi=$this->Page_model->pic();

        $data=[
            'ti'=>$t,
            'co'=>$c,
            'st'=>$s,
            'all_pic'=>$pi,
            'link'=>$l,
            's_h'=>$sh,
            'e_h'=>$eh,
            'size'=>$size
        ];
        echo $this->load->view('panel/add_box_page.php',$data,TRUE);
            
            
        }else{
            header('Location :'.base_url().'err'.DS.'not_found');
            exit();
        }
    }

    public function add_slider()
    {
        if(!empty($_POST['se']) && $_POST['se']=='se'){
            $t = ['name' => 'title',
                'class' => 'form-control rounded-5',
                'id' => 'title',
                'value' => set_value('title'),
                'placeholder' => 'عنوان جعبه را وارد کنید',
                'type' => 'text'];
        
            $s = ['name' => 'style',
                'class' => 'form-control rounded-5 dir_ltr',
                'id' => 'style',
                'value' => set_value('style'),
                'placeholder' => 'css دلخواه',
                'type' => 'text'];
                
            $sh=['name' => 's_h',
                'class' => 'form-control rounded-5 dir_ltr',
                'id' => 's_h',
                'value' => set_value('s_h'),
                'placeholder' => 'تگ های آغاز html دلخواه',
                'type' => 'text'];
                
            $eh=['name' => 'e_h',
                'class' => 'form-control rounded-5 dir_ltr',
                'id' => 'e_h',
                'value' => set_value('e_h'),
                'placeholder' => 'تگ های پایانی html دلخواه',
                'type' => 'text'];
                
            $si=[
                '0'=>'انتخاب کنید',
                '1'=>'indicators',   
                '2'=>'dark indicators',
                '3'=>'inner',
                '4'=>'dark inner',
                '5'=>'fade',
                '6'=>'dark fade'
            ];
        
            $type=form_dropdown('type', $si, '0', array('class' => 'rounded-5 SlectBox form-control', 'id' => 'type'));
        
        $pi=$this->Page_model->pic();

        $data=[
            'ti'=>$t,
            'st'=>$s,
            'all_pic'=>$pi,
            's_h'=>$sh,
            'e_h'=>$eh,
            'type'=>$type
        ];
         echo $this->load->view('panel/add_slider_page.php',$data,TRUE);  
    }else{
            header('Location :'.base_url().'err'.DS.'not_found');
            exit();
        }
    }

    public function add_post()
    {
        if(!empty($_POST['se']) && $_POST['se']=='se'){
            $t = ['name' => 'title',
                'class' => 'form-control rounded-5',
                'id' => 'title',
                'value' => set_value('title'),
                'placeholder' => 'عنوان پست را وارد کنید',
                'type' => 'text'];
    
            $c = ['name' => 'content',
                'class' => 'form-control rounded-5',
                'id' => 'content',
                'value' => set_value('content'),
                'placeholder' => 'متن پست خود راوارد کنید',
                'type' => 'text'];
    
    
            $l = ['name' => 'link',
                'class' => 'form-control rounded-5',
                'id' => 'link',
                'value' => set_value('link'),
                'placeholder' => 'لینک پست را وارد کنید',
                'type' => 'text'];
    
            $p = ['name' => 'pri',
                'class' => 'form-control rounded-5',
                'id' => 'pri',
                'value' => set_value('pri'),
                'placeholder' => 'قیمت را به تومان وارد کنید',
                'type' => 'number'];
    
            $d = ['name' => 'dis',
                'class' => 'form-control rounded-5',
                'id' => 'dis',
                'value' => set_value('dis'),
                'placeholder' => 'توضیحات اضافه',
                'type' => 'text'];
    
            $n = ['name' => 'np',
                'class' => 'form-control rounded-5',
                'id' => 'np',
                'value' => set_value('np'),
                'placeholder' => 'قیمت با تخفیف',
                'type' => 'number'];
    
            $e = ['name' => 'datepicker1',
                'class' => 'form-control rounded-5',
                'id' => 'datepicker1',
                'value' => (isset($itemOutData->datepicker1) ? set_value('datepicker1', date('Y-m-d', strtotime($itemOutData->datepicker1))) : set_value('datepicker1')),
                'placeholder' => 'مدت زمان',
                'type' => 'text'];
    
            $data = $this->Page_model->pic();
            $info=['data' => $data, 'c' => $c, 'l' => $l, 'pr' => $p, 'd' => $d, 'n' => $n,'e'=>$e, 't' => $t];
            echo $this->load->view('panel/add_post_page.php', ['data' => $data, 'c' => $c, 'l' => $l, 'pr' => $p, 'd' => $d, 'n' => $n,'e'=>$e, 't' => $t], TRUE);
        }else{
            header('Location :'.base_url().'err'.DS.'not_found');
            exit();
        }
    }

    // end of add element

    public function index()
    {
        if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
        $info=$this->Page_model->s_p();
        $data=$x='';
        if(!empty($info)){
            $data='ok';
            $num=1;
            foreach($info as $val){
                $slider_name='';
				if(!empty($val['slider_id'])){
				    $a=explode(',',$val['slider_id']);
				    for($b=0;$b<=count($a)-1;$b++){
					    $c=$this->Page_model->slider($a[$b]);
						if(!empty($c)){
						    $slider_name.=$c['0']['title'].'  ';   
						}
					}
				}
				
				$side_name='';
				if(!empty($val['side_id'])){
				    $d=explode(',',$val['side_id']);
				    for($e=0;$e<=count($d)-1;$e++){
					    $f=$this->Page_model->side($d[$e]);
						if(!empty($f)){
						    $side_name.=$f['0']['title'].'  ';   
						}
					}
				}
				
				$post_name='';
				if(!empty($val['post_id'])){
				    $g=explode(',',$val['post_id']);
				    for($h=0;$h<=count($g)-1;$h++){
					    $i=$this->Page_model->post($g[$h]);
						if(!empty($i)){
						    $post_name.=$i['0']['title'].'  ';   
						}
					}
				}
				
				$box_name='';
				if(!empty($val['box_id'])){
				    $j=explode(',',$val['box_id']);
				    for($k=0;$k<=count($j)-1;$k++){
					    $l=$this->Page_model->box($j[$k]);
						if(!empty($l)){
						    $box_name.=$l['0']['title'].'  ';   
						}
					}
				}
				
				$content_name='';
				if(!empty($val['content_id'])){
				    $m=explode(',',$val['content_id']);
				    for($n=0;$n<=count($m)-1;$n++){
					    $o=$this->Page_model->content($m[$n]);
						if(!empty($o)){
						    $content_name.=$o['0']['title'].'  ';   
						}
					}
				}
				
                $x.="<tr><th scope='row'>". $num ."</th><td>". $val['title'] ."</td><td>";
				$x.=(!empty($side_name)?$side_name:'-');
				$x.="</td><td>";
				$x.=(!empty($post_name)?$post_name:'-');
				$x.="</td><td>";
				$x.=(!empty($box_name)?$box_name:'-');
				$x.="</td><td>";
				$x.=(!empty($slider_name)?$slider_name:'-');
				$x.="</td><td>";
				$x.=(!empty($content_name)?$content_name:'-');
				$x.="</td><td>". $val['link'] ."</td><td>";
				$x.=($val['status'] == 1?"<a class='btn btn-block btn-warning-gradient pd-x-25 rounded-10 box-shadow-pink' href='". base_url()."page".DS."disable".DS.$val['id']."'>غیر فعال</a>":"<a class='btn btn-block btn-success-gradient pd-x-25 rounded-10 box-shadow-success' href='". base_url()."page".DS."enable".DS.$val['id']."'>فعال</a>");
				$x.="</td><td><a class='btn btn-danger-gradient pd-x-25 rounded-10 box-shadow-pink ml-1' href='". base_url()."page".DS."del".DS.$val['id']."'>حذف</a><a class='btn btn-info-gradient pd-x-25 rounded-10 box-shadow-primary' href='". base_url()."page".DS."edit".DS.$val['id']."'>ویرایش</a></td></tr>";
		        $num++;
		    }
        }
        echo $this->Page_model->render_page('صفحه ها','panel/page.php',['data'=>$data,'x'=>$x]);
        }else{
            header('Location :'.base_url().'err'.DS.'no_access');
            exit();
        }
    }
    
    public function com_pic($val)
    {
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
    
    public function show_htmls()
    {
        if(!empty($_POST['send']) && $_POST['send'] == "send"){
            if(!empty($_POST['xa'])){
                $a=$c=$f=$po=$si=[];
                $si_top=$si_left=  $si_right= $si_foot=$x=$i='';
                $a=explode(",", $_POST['xa']);
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
                                $left_menus="<style>#sidebar{left: 21px !important;top: 60px !important;position: absolute !important;z-index: 0;height: 94.6%;}</style>";
                                $left_menus.=$this->Page_model->s_menus_w_si_p($si['0']['id'],'left',0,$si['0']['custom_html'],$si['0']['end_custom_html']);
                                $si_left.=$this->load->view('page'.DS.'leftMenu.php', ['data'=>$left_menus], true);
                            }elseif($si['0']['place']=='right'){
                                $right_menus=$this->Page_model->s_menus_w_si_p($si['0']['id'],'right',0,$si['0']['custom_html'],$si['0']['end_custom_html']);
                                $si_right.=$this->load->view('page'.DS.'rightMenu.php', ['data'=>$right_menus], true);
                            }else{
                                $foot_menu=$this->Page_model->s_menus_w_si_p($si['0']['id'],'foot',0,$si['0']['custom_html'],$si['0']['end_custom_html']);
                                $si_foot.=$this->load->view('page'.DS.'footer.php', ['data'=>$foot_menus], true);
                            }
                        }else{
                            echo 0;
                            die();
                        }
                        
                    }
                }
                if(!empty($si_top)){
                    $x.=$si_top;
                }
                if(!empty($si_right)){
                    $x.=$si_right;
                }
                if(!empty($si_left)){
                    $x.=$si_left;
                }
                
                $x.="<div class='mt-5 container fluid' style='min-height:480px;'><div class='row row-sm'>";
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
                $x.='</div></div>';
                if(!empty($si_foot)){
                    $x.=$si_foot;
                }
                echo $x;
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
    
    public function check_add()
    {
        if(!empty($_POST['s']) && $_POST['s']=='s'){
            if(!empty($_POST['all'])){
                $a=explode(',',$_POST['all']);
                for($b=0;$b<=count($a)-1;$b++){
                    if(!empty($a[$b])){
                        $c[]=explode(":",$a[$b]);
                    }        
                }
                for($e=0;$e<=count($c)-1;$e++){
                    switch($c[$e]['0']){
                        case 'post':
                            $post=$c[$e]['1'].',';
                            break;
                            
                        case 'content':
                            $content=$c[$e]['1'].',';
                            break;
                                
                        case 'box':
                            $box=$c[$e]['1'].',';
                            break;    
                                
                        case 'slider':
                            $slider=$c[$e]['1'].',';
                            break;
                        
                        case 'side':
                            $side=$c[$e]['1'].',';
                            break;
                    }
                }
                $data=[
                    'title'=>$this->direction_check($_POST['title']),
                    'post_id'=>(!empty($post)?$post:NULL),
                    'slider_id'=>(!empty($slider)?$slider:NULL),
                    'side_id'=>(!empty($side)?$side:NULL),
                    'content_id'=>(!empty($content)?$content:NULL),
                    'box_id'=>(!empty($box)?$box:NULL),
                    'link'=>$this->direction_check($_POST['link']),
                    'style'=>$this->direction_check($_POST['cssS']),
                    'all_element'=>$_POST['all'],
                    'logo'=>$this->direction_check($_POST['logo'])
                ];
                if(empty($this->Page_model->s_p_t($this->direction_check($_POST['title']) , $this->direction_check($_POST['link']) ) )){
                    echo ($this->Page_model->add($data)?1:0);
                    die();
                }
                echo 0;
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
    
    public function post_new(){
        if(!empty($_POST['send']) && $_POST['send'] == 'ok'){
            if(!empty($_POST['values']) && $_POST['values'] == '1' && is_numeric($_POST['values'])){
                $info=$this->post_id();
                $x='';
                foreach($info as $key => $val){
                    $x.='<option value="'.$key.'">'.$val.'</option>';
                }    
                echo $x;
                exit();
            }else{
                header('Location :'.base_url().'err'.DS.'not_found');
                exit();
            }
        }else{
            header('Location :'.base_url().'err'.DS.'not_found');
            exit();
        }
    }
    
    public function post_id()
    {
        $post_id=[
            'none'=>'انتخاب کنید',
            '0'=>'افزودن دستی'
        ];
        $a=$this->Page_model->s_post();
        if(!empty($a)){
            foreach($a as $b){
                $post_id[$b['id']]=$b['title'];
            }
        }
        return $post_id;
    }
    
    public function slider_new(){
        if(!empty($_POST['send']) && $_POST['send'] == 'send'){
            if(!empty($_POST['values']) && $_POST['values'] == '1' && is_numeric($_POST['values'])){
                $info=$this->slider_id();
                $x='';
                foreach($info as $key => $val){
                    $x.='<option value="'.$key.'">'.$val.'</option>';
                }    
                echo $x;
                exit();
            }else{
                header('Location :'.base_url().'err'.DS.'not_found');
                exit();
            }
        }else{
            header('Location :'.base_url().'err'.DS.'not_found');
            exit();
        }
    }
    
    public function slider_id()
    {
         $slider_id =[
            'none'=>'انتخاب کنید',
            '0'=>'افزودن دستی'
        ];
        $c=$this->Page_model->s_slider();
        if(!empty($c)){
            foreach($c as $d){
                $slider_id[$d['id']]=$d['title'];
            }
        }
        return $slider_id;
    }
    
    public function side_new(){
         if(!empty($_POST['send']) && $_POST['send'] == 'ok'){
            if(!empty($_POST['y']) && $_POST['y'] == '1' && is_numeric($_POST['y'])){
                $info=$this->side_id();
                $x='';
                foreach($info as $key => $val){
                    $x.='<option value="'.$key.'">'.$val.'</option>';
                }    
                echo $x;
                exit();
            }else{
                header('Location :'.base_url().'err'.DS.'not_found');
                exit();
            }
        }else{
            header('Location :'.base_url().'err'.DS.'not_found');
            exit();
        }
    }
    
    public function side_id()
    {
        $side_id=[
            'none'=>'انتخاب کنید',
            '0'=>'افزودن دستی'
        ];
        $e=$this->Page_model->s_side();
        if(!empty($e)){
            foreach($e as $f){
                $side_id[$f['id']]=$f['title'];
            }
        }
        return $side_id;
    }
    
    public function content_new(){
        if(!empty($_POST['send']) && $_POST['send'] == 'send'){
            if(!empty($_POST['values']) && $_POST['values'] == '1' && is_numeric($_POST['values'])){
                $info=$this->content_id();
                $x='';
                foreach($info as $key => $val){
                    $x.='<option value="'.$key.'">'.$val.'</option>';
                }    
                echo $x;
                exit();
            }else{
                header('Location :'.base_url().'err'.DS.'not_found');
                exit();
            }
        }else{
            header('Location :'.base_url().'err'.DS.'not_found');
            exit();
        }
    }
    
    public function content_id()
    {
        $content_id=[
            'none'=>'انتخاب کنید',
            '0'=>'افزودن دستی'
        ];
        $g=$this->Page_model->s_content();
        if(!empty($g)){
            foreach($g as $h){
               $content_id[$h['id']] =$h['title'];
            }
        }
        return $content_id;
    }
    
    public function box_new()
    {
        if(!empty($_POST['send']) && $_POST['send'] == 'send'){
            if(!empty($_POST['values']) && $_POST['values'] == '1' && is_numeric($_POST['values'])){
                $info=$this->box_id();
                $x='';
                foreach($info as $key => $val){
                    $x.='<option value="'.$key.'">'.$val.'</option>';
                }    
                echo $x;
                exit();
            }else{
                header('Location :'.base_url().'err'.DS.'not_found');
                exit();
            }
        }else{
            header('Location :'.base_url().'err'.DS.'not_found');
            exit();
        }
    }
    
    public function box_id()
    {
        $box_id =[
            'none'=>'انتخاب کنید',
            '0'=>'افزودن دستی'
        ];
        $i=$this->Page_model->s_box();
        if(!empty($i)){
            foreach($i as $j){
               $box_id[$j['id']] =$j['title'];
            }
        }
        return $box_id;
    }
    
    public function add()
    {
        if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
            $title=[
                'name'=>'title',
                'class'=>'form-control rounded-5',
                'id'=>'title',
                'value'=>set_value('title'),
                'placeholder'=>'عنوان صفحه',
                'type'=>'text'
            ];
            $post_id=$this->post_id();
            $slider_id = $this->slider_id();
            $side_id=$this->side_id();
            $content_id=$this->content_id();
            $box_id =$this->box_id();
            $link=[
               'name'=>'link',
                'class'=>'form-control rounded-5',
                'id'=>'link',
                'value'=>set_value('link'),
                'placeholder'=>'آدرس صفحه',
                'type'=>'text' 
            ];
            $style=[
               'name'=>'style',
                'class'=>'form-control rounded-5 dir-ltr',
                'id'=>'style',
                'value'=>set_value('style'),
                'placeholder'=>'css',
                'type'=>'text' 
            ];
            $btn=['class'=>"btn btn-main-primary btn-block rounded-5",
                'value'=>'افزودن',
                'type'=>'button',
                'id'=>'send',
                'name'=>'send',
                'content'=>'افزودن',
                'style'=>'height:40px;'
            ];
            $info=[
                'b' => form_dropdown('post', $post_id, 'none', array('class' => 'rounded-5 form-control', 'id' => 'post')),
                'c' => form_dropdown("slider", $slider_id, 'none', array('class' => 'rounded-5 form-control', 'id' => 'slider')),
                'd' => form_dropdown("side", $side_id, 'none', array('class' => 'rounded-5 form-control', 'id' => 'side')),
                'e' => form_dropdown("contentS", $content_id, 'none', array('class' => 'rounded-5 form-control', 'id' => 'contentS')),
                'f' => form_dropdown('box', $box_id, 'none', array('class' => 'rounded-5 form-control', 'id' => 'box')),
                'title'=>$title,
                'link'=>$link,
                'style'=>$style,
                'btn'=>$btn
            ];
            echo $this->Page_model->render_page('افزودن صفحه','panel/add_page.php',$info);
        }else{
            header('Location :'.base_url().'err'.DS.'no_access');
            exit();
        }
    }
    
    public function check_edit()
    {
         if(!empty($_POST['s']) && $_POST['s']=='s'){
            if(!empty($_POST['all']) && !empty($_POST['id']) && is_numeric($_POST['id'])){
                
                $a=explode(',',$_POST['all']);
                 for($b=0;$b<=count($a)-1;$b++){
                    if(!empty($a[$b])){
                        $c[]=explode(":",$a[$b]);
                    }        
                }
                for($e=0;$e<=count($c)-1;$e++){
                    switch($c[$e]['0']){
                        case 'post':
                            $post=$c[$e]['1'].',';
                            break;
                            
                        case 'content':
                            $content=$c[$e]['1'].',';
                            break;
                                
                        case 'box':
                            $box=$c[$e]['1'].',';
                            break;    
                                
                        case 'slider':
                            $slider=$c[$e]['1'].',';
                            break;
                        
                        case 'side':
                            $side=$c[$e]['1'].',';
                            break;
                    }
                }
                $data=[
                    'title'=>$this->direction_check($_POST['title']),
                    'post_id'=>(!empty($post)?$post:NULL),
                    'slider_id'=>(!empty($slider)?$slider:NULL),
                    'side_id'=>(!empty($side)?$side:NULL),
                    'content_id'=>(!empty($content)?$content:NULL),
                    'box_id'=>(!empty($box)?$box:NULL),
                    'link'=>$this->direction_check($_POST['link']),
                    'style'=>$this->direction_check($_POST['cssS']),
                    'all_element'=>$_POST['all'],
                    'logo'=>$this->direction_check($_POST['logo'])
                ];
                echo ($this->Page_model->edit($data,$_POST['id'])?1:0);
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
    
    public function edit($id)
    {
        if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
        if(is_numeric($id)&&!empty($id)){
            $info_id=$this->Page_model->s_p_i($id);
            if(!empty($info_id)){
                $post_s_ids=$content_s_ids=$box_s_ids=$slider_s_ids=$side_s_ids=$post_s_html=$content_s_html=$box_s_html=$slider_s_html=$side_s_html=$all_s_html='';
                $title=[
                    'name'=>'title',
                    'class'=>'form-control rounded-5',
                    'id'=>'title',
                    'value'=>$info_id['0']['title'],
                    'placeholder'=>'عنوان صفحه',
                    'type'=>'text'
                ];
                $allE=$info_id['0']['all_element'];
                $z=explode(',',$allE);
                for($x=0;$x<=count($z)-1;$x++){
                    $y[]=explode(':',$z[$x]);
                }
                for($v=0;$v<=count($y)-1;$v++){
                    switch($y[$v]['0']){
                        case 'post':
                            $post_s_ids.=$y[$v]['1'].':'.$y[$v]['2'].',';
                            $post_id_s=$this->Page_model->post($y[$v]['1']);
                            $post_s_html.='<div class="li">'.$post_id_s['0']['title'].'<input type="hidden" value="'.$post_id_s['0']['id'].':'.$y[$v]['2'].'"></div>';
                            $all_s_html.='<div class="li">'.$post_id_s['0']['title'].'<input type="hidden" class="dani" value="post:'.$post_id_s['0']['id'].':'.$y[$v]['2'].'"></div>';
                            break;
                            
                        case 'content':
                            $content_s_ids.=$y[$v]['1'].':'.$y[$v]['2'].',';
                            $content_id_s=$this->Page_model->content($y[$v]['1']);
                            $content_s_html.='<div class="li">'.$content_id_s['0']['title'].'<input type="hidden" value="'.$content_id_s['0']['id'].':'.$y[$v]['2'].'"></div>';
                            $all_s_html.='<div class="li">'.$content_id_s['0']['title'].'<input type="hidden" class="dani" value="content:'.$content_id_s['0']['id'].':'.$y[$v]['2'].'"></div>';
                            break;
                                
                        case 'box':
                            $box_s_ids.=$y[$v]['1'].':'.$y[$v]['2'].',';
                            $box_id_s=$this->Page_model->box($y[$v]['1']);
                            $box_s_html.='<div class="li">'.$box_id_s['0']['title'].'<input type="hidden" value="'.$box_id_s['0']['id'].':'.$y[$v]['2'].'"></div>';
                            $all_s_html.='<div class="li">'.$box_id_s['0']['title'].'<input type="hidden" class="dani" value="box:'.$box_id_s['0']['id'].':'.$y[$v]['2'].'"></div>';
                            break;    
                                
                        case 'slider':
                            $slider_s_ids.=$y[$v]['1'].':'.$y[$v]['2'].',';
                            $slider_id_s=$this->Page_model->slider($y[$v]['1']);
                            $slider_s_html.='<div class="li">'.$slider_id_s['0']['title'].'<input type="hidden" value="'.$slider_id_s['0']['id'].':'.$y[$v]['2'].'"></div>';
                            $all_s_html.='<div class="li">'.$slider_id_s['0']['title'].'<input type="hidden" class="dani" value="slider:'.$slider_id_s['0']['id'].':'.$y[$v]['2'].'"></div>';
                            break;
                        
                        case 'side':
                            $side_s_ids.=$y[$v]['1'].':'.$y[$v]['2'].',';
                            $side_id_s=$this->Page_model->side($y[$v]['1']);
                            $side_s_html.='<div class="li">'.$side_id_s['0']['title'].'<input type="hidden" value="'.$side_id_s['0']['id'].':'.$y[$v]['2'].'"></div>';
                            $all_s_html.='<div class="li">'.$side_id_s['0']['title'].'<input type="hidden" class="dani" value="side:'.$side_id_s['0']['id'].':'.$y[$v]['2'].'"></div>';
                            break;
                    }
                }
                $post_id=$this->post_id();
                $slider_id = $this->slider_id();
                $side_id=$this->side_id();
                $content_id=$this->content_id();
                $box_id =$this->box_id();
                $link=[
                   'name'=>'link',
                    'class'=>'form-control rounded-5',
                    'id'=>'link',
                    'value'=>$info_id['0']['link'],
                    'placeholder'=>'آدرس صفحه',
                    'type'=>'text' 
                ];
                $style=[
                   'name'=>'style',
                    'class'=>'form-control rounded-5',
                    'id'=>'style',
                    'value'=>$info_id['0']['style'],
                    'placeholder'=>'css دلخواه',
                    'type'=>'text' 
                ];
                $btn=['class'=>"btn btn-main-primary btn-block rounded-5",
                    'value'=>'ویرایش',
                    'type'=>'button',
                    'id'=>'send',
                    'name'=>'send',
                    'content'=>'ویرایش',
                    'style'=>'height:40px;'
                ];
                $info=[
                    'b' => form_dropdown('post', $post_id, 'none', array('class' => 'rounded-5 form-control', 'id' => 'post')),
                    'c' => form_dropdown("slider", $slider_id, 'none', array('class' => 'rounded-5 form-control', 'id' => 'slider')),
                    'd' => form_dropdown("side", $side_id, 'none', array('class' => 'rounded-5 form-control', 'id' => 'side')),
                    'e' => form_dropdown("contentS", $content_id, 'none', array('class' => 'rounded-5 form-control', 'id' => 'contentS')),
                    'f' => form_dropdown('box', $box_id, 'none', array('class' => 'rounded-5 form-control', 'id' => 'box')),
                    'pic'=>(!empty($info_id['0']['logo'])?$info_id['0']['logo']:''),
                    'post_html_e'=>$post_s_html,
                    'content_html_e'=>$content_s_html,
                    'box_html_e'=>$box_s_html,
                    'slider_html_e'=>$slider_s_html,
                    'side_html_e'=>$side_s_html,
                    'all_html_e'=>$all_s_html,
                    'edit'=>$id,
                    'title'=>$title,
                    'post_s'=>$post_s_ids,
                    'slider_s'=>$slider_s_ids,
                    'side_s'=>$side_s_ids,
                    'content_s'=>$content_s_ids,
                    'box_s'=>$box_s_ids,
                    'all_s'=>$info_id['0']['all_element'],
                    'link'=>$link,
                    'style'=>$style,
                    'btn'=>$btn
                ];
                echo $this->Page_model->render_page('ویرایش صفحه','panel/add_page.php',$info);
            }else{
                header('Location :'.base_url().'err'.DS.'not_found');
                exit();
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
    
    public function direction_check($text = '')
    {
        return empty($text) ? '' : strip_tags($text, '<p><a>');
    }

    public function check_xss($text = "")
    {
        return empty($text) ? '' : addslashes($text);
    }

    public function disable($id)
    {
        if (is_numeric($id) && !empty($id)) {
            if ($this->Page_model->dis($id)) {
                header('location :' . base_url() . 'page');
                exit();
            }
        }
        return false;
    }

    public function enable($id)
    {
        if (is_numeric($id) && !empty($id)) {
            if ($this->Page_model->en($id)) {
                header('location :' . base_url() . 'page');
                exit();
            }
        }
        return false;
    }

    public function del($id)
    {
        if (is_numeric($id) && !empty($id)) {
            $p=($this->Page_model->del($id)?'?success=del':'?err=del');
            header('Location :'.base_url().'page'.$p);
            exit();
        } else {
            header('Location : ' . base_url() . 'err' . DS . 'not_found');
            exit();
        }
    }
  
}