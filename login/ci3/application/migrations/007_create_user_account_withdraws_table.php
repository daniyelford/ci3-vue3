<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_user_account_withdraws_table extends CI_Migration {
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
                'null' => FALSE,
            ],
            'user_cart_id' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'null' => FALSE,
            ],
            'value' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
                'null' => FALSE,
            ],
            'time' => [
                'type' => 'DATETIME',
                'null' => TRUE,
            ],
            'vaziate_entghal' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'default' => 'pending',
                'null' => FALSE,
            ],
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('user_account_withdraws');
        $this->db->query('ALTER TABLE user_account_withdraws ADD CONSTRAINT fk_user_account_withdraws_user_account FOREIGN KEY (user_account_id) REFERENCES user_account(id) ON DELETE CASCADE ON UPDATE CASCADE');
        $this->db->query('ALTER TABLE user_account_withdraws ADD CONSTRAINT fk_user_account_withdraws_user_cart FOREIGN KEY (user_cart_id) REFERENCES user_cart(id) ON DELETE CASCADE ON UPDATE CASCADE');
    }

    public function down() {
        $this->dbforge->drop_table('user_account_withdraws');
    }
}
