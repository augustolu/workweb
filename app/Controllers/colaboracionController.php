<?php

namespace App\Controllers;

use App\Models\Tarea;
use App\Models\Colaboracion;  
use App\Models\Subtarea;
use App\Models\MiembroSubtarea;


class ColaboracionController extends BaseController{
    

    public function ColaborarEnTarea(){
        return view('colaborarView');
    }

    public function tareaColaborar(){
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
        $data['idTarea'] = $idTarea;
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
        $data['correo_usuario_logueado'] = session()->get('correo'); // o el campo que uses en sesión


        return view('tareaColaborarView', $data);
    }
    
        


    
}
