<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_payment_table extends CI_Migration {
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
            'report_list_id' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'null' => FALSE,
            ],
            'pay_money_user_account_id' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'null' => FALSE,
            ],
            'give_money_user_account_id' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'null' => FALSE,
            ],
            'give_money_user_cart_id' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'null' => TRUE,
            ],
            'product_id' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'null' => TRUE,
            ],
            'product_count' => [
                'type' => 'DECIMAL',
                'default' => 1,
                'null' => TRUE,
            ],
            'amount' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
                'default' => 0,
                'null' => FALSE,
            ],
            'factor' => [
                'type' => 'TEXT',
                'null' => FALSE,
            ],
            'status' => [
                'type' => 'ENUM("dont", "do")',
                'default' => 'do',
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
        $this->dbforge->create_table('payment');
        $this->db->query("ALTER TABLE payment MODIFY created_at DATETIME DEFAULT CURRENT_TIMESTAMP");
        $this->db->query("ALTER TABLE payment MODIFY updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP");
        $this->db->query('ALTER TABLE payment ADD CONSTRAINT fk_payment_pay_money_user_account FOREIGN KEY (pay_money_user_account_id) REFERENCES user_account(id) ON DELETE CASCADE ON UPDATE CASCADE');
        $this->db->query('ALTER TABLE payment ADD CONSTRAINT fk_payment_give_money_user_account FOREIGN KEY (give_money_user_account_id) REFERENCES user_account(id) ON DELETE CASCADE ON UPDATE CASCADE');
        $this->db->query('ALTER TABLE payment ADD CONSTRAINT fk_payment_report_list FOREIGN KEY (report_list_id) REFERENCES report_list(id) ON DELETE CASCADE ON UPDATE CASCADE');
        $this->db->query('ALTER TABLE payment ADD CONSTRAINT fk_payment_give_money_user_cart FOREIGN KEY (give_money_user_cart_id) REFERENCES user_cart(id) ON DELETE SET NULL ON UPDATE CASCADE');
        $this->db->query('ALTER TABLE payment ADD CONSTRAINT fk_payment_product FOREIGN KEY (product_id) REFERENCES product(id) ON DELETE SET NULL ON UPDATE CASCADE');
    }

    public function down() {
        $this->dbforge->drop_table('payment');
    }
}
