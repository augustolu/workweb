<?php

namespace App\Models;

use CodeIgniter\Model;

class MiembroSubtarea extends Model
{
    protected $table            = 'miembro_subtarea';
    protected $primaryKey       = ['subtarea_id', 'usuario_id'];
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $allowedFields    = ['subtarea_id', 'usuario_id'];

    public function obtenerMiembrosSubTarea()
    {
        return $this->findAll();
    }



    public function obtenerUsuariosConDatosPorSubtarea($subtarea_id)
{
    return $this->select('miembro_subtarea.*, usuario.nombre, usuario.correo')
                ->join('usuario', 'usuario.id = miembro_subtarea.usuario_id')
                ->where('miembro_subtarea.subtarea_id', $subtarea_id)
                ->findAll();
}



}
