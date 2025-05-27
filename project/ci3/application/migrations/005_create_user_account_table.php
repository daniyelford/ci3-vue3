<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_user_account_table extends CI_Migration {
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
            'user_mobile_id' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'null' => FALSE,
            ],
            'gmail' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => FALSE,
            ],
            'gmail_code' => [   // اصلاح نام فیلد از gamil_code به gmail_code
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => TRUE,
            ],
            'image_id' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'null' => TRUE,
            ],
            'balance' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
                'default' => 0,
                'null' => FALSE,
            ],
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('user_account');
        $this->db->query('ALTER TABLE user_account ADD CONSTRAINT fk_user_account_user_mobile FOREIGN KEY (user_mobile_id) REFERENCES user_mobile(id) ON DELETE CASCADE ON UPDATE CASCADE');
        $this->db->query('ALTER TABLE user_account ADD CONSTRAINT fk_user_account_image FOREIGN KEY (image_id) REFERENCES media(id) ON DELETE SET NULL ON UPDATE CASCADE');
    }

    public function down() {
        $this->dbforge->drop_table('user_account');
    }
}
