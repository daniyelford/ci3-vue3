<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_user_credentials_table extends CI_Migration {
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
            'credential_id' => [
                'type' => 'VARBINARY',
                'constraint' => 255,
                'null' => FALSE,
            ],
            'public_key' => [
                'type' => 'TEXT',
                'null' => FALSE,
            ],
            'counter' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'default' => 0,
                'null' => FALSE,
            ],
            'aaguid' => [
                'type' => 'BINARY',
                'constraint' => 16,
                'null' => TRUE,
            ],
            'attestation_format' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => TRUE,
            ],
            'certificate' => [
                'type' => 'TEXT',
                'null' => TRUE,
            ],
            'certificate_issuer' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE,
            ],
            'certificate_subject' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE,
            ],
            'user_verified' => [
                'type' => 'BOOLEAN',
                'null' => FALSE,
                'default' => FALSE,
            ],
            'user_present' => [
                'type' => 'BOOLEAN',
                'null' => FALSE,
                'default' => FALSE,
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ]);

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('credential_id', FALSE, TRUE); // unique

        $this->dbforge->create_table('user_credentials');

        $this->db->query('ALTER TABLE `user_credentials` ADD CONSTRAINT `fk_user_credentials_user_mobile` FOREIGN KEY (`user_mobile_id`) REFERENCES `user_mobile`(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
    }

    public function down() {
        $this->dbforge->drop_table('user_credentials');
    }
}
