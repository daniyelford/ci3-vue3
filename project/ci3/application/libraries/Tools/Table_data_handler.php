<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Db_data{
    private $CI;
    private $table;
    private $search;
    private $sort;
    private $order;
    public function __construct($ci,$table,$search_field='title',$sort_field='created_at', $order = 'DESC'){
      $this->CI=$ci;
      $this->table=$table;
      $this->search=$search_field;
      $this->sort=$sort_field;
      $this->order=$order;
    }
    public function count($search = null) {
        if ($search) $this->CI->db->like($this->search, $search);
        return $this->CI->db->count_all_results($this->table);
    }
    public function get($limit, $offset, $search = null){
        if ($search) $this->CI->db->like($this->search, $search);
        return $this->CI->db->order_by($this->sort, $this->order)->limit($limit, $offset)->get($this->table)->result();
    }
}
class Table_data_handler
{
    private $CI;
    public $data=[];
    public $return_json=true;
    public $pagination=true;
    public $table='';
    public function __construct(){
      $this->CI =& get_instance();
    }
}