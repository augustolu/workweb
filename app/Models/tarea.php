<?php

namespace App\Models;

use CodeIgniter\Model;

class Tarea extends Model
{
    protected $table = 'tarea';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'usuario_id',
        'titulo',
        'descripcion',
        'estado',
        'prioridad',
        'fecha_vencimiento',
        'fecha_recordatorio',
        'color',
        'archivada'
    ];

    protected $returnType = 'array';
    protected $useTimestamps = false;

    protected $validationRules = [
        'titulo' => 'required|min_length[3]',
        'prioridad' => 'in_list[baja,normal,alta]',
        'fecha_vencimiento' => 'permit_empty|valid_date',
        'fecha_recordatorio' => 'permit_empty|valid_date',
    ];

    // Obtiene todas las tareas no archivadas (solo las visibles)
    public function obtenerTareas()
    {
        return $this->where('archivada', 0)->findAll();
    }

    public function obtenerTarea($id)
    {
        return $this->find($id);
    }

    // Tareas propias + colaborativas no archivadas
    public function obtenerTareasPorUsuario($usuarioId)
        {
            return $this->where('usuario_id', $usuarioId)
            ->where('archivada', 0)
            ->findAll();
    }

    public function obtenerTareasColaborativas($usuarioId)
        {
            return $this->db->table('tarea')
                ->select('tarea.*')
                ->join('colaboracion', 'colaboracion.tarea_id = tarea.id')
                ->where('colaboracion.usuario_id', $usuarioId)
                ->where('tarea.archivada', 0)
                ->get()
                ->getResultArray();
        }

    public function obtenerTareasArchivadas($usuarioId)
    {
        return $this->where('usuario_id', $usuarioId)
                    ->where('archivada', 1)
                    ->findAll();
    }

    public function obtenerTareasNoArchivadas($usuarioId)
    {
        return $this->where('usuario_id', $usuarioId)
                    ->where('archivada', 0)
                    ->findAll();
    }

    public function cambiarEstado($id, $nuevoEstado)
    {
        return $this->update($id, ['estado' => $nuevoEstado]);
    }


public function actualizarEstadoPorSubtareas($idTarea) {
    $modeloSubtarea = new \App\Models\Subtarea();

    $subtareas = $modeloSubtarea->where('tarea_id', $idTarea)->findAll();

    if (empty($subtareas)) return;

    $completadas = 0;
    $total = count($subtareas);

    foreach ($subtareas as $sub) {
        if ($sub['estado'] === 'completada') {
            $completadas++;
        }
    }

    if ($completadas === $total) {
        $nuevoEstado = 'completada';
    } elseif ($completadas > 0) {
        $nuevoEstado = 'en_proceso';
    } else {
        $nuevoEstado = 'definida';
    }

    $this->update($idTarea, ['estado' => $nuevoEstado]);
}

}
