<?php
header('Access-Control-Allow-Origin: *');

class Post extends My_Controller
{

    public function __construct()
    {
        parent::__construct();
    }
    
    public function media_player(){
        $data=[];
        echo $this->Page_model->render_page('media','panel/media',$data);
    }

    public function buy(){
        if(!empty($_POST['send']) && $_POST['send']=='s'){
            if(!empty($_POST['id']) && $_POST['id'] != 0){
                if(!empty($_SESSION['id'])){
                    $data=['user_id'=>intval($_SESSION['id']),'post_id'=>intval($_POST['id'])];
                    echo ($this->Post_model->pro($data)?1:2);
                    die();
                }else{
                    echo 0;
                    die();
                }
            }else{
                header('Location :'.base_url().'err'.DS.'not_found');
                exit();
            }
        }else{
            header('Location :'.base_url().'err'.DS.'not_found');
            exit();
        }
    }

    public function index()
    {
        if(!empty($_SESSION['role']) && $_SESSION['role'] == 'admin'){
            $info=$this->Post_model->show_post();
            $num=1;
            $x=$z='';
            foreach($info as $val){
                if(!empty($val['pic_id'])){
                    $a=explode(',',$val['pic_id']);
                    if(!empty($a['0'])){
                        $d=explode(':',$a['0']);
                        $f=(!empty($d['0'])?$this->Post_model->p_s_n($d['0']):'');
                        if(!empty($f)){
                            $z.='<div class="carousel-item active"> <img class="card-img-top w-100" src="'.base_url().'pic'.DS.$f['0']['name'].'" alt="picture"/></div>';
                        }
                        for($b=1;$b<=count($a)-1;$b++){
                            $c=explode(':',$a[$b]);   
                            $y=(!empty($c['0'])?$this->Post_model->p_s_n($c['0']):'');
                            if(!empty($y)){
                                $z.='<div class="carousel-item"> <img class="card-img-top w-100" src="'.base_url().'pic'.DS.$y['0']['name'].'" alt="picture"/></div>';
                            }
                        }
                    }else{
                        $d=explode(':',$a['1']);
                        $f=(!empty($d['0'])?$this->Post_model->p_s_n($d['0']):'');
                        if(!empty($f)){
                            $z.='<div class="carousel-item active"> <img class="card-img-top w-100" src="'.base_url().'pic'.DS.$f['0']['name'].'" alt="picture"/></div>';
                        }
                        for($b=2;$b<=count($a)-1;$b++){
                            $c=explode(':',$a[$b]);   
                            $y=(!empty($c['0'])?$this->Post_model->p_s_n($c['0']):'');
                            if(!empty($y)){
                                $z.='<div class="carousel-item"> <img class="card-img-top w-100" src="'.base_url().'pic'.DS.$y['0']['name'].'" alt="picture"/></div>';
                            }
                        }
                    }
                }
                $x.="<tr><th scope='row'>". $num ."</th><td>". (!empty($val['title'])?$val['title']:'-') ."</td><td>";
    			$x.=(!empty($val['content'])?$val['content']:'-');
    			$x.="</td><td>";
    			$x.=(!empty($val['link'])?$val['link']:'-');
    			
    			$x.='</td><td style="width: 100px;height: 100px;text-align: center;"><div class="carousel slide" style="margin-top: 20px;margin-bottom: -21px;" data-ride="carousel" id="carouselExampleSlidesOnly"><div class="carousel-inner">';
    			
    			$x.=(!empty($val['pic_id'])?$z:'-');
    			
    			$x.='</div></div></td><td>';
    			$x.=(!empty($val['des'])?$val['des']:'-');
    			$x.="</td><td>";
    			$x.=(!empty($val['price'])?$val['price']:'-');
    			$x.="</td><td>";
    			$x.=(!empty($val['n_p'])?$val['n_p']:'-');
    			$x.="</td><td>";
    			$x.=(!empty($val['exp'])?date('Y/m/d',strtotime($val['exp'])):' ');
    			$x.="</td><td>";
    			$x.="<a class='btn btn-block btn-warning-gradient pd-x-25 rounded-10 box-shadow-pink' href='". base_url()."post".DS."show_post".DS.$val['id']."'>مشاهده</a></td></tr>";
    		    $num++;
                
            }
            echo $this->Page_model->render_page('نمایش پست ها','panel/show_post.php',['x'=>$x]);
        }else{
            header('Location :'.base_url().'err'.DS.'no_access');
            exit();
        }
    }

    public function show_post($id)
    {
        
            if (is_numeric($id) && !empty($id)) {
                $data = $this->Post_model->s_p(['id' => $id]);
                $i = (!empty($data['0']['pic_id'])&&!is_null($data['0']['pic_id'])?explode(',', $data['0']['pic_id']):NULL);
                $pics = [];
                if(!is_null($i)){
                    for ($hamid = 0; $hamid <= count($i) -1; $hamid++) {
                        if(!empty($i[$hamid]) && $i[$hamid] != "0"){
                            $abas[] = $this->Post_model->p_s(['id' => $i[$hamid]]);
                            if (!empty($abas)) {
                                array_push($pics, $abas[$hamid]['0']['name']);
                            }
                        }
                    }
                }
                echo $this->Page_model->render_page('مشاهده ی پست','panel' . DS . 'show_post_selected.php', ['data' => $data, 'pic' => $pics]);
            } else {
                header('Location: ' . base_url() . 'err' . DS . 'not_found');
                exit();
            }
                

    }

    public function add_post()
    {
        if(!empty($_SESSION['role']) && $_SESSION['role'] == 'admin'){
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

        $data = $this->Post_model->show_pic();

        echo $this->Page_model->render_page('افزودن پست ها','panel'.DS.'add_post.php', ['data' => $data, 'c' => $c, 'l' => $l, 'pric' => $p, 'd' => $d, 'n' => $n,'e'=>$e, 't' => $t]);
        }else{
             header('Location :'.base_url().'err'.DS.'no_access');
            exit();
        }
    }

    public function edit_post($id)
    { 
        if($_SESSION['role'] == 'admin' && !empty($_SESSION['role'])){
            if (is_numeric($id) && !empty($id)) {
                $info = $this->Post_model->s_p(['id' => $id]);
                $pictures=[];
                $pics = (!is_null($info['0']['pic_id']) && !empty($info['0']['pic_id'])?explode(',', $info['0']['pic_id']):NULL);
                if(!is_null($pics)){
                    for($as=0;$as<=count($pics)-1;$as++){
                        if(!empty($pics[$as])&&$pics[$as]!='0'){
                            $picture_ko[]=$this->Post_model->p_s(['id'=>$pics[$as]]);
                            if(!empty($picture_ko)){
                                $pi_1=$picture_ko[$as]['0']['id'];
                                $pi_2=$picture_ko[$as]['0']['name'];
                                   $p_so = ['id'=>$pi_1,'name'=>$pi_2]; 
                                   array_push($pictures,$p_so);
                            }
                        }
                    }
                }
                $all_pic=$this->Post_model->show_pic();
                $t = ['name' => 'title',
                    'class' => 'form-control rounded-5',
                    'id' => 'title',
                    'value' => $info['0']['title'],
                    'placeholder' => 'عنوان پست را وارد کنید',
                    'type' => 'text'];
    
                $c = ['name' => 'content',
                    'class' => 'form-control rounded-5',
                    'id' => 'content',
                    'value' => $info['0']['content'],
                    'placeholder' => 'متن پست خود راوارد کنید',
                    'type' => 'text'];
    
    
                $l = ['name' => 'link',
                    'class' => 'form-control rounded-5',
                    'id' => 'link',
                    'value' => $info['0']['link'],
                    'placeholder' => 'لینک پست را وارد کنید',
                    'type' => 'text'];
    
                $pr = ['name' => 'pri',
                    'class' => 'form-control rounded-5',
                    'id' => 'pri',
                    'value' => $info['0']['price'],
                    'placeholder' => 'قیمت را به تومان وارد کنید',
                    'type' => 'number'
                    ];
    
                $d = ['name' => 'dis',
                    'class' => 'form-control rounded-5',
                    'id' => 'dis',
                    'value' => $info['0']['des'],
                    'placeholder' => 'توضیحات اضافه',
                    'type' => 'text'];
    
                $n = ['name' => 'np',
                    'class' => 'form-control rounded-5',
                    'id' => 'np',
                    'value' => $info['0']['n_p'],
                    'placeholder' => 'قیمت با تخفیف',
                    'type' => 'number'];
    
                $e = ['name' => 'exp',
                    'class' => 'form-control rounded-5',
                    'id' => 'datepicker1',
                    'value' => $info['0']['exp'],
                    'placeholder' => 'مدت زمان',
                    'type' => 'date'];
                $data=['t'=>$t,
                    'c'=>$c,
                    'l'=>$l,
                    'pric'=>$pr,
                    'd'=>$d,
                    'n'=>$n,
                    'e'=>$e,
                    'edit'=>$id,
                    'pics'=>$pictures,
                    'data'=>$all_pic];
    
                echo $this->Page_model->render_page('ویرایش پست ها','panel'.DS.'add_post.php', $data);
    
            } else {
                header('Location : ' . base_url() . 'err' . DS . 'not_found');
                exit();
            }
        }else{
          header('Location :'.base_url().'err'.DS.'no_access');
            exit();   
        }
    }

    public function check_edit()
    {
        if (isset($_POST['send']) && !empty($_POST['send'])) {
            if (!empty($_POST['edit']) && is_numeric($_POST['edit'])) {
                $id = $_POST['edit'];
            } else {
                echo 0;
                die();
            }
            if (isset($_POST['title']) && !empty($_POST['title'])) {
                $t = $this->direction_check($_POST['title']);
            } else {
                echo 0;
                die();
            }
            if (isset($_POST['content']) && !empty($_POST['content'])) {
                $c = $this->direction_check($_POST['content']);
            } else {
                echo 0;
                die();
            }
            if (isset($_POST['pi']) && !empty($_POST['pi'])) {
                $p = explode(',', $_POST['pi']);
                $pi='';
                for ($ee = 0; $ee <= count($p) - 1; $ee++) {
                    if(!empty($p[$ee]) && $p[$ee] != '0'){
                        $pi .= $p[$ee] . ',';
                    }
                }
            } else {
                echo 0;
                die();
            }
            $l = (isset($_POST['link']) && !empty($_POST['link'])) ? $this->direction_check($_POST['link']) : '#';
            $ds = (isset($_POST['dis']) && !empty($_POST['dis']) ? $this->direction_check($_POST['dis']) : '');
            $pri = (is_numeric($_POST['pri']) && !empty($_POST['pri']) ? $_POST['pri'] : '');
            $np = (is_numeric($_POST['np']) && !empty($_POST['np']) ? $_POST['np'] : '');
            $exp = (isset($_POST['date_out']) && !empty($_POST['date_out']) ? $_POST['date_out'] : '');
            $data = [
                'title' => $t,
                'content' => $c,
                'pic_id' => $pi,
                'link' => $l,
                'des' => $ds,
                'price' => $pri,
                'n_p' => $np,
                'exp' => $exp
            ];
            echo ($this->Post_model->edit($data,$id)?1:0);
            die();
        } else {
            header('Location : ' . base_url() . 'err' . DS . 'not_found');
            exit();
        }
    }

    public function check_add()
    {
        if (isset($_POST['send']) && !empty($_POST['send'])) {
            if (isset($_POST['title']) && !empty($_POST['title'])) {
                $t = $this->direction_check($_POST['title']);
            } else {
                echo 0;
                die();
            }
            if (isset($_POST['content']) && !empty($_POST['content'])) {
                $c = $this->direction_check($_POST['content']);
            } else {
                echo 0;
                die();
            }
            if (isset($_POST['pi']) && !empty($_POST['pi'])) {
                $p = explode(',', $_POST['pi']);
                $pi='';
                for ($ee = 0; $ee <= count($p) - 1; $ee++) {
                    if(!empty($p[$ee])&&$p[$ee]!='0'){
                        $pi .= $p[$ee] . ',';
                    }
                }
            } else {
                echo 0;
                die();
            }
            $l = (isset($_POST['link']) && !empty($_POST['link'])) ? $this->direction_check($_POST['link']) : '#';
            $ds = (isset($_POST['dis']) && !empty($_POST['dis']) ? $this->direction_check($_POST['dis']) : '');
            $pri = (is_numeric($_POST['pri']) && !empty($_POST['pri']) ? $_POST['pri'] : '');
            $np = (is_numeric($_POST['np']) && !empty($_POST['np']) ? $_POST['np'] : '');
            $exp = (isset($_POST['date_out']) && !empty($_POST['date_out']) ? $_POST['date_out'] : '');
            $data = [
                'title' => $t,
                'content' => $c,
                'pic_id' => $pi,
                'link' => $l,
                'des' => $ds,
                'price' => $pri,
                'n_p' => $np,
                'exp' => $exp
            ];
            echo($this->Post_model->add_post($data) ? 1 : 0);
            die();
        } else {
            header('Location : ' . base_url() . 'err' . DS . 'not_found');
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
            if ($this->Post_model->dis($id)) {
                header('location :' . base_url() . 'post' . DS . 'show_post' . DS . $id);
                exit();
            }
        }
        return false;
    }

    public function enable($id)
    {
        if (is_numeric($id) && !empty($id)) {
            if ($this->Post_model->en($id)) {
                header('location :' . base_url() . 'post' . DS . 'show_post' . DS . $id);
                exit();
            }
        }
        return false;
    }

    public function del()
    {
        if (isset($_POST['send']) && !empty($_POST['send'])) {
            if (is_numeric($_POST['id'])) {
                if (isset($_POST['id']) && !empty($_POST['id'])) {
                    $id = $_POST['id'];
                    $a = $this->Post_model->del($id);
                    if ($a) {
                       echo 1;
                       die();
                    } else {
                        echo 0;
                        die();
                    }
                } else {
                    echo 0;
                    die();
                }
            } else {
                header('Location : ' . base_url() . 'err' . DS . 'not_found');
                exit();
            }
        } else {
            header('Location : ' . base_url() . 'err' . DS . 'not_found');
            exit();
        }
    }
}