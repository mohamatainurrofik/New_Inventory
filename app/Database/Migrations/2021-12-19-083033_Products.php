<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Products extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_product'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,

            ],
            'parent_id_product'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 50,
                'null'          => true,
            ],
            'kode_content_product'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'content_product'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'jenis_product'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'          => true,
            ],
            'pj_departement'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'          => true,
            ],
            'deskripsi_product'       => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'created_by' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
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
        $this->forge->addKey('id_product', true);
        $this->forge->createTable('products');
    }

    public function down()
    {
        $this->forge->dropTable('products');
    }
}
