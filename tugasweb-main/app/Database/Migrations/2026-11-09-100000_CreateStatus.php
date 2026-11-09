<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStatus extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_status' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_status' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
        ]);
        $this->forge->addKey('id_status', true);
        $this->forge->addKey('nama_status', false, true);
        $this->forge->createTable('tbl_status');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_status', true);
    }
}