<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AuthPermissionMenu extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'permission_id'      => [
                'type'           => 'INT',
                'constraint'     => 5,
            ],
            'menu_id'       => [
                'type'       => 'int',
                'constraint' => 5,
            ],
        ]);
        $this->forge->createTable('auth_permissions_menu');
    }

    public function down()
    {
        $this->forge->dropTable('auth_permissions_menu');
    }
}
