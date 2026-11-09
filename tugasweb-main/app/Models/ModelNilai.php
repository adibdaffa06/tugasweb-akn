<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelNilai extends Model
{
    protected $table = 'tbl_nilai';
    protected $primaryKey = 'id_nilai';
    protected $returnType = 'object';
    protected $allowedFields = ['id_transaksi', 'kode_akun3', 'debit', 'kredit', 'id_status'];
}