<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Suplliers extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_supplier'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'supplier'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 50,
            ],
            'email_supplier'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'alamat'       => [
                'type'       => 'VARCHAR',
                'constraint' => '256',
            ],
            'contact1'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'contact2'       => [
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
        $this->forge->addKey('id_supplier', true);

        $this->forge->createTable('suppliers');
    }

    public function down()
    {
        $this->forge->dropTable('suppliers');
    }
}
