<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Fuzzymaster extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_fuzzy'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,

            ],
            'fuzzy_type'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
                'null'          => true,
            ],
            'value'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
                'null'          => true,
            ],
            'up'       => [
                'type'           => 'DECIMAL',
                'constraint'     => '10, 2',
                'null'          => true,
            ],
            'middle'       => [
                'type'           => 'DECIMAL',
                'constraint'     => '10, 2',
                'null'          => true,
            ],
            'low'       => [
                'type'           => 'DECIMAL',
                'constraint'     => '10, 2',
                'null'          => true,
            ],
            'deskripsi'       => [
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
        $this->forge->addKey('id_fuzzy', true);
        $this->forge->createTable('fuzzymaster');
    }

    public function down()
    {
        $this->forge->dropTable('fuzzymaster');
    }
}


// INSERT INTO `fuzzymaster`(`id_fuzzy`, `fuzzy_type`, `value`, `up`, `middle`, `low`, `deskripsi`) VALUES ('','l','2',3,2,1,'Slightly Less Important');
// INSERT INTO `fuzzymaster`(`id_fuzzy`, `fuzzy_type`, `value`, `up`, `middle`, `low`, `deskripsi`) VALUES ('','l','3',4,3,2,'Slightly Important');
// INSERT INTO `fuzzymaster`(`id_fuzzy`, `fuzzy_type`, `value`, `up`, `middle`, `low`, `deskripsi`) VALUES ('','l','4',5,4,3,'Important And More Important');
// INSERT INTO `fuzzymaster`(`id_fuzzy`, `fuzzy_type`, `value`, `up`, `middle`, `low`, `deskripsi`) VALUES ('','l','5',6,5,4,'More Important');
// INSERT INTO `fuzzymaster`(`id_fuzzy`, `fuzzy_type`, `value`, `up`, `middle`, `low`, `deskripsi`) VALUES ('','l','6',7,6,5,'Between More Important and Very Important');
// INSERT INTO `fuzzymaster`(`id_fuzzy`, `fuzzy_type`, `value`, `up`, `middle`, `low`, `deskripsi`) VALUES ('','l','7',8,7,6,'Very Important');
// INSERT INTO `fuzzymaster`(`id_fuzzy`, `fuzzy_type`, `value`, `up`, `middle`, `low`, `deskripsi`) VALUES ('','l','8',9,8,7,'Between Very Important and Extremely Important');
// INSERT INTO `fuzzymaster`(`id_fuzzy`, `fuzzy_type`, `value`, `up`, `middle`, `low`, `deskripsi`) VALUES ('','l','9',10,9,8,'Extremely Important');
// INSERT INTO `fuzzymaster`(`id_fuzzy`, `fuzzy_type`, `value`, `up`, `middle`, `low`, `deskripsi`) VALUES ('','r','2',1,0.5,0.33,'Slightly Less Important');
// INSERT INTO `fuzzymaster`(`id_fuzzy`, `fuzzy_type`, `value`, `up`, `middle`, `low`, `deskripsi`) VALUES ('','r','3',0.5,0.33,0.25,'Slightly Important');
// INSERT INTO `fuzzymaster`(`id_fuzzy`, `fuzzy_type`, `value`, `up`, `middle`, `low`, `deskripsi`) VALUES ('','r','4',0.33,0.25,0.20,'Important And More Important');
// INSERT INTO `fuzzymaster`(`id_fuzzy`, `fuzzy_type`, `value`, `up`, `middle`, `low`, `deskripsi`) VALUES ('','r','5',0.25,0.20,0.1667,'More Important');
// INSERT INTO `fuzzymaster`(`id_fuzzy`, `fuzzy_type`, `value`, `up`, `middle`, `low`, `deskripsi`) VALUES ('','r','6',0.20,0.1667,0.0143,'Between More Important and Very Important');
// INSERT INTO `fuzzymaster`(`id_fuzzy`, `fuzzy_type`, `value`, `up`, `middle`, `low`, `deskripsi`) VALUES ('','r','7',0.1667,0.1428,0.1250,'Very Important');
// INSERT INTO `fuzzymaster`(`id_fuzzy`, `fuzzy_type`, `value`, `up`, `middle`, `low`, `deskripsi`) VALUES ('','r','8',0.1428,0.1250,0.1111,'Between Very Important and Extremely Important');
// INSERT INTO `fuzzymaster`(`id_fuzzy`, `fuzzy_type`, `value`, `up`, `middle`, `low`, `deskripsi`) VALUES ('','r','9',0.1250, 0.1111, 0.1000,'Extremely Important');