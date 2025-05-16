<?php

namespace App\Models;

use CodeIgniter\Model;

class Asignacion extends Model
{
    protected $table = 'miembro_subtarea';
    protected $primaryKey = false;
    protected $allowedFields = ['subtarea_id', 'usuario_id'];
    protected $returnType = 'array';
    protected $useTimestamps = false;
    protected $useAutoIncrement = false;  
}
