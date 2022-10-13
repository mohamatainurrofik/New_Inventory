<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Logactivities extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_log'      => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'table_names'       => [
                'type'       => 'VARCHAR',
                'constraint'     => '100',
            ],
            'table_id'       => [
                'type'       => 'INT',
                'constraint'     => 5,
            ],
            'description'       => [
                'type'       => 'TEXT',
            ],
            'before'       => [
                'type'       => 'VARCHAR',
                'constraint'     => '100',
            ],
            'after'       => [
                'type'       => 'VARCHAR',
                'constraint'     => '100',
            ],
            'created_by'      => [
                'type'       => 'VARCHAR',
                'constraint'     => '50',
            ],
            'created_at' => [
                'type' => 'DATETIME default current_timestamp',
            ],
            'updated_at' => [
                'type' => 'DATETIME default current_timestamp on update current_timestamp',
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_log', true);

        $this->forge->createTable('logactivities');
    }

    public function down()
    {
        $this->forge->dropTable('logactivities');
    }
}
