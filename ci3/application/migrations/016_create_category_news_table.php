<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_category_news_table extends CI_Migration {
    public function __construct() {
        parent::__construct();
        $this->load->dbforge();
    }

    public function up() {
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'auto_increment' => TRUE,
                'unsigned' => TRUE
            ],
            'news_id' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'null' => FALSE
            ],
            'category_id' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'null' => FALSE
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => TRUE
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => TRUE
            ],
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('category_news', TRUE);
        $this->db->query("ALTER TABLE category_news MODIFY created_at DATETIME DEFAULT CURRENT_TIMESTAMP");
        $this->db->query("ALTER TABLE category_news MODIFY updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP");
        $this->db->query('ALTER TABLE category_news ADD CONSTRAINT fk_category_news_news FOREIGN KEY (news_id) REFERENCES news(id) ON DELETE CASCADE ON UPDATE CASCADE');
        $this->db->query('ALTER TABLE category_news ADD CONSTRAINT fk_category_news_category FOREIGN KEY (category_id) REFERENCES category(id) ON DELETE CASCADE ON UPDATE CASCADE');
    }

    public function down() {
        $this->dbforge->drop_table('category_news', TRUE);
    }
}
