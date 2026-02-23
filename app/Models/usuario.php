<?php

namespace App\Models;

use CodeIgniter\Model;

class Usuario extends Model
{
    protected $table = 'usuario';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombre', 'correo', 'contrasenia'];
    protected $returnType = 'array';
    protected $useTimestamps = false;

    public function verificarCredenciales($correo, $clave)
    {
        return $this->where([
            'correo'     => $correo,
            'contrasenia' => $clave
        ])->first();
    }

    
}
