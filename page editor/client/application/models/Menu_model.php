<?php

class Menu_model extends CI_Model
{
	public function __construct(){
		parent::__construct();
	}
    
    //fetch
    
    public function all_icons(){
        return $this->db->query('SELECT * FROM icons')->result_array();
    }
    
	public function sidebar_place($place='', $side_id = ''){
		if (empty($side_id)) {
			if (!empty($place)) {
				return $this->sidebars()->where(array('place' => $place))->result_array();
			}
			return $this->sidebars()->result_array();
		}
		return $this->sidebars()->where(array('place' => $place, 'side_id' => $side_id,'status'=>1))->result_array();
	}

    //menu

	public function all_menu(){
		return $this->db->get('menu');
	}
	
	public function menus(){
	    return $this->db->query("SELECT * FROM menu")->result_array();
	}

   public function dis($id){
        return (is_numeric($id) && !empty($id)?$this->edit('menu',['status'=>0],['id'=>$id]):false);
    }

    public function en($id){
        return (is_numeric($id) && !empty($id)?$this->edit('menu',['status'=>1],['id'=>$id]):false);
    }
    
    public function menu_w_p($id){
        return (!empty($id) && is_numeric($id)?$this->select_where('menu',array('parent_id'=>$id)):'');
    }

    public function menu_w_side($side){
        return $this->select_where('menu',array('side_id'=>$side));
    }
    
    public function select_join($table,$tableJoin,$fetch_item,$con){
        $sql="SELECT $fetch_item FROM $table INNER JOIN $tableJoin ON $con;";
        return $this->db->query($sql)->result_array();
    }

	public function place_menu($place1 = "", $place2 = "", $side_id = ""){
		if (!empty($place1) && !empty($place2) && empty($side_id)) {
			$sql = "select * from menu where (`place` = '$place1' or `place` = '$place2') and `status`=1";
		} elseif (empty($place2) && !empty($place1) && empty($side_id)) {
			$sql = "select * from menu where `place`='$place1' and `status`=1";
		} elseif (!empty($side_id) && !empty($place2) && !empty($place1)) {
			$sql = "select * from menu where `side_id`=$side_id and (`place`='$place1' or `place`='$place2') and status=1";
		} elseif (!empty($place1) && empty($place2) && !empty($side_id)) {
			$sql = "select * from menu where `side_id`=$side_id and `place`='$place1' and `status`=1";
		} elseif (empty($place1) && !empty($place2) && !empty($side_id)) {
			$sql = "select * from menu where `side_id`=$side_id and `place`='$place2' and `status`=1";
		} elseif (empty($place1) && empty($place2) && !empty($side_id)) {
			$sql = "select * from menu where `side_id`=$side_id and `status`=1";
		}
		return $this->db->query($sql)->result_array();
	}

//	insert delete update

	public function add($table, $data){
		return $this->db->insert($table, $data);
	}

    public function select_where($tbl,$con){
        return $this->db->get_where($tbl,$con)->result_array();
    }

	public function edit($table, $data,$where){
		return ($this->db->update($table, $data,$where)?:false);
	}

    public function remove_menu_id($id){
        if(!empty($id)){
            $sql="DELETE FROM `menu` WHERE `menu`.`id` = $id";
            return $this->db->query($sql);
        }else{
            return false;
        }
    }

	public function remove($table, $condition){
		return $this->db->delete($table, $condition);
	}
        
    //you can create a html and css class and put this name into args
    
    public function menu_configing($a,$b,$c,$d,$e){
        return $this->menu_con($a,$b,$c,$d,$e);
    }
    
    public function menu_con($side_id='',$place='',$p_id=0,$customOne='',$endCustomOne=''){
        if(!empty($side_id)&&!empty($place)){
            $x= $this->select_where('menu',array('status'=>1,'place'=>$place,'parent_id'=>$p_id,'side_id'=>$side_id));
            if(!empty($x)){
                if(!empty($customOne) && !empty($endCustomOne)){
                    $ve=$customOne;
                    $end=$endCustomOne;
                }else{
                    
                    // //ui add menu need to check up
                    
                    // if($place === 'top' && $p_id == 0){
                    //     $ve='<div class="sticky sticky-pin" style="margin-bottom: 0px;"><div class="horizontal-main hor-menu clearfix side-header"><div class="horizontal-mainwrapper container clearfix"><nav class="horizontalMenu clearfix"><div class="horizontal-overlapbg"></div><ul class="horizontalMenu-list">';
                    //     $end='</ul></nav></div></div></div>'; 
                    //     foreach($x as $value){
                    //         $y=$this->select_where('menu',array('status'=>1,'place'=>$value['place'],'parent_id'=>$value['id'],'side_id'=>$value['side_id']));
                    //         if(!empty($y)){
                    //             $ve.= '<li '.$value['li_css'].'>';
                    //         }else{
                    //             $ve.='<li>';
                    //         }
                    //         if(!empty($value['link_css'])){
                    //             $ve.='<a '.$value['link_css'];
                    //         }else{
                    //             $ve.='<a ';
                    //         }
                    //         if(!empty($value['link'])){
                    //             $ve.= 'href="'.$value['link'].'">';
                    //         }else{
                    //             $ve.='href="#">';    
                    //         }
                    //         if(!empty($value['icon_name'])){
                    //             $ve.='<i class="'. $value['icon_name'].' pl-1" aria-hidden="true"></i>';
                    //         }else{
                    //             $ve.='';
                    //         }
                    //         if(!empty($value['title'])){
                    //             $ve.=$value['title'];
                    //         }else{
                    //             $ve.='';
                    //         }
                    //         $ve.='</a>';
                    //         if(!empty($y)){
                    //             if($value['megaMenu'] == 1 && $p_id == 0){
                    //                 $ve.='<div class="horizontal-megamenu clearfix"><div class="container"><div class="mega-menubg hor-mega-menu"><div class="row"><div class="col-lg-12 col-md-12 col-xs-12 link-list">';
                    //                 $endCstm='</div></div></div></div></div>';
                    //                 if(!empty($value['ul_css'])){
                    //                     $ve.='<ul class="'.$value['ul_css'].'">';
                    //                 }else{
                    //                     $ve.="<ul>";
                    //                 }
                    //             }else{
                    //                 $endCstm='';
                    //                  if(!empty($value['ul_css'])){
                    //                     $ve.='<ul '.$value['ul_css'].'>';
                    //                 }else{
                    //                     $ve.='<ul class="sub-menu">';
                    //                 }
                    //             }
                                
                    //             foreach($y as $bin){
                    //                 $vei = $this->menu_con($bin['side_id'],$bin['place'],$bin['parent_id'],$bin['custom_html'],$bin['end_custom_html']);
                    //             }
                    //             $ve.=$vei;
                    //             $ve.="</ul>".$endCstm."</li>";
                    //         }else{
                    //             $ve.="</li>";
                    //         }
                    //     }
                    // }elseif($place === 'right' && $p_id == 0){
                    //     $ve='';
                    //     $end='';
                    // }elseif($place === 'left' && $p_id == 0){
                    //     $ve='';
                    //     $end='';
                    // }else{
                        $ve='';
                        $end='';
                    // }
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
    
    //custom fetch with css in the every where you want
    
    public function fetch_for_menu($place,$path,$data=array()){
         if(!empty($place)&&!empty($path)){
            $place_sides_id=$this->select_where("sidebars_place",array('place'=>$place,'status'=>1));
            if(!empty($place_sides_id)){
                $num=1;
                $y='';
                foreach($place_sides_id as $val){
                    $x=$this->menu_con($val['id'],$val['place'],0,$val['custom_html'],$val['end_custom_html']);
                    $num++;
                    if(empty($data)){
                        $z=array('0'=>$x);
                        $y.=$this->load->view('panel'.DS.$path,array('data'=>$z,'num'=>$num),TRUE);
                    }else{
                        $z=array('0'=>$x,'1'=>$data);
                        $y.=$this->load->view('panel'.DS.$path,array('data'=>$z,'num'=>$num),TRUE);
                    }
                }
                return $y;
            }elseif(empty($place_sides_id)&&!empty($data)){
                 return $this->load->view('panel'.DS.$path,$data,TRUE);
            }else{
                return false;
            }
        }
        return false;
    }
}