<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Unitkerjas extends Migration
{
    public function up()
    {

        $this->forge->addField([
            'id_unitkerja'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'parent_id_unitkerja'   => [
                'type'           => 'VARCHAR',
                'constraint'     => 50,
                'null' => true,
            ],
            'kode_unitkerja'        => [
                'type'           => 'VARCHAR',
                'constraint'     => 50,
            ],
            'unitkerja'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'depth_unitkerja' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'status_unitkerja'      => [
                'type'           => 'ENUM',
                'constraint'     => ['Aktif', 'Tidak Aktif', 'Pending'],
                'default'        => 'Aktif',
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
        $this->forge->addKey('id_unitkerja', true);
        $this->forge->createTable('unitkerja');
    }

    public function down()
    {
        $this->forge->dropTable('unitkerja');
    }
}
