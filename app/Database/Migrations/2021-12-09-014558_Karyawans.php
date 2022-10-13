<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Karyawans extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_karyawan'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'jabatan_id'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 50,
            ],
            'nrp'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'email'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'nama'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'alamat'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'foto'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'status_karyawan'      => [
                'type'           => 'ENUM',
                'constraint'     => ['PKWT', 'Organik', 'Tidak Aktif'],
                'default'        => 'PKWT',
            ],
            'deskripsi'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'is_pic'       => [
                'type'       => 'VARCHAR',
                'constraint'       => '50',
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
        $this->forge->addKey('id_karyawan', true);
        $this->forge->createTable('karyawans');
    }

    public function down()
    {
        $this->forge->dropTable('karyawans');
    }
}
