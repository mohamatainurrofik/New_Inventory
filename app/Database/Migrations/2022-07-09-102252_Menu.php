<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Menu extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_menu'      => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'parent_id_menu'       => [
                'type'       => 'int',
                'constraint' => 5,
                'null'       => true,
            ],
            'title'      => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'url'      => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'menuorder'      => [
                'type'       => 'int',
                'constraint' => 5,
            ],
            'level'      => [
                'type'       => 'int',
                'constraint' => 5,
            ],
            'icon'      => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'deskripsi_menu'      => [
                'type'       => 'TEXT',
                'null'       => true,
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
        $this->forge->addKey('id_menu', true);

        $this->forge->createTable('menu');
    }

    public function down()
    {
        $this->forge->dropTable('menu');
    }
}
