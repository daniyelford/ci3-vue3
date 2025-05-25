<?php

class User_handler
{
    private $CI;
    public $location=['ln'=>'','lt'=>''];
    public $id=0;
    public $infos=[];
    public $wallet=[];
    public $company=[];
    public $has_code_mely_info=false;
    public function __construct(){
        $this->CI =& get_instance();
        $this->CI->load->library('session');
        $this->CI->load->library('role_handler');
    }
    public function info(){
        if($this->id>0){
            $this->get_user_info();
            $this->get_company_info();
        }
        $this->find_position();
    }
    private function find_position(){
		$a=$this->CI->Include_model->ip_handler();
		if(!empty($a) && !empty($a['lat']) && !empty($a['lon'])){
			$this->location=[
				'lt'=> $a['lat'],
				'ln'=> $a['lon']
			];
        }
		return true;
	}
	private function get_user_info(){
		$a=$this->CI->Users_model->select_where_id($this->id);
        $b=$this->CI->Users_model->select_info_where_user_id(intval($this->id));
		if(!empty($a) && !empty($a['0']) && !empty($b) && !empty($b['0'])){
			$this->infos=[
                'image'=>(!empty($b['0']['image'])?$b['0']['image']:''),
                'name'=>(!empty($b['0']['name'])?$b['0']['name']:''),
                'family'=>(!empty($b['0']['family'])?$b['0']['family']:''),
            ];
            if(!empty($b['0']['cart_mely_picture']) && !empty($b['0']['mely_code'])) 
                $this->has_code_mely_info=true;
		}
		$c=$this->CI->Order_model->select_wallet_where_user_id(intval($this->id));
		if(!empty($c) && !empty(end($c))) 
            $this->wallet = end($c);
		return true;
	}
    private function get_company_info(){
        $this->company=$this->CI->role_handler->show_my_company_valex($this->id);
        return true;
    }
}
