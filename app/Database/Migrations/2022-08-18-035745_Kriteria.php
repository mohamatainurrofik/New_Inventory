<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kriteria extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kriteria'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,

            ],
            'kode_kriteria'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 50,
                'null'          => true,
            ],
            'parent_kode_kriteria'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 50,
                'null'          => true,
            ],
            'kriteria'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'level'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'atribut'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
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
        $this->forge->addKey('id_kriteria', true);
        $this->forge->createTable('kriteria');
    }

    public function down()
    {
        $this->forge->dropTable('kriteria');
    }
}
