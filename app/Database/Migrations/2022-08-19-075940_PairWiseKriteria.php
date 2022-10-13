<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PairWiseKriteria extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pairwise'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,

            ],
            'fuzzy_id'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '10',
                'null'          => true,
            ],
            'kriteria_kolom'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '10',
                'null'          => true,
            ],
            'kriteria_baris'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '10',
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
        $this->forge->addKey('id_pairwise', true);
        $this->forge->createTable('pairwisekriteria');
    }

    public function down()
    {
        $this->forge->dropTable('pairwisekriteria');
    }
}
