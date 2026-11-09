<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateNilai extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_nilai' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_transaksi' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'kode_akun3' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
            ],
            'debit' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
                'default' => 0,
            ],
            'kredit' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
                'default' => 0,
            ],
            'id_status' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
            ],
        ]);
        $this->forge->addKey('id_nilai', true);
        $this->forge->addKey('id_transaksi');
        $this->forge->addForeignKey('id_transaksi', 'tbl_transaksi', 'id_transaksi', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_status', 'tbl_status', 'id_status', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('tbl_nilai');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_nilai', true);
    }
}