<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Migration_Create_rule_relations_table extends CI_Migration {
    public function up() {
        $this->dbforge->add_field([
            'id' => ['type' => 'INT', 'auto_increment' => TRUE, 'unsigned' => TRUE],
            'rule_id' => ['type' => 'INT', 'unsigned' => TRUE, 'null' => FALSE],
            'user_account_id' => ['type' => 'INT', 'unsigned' => TRUE, 'null' => FALSE],
            'created_at' => ['type' => 'DATETIME', 'null' => TRUE],
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('rule_relation', TRUE);
        $this->db->query('ALTER TABLE rule_relation ADD CONSTRAINT fk_rule_relation_rule FOREIGN KEY (rule_id) REFERENCES rules(id) ON DELETE CASCADE ON UPDATE CASCADE');
        $this->db->query('ALTER TABLE rule_relation ADD CONSTRAINT fk_rule_relation_user_account FOREIGN KEY (user_account_id) REFERENCES user_account(id) ON DELETE CASCADE ON UPDATE CASCADE');
        $this->db->query('ALTER TABLE rule_relation MODIFY created_at DATETIME DEFAULT CURRENT_TIMESTAMP');
    }
    public function down() {
        $this->dbforge->drop_table('rule_relation', TRUE);
    }
}