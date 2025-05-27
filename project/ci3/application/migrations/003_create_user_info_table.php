<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_user_info_table extends CI_Migration {
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
            'user_id' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'null' => FALSE,
            ],
            'nation_code' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => TRUE,
            ],
            'nation_code_image_id' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'null' => TRUE,
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
        $this->dbforge->add_key('user_id');
        $this->dbforge->create_table('user_info');
        $this->db->query("ALTER TABLE user_info MODIFY created_at DATETIME DEFAULT CURRENT_TIMESTAMP");
        $this->db->query("ALTER TABLE user_info MODIFY updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP");
        $this->db->query("ALTER TABLE user_info ADD CONSTRAINT fk_user_info_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE");
        $this->db->query("ALTER TABLE user_info ADD CONSTRAINT fk_user_info_nation_image FOREIGN KEY (nation_code_image_id) REFERENCES media(id) ON DELETE SET NULL ON UPDATE CASCADE");
    }

    public function down() {
        $this->dbforge->drop_table('user_info');
    }
}
