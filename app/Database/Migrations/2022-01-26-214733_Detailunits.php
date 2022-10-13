<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Detailunits extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_detailunit'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'unit_id'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 50,
            ],
            'supplier_id'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'karyawan_id'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'unitkerja_id'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'milik'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'status_unit'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'kode_unit'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'foto_unit'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
            ],
            'kondisi'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'tahun_perolehan'       => [
                'type'       => 'YEAR',
            ],
            'invoice'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'nota_dinas'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'pj'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'harga'       => [
                'type'       => 'INT',
            ],
            'barcode'       => [
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
        $this->forge->addKey('id_detailunit', true);
        $this->forge->createTable('detailunits');
    }

    public function down()
    {
        $this->forge->dropTable('detailunits');
    }
}
