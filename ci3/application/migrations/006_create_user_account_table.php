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
            'category_id' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'null' => TRUE,
            ],
            'rule' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => TRUE,
            ],
            'gmail' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => TRUE,
            ],
            'gmail_code' => [  
                'type' => 'VARCHAR',
                'constraint' => 100,
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
        $this->db->query('ALTER TABLE user_account ADD CONSTRAINT fk_user_account_category FOREIGN KEY (category_id) REFERENCES category(id) ON DELETE SET NULL ON UPDATE CASCADE');
    }

    public function down() {
        $this->dbforge->drop_table('user_account');
    }
}
