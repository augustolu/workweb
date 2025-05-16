<?php

namespace App\Models;

use CodeIgniter\Model;

class Colaboracion extends Model
{
    protected $table = 'colaboracion';
    protected $primaryKey = ['usuario_id', 'tarea_id'];
    protected $allowedFields = ['tarea_id', 'usuario_id', 'rol'];
    protected $returnType = 'array';
    protected $useTimestamps = false;
    protected $useAutoIncrement = false;


     public function obtenerColaboradores($tarea_id)
    {
        return $this->select('colaboracion.*, usuario.nombre')
                ->join('usuario', 'usuario.id = colaboracion.usuario_id')
                ->where('colaboracion.tarea_id', $tarea_id)
                ->findAll();
    }

    public function agregarColaboracion($tarea_id, $usuario_id)
{
    $db = \Config\Database::connect();
    return $db->table('colaboracion')->insert([
        'tarea_id' => $tarea_id,
        'usuario_id' => $usuario_id,

        'rol' => 'colaborador'
    ]);
}

public function obtenerTarea($id)
    {
        return $this->find($id);
    }



}
