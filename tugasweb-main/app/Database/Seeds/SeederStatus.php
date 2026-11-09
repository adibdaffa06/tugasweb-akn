<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeederStatus extends Seeder
{
    public function run()
    {
        $statuses = ['Penerimaan', 'Pengeluaran', 'Investasi Masuk', 'Investasi Keluar', 'Normal'];
        $builder = $this->db->table('tbl_status');

        foreach ($statuses as $status) {
            $exists = $builder->where('nama_status', $status)->countAllResults();
            if ($exists === 0) {
                $builder->insert(['nama_status' => $status]);
            }
        }
    }
}