<?php
header('Access-Control-Allow-Origin: *');
class Menu extends My_Controller{
    
    public function __construct(){
        parent::__construct();
    }
    
    public function index(){
         if($_SESSION['role'] == 'admin' && !empty($_SESSION['role'])){
        $info=$this->Menu_model->select_join('menu','sidebars_place','menu.*,sidebars_place.title as stitle','sidebars_place.id=menu.side_id');
		echo $this->Page_model->render_page('مدیریت منو ها','panel'.DS.'show_menu.php',['data'=>$info]);
    }else{
          header('Location :'.base_url().'err'.DS.'no_access');
            exit();   
        }
    }
    
    public function delete_menu($id){
        if(is_numeric($id) && !empty($id)){
            $a= (!empty($this->Menu_model->menu_w_p($id))?'?hasChild=err':($this->Menu_model->del($id)?'?del=success':'?del=err'));
            header('Location :'.base_url().'menu'.$a);
            exit();
        }else{
             redirect(base_url()."err".DS.'not_found');
             exit();
        }
    }
 
    public function en_child($a,$id){
        $x= ($this->Menu_model->en(intval($id))?1:0);
        
        if(!empty($a) && is_array($a)){
            foreach($a as $b){
                $c=(!empty($this->Menu_model->menu_w_p($b['id']))?$this->Menu_model->menu_w_p($b['id']):'no');
                return $this->en_children($c,$b['id']);
            }
        }
        return $x;
    }
        
    public function en_children($a,$id){
        $x= ($this->Menu_model->en(intval($id))?1:0);
        if(!empty($a) && is_array($a)){
            foreach($a as $b){
                $c=(!empty($this->Menu_model->menu_w_p($b['id']))?$this->Menu_model->menu_w_p($b['id']):'no');
                return $this->en_child($c,$b['id']);
            }
        }
        return $x;
    }
       
    public function dis_child($a,$id){
        $x= ($this->Menu_model->dis(intval($id))?1:0);
        if(!empty($a) && is_array($a)){
            foreach($a as $b){
                $c=(!empty($this->Menu_model->menu_w_p($b['id']))?$this->Menu_model->menu_w_p($b['id']):'no');
                return $this->dis_children($c,$b['id']);
            }
        }
        return $x;
    }   
    
    public function dis_children($a,$id){
         $x= ($this->Menu_model->dis(intval($id))?1:0);
        if(!empty($a) && is_array($a)){
            foreach($a as $b){
                $c=(!empty($this->Menu_model->menu_w_p($b['id']))?$this->Menu_model->menu_w_p($b['id']):'no');
                return $this->dis_child($c,$b['id']);
            }
        }
        return $x;
    }

    public function enable_menu($id){
        if(!empty($id) && is_numeric($id)){
            $a=(!empty($this->Menu_model->menu_w_p($id))?$this->Menu_model->menu_w_p($id):'no');
            if($this->en_child($a,$id) === 1){
                redirect(base_url()."menu");   
            }
        }
    }
    
    public function disable_menu($id){
        if(!empty($id) && is_numeric($id)){
            $a=(!empty($this->Menu_model->menu_w_p($id))?$this->Menu_model->menu_w_p($id):'no');
            if($this->dis_child($a,$id) == 1){
                redirect(base_url()."menu");   
            }
        }
    }
 
    //xss cleaner
    
    public function direction_check($text=''){
        return empty($text)?'':strip_tags($text, '<p><a>'); 
    }    
    
    public function check_xss($text=""){
        return empty($text)?'':addslashes($text);
    }

    public function side_place_id(){
        if(isset($_POST['selectBox']) && is_numeric($_POST['selectBox']) && !empty($_POST['selectBox'])){
            $side=$this->Side_model->side_w_id($_POST['selectBox']);
            if(!empty($side)){
                echo $side['0']['place'];
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    
    public function menuselectbox(){
        if(isset($_POST['selectBox']) && is_numeric($_POST['selectBox']) && !empty($_POST['selectBox'])){
            $menus=$this->Menu_model->menu_w_side($_POST['selectBox']);
            $p='<option value="0">خودش منوی مادر باشد</option>';
            if(!empty($menus)){
                foreach ($menus as $key){
                    
                    $p.='<option value="'.$key['id'].'">'.$key['title'].'</option>';
                }
            }
            echo $p;
        }else{
            return false;
        }
       
    }
    
    public function edit_menu_check(){
        if(isset($_POST['send']) && $_POST['send']=="ok"){
            if(!empty($_POST['id']) && isset($_POST['id'])){
                $id=$_POST['id'];
            }else{
                return false;
            }
            if(isset($_POST['title'])){
                $t= $this->check_xss($_POST['title']);
            }else{
                echo 0;
                die();
            }
            if(!is_numeric($_POST['side']) && $_POST['side'] == 0){
                echo 0;
                die();
            }else{
                $side=$_POST['side'];
                $asd=$this->Menu_model->select_where('sidebars_place',array('id'=>$side));
                if(!empty($asd)){
                    $pl=$asd['0']['place'];   
                }else{
                    echo 0;
                    die();
                }
            }
            $icons=(isset($_POST['icons']) && !empty($_POST['icons'])?$this->direction_check($_POST['icons']):'');
            $link=(isset($_POST['link']) && !empty($_POST['link'])?$this->direction_check($_POST['link']):'');
            $li=(isset($_POST['list_css']) && !empty($_POST['list_css'])?$this->direction_check($_POST['list_css']):'');
            $a=(isset($_POST['link_css']) && !empty($_POST['link_css'])?$this->direction_check($_POST['link_css']):''); 
            $ul=(isset($_POST['ul_css']) && !empty($_POST['ul_css'])?$this->direction_check($_POST['ul_css']):'');
            $h=(isset($_POST['custom_html']) && !empty($_POST['custom_html'])?$this->direction_check($_POST['custom_html']):'');
            $e=(isset($_POST['end_custom_html']) && !empty($_POST['end_custom_html'])?$this->direction_check($_POST['end_custom_html']):'');
            if(is_numeric($_POST['parent_id'])){
                if($_POST['parent_id'] == 0){
                    $menga_menu_p = ($_POST['mega'] == 1 ? 1 : 0);
                    $par_id = 0;
                }else{
                    $data_par = $this->Menu_model->select_where('menu',array('id'=>$_POST['parent_id']));
                    $menga_menu_p = ($_POST['mega'] == 1 && $data_par['0']['megaMenu'] == 1 ? 1 : ($_POST['mega'] == 0 && $data_par['0']['megaMenu'] == 1 ? 1 : 0));
                    if($menga_menu_p == 1){
                        $par_id = ($data_par['0']['parent_id'] == 0?$data_par['0']['id']:$data_par['0']['parent_id']);
                    }
                }
            }else{
                echo 0;
                die();
            }
            if(!empty($t) && !empty($side) && !empty($pl)){
                $data=[
                    'title'=>$t,
                    'link'=>$link,
                    'parent_id'=>$par_id,
                    'side_id'=>$side,
                    'icon_name'=>$icons,
                    'place'=>$pl,
                    'li_css'=>$li,
                    'link_css'=>$a,
                    'ul_css'=>$ul,
                    'custom_html'=>$h,
                    'end_custom_html'=>$e,
                    'megaMenu'=>$menga_menu_p
                    ];
                echo $this->Menu_model->edit("menu",$data,array('id'=>$id))?1:0;
            }else{
                echo 0;
                die();
            }
        }else{
            return false;
        }
    }

    public function edit_menu($id){
        if($_SESSION['role'] == 'admin' && !empty($_SESSION['role'])){
            if(!empty($id) && is_numeric($id)){     
                $info_m = $this->Menu_model->select_where('menu',array('id'=>$id));
                $n1=$info_m['0']['icon_name'];
                $p1=$info_m['0']['parent_id'];
                $q1=$info_m['0']['side_id'];
                $r1=$info_m['0']['megaMenu'];
                $n=    ['0'=>'انتخاب کنید'];
                $p=    ['0'=>'منوی والد باشد'];
                $q=    ['0'=>'انتخاب کنید'];
                $icons=$this->Menu_model->all_icons();
                $menus=$this->Menu_model->menus();
                $sides=$this->Side_model->sides();
                $condition=(!empty($sides))?true:false;
                $m=['name'=>'title',
                    'class'=>'form-control rounded-5',
                    'id'=>'title',
                    'value'=>$info_m['0']['title'],
                    'placeholder'=>'عنوان منو',
                    'type'=>'text'];
                foreach($icons as $val){
                    $n[$val['class']] = $val['title']." ".$val['shrtcd'];
                }
                $o=['name'=>'link',
                    'class'=>'form-control rounded-5',
                    'id'=>'link',
                    'value'=>$info_m['0']['link'],
                    'placeholder'=>'https://www.aseos.ir',
                    'type'=>'text'];
                foreach ($menus as $key){
                    $p[$key['id']]=$key['title'];
                }
                foreach ($sides as $value){
                    $q[$value['id']] = $value['title'];
                }
                $r=['0'=>'منوی ساده',
                    '1'=>'مگا منو'];
                
                $s=['name'=>'list_css',
                    'class'=>'form-control rounded-5',
                    'id'=>'list_css',
                    'value'=>$info_m['0']['li_css'],
                    'placeholder'=>'(li)',
                    'type'=>'text'];
                    
                $t=['name'=>'link_css',
                    'class'=>'form-control rounded-5',
                    'id'=>'link_css',
                    'value'=>$info_m['0']['link_css'],
                    'placeholder'=>'(a)',
                    'type'=>'text'];
                
                $u=['name'=>'ul_css',
                    'class'=>'form-control rounded-5',
                    'id'=>'ul_css',
                    'value'=>$info_m['0']['ul_css'],
                    'placeholder'=>'(ul)',
                    'type'=>'text'];
                    
                $v=['name'=>'custom_html',
                    'class'=>'form-control rounded-5',
                    'id'=>'custom_html',
                    'value'=>$info_m['0']['custom_html'],
                    'placeholder'=>'<html tags>',
                    'type'=>'text'];
                    
                $z=['name'=>'end_custom_html',
                    'class'=>'form-control rounded-5',
                    'id'=>'end_custom_html',
                    'value'=>$info_m['0']['end_custom_html'],
                    'placeholder'=>'</html tags> ',
                    'type'=>'text'];
        	    $data=['m'=>$m,'n'=>$n,'o'=>$o,'p'=>$p,'q'=>$q,'r'=>$r,'s'=>$s,'t'=>$t,'u'=>$u,'v'=>$v,'r1'=>$r1,'q1'=>$q1,'p1'=>$p1,'n1'=>$n1,'z'=>$z,'con'=>$condition,'edit'=>$id];
        	    echo $this->Page_model->render_page('ویرایش منو','panel'.DS.'add_menu.php',$data);
            }else{
                header('Location :'.base_url().'err'.DS.'not_found');
                exit();      
            }
        }else{
            header('Location :'.base_url().'err'.DS.'no_access');
            exit();   
        }
    }
     
    public function config_tag ($a,$b,$c=0){
        // $e=$this->security->entity_decode($a);
        $e=$a;
        $f=$b;
        // $f=$this->security->entity_decode($b);
        if($c == 0){
            if(!empty($e) && !empty($f)){
                $d=' class="'.$a.'" '.$b;
            }elseif(!empty($e) && empty($f)){
                $d=' class="'.$e.'"';
            }elseif(empty($e) && !empty($f)){
                $d=$f;
            }else{
                $d='';
            }
        }elseif($c == 1){
            if(!empty($e) && !empty($f)){
                $d=' class="sub-menu '.$a.'" '.$b;
            }elseif(!empty($e) && empty($f)){
                $d=' class="sub-menu '.$e.'"';
            }elseif(empty($e) && !empty($f)){
                $d=$f;
            }else{
                $d='';
            }
        }else{
            echo 0;
            die();
        }
        return $d;
    }
    
    public function check_add_menu(){//check bshe
        if($_POST['send'] =='ok' && !empty($_POST['send'])){
            if(!empty($_POST['title'])){
                $t=$this->direction_check($_POST['title']);
            }else{
                echo 0;
                die();
            }
            $a=(isset($_POST['link']) && !empty($_POST['link']))?$this->direction_check($_POST['link']):'#';
            
            $li1=(!empty($_POST['list_class'])?$this->direction_check($_POST['list_class']):'');
            $li2=(!empty($_POST['list_attr'])?$this->direction_check($_POST['list_attr']):'');
            $li3=$this->config_tag($li1,$li2);
           
            $li=$this->direction_check($li3);
            
            $link1=(isset($_POST['link_class']) && !empty($_POST['link_class'])?$this->direction_check($_POST['link_class']):'');
            $link2=(isset($_POST['link_attr']) && !empty($_POST['link_attr'])?$this->direction_check($_POST['link_attr']):'');
            $link3=$this->config_tag($link1,$link2);
           
            $link=$this->direction_check($link3);
            
            $ul1=(isset($_POST['ul_child_class']) && !empty($_POST['ul_child_class'])?$this->direction_check($_POST['ul_child_class']).'"':'');
            $ul2=(isset($_POST['ul_child_attr']) && !empty($_POST['ul_child_attr'])?$this->direction_check($_POST['ul_child_attr']):'');
            $ul3=$this->config_tag($ul1,$ul2,1);
           
            $ul=$this->direction_check($ul3);
            
            $c=(!empty($_POST['custom_html'])?$this->direction_check($_POST['custom_html']):'');
            $e=(!empty($_POST['end_custom_html'])?$this->direction_check($_POST['end_custom_html']):'');
    
            $ali=$this->Menu_model->select_where('sidebars_place',array('id'=>$_POST['side']));
            if(!empty($ali)){
                $p=$ali['0']['place'];
                $i=$ali['0']['id'];
            }else{
                echo 0;
                die();
            }
            $data_par = $this->Menu_model->select_where('menu',array('id'=>intval($_POST['parent_id'])));
            if(is_numeric($_POST['parent_id'])){
                if($_POST['parent_id'] == 0){
                    $menga_menu_p = ($_POST['mega'] == 1 ? 1 : 0);
                    $par_id = 0;
                }else{
                    if(!empty($data_par)){
                        $menga_menu_p = ($_POST['mega'] == 1 && $data_par['0']['megaMenu'] == 1 ? 1 : ($_POST['mega'] == 0 && $data_par['0']['megaMenu'] == 1 ? 1 : 0));
                        if($menga_menu_p == 1){
                            $par_id = ($data_par['0']['parent_id'] == 0?$data_par['0']['id']:$data_par['0']['parent_id']);
                        }else{
                            $par_id=intval($_POST['parent_id']);
                        }
                    }else{
                        $par_id=0;
                    }
                }
            }else{
                echo 0;
                die();
            }
            $abas = $this->Menu_model->select_where('menu',array('title'=>$t,'place'=>$p));
            if(empty($abas)){
                $data=array(
                    'title'=> $t,
                    'link'=> $a,
                    'parent_id'=> $par_id,
                    'side_id'=> $i,
                    'icon_name'=> $_POST['icons'],
                    'place'=>$p,
                    'li_css'=> $li,
                    'link_css'=>$link,
                    'ul_css'=>$ul,
                    'custom_html'=>$c,
                    'end_custom_html'=>$e,
                    'megaMenu'=>$menga_menu_p
                    );
                echo ($this->Menu_model->add("menu",$data)?1:0);
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
    
    public function add_menu(){
        if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
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

    		echo $this->Page_model->render_page('افزودن منو','panel'.DS.'add_menu.php',['m'=>$m,'n'=>$n,'o'=>$o,'p'=>$p,'q'=>$q,'r'=>$r,'s'=>$s,'t'=>$t,'u'=>$u,'v'=>$v,'w'=>$w,'x'=>$x,'y'=>$y,'z'=>$z,'con'=>(!empty($sides)?true:false)]);
        }else{
            header('Location :'.base_url().'err'.DS.'no_access');
            exit();   
        }
    }
        
}