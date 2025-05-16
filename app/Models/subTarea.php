<?php

namespace App\Models;

use CodeIgniter\Model;

class Subtarea extends Model
{
    protected $table = 'subtarea';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'tarea_id', 'titulo', 'descripcion', 'estado',
        'prioridad', 'fecha_vencimiento', 'fecha_recordatorio', 'color'
    ];
    protected $returnType = 'array';
    protected $useTimestamps = false;

    public function obtenerSubTareas($id_Tarea)
{
    return $this->where('tarea_id', $id_Tarea)->findAll();
}

    public function obtenerSubTarea($id_SubTarea){
        return $this->findAll($id_SubTarea);
    }

    public function obtenerUsuariosPorSubtarea($subtarea_id)
    {
        return $this->where('subtarea_id', $subtarea_id)->findAll();
    }

    public function quitarResponsable($subtarea_id, $usuario_id)
    {
        return $this->db->table('miembro_subtarea')
            ->where('subtarea_id', $subtarea_id)
            ->where('usuario_id', $usuario_id)
            ->delete();
    }

    public function asignarResponsable($subtarea_id, $usuario_id)
    {
        return $this->db->table('miembro_subtarea')->insert([
            'subtarea_id' => $subtarea_id,
            'usuario_id' => $usuario_id
        ]);
    }

    public function obtenerColaboradoresDisponibles($subtarea_id)
    {
        $subquery = $this->db->table('miembro_subtarea')
            ->select('usuario_id')
            ->where('subtarea_id', $subtarea_id);

        return $this->db->table('usuario')
            ->whereNotIn('id', $subquery)
            ->get()->getResultArray();
    }

      public function cambiarEstado($id, $nuevoEstado)
    {
        return $this->update($id, ['estado' => $nuevoEstado]);
    }
}
