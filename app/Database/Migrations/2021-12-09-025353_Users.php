<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_user'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'karyawan_id'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 50,
            ],
            'passwd'       => [
                'type'       => 'VARCHAR',
                'constraint' => '256',
            ],
            'level'       => [
                'type'       => 'int',
                'constraint' => '4',
            ],
            'status_user'      => [
                'type'           => 'ENUM',
                'constraint'     => ['Aktif', 'Tidak Aktif', 'Pending'],
                'default'        => 'Pending',
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
        $this->forge->addKey('id_user', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
