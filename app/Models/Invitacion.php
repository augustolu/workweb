<?php

namespace App\Models;

use CodeIgniter\Model;

class Invitacion extends Model
{
    protected $table = 'invitacion';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'correo', 'codigo', 'tarea_id', 'estado', 'creado_en'
    ];
    protected $returnType = 'array';
    protected $useTimestamps = false;

    public function obtenerCodigo($correo, $tarea_id)
    {
        helper('text');
        $codigo = bin2hex(random_bytes(4));

        $this->insert([
            'correo'    => $correo,
            'codigo'    => $codigo,
            'tarea_id'  => $tarea_id,
            'estado'    => 'pendiente',
            'creado_en' => date('Y-m-d H:i:s'),
        ]);

        return $codigo;
    }

    public function obtenerPorCodigo($codigo)
{
    return $this->where('codigo', $codigo)->first();
}

public function marcarComoAceptada($codigo)
{
    return $this->where('codigo', $codigo)->set(['estado' => 'aceptada'])->update();
}

}