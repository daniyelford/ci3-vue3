<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_news_table extends CI_Migration {
    public function __construct() {
        parent::__construct();
        $this->load->dbforge();
    }

    public function up() {
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ],
            'user_account_id' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'null' => TRUE,
            ],
            'category_id' => [
                'type' => 'TEXT',
                'null' => TRUE,
            ],
            'user_address_id' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'null' => TRUE,
            ],
            'privacy' => [
                'type' => 'ENUM("public", "private")',
                'default' => 'public',
                'null' => FALSE,
            ],
            'media_id' => [
                'type' => 'TEXT',
                'null' => TRUE,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => FALSE,
            ],
            'status' => [
                'type' => 'ENUM("checking", "seen")',
                'default' => 'checking',
                'null' => FALSE,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => TRUE,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => TRUE,
            ],
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('news');
        $this->db->query("ALTER TABLE news MODIFY created_at DATETIME DEFAULT CURRENT_TIMESTAMP");
        $this->db->query("ALTER TABLE news MODIFY updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP");
        $this->db->query('ALTER TABLE news ADD CONSTRAINT fk_news_user_account FOREIGN KEY (user_account_id) REFERENCES user_account(id) ON DELETE SET NULL ON UPDATE CASCADE');
        $this->db->query("ALTER TABLE news ADD CONSTRAINT fk_news_user_address FOREIGN KEY (user_address_id) REFERENCES user_address(id) ON DELETE SET NULL ON UPDATE CASCADE");
    }

    public function down() {
        $this->dbforge->drop_table('news');
    }
}
