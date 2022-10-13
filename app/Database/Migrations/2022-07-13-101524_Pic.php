<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pic extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'pic_id'      => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'pic_name'       => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
        ]);
        $this->forge->addKey('pic_id', true);
        $this->forge->createTable('pic');
    }

    public function down()
    {
        $this->forge->dropTable('pic');
    }
}
