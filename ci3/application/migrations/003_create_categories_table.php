<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_categories_table extends CI_Migration {
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
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
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
        $this->dbforge->create_table('categories');
        $this->db->query("ALTER TABLE categories MODIFY created_at DATETIME DEFAULT CURRENT_TIMESTAMP");
        $this->db->query("ALTER TABLE categories MODIFY updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP");
    }

    public function down() {
        $this->dbforge->drop_table('categories');
    }
}
