<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Units extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_unit'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'product_id'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 50,
            ],
            'brand'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'nama_unit'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'jenis_unit'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'satuan'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
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
        $this->forge->addKey('id_unit', true);
        $this->forge->createTable('units');
    }

    public function down()
    {
        $this->forge->dropTable('units');
    }
}
