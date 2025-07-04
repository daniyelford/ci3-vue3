<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_product_table extends CI_Migration {
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
            'category_id' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'null' => TRUE,
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => FALSE,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => TRUE,
            ],
            'media_id' => [
                'type' => 'TEXT',
                'null' => TRUE,
            ],
            'price' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
                'default' => 0,
                'null' => FALSE,
            ],
            'per_unit' => [
                'type' => 'ENUM("geram", "adad")',
                'default' => 'adad',
                'null' => FALSE,
            ],
            'max_token' => [
                'type' => 'DECIMAL',
                'null' => TRUE,
            ],
            'per_token_price' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
                'null' => TRUE,
            ],
            'can_buy_user' => [
                'type' => 'ENUM("yes", "no")',
                'default' => 'no',
                'null' => FALSE,
            ],
            'status' => [
                'type' => 'ENUM("active", "inactive")',
                'default' => 'active',
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
        $this->dbforge->create_table('product');
        $this->db->query("ALTER TABLE product MODIFY created_at DATETIME DEFAULT CURRENT_TIMESTAMP");
        $this->db->query("ALTER TABLE product MODIFY updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP");
        $this->db->query('ALTER TABLE product ADD CONSTRAINT fk_product_category FOREIGN KEY (category_id) REFERENCES category(id) ON DELETE SET NULL ON UPDATE CASCADE');
    }

    public function down() {
        $this->dbforge->drop_table('product');
    }
}
