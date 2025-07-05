<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_rules_table extends CI_Migration {
    public function up() {
        $this->dbforge->add_field([
            'id' => ['type' => 'INT', 'auto_increment' => TRUE, 'unsigned' => TRUE],
            'name' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => FALSE],
            'slug' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => FALSE],
            'description' => ['type' => 'TEXT', 'null' => TRUE],
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('rules', TRUE);
    }

    public function down() {
        $this->dbforge->drop_table('rules', TRUE);
    }
}
