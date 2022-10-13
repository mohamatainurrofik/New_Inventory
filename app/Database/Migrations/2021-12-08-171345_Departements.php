<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Departements extends Migration
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
            'parent_id'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 50,
                'null' => true,
            ],
            'content'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'lokasi_id'       => [
                'type'       => 'int',
                'constraint' => '5',
            ],
            'depth_dep'       => [
                'type'       => 'INT',
                'constraint' => '11',
            ],
            'status_dep'      => [
                'type'           => 'ENUM',
                'constraint'     => ['Aktif', 'Tidak Aktif', 'Pending'],
                'default'        => 'Aktif',
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME default current_timestamp',
            ],
            'updated_at' => [
                'type' => 'DATETIME default current_timestamp on update current_timestamp',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('departements');
    }

    public function down()
    {
        $this->forge->dropTable('departements');
    }
}
