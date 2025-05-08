<?php

class Position_model extends CI_Model
{
    public function __construct()
	{
		parent::__construct();
	}
	private $company='company_category_product_position';
    private $tbl="position";	
    private $map="position_map";
	private $order="position_product_order";
	private $user="position_user";
    private $tel="position_tel";
	private $chat='position_chat';
	private $image='position_image';
	private $video='position_video';
	private $form='position_form';
    private $form_question='position_form_question';
    private $form_answer='position_form_question_answer';
	private function select_where_array_in_table($tbl,$arr){
		return (!empty($tbl) && is_string($tbl) && !empty($arr) && is_array($arr)?$this->db->get_where($tbl,$arr)->result_array():false);
	}
	private function select_where_array_in_table_order_by_id($tbl,$arr){
	    return (!empty($tbl) && is_string($tbl) && !empty($arr) && is_array($arr)?$this->db->order_by('id', 'DESC')->get_where($tbl,$arr)->result_array():false);
	}
	private function add_to_table($tbl,$arr){
        return (!empty($tbl) && is_string($tbl) && !empty($arr) && is_array($arr) && $this->db->insert($tbl,$arr));
    }
    private function add_to_table_return_id($tbl,$arr){
        return (!empty($tbl) && is_string($tbl) && !empty($arr) && is_array($arr) && $this->db->insert($tbl,$arr)?$this->db->insert_id():false);
    }

    private function edit_table($tbl,$arr,$where){
        return (!empty($tbl) && is_string($tbl) && !empty($arr) && is_array($arr) && !empty($where) && is_array($where) && $this->db->update($tbl,$arr,$where));
    }
    private function remove_where_array_in_table($tbl,$arr){
        return (!empty($tbl) && is_string($tbl) && !empty($arr) && is_array($arr) && $this->db->delete($tbl, $arr));
    }
    public function select_all(){
        return $this->db->query('SELECT * FROM '.$this->tbl)->result_array();
    }
	public function select_all_where_status(){
		return $this->select_where_array_in_table($this->tbl,['status'=>1]);
	}
	public function select_where_id($id){
		return (!empty($id) && intval($id)>0?$this->select_where_array_in_table($this->tbl,['id'=>intval($id)]):false);
	}
	public function select_where_id_and_status($id){
		return (!empty($id) && intval($id)>0?$this->select_where_array_in_table($this->tbl,['id'=>intval($id),'status'=>1]):false);
	}
	public function select_user_where_id($id){
		return (!empty($id) && intval($id)>0?$this->select_where_array_in_table($this->user,['user_id'=>intval($id)]):false);
	}
	public function select_user_where_position_id($id){
		return (!empty($id) && intval($id)>0?$this->select_where_array_in_table($this->user,['position_id'=>intval($id)]):false);
	}
	public function select_user_where_arr($arr){
		return (!empty($arr) && is_array($arr)?$this->select_where_array_in_table($this->user,$arr):false);
	}
	public function select_order_where_arr($arr){
		return (!empty($arr) && is_array($arr)?$this->select_where_array_in_table($this->order,$arr):false);
	}
	public function select_order_where_id($id){
		return (!empty($id) && intval($id)>0?$this->select_where_array_in_table($this->order,['id'=>intval($id)]):false);
	}
	public function select_order_where_product_id($id){
		return (!empty($id) && intval($id)>0?$this->select_where_array_in_table($this->order,['product_id'=>intval($id)]):false);
	}
	public function select_order_where_payment_id($id){
		return (!empty($id) && intval($id)>0?$this->select_where_array_in_table($this->order,['payment_id'=>intval($id)]):false);
	}
	public function select_order_where_product_id_without_status($id){
		return (!empty($id) && intval($id)>0?$this->select_where_array_in_table($this->order,['product_id'=>intval($id),'status'=>0]):false);
	}
	public function select_order_where_position_user_id($id){
		return (!empty($id) && intval($id)>0?$this->select_where_array_in_table($this->order,['position_user_id'=>intval($id)]):false);
	}
	public function select_map_where_position_id($id){
	    return (!empty($id) && intval($id)>0?$this->select_where_array_in_table($this->map,['position_id'=>intval($id)]):false);
	}
	public function select_map_where_company_position_id($id){
	    return (!empty($id) && intval($id)>0?$this->select_where_array_in_table($this->map,['position_id'=>intval($id)]):false);
	}
	public function select_tel_where_position_id($id){
	    return (!empty($id) && intval($id)>0?$this->select_where_array_in_table($this->tel,['position_id'=>intval($id)]):false);
	}
	public function select_tel_where_position_id_and_status($id){
	    return (!empty($id) && intval($id)>0?$this->select_where_array_in_table($this->tel,['position_id'=>intval($id),'status'=>1]):false);
	}
	public function select_chat_where_arr($arr){
	    return (!empty($arr) && is_array($arr)?$this->select_where_array_in_table($this->chat,$arr):false);
	}
	public function select_chat_where_id($id){
	    return (!empty($id) && intval($id)>0?$this->select_where_array_in_table($this->chat,['id'=>intval($id)]):false);
	}
	public function select_chat_where_user_id($id){
	    return (!empty($id) && intval($id)>0?$this->select_where_array_in_table($this->chat,['user_id'=>intval($id)]):false);
	}
	public function select_chat_where_position_id($id){
	    return (!empty($id) && intval($id)>0?$this->select_where_array_in_table($this->chat,['position_id'=>intval($id)]):false);
	}
	public function select_chat_where_parent_id($id){
	    return (!empty($id) && intval($id)>0?$this->select_where_array_in_table($this->chat,['parent_id'=>intval($id)]):false);
	}
	public function select_image_where_id($id){
		return (!empty($id) && intval($id)>0?$this->select_where_array_in_table($this->image,['id'=>intval($id)]):false);
	}
	public function select_image_where_position_id($id){
	    return (!empty($id) && intval($id)>0?$this->select_where_array_in_table_order_by_id($this->image,['position_id'=>intval($id)]):false);
	}
	public function select_image_where_position_id_and_status($id){
	    return (!empty($id) && intval($id)>0?$this->select_where_array_in_table_order_by_id($this->image,['position_id'=>intval($id),'status'=>1]):false);
	}
	public function select_video_where_id($id){
		return (!empty($id) && intval($id)>0?$this->select_where_array_in_table($this->video,['id'=>intval($id)]):false);
	}
	public function select_video_where_position_id($id){
	    return (!empty($id) && intval($id)>0?$this->select_where_array_in_table_order_by_id($this->video,['position_id'=>intval($id)]):false);
	}
	public function select_video_where_position_id_and_status($id){
	    return (!empty($id) && intval($id)>0?$this->select_where_array_in_table_order_by_id($this->video,['position_id'=>intval($id),'status'=>1]):false);
	}
	public function select_company_where_position_id($id){
	    return (!empty($id) && intval($id)>0?$this->select_where_array_in_table($this->company,['position_id'=>intval($id)]):false);
	}
	public function select_company_where_arr($arr){
	    return (!empty($arr) && is_array($arr)?$this->select_where_array_in_table($this->company,$arr):false);
	}
	public function select_all_form_status(){
	    return $this->select_where_array_in_table($this->form,['status'=>1]);
	}
	public function select_form_where_arr($arr){
	    return (!empty($arr) && is_array($arr)?$this->select_where_array_in_table($this->form,$arr):false);
	}
	public function select_form_answer_where_position_user_id_and_position_form_question_id($id,$pid){
	    return (!empty($id) && intval($id)>0 && !empty($pid) && intval($pid)>0?$this->select_where_array_in_table($this->form_answer,['position_form_question_id'=>$pid,'position_user_id'=>intval($id)]):false);
	}
	public function add_answer_question($arr){
	    return (!empty($arr) && is_array($arr)?$this->db->insert_batch($this->form_answer, $arr):false);
	}
	public function select_form_question_where_id($id){
	    return (!empty($id) && intval($id)>0?$this->select_where_array_in_table($this->form_question,['id'=>intval($id)]):false);
	}
	public function add_form($arr){
        return (!empty($arr) && is_array($arr) && $this->add_to_table($this->form,$arr));
    }
    public function add_form_question_return_id($arr){
        return (!empty($arr) && is_array($arr)?$this->add_to_table_return_id($this->form_question,$arr):false);
    }
    public function add_position_return_id($arr){
        return (!empty($arr) && is_array($arr)?$this->add_to_table_return_id($this->tbl,$arr):false);
    }
    public function add_company_category_return_id($arr){
        return (!empty($arr) && is_array($arr)?$this->add_to_table_return_id($this->company,$arr):false);
    }
    public function add_image($arr){
        return (!empty($arr) && is_array($arr) && $this->add_to_table($this->image,$arr));
    }
    public function add_video($arr){
        return (!empty($arr) && is_array($arr) && $this->add_to_table($this->video,$arr));
    }
    public function add_chat($arr){
        return (!empty($arr) && is_array($arr) && $this->add_to_table($this->chat,$arr));
    }
    public function add_tel($arr){
        return (!empty($arr) && is_array($arr) && $this->add_to_table($this->tel,$arr));
    }
    public function add_company_category($arr){
        return (!empty($arr) && is_array($arr) && $this->add_to_table($this->company,$arr));
    }
    public function edit_chat($arr,$where){
        return (!empty($arr) && is_array($arr) && !empty($where) && is_array($where) && $this->edit_table($this->chat,$arr,$where));
    }
    public function add_map($arr){
        return (!empty($arr) && is_array($arr) && $this->add_to_table($this->map,$arr));
    }
    public function edit_user($arr,$where){
        return (!empty($arr) && is_array($arr) && !empty($where) && is_array($where) && $this->edit_table($this->user,$arr,$where));
    }
    public function add_user($arr){
        return (!empty($arr) && is_array($arr) && $this->add_to_table($this->user,$arr));
    }
    public function edit_order($arr,$where){
        return (!empty($arr) && is_array($arr) && !empty($where) && is_array($where) && $this->edit_table($this->order,$arr,$where));
    }
    public function add_order($arr){
        return (!empty($arr) && is_array($arr) && $this->add_to_table($this->order,$arr));
    }
    public function add_order_return_id($arr){
        return (!empty($arr) && is_array($arr)?$this->add_to_table_return_id($this->order,$arr):false);
    }
    public function add_user_return_id($arr){
        return (!empty($arr) && is_array($arr)?$this->add_to_table_return_id($this->user,$arr):false);
    }
    public function edit($arr,$where){
        return (!empty($arr) && is_array($arr) && !empty($where) && is_array($where) && $this->edit_table($this->tbl,$arr,$where));
    }
    public function edit_form($arr,$where){
        return (!empty($arr) && is_array($arr) && !empty($where) && is_array($where) && $this->edit_table($this->form,$arr,$where));
    }
    public function edit_form_question($arr,$where){
        return (!empty($arr) && is_array($arr) && !empty($where) && is_array($where) && $this->edit_table($this->form_question,$arr,$where));
    }
    public function edit_company($arr,$where){
        return (!empty($arr) && is_array($arr) && !empty($where) && is_array($where) && $this->edit_table($this->company,$arr,$where));
    }
    public function edit_tel($arr,$where){
        return (!empty($arr) && is_array($arr) && !empty($where) && is_array($where) && $this->edit_table($this->tel,$arr,$where));
    }
    public function remove_company_where_array($arr){
        return (!empty($arr) && is_array($arr) && $this->remove_where_array_in_table($this->company,$arr));
    }
    public function remove_company($id){
        return (!empty($id) && intval($id)>0 && $this->remove_company_where_array(['id'=>intval($id)]));
    }
    public function remove_chat($id){
        return (!empty($id) && intval($id)>0 && $this->remove_where_array_in_table($this->chat,['id'=>intval($id)]));
    }
    public function remove_order($id){
        return (!empty($id) && intval($id)>0 && $this->remove_where_array_in_table($this->order,['id'=>intval($id)]));
    }
    public function remove_image($id){
        return (!empty($id) && intval($id)>0 && $this->remove_where_array_in_table($this->image,['id'=>intval($id)]));
    }
    public function remove_video($id){
        return (!empty($id) && intval($id)>0 && $this->remove_where_array_in_table($this->video,['id'=>intval($id)]));
    }
    public function remove_map($id){
        return (!empty($id) && intval($id)>0 && $this->remove_where_array_in_table($this->map,['id'=>intval($id)]));
    }
    public function position_form_question_where_position_id_and_status($position_id){
        $form_info=[];
        if(!empty($position_id) && intval($position_id)>0){
            $form=$this->select_form_where_arr(['position_id'=>intval($position_id)]);
            if(!empty($form) && is_array($form))
                foreach($form as $for){
                    if(!empty($for) && !empty($for['position_form_question_id']) && intval($for['position_form_question_id'])>0 && ($a=$this->select_form_question_where_id(intval($for['position_form_question_id'])))!==false && !empty($a) && !empty(end($a)))
                        $form_info[]=['form'=>$for,'question'=>end($a)];
                }
        }
        return $form_info;
    }
    public function position_form_info_where_position_id_and_position_user_id($position_id,$position_user_id){
        $form_info=[];
        if(!empty($position_id) && intval($position_id)>0 && !empty($position_user_id) && intval($position_user_id)>0){
            $form=$this->select_all_form_status();
            if(!empty($form) && is_array($form) && in_array(intval($position_id), array_column($form, 'position_id')))
                foreach($form as $for){
                    if(!empty($for) && !empty($for['position_id']) && intval($for['position_id'])>0 && 
                    intval($for['position_id'])===intval($position_id) && 
                    !empty($for['position_form_question_id']) && intval($for['position_form_question_id'])>0 && 
                    ($form_question=$this->select_form_question_where_id(intval($for['position_form_question_id'])))!==false &&
                    ($form_answer=$this->select_form_answer_where_position_user_id_and_position_form_question_id(intval($position_user_id),intval($for['position_form_question_id'])))!==false && 
                    !empty($form_question) && !empty($form_question['0']))
                        $form_info[]=[
                            'question'=>$form_question['0'],
                            'answer'=>(!empty($form_answer) && is_array($form_answer)?$form_answer:[])
                        ];
                }
        }
        return $form_info;
    }
}