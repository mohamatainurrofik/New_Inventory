<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Dataorder extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_dataorder'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kode_order'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 50,
            ],
            'detailunit_id'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 50,
            ],
            'status_dataorder'       => [
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
        $this->forge->addKey('id_dataorder', true);
        $this->forge->createTable('dataorder');
    }

    public function down()
    {
        $this->forge->dropTable('dataorder');
    }
}
