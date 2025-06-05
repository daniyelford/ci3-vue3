<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Db_data{
    private $CI;
    private $db_table;
    private $search;
    private $sort;
    private $order;
    public function __construct($ci,$table,$search_field,$sort_field, $order){
      $this->CI=$ci;
      $this->db_table=$table;
      $this->search=$search_field;
      $this->sort=$sort_field;
      $this->order=$order;
    }
    public function get($limit, $offset, $search = null){
        if ($search) $this->CI->db->like($this->search, $search);
        return $this->CI->db->order_by($this->sort, $this->order)->limit($limit, $offset)->get($this->db_table)->result();
    }
}
class Table_data_handler{
    private $CI;
    private $array=[];
    private $pagination_result='';
    private $table_result='';
    private $db_handler;
    private $limit;
    private $offset;
    private $search;
    private $pagination_handler;
    private $table_handler;
    public $data=[];
    public $db_table='';
    public $return_json=true;
    public $return_table=false;
    public $sort=false;
    public $table_headers=[];
    public $table_fields=[];
    public $table_css='<table class="table table-striped table-bordered">';
    public $return_pagination=false;
    public $pagination_url='';
    public $pagination_uri_seg=3;
    public $search_field='title';
    public $sort_field='created_at';
    public $order = 'DESC';
    public function __construct($limit=5,$offset=0,$search=null){
      $this->CI =& get_instance();
      $this->limit=$limit;
      $this->offset=$offset;
      $this->search=$search;
      $this->CI->load->library('pagination');
      $this->CI->load->library('table');
    }
    public function handler(){
      if(!empty($this->data)){
        $this->array=$this->data;
        if (!empty($this->search)) {
          $search=$this->search;
          $this->array = array_filter($this->array, function($item) use ($search) {
            return stripos($item[$this->search_field], $search) !== false;
          });
        }
        if($this->sort){
          $sort=$this->sort_field;
          $order=$this->order;
          usort($this->array, function($a, $b) use ($sort, $order) {
              if ($order == 'ASC') {
                  return strcmp($a[$sort], $b[$sort]);
              } else {
                  return strcmp($b[$sort], $a[$sort]);
              }
          });
        }
      }elseif(!empty($this->db_table)){
        $this->db_handler=new Db_data($this,$this->db_table,$this->search_field,$this->sort_field,$this->order);
        $this->array=$this->db_handler->get($this->limit,$this->offset,$this->search);
      }else{
        die(json_encode(['status' => 'error', 'message' => 'invalid request']));
      }
      if(!empty($this->return_json)){
        die(json_encode(['status'=>'success','data'=>$this->array]));
      }
      if($this->return_pagination){
        $this->pagination_handler = $this->CI->pagination;
        $config['base_url'] = $this->pagination_url;
        $config['per_page'] = 5;
        $config['uri_segment'] = $this->pagination_uri_seg;
        $config['num_links'] = 3;
        $config['total_rows'] = count($this->array);
        $config['full_tag_open'] = '<nav><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav>';
        $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['first_tag_close'] = '</span></li>';
        $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['last_tag_close'] = '</span></li>';
        $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['next_tag_close'] = '</span></li>';
        $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['prev_tag_close'] = '</span></li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '</span></li>';
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close'] = '</span></li>';
        $this->pagination_handler->initialize($config);
        $this->pagination_result = $this->pagination_handler->create_links();
      }
      if($this->return_table){
        $this->table_handler=$this->CI->table;
        $this->table_handler->set_heading(implode(',',$this->table_headers));
        foreach ($this->array as $a) {
          $array=[];
          foreach($this->table_fields as $b){
            $array[]=$a[$b];
          }
          $this->table_handler->add_row(implode(',',$array));
        }
        $this->table_handler->set_template([
          'table_open' => $this->table_css
        ]);
        $this->table_result = $this->table_handler->generate();
      }
      die(json_encode(['status'=>'success','data'=>['table'=>$this->table_result,'pagination'=>$this->pagination_result]]));
    }
}