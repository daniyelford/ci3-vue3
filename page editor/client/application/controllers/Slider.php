<?php

class Slider extends MY_Controller
{


    public function __construct()
    {
        parent::__construct();
    }
    
    
    public function check_edit()
    {
        if(is_numeric($_POST['id']) && !empty($_POST['id']) && !empty($_POST['send']) && $_POST['send']=='send'){
            $data=[
                'title'=>$this->direction_check($_POST['title']),
                'style'=>(!empty($_POST['style'])?$this->direction_check($_POST['style']):''),
                'pic_id'=>$_POST['pi'],
                's_h'=>(!empty($_POST['s_h'])?$this->direction_check($_POST['s_h']):''),
                'e_h'=>(!empty($_POST['e_h'])?$this->direction_check($_POST['e_h']):''),
                'type'=>$_POST['type']
            ];
            echo ($this->Slider_model->edit($data,$_POST['id'])?1:0);
            die();
        }else{
            header('Location :'.base_url().'err'.DS.'not_found');
            exit();
        }
    }
    
    public function edit($id)
    { 
        if($_SESSION['role'] == 'admin' && !empty($_SESSION['role'])){

            if(is_numeric($id)&&!empty($id)){
                $info=$this->Slider_model->slider($id);
                $t = ['name' => 'title',
                    'class' => 'form-control rounded-5',
                    'id' => 'title',
                    'value' => $info['0']['title'],
                    'placeholder' => 'عنوان جعبه را وارد کنید',
                    'type' => 'text'];
            
                $s = ['name' => 'style',
                    'class' => 'form-control rounded-5 dir_ltr',
                    'id' => 'style',
                    'value' => $info['0']['style'],
                    'placeholder' => 'css دلخواه',
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
                    '1'=>'indicators',   
                    '2'=>'dark indicators',
                    '3'=>'inner',
                    '4'=>'dark inner',
                    '5'=>'fade',
                    '6'=>'dark fade'
                ];
                
                $type=form_dropdown('type', $si,$info['0']['type'] , array('class' => 'rounded-5 SlectBox form-control', 'id' => 'type'));
                
                $pi=$this->Slider_model->pics();
                $pictures=[];
                $pics = (!empty($info['0']['pic_id'])?explode(',', $info['0']['pic_id']):NULL);
                    if(!is_null($pics)){
                        for($as=0;$as<=count($pics)-1;$as++){
                            $shit=explode(':',$pics[$as]);
                            if($shit['0'] != '0' && !empty($shit['0']) && is_numeric($shit['0'])){
                                $picture_ko=$this->Slider_model->pic($shit['0']);
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
                    'st'=>$s,
                    'all_pic'=>$pi,
                    'pics'=>$pictures,
                   
                    's_h'=>$sh,
                    'e_h'=>$eh,
                    'type'=>$type
                ];
                echo $this->Page_model->render_page('ویرایش اسلایدر ها','panel/add_slider.php',$data);
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
        if(!empty($_POST['send']) && $_POST['send']=='send' && !empty($_POST['title'])){
            $a=explode(',',$_POST['pi']);
            $d='';
            for($b=0;$b<=count($a)-1;$b++){
                $c=explode(':',$a[$b]);
                $d.=$c['0'].',';
            }
            $data=[
                'title'=>$this->direction_check($_POST['title']),
                'style'=>(!empty($_POST['style'])?$this->direction_check($_POST['style']):''),
                'pic_id'=>$d,
                's_h'=>(!empty($_POST['s_h'])?$this->direction_check($_POST['s_h']):''),
                'e_h'=>(!empty($_POST['e_h'])?$this->direction_check($_POST['e_h']):''),
                'type'=>(!empty($_POST['type']) && is_numeric($_POST['type'])?$_POST['type']:0),
                'status'=>0,
            ];
            echo ($this->Slider_model->add($data)?1:0);
            die();
        }else{
            header('Location :'.base_url().'err'.DS.'not_found');
            exit();
        }
    }
    
    
    
    public function add()
    {
        if($_SESSION['role'] == 'admin' && !empty($_SESSION['role'])){
   
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
        
        $pi=$this->Slider_model->pics();

        $data=[
            'ti'=>$t,
            'st'=>$s,
            'all_pic'=>$pi,
            's_h'=>$sh,
            'e_h'=>$eh,
            'type'=>$type
        ];
        echo $this->Page_model->render_page('افزودن اسلایدر','panel/add_slider.php',$data);   
        }else{
          header('Location :'.base_url().'err'.DS.'no_access');
            exit();   
        }
    }
    
    public function index()
    {
        if($_SESSION['role'] == 'admin' && !empty($_SESSION['role'])){
        $info=$this->Slider_model->s_s();
        $num=1;
        $x=$pic=$z='';
        foreach($info as $val){
            if(!empty($val['pic_id'])){
                $a=explode(',',$val['pic_id']);
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
            }
            $x.="<tr><th scope='row'>". $num ."</th><td>". $val['title'] ."</td>";
            
      	    $x.='<td style="width: 100px;height: 100px;text-align: center;"><div class="carousel slide" style="margin-top: 20px;margin-bottom: -21px;" data-ride="carousel" id="carouselExampleSlidesOnly"><div class="carousel-inner">';
			
			$x.=(!empty($val['pic_id'])?$z:'-');
			
			$x.='</div></div></td><td>';
			$x.=(!empty($val['style'])?'دارد':'ندارد');
			$x.="</td><td>";
			$x.=(!empty($val['s_h'])?'دارد':'ندارد');
			$x.="</td><td>";
			$x.=(empty($val['type']) || $val['type']== 0 || is_null($val['type'])?'-':($val['type']==1?'indicators':($val['type']=='2'?'dark indicators':($val['type']=='3'?'inner':($val['type']=='4'?'dark inner':($val['type']=='5'?'fade':'dark fade'))))));
			$x.="</td><td>";
			$x.=($val['status'] == 1?"<a class='btn btn-block btn-warning-gradient pd-x-25 rounded-10 box-shadow-pink' href='". base_url()."slider".DS."disable".DS.$val['id']."'>غیر فعال</a>":"<a class='btn btn-block btn-success-gradient pd-x-25 rounded-10 box-shadow-success' href='". base_url()."slider".DS."enable".DS.$val['id']."'>فعال</a>");
			$x.="</td><td><a class='btn btn-danger-gradient pd-x-25 rounded-10 box-shadow-pink ml-1' href='". base_url()."slider".DS."del".DS.$val['id']."'>حذف</a><a class='btn btn-info-gradient pd-x-25 rounded-10 box-shadow-primary' href='". base_url()."slider".DS."edit".DS.$val['id']."'>ویرایش</a></td></tr>";
		    $num++;
	    }
        echo $this->Page_model->render_page('اسلایدر ها','panel/slider.php',['x'=>$x]);
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
            if ($this->Slider_model->dis($id)) {
                header('location :' . base_url() . 'slider');
                exit();
            }
        }
        return false;
    }
    
    public function enable($id)
    {
        if (is_numeric($id) && !empty($id)) {
            if ($this->Slider_model->en($id)) {
                header('location :' . base_url() . 'slider');
                exit();
            }
        }
        return false;
    }

    public function del($id)
    {
        if (is_numeric($id) && !empty($id)) {
            $p=($this->Slider_model->del($id)?'?success=del':'?err=del');
            header('Location :'.base_url().'slider'.$p);
            exit();
        } else {
            header('Location : ' . base_url() . 'err' . DS . 'not_found');
            exit();
        }
    }
    
}