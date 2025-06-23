<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_report_list_table extends CI_Migration {
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
            'user_account_id' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'null' => TRUE,
            ],
            'news_id' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'null' => TRUE,
            ],
            'status' => [
                'type' => 'ENUM("checking", "done")',
                'default' => 'checking',
                'null' => FALSE,
            ],
            'type'=>[
                'type' => 'ENUM("force", "normal")',
                'default' => 'force',
                'null' => FALSE,
            ],
            'run_time' => [
                'type' => 'DATETIME',
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
        $this->dbforge->create_table('report_list');
        $this->db->query("ALTER TABLE report_list MODIFY created_at DATETIME DEFAULT CURRENT_TIMESTAMP");
        $this->db->query("ALTER TABLE report_list MODIFY updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP");
        $this->db->query('ALTER TABLE report_list ADD CONSTRAINT fk_report_list_user_account FOREIGN KEY (user_account_id) REFERENCES user_account(id) ON DELETE SET NULL ON UPDATE CASCADE');
        $this->db->query('ALTER TABLE report_list ADD CONSTRAINT fk_report_list_news FOREIGN KEY (news_id) REFERENCES news(id) ON DELETE SET NULL ON UPDATE CASCADE');
    }

    public function down() {
        $this->dbforge->drop_table('report_list');
    }
}
