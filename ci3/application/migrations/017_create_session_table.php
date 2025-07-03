<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_session_table extends CI_Migration {
    public function __construct() {
        parent::__construct();
        $this->load->dbforge();
    }

    public function up() {
        $this->dbforge->add_field([
            'id' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
                'null' => FALSE
            ],
            'ip_address' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
                'null' => FALSE
            ],
            'timestamp' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'null' => FALSE
            ],
            'data' => [
                'type' => 'BLOB',
                'null' => FALSE
            ],
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('ci_sessions', TRUE);
    }

    public function down() {
        $this->dbforge->drop_table('ci_sessions');
    }
}
