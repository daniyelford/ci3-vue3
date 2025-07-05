<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CategorySeeder extends CI_Controller {

public function index() {
    $this->load->database();
    $data = [];

    for ($i = 1; $i <= 10; $i++) {
        $data[] = [
            'title' => "دسته بندی شماره $i",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
    }
    $this->db->insert_batch('category', $data);
    echo 'ok';
}

}
