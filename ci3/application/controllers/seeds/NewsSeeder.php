<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NewsSeeder extends CI_Controller {
    
    public function index() {
        $this->load->database();
        $newsData = [];
        $catNewsData = [];
        $categories = [1, 2, 3, 4 , 5 ,6 , 7, 8, 9,10];
        for ($i = 1; $i <= 10000; $i++) {
            $newsData[] = [
                'user_account_id'=>1,
                'user_address_id'=>1,
                'description' => "توضیحات خبر شماره $i",
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            if (count($newsData) >= 500) {
                $this->db->insert_batch('news', $newsData);
                $newsData = [];
            }
        }
        for ($i = 1; $i <= 10000; $i++) {
            $news_id = $i;
            $category_id = $categories[array_rand($categories)];
            $catNewsData[] = [
                'news_id' => $news_id,
                'category_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            if (count($catNewsData) >= 500) {
                $this->db->insert_batch('category_news', $catNewsData);
                $catNewsData = [];
            }
        }
        echo "درج 10000 خبر و ارتباط با دسته‌ها انجام شد ✅";
    }
}
