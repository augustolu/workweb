<?php

namespace App\Controllers;

use App\Models\Tarea;
use App\Models\Subtarea;
use App\Models\MiembroSubtarea;
use App\Models\Colaboracion;


class TareaController extends BaseController{
    
    
    public function mostrarDetalles(){
        $modeloTarea = new Tarea();
        $modeloSubTarea = new Subtarea();
        $modeloMiembroSubtarea = new MiembroSubtarea();
        $modeloColaboracion = new Colaboracion();
    
        if (isset($this->request) && $this->request->getPost('tarea_id') !== null) {
            $idTarea = $this->request->getPost('tarea_id');
        } else {
            $idTarea = session()->getFlashdata('tarea_id');
        }
    
        $subTareas = $modeloSubTarea->obtenerSubTareas($idTarea);
        $totalSubtareas = count($subTareas);
        $cantidadCompletadas = 0;
        $haySubtareaNoCompletada = false;
    
        foreach ($subTareas as $sub) {
            $estadoSub = strtolower($sub['estado']);
            if ($estadoSub === 'completada') {
                $cantidadCompletadas++;
            } else {
                $haySubtareaNoCompletada = true;
            }
        }
    
        $tarea = $modeloTarea->find($idTarea);
        $estadoTarea = strtolower($tarea['estado']);
    
        if ($totalSubtareas === 0) {
            if ($estadoTarea !== 'definida') {
                $modeloTarea->update($idTarea, ['estado' => 'definida']);
            }
        } else {
            if ($cantidadCompletadas === $totalSubtareas) {
                if ($estadoTarea !== 'completada') {
                    $modeloTarea->update($idTarea, ['estado' => 'completada']);
                }
            } else {
                if ($estadoTarea === 'completada') {
                    $modeloTarea->update($idTarea, ['estado' => 'en_proceso']);
                } elseif ($estadoTarea === 'definida') {
                    $modeloTarea->update($idTarea, ['estado' => 'en_proceso']);
                }
            }
        }
    
        $data['tarea'] = $modeloTarea->obtenerTarea($idTarea);
        $data['subTareas'] = $subTareas;
        $data['subtareas'] = [];
    
        foreach ($subTareas as $subtarea) {
            $responsables = $modeloMiembroSubtarea
                ->select('usuario.*')
                ->join('usuario', 'usuario.id = miembro_subtarea.usuario_id')
                ->where('miembro_subtarea.subtarea_id', $subtarea['id'])
                ->findAll();
            $subtarea['responsables'] = $responsables;
            $data['subtareas'][] = $subtarea;
        }
    
        $colaboradores = $modeloColaboracion
            ->select('usuario.*')
            ->join('usuario', 'usuario.id = colaboracion.usuario_id')
            ->where('colaboracion.tarea_id', $idTarea)
            ->findAll();
    
        $asignados = $modeloMiembroSubtarea
            ->select('usuario_id')
            ->join('subtarea', 'subtarea.id = miembro_subtarea.subtarea_id')
            ->where('subtarea.tarea_id', $idTarea)
            ->findColumn('usuario_id');
    
        $colaboradoresDisponibles = array_filter($colaboradores, function ($usuario) use ($asignados) {
            return !in_array($usuario['id'], $asignados ?? []);
        });
    
        $data['colaboradores_disponibles'] = $colaboradoresDisponibles;
    
        return view('tareaView', $data);
    }
    
    
    
    

    public function crear()
    {
        return view('crearTareaView');
    }

    public function guardar()
    {
        $modeloTarea = new Tarea();
        $data = [
            'usuario_id' => session('id_usuario') ?? 1, // Mejor usar sesión si está disponible
            'titulo' => $this->request->getPost('titulo'),
            'descripcion' => $this->request->getPost('descripcion'),
            'estado' => 'definida',
            'prioridad' => $this->request->getPost('prioridad'),
            'fecha_vencimiento' => $this->request->getPost('fecha_vencimiento'),
            'fecha_recordatorio' => $this->request->getPost('fecha_recordatorio'),
            'color' => $this->request->getPost('color'),
            'archivada' => 0
        ];
        if ($modeloTarea->insert($data)) {
            return redirect()->to('/')->with('mensaje', 'Tarea creada con éxito');
        } else {
            dd($modeloTarea->errors());
        }
    }
    

    public function editar()
    {
        $id = $this->request->getPost('id_tarea');
        $modeloTarea = new Tarea();
        $data['tarea'] = $modeloTarea->find($id);
        return view('editarTareaView', $data);
    }

    public function actualizar()
    {
        $modeloTarea = new Tarea();
        $id = $this->request->getPost('id');
        $data = [
            'titulo' => $this->request->getPost('titulo'),
            'descripcion' => $this->request->getPost('descripcion'),
            'estado' => 'definida',
            'prioridad' => $this->request->getPost('prioridad'),
            'fecha_vencimiento' => $this->request->getPost('fecha_vencimiento'),
            'fecha_recordatorio' => $this->request->getPost('fecha_recordatorio'),
            'color' => $this->request->getPost('color')
        ];
        $modeloTarea->update($id, $data);
        return redirect()->to('/')->with('mensaje', 'Tarea actualizada con éxito');
    }

    // En vez de borrar, se archiva
    public function baja()
    {
        $id = $this->request->getPost('id_tarea');
        if ($id) {
            $tareaModel = new Tarea();
            $tareaModel->update($id, ['archivada' => 1]); // Baja lógica
            return redirect()->to('/')->with('mensaje', 'Tarea archivada correctamente');
        }
        return redirect()->to('/')->with('error', 'No se pudo archivar la tarea');
    }

    public function archivar($id)
    {
        $modeloTarea = new Tarea();
        $modeloTarea->update($id, ['archivada' => 1]);
        return redirect()->to('/')->with('mensaje', 'Tarea archivada correctamente.');
    }

    public function historial()
    {
        $modeloTarea = new Tarea();
        $usuarioId = session('id_usuario') ?? 1;
        $data['tareasArchivadas'] = $modeloTarea->obtenerTareasArchivadas($usuarioId);
        $data['tareasActivas'] = $modeloTarea->obtenerTareasNoArchivadas($usuarioId);
        return view('historialView', $data);
    }

    public function verColaboraciones()
    {
        $usuario_id = session()->get('id_usuario'); 
        $tareaModel = new Tarea(); 
        $data['tareas_colaborativas'] = $tareaModel->obtenerTareasColaborativas($usuario_id); 
        return view('inicioView', $data); 
    }

}
