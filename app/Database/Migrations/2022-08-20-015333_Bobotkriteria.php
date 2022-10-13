<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Bobotkriteria extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_bobotkriteria'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,

            ],
            'kriteria_kode'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
                'null'          => true,
            ],
            'value'       => [
                'type'           => 'DECIMAL',
                'constraint'     => '10, 2',
                'null'          => true,
            ],
            'deskripsi'       => [
                'type'       => 'TEXT',
                'null' => true,
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
        $this->forge->addKey('id_bobotkriteria', true);
        $this->forge->createTable('bobotkriteria');
    }

    public function down()
    {
        $this->forge->dropTable('bobotkriteria');
    }
}
