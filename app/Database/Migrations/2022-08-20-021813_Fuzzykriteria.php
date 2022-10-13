<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Fuzzykriteria extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,

            ],
            'fuzzy_id'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
                'null'          => true,
            ],
            'left'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
                'null'          => true,
            ],
            'right'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
                'null'          => true,
            ],
            'valueL'       => [
                'type'           => 'DECIMAL',
                'constraint'     => '10, 2',
                'null'          => true,
            ],
            'valueM'       => [
                'type'           => 'DECIMAL',
                'constraint'     => '10, 2',
                'null'          => true,
            ],
            'valueU'       => [
                'type'           => 'DECIMAL',
                'constraint'     => '10, 2',
                'null'          => true,
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
        $this->forge->addKey('id', true);
        $this->forge->createTable('fuzzykriteria');
    }

    public function down()
    {
        $this->forge->dropTable('fuzzykriteria');
    }
}
