<?php

class Box extends MY_Controller
{


    public function __construct()
    {
        parent::__construct();
    }
    
    public function check_edit(){
        if(is_numeric($_POST['id']) && !empty($_POST['id']) && !empty($_POST['send']) && $_POST['send']=='send'){
            $data=[
                'title'=>$this->direction_check($_POST['title']),
                'content'=>$this->direction_check($_POST['content']),
                'style'=>(!empty($_POST['style'])?$this->direction_check($_POST['style']):''),
                'pic'=>$_POST['pi'],
                'link'=>(!empty($_POST['link'])?$this->direction_check($_POST['link']):''),
                's_h'=>(!empty($_POST['s_h'])?$this->direction_check($_POST['s_h']):''),
                'e_h'=>(!empty($_POST['e_h'])?$this->direction_check($_POST['e_h']):''),
                'size'=>$_POST['size']
            ];
            echo ($this->Box_model->edit($data,$_POST['id'])?1:0);
            die();
        }else{
            header('Location :'.base_url().'err'.DS.'not_found');
            exit();
        }
    }
    
    public function edit($id){
        if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
        if(is_numeric($id)&&!empty($id)){
            $info=$this->Box_model->box($id);
            $t = ['name' => 'title',
                'class' => 'form-control rounded-5',
                'id' => 'title',
                'value' => $info['0']['title'],
                'placeholder' => 'عنوان جعبه را وارد کنید',
                'type' => 'text'];
        
            $c = ['name' => 'content',
                'class' => 'form-control rounded-5',
                'id' => 'content',
                'value' => $info['0']['content'],
                'placeholder' => 'متن جعبه را وارد کنید',
                'type' => 'text'];
                    
            $s = ['name' => 'style',
                'class' => 'form-control rounded-5 dir_ltr',
                'id' => 'style',
                'value' => $info['0']['style'],
                'placeholder' => 'css دلخواه',
                'type' => 'text'];
                
            $l=['name' => 'link',
                'class' => 'form-control rounded-5',
                'id' => 'link',
                'value' => $info['0']['link'],
                'placeholder' => 'لینک جعبه را وارد کنید',
                'type' => 'text'];
                
            $sh=['name' => 's_h',
                'class' => 'form-control rounded-5 dir_ltr',
                'id' => 's_h',
                'value' => $info['0']['s_h'],
                'placeholder' => 'تگ های آغاز html دلخواه',
                'type' => 'text'];
                
            $eh=['name' => 'e_h',
                'class' => 'form-control rounded-5 dir_ltr',
                'id' => 'e_h',
                'value' => $info['0']['e_h'],
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
            
            $size=form_dropdown('size', $si,$info['0']['size'] , array('class' => 'rounded-5 SlectBox form-control', 'id' => 'size'));
            
            $pi=$this->Box_model->pics();
            $pictures=[];
            $pics = (!empty($info['0']['pic'])?explode(',', $info['0']['pic']):NULL);
            if(!is_null($pics)){
                for($as=0;$as<=count($pics)-1;$as++){
                    $piccc=explode(':',$pics[$as]);
                    if(!empty($piccc['0'])&&$piccc['0']!='0'){
                        $picture_ko=$this->Box_model->pic($piccc['0']);
                        if(!empty($picture_ko)){
                            $pictures[$as]=['id'=>$picture_ko['0']['id'],'name'=>$picture_ko['0']['name']];
                        }
                    }
                }
            }else{
                header('Location :'.base_url().'err'.DS.'not_found');
                die();
            }
            $data=[
                'edit'=>$id,
                'ti'=>$t,
                'co'=>$c,
                'st'=>$s,
                'all_pic'=>$pi,
                'pics'=>$pictures,
                'link'=>$l,
                's_h'=>$sh,
                'e_h'=>$eh,
                'size'=>$size
            ];
            echo $this->Page_model->render_page('ویرایش جعبه ها','panel/add_box.php',$data);
        }else{
            header('Location :'.base_url().'err'.DS.'not_found');
            exit();
        }
        }else{
          header('Location :'.base_url().'err'.DS.'no_access');
            exit();   
        }
    }
    
    public function check_add()
    {
        if(!empty($_POST['send']) && $_POST['send']=='send' && !empty($_POST['title']) && !empty($_POST['content']) && !empty($_POST['size']) && is_numeric($_POST['size']) && $_POST['size'] != '0'){
            $a=explode(',',$_POST['pi']);
            $d='';
            for($b=0;$b<=count($a)-1;$b++){
                $c=explode(':',$a[$b]);
                $d.=$c['0'].',';
            }
            $data=[
                'title'=>$this->direction_check($_POST['title']),
                'content'=>$this->direction_check($_POST['content']),
                'style'=>(!empty($_POST['style'])?$this->direction_check($_POST['style']):''),
                'pic'=>$d,
                'link'=>(!empty($_POST['link'])?$this->direction_check($_POST['link']):''),
                's_h'=>(!empty($_POST['s_h'])?$this->direction_check($_POST['s_h']):''),
                'e_h'=>(!empty($_POST['e_h'])?$this->direction_check($_POST['e_h']):''),
                'size'=>$_POST['size'],
                'status'=>0,
            ];
            echo ($this->Box_model->add($data)?1:0);
            die();
        }else{
            header('Location :'.base_url().'err'.DS.'not_found');
            exit();
        }
    }
    
    public function add()
    {
         if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
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
        
        $pi=$this->Box_model->pics();

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
        echo $this->Page_model->render_page('افزودن جعبه','panel/add_box.php',$data);
         }else{
          header('Location :'.base_url().'err'.DS.'no_access');
            exit();   
        }
    }
    
    public function index()
    {
        if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
        $info=$this->Box_model->s_b();
        $num=1;
        $x=$z='';
        foreach($info as $val){
            if(!empty($val['pic'])){
                $a=explode(',',$val['pic']);
                if(!empty($a['0'])){
                    $d=explode(':',$a['0']);
                    $f=$this->Box_model->pic($d['0']);
                    if(!empty($f)){
                        $z.='<div class="carousel-item active"> <img class="card-img-top w-100" src="'.base_url().'pic'.DS.$f['0']['name'].'" alt="picture"/></div>';
                    }
                    for($b=1;$b<=count($a)-1;$b++){
                        $c=explode(':',$a[$b]);   
                        $y=$this->Box_model->pic($c['0']);
                        if(!empty($y)){
                            $z.='<div class="carousel-item"> <img class="card-img-top w-100" src="'.base_url().'pic'.DS.$y['0']['name'].'" alt="picture"/></div>';
                        }
                    }
                }else{
                    $d=explode(':',$a['1']);
                    $f=$this->Box_model->pic($d['0']);
                    if(!empty($f)){
                        $z.='<div class="carousel-item active"> <img class="card-img-top w-100" src="'.base_url().'pic'.DS.$f['0']['name'].'" alt="picture"/></div>';
                    }
                    for($b=2;$b<=count($a)-1;$b++){
                        $c=explode(':',$a[$b]);   
                        $y=$this->Box_model->pic($c['0']);
                        if(!empty($y)){
                            $z.='<div class="carousel-item"> <img class="card-img-top w-100" src="'.base_url().'pic'.DS.$y['0']['name'].'" alt="picture"/></div>';
                        }
                    }
                }
            }
            $x.="<tr><th scope='row'>". $num ."</th><td>". $val['title'] ."</td><td>";
			$x.=(!empty($val['content'])?$val['content']:'-');
			$x.="</td><td>";
			$x.=(!empty($val['link'])?$val['link']:'-');
			$x.='</td><td style="width: 100px;height: 100px;text-align: center;"><div class="carousel slide" style="margin-top: 20px;margin-bottom: -21px;" data-ride="carousel" id="carouselExampleSlidesOnly"><div class="carousel-inner">';
			
			$x.=(!empty($val['pic'])?$z:'');
			
			$x.='</div></div></td><td>';
			$x.=(!empty($val['size']) && $val['size']== 0 ?'-':($val['size']==1?'خیلی بزرگ':($val['size']=='2'?'بزرگ':($val['size']=='3'?'نسبتا بزرگ':($val['size']=='4'?'متوسط':($val['size']=='5'?'کوچک':'خیلی کوچک'))))));
			$x.="</td><td>";
			$x.=($val['status'] == 1?"<a class='btn btn-block btn-warning-gradient pd-x-25 rounded-10 box-shadow-pink' href='". base_url()."box".DS."disable".DS.$val['id']."'>غیر فعال</a>":"<a class='btn btn-block btn-success-gradient pd-x-25 rounded-10 box-shadow-success' href='". base_url()."box".DS."enable".DS.$val['id']."'>فعال</a>");
			$x.="</td><td><a class='btn btn-danger-gradient pd-x-25 rounded-10 box-shadow-pink ml-1' href='". base_url()."box".DS."del".DS.$val['id']."'>حذف</a><a class='btn btn-info-gradient pd-x-25 rounded-10 box-shadow-primary' href='". base_url()."box".DS."edit".DS.$val['id']."'>ویرایش</a></td></tr>";
		    $num++;
	    }
        echo $this->Page_model->render_page('جعبه ها','panel/box.php',['x'=>$x]);
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
            if ($this->Box_model->dis($id)) {
                header('location :' . base_url() . 'box');
                exit();
            }
        }
        return false;
    }
    
    public function enable($id)
    {
        if (is_numeric($id) && !empty($id)) {
            if ($this->Box_model->en($id)) {
                header('location :' . base_url() . 'box');
                exit();
            }
        }
        return false;
    }

    public function del($id)
    {
        if (is_numeric($id) && !empty($id)) {
            $p=($this->Box_model->del($id)?'?success=del':'?err=del');
            header('Location :'.base_url().'box'.$p);
            exit();
        } else {
            header('Location : ' . base_url() . 'err' . DS . 'not_found');
            exit();
        }
    }
    
}