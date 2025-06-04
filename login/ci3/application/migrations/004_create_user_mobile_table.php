<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_user_mobile_table extends CI_Migration {
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
                'null' => TRUE,
            ],
            'phone' => [
                'type' => 'VARCHAR',
                'constraint' => 15,
                'null' => FALSE,
            ],
            'image_id' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'null' => TRUE,
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ]);

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('user_mobile');
        $this->db->query('ALTER TABLE `user_mobile` ADD CONSTRAINT `fk_user_mobile_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
        $this->db->query('ALTER TABLE user_mobile ADD CONSTRAINT fk_user_mobile_image FOREIGN KEY (image_id) REFERENCES media(id) ON DELETE SET NULL ON UPDATE CASCADE');
    }

    public function down() {
        $this->dbforge->drop_table('user_mobile');
    }
}
