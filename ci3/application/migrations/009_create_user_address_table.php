<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_user_address_table extends CI_Migration {
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
            'ip_address' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => TRUE,
            ],
            'address' => [
                'type' => 'TEXT',
                'null' => TRUE,
            ],
            'code_posti' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => TRUE,
            ],
            'city' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => TRUE,
            ],
            'province' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => TRUE,
            ],
            'country' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => TRUE,
            ],
            'country_code' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => TRUE,
            ],
            'lat' => [
                'type' => 'DECIMAL',
                'constraint' => '10,7',
                'null' => TRUE,
            ],
            'long' => [
                'type' => 'DECIMAL',
                'constraint' => '10,7',
                'null' => TRUE,
            ],
            'status' => [
                'type' => 'ENUM("login", "news")',
                'default' => 'login',
                'null' => FALSE,
            ],
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('user_address');
        $this->db->query('ALTER TABLE user_address ADD CONSTRAINT fk_user_address_user_account FOREIGN KEY (user_account_id) REFERENCES user_account(id) ON DELETE SET NULL ON UPDATE CASCADE');
    }

    public function down() {
        $this->dbforge->drop_table('user_address');
    }
}
