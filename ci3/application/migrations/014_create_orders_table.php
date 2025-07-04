<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_orders_table extends CI_Migration {
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
        $this->dbforge->create_table('orders');
        $this->db->query("ALTER TABLE orders MODIFY created_at DATETIME DEFAULT CURRENT_TIMESTAMP");
        $this->db->query("ALTER TABLE orders MODIFY updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP");
        $this->db->query('ALTER TABLE orders ADD CONSTRAINT fk_orders_report_list FOREIGN KEY (report_list_id) REFERENCES report_list(id) ON DELETE CASCADE ON UPDATE CASCADE');
        $this->db->query('ALTER TABLE orders ADD CONSTRAINT fk_orders_product FOREIGN KEY (product_id) REFERENCES product(id) ON DELETE SET NULL ON UPDATE CASCADE');
    }
    public function down() {
        $this->dbforge->drop_table('orders');
    }
}
