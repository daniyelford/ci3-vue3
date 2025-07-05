<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_rule_hierarchy_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'id' => ['type' => 'INT', 'auto_increment' => TRUE, 'unsigned' => TRUE],
            'parent_rule_id' => ['type' => 'INT', 'unsigned' => TRUE, 'null' => FALSE],
            'child_rule_id' => ['type' => 'INT', 'unsigned' => TRUE, 'null' => FALSE],
            'relation_type' => ['type' => 'ENUM("view", "control")', 'default' => 'view', 'null' => FALSE],
        ]);

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('rule_hierarchy', TRUE);

        $this->db->query('ALTER TABLE rule_hierarchy ADD CONSTRAINT fk_rule_hierarchy_parent FOREIGN KEY (parent_rule_id) REFERENCES rules(id) ON DELETE CASCADE ON UPDATE CASCADE');
        $this->db->query('ALTER TABLE rule_hierarchy ADD CONSTRAINT fk_rule_hierarchy_child FOREIGN KEY (child_rule_id) REFERENCES rules(id) ON DELETE CASCADE ON UPDATE CASCADE');
    }

    public function down()
    {
        $this->dbforge->drop_table('rule_hierarchy', TRUE);
    }
}
