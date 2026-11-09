<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelStatus extends Model
{
    protected $table = 'tbl_status';
    protected $primaryKey = 'id_status';
    protected $returnType = 'object';
    protected $allowedFields = ['nama_status'];
}