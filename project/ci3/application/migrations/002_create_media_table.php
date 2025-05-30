<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_media_table extends CI_Migration {
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
            'filename' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => FALSE,
            ],
            'url' => [
                'type' => 'TEXT',
                'null' => TRUE,
            ],
            'type' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE,
            ],
            'user_sign' => [
                'type' => 'LONGTEXT',
                'null' => TRUE,
            ],
            'used_status' => [
                'type' => 'ENUM("pending", "used")',
                'default' => 'pending',
                'null' => FALSE,
            ],
            'upload_place' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => TRUE,
            ]
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('media');
        $this->db->query("ALTER TABLE media MODIFY created_at DATETIME DEFAULT CURRENT_TIMESTAMP");
    }

    public function down() {
        $this->dbforge->drop_table('media');
    }
}
