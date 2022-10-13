<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Alternatif extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_alternatif'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,

            ],
            'kode_alternatif'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 50,
                'null'          => true,
            ],
            'alternatif'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
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
        $this->forge->addKey('id_alternatif', true);
        $this->forge->createTable('alternatif');
    }

    public function down()
    {
        $this->forge->dropTable('alternatif');
    }
}
