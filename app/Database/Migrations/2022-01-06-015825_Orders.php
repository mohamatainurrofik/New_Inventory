<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Orders extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_order'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'order_type'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'order_lokasi'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'description'       => [
                'type'       => 'TEXT',

            ],
            'status_order'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'dokumen_order'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'created_by' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
            ],
            'updated_by' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
            ],
            'feedbackdescription'       => [
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
        $this->forge->addKey('id_order', true);
        $this->forge->createTable('orders');
    }

    public function down()
    {
        $this->forge->dropTable('orders');
    }
}
