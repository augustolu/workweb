<?php

namespace App\Controllers;

use App\Models\Colaboracion;
use App\Models\Subtarea;
use App\Models\Tarea;

class SubTareaController extends BaseController
{
    public function quitarResponsable()
    {
        $subtarea_id = $this->request->getPost('subtarea_id');
        $usuario_id = $this->request->getPost('usuario_id');
        $tarea_id = $this->request->getPost('tarea_id');
        $model = new Subtarea();
        $model->quitarResponsable($subtarea_id, $usuario_id);

        session()->setFlashdata('tarea_id', $tarea_id);
        return redirect()->to('/tarea')->with('mensaje', 'Responsable removido');
    }

    public function agregarResponsable()
    {
        $subtarea_id = $this->request->getPost('subtarea_id');
        $usuario_id = $this->request->getPost('usuario_id');
        $tarea_id = $this->request->getPost('tarea_id');
        $model = new Subtarea();
        $model->asignarResponsable($subtarea_id, $usuario_id);
        
        session()->setFlashdata('tarea_id', $tarea_id);
        return redirect()->to('/tarea')->with('mensaje', 'Responsable agregado');
    }
    public function guardarAsignacion()
    {
        $subtarea_id = $this->request->getPost('subtarea_id');
        $usuario_id = $this->request->getPost('usuario_id');
        $correo = $this->request->getPost('correo');
        $model = new Subtarea();
        $model->asignarResponsable($subtarea_id, $usuario_id, $correo);
        return redirect()->to('/tareas/detalles/' . $subtarea_id)->with('mensaje', 'Responsable asignado');
    }

    public function guardar()
{
    $modeloSubtarea = new Subtarea();
    $modeloMiembroSubtarea = new Colaboracion();

    $data = [
        'tarea_id' => $this->request->getPost('tarea_id'),
        'titulo' => $this->request->getPost('titulo'),
        'descripcion' => $this->request->getPost('descripcion'),
        'estado' => $this->request->getPost('estado') // importante agregar
    ];

    if ($modeloSubtarea->insert($data)) {
        $subtarea_id = $modeloSubtarea->insertID();

        $responsable_id = $this->request->getPost('responsable');
        if (!empty($responsable_id)) {
            $modeloMiembroSubtarea->insert([
                'subtarea_id' => $subtarea_id,
                'usuario_id' => $responsable_id
            ]);
        }

        session()->setFlashdata('tarea_id', $data['tarea_id']);
        return redirect()->to('/tarea/detalles')->with('mensaje', 'Subtarea creada con éxito');
    } else {
        return redirect()->back()->withInput()->with('error', 'Error al crear la subtarea');
    }
}

public function crear()
{
    $titulo = $this->request->getPost('titulo');
    $descripcion = $this->request->getPost('descripcion');
    $estado = $this->request->getPost('estado');
    $tarea_id = $this->request->getPost('tarea_id');
    $prioridad = $this->request->getPost('prioridad');
    $color = $this->request->getPost('color');

    $model = new \App\Models\Subtarea();
    $insert = $model->insert([
        'titulo' => $titulo,
        'descripcion' => $descripcion,
        'estado' => $estado,
        'tarea_id' => $tarea_id,
        'prioridad' => $prioridad,
        'color' => $color
    ]);

    if ($insert) {
        return redirect()->back()->with('success', 'Subtarea creada correctamente');
    } else {
        return redirect()->back()->with('error', 'No se pudo guardar la subtarea.');
    }
}


public function eliminar($id)
{
    $modelo = new \App\Models\Subtarea();
    $tarea_id = $this->request->getPost('tarea_id');
    

    if ($modelo->delete($id)) {
        $tareaCtrl = new \App\Controllers\tareaController();
            session()->setFlashdata('tarea_id', $tarea_id);

    return $tareaCtrl->mostrarDetalles();
    } else {
        return redirect()->back()->with('error', 'No se pudo eliminar la subtarea.');
    }
}

public function editar($id)
{
    $modelo = new \App\Models\Subtarea();
    $datos = [
        'titulo' => $this->request->getPost('titulo'),
        'descripcion' => $this->request->getPost('descripcion'),
        'estado' => $this->request->getPost('estado'),
        'prioridad' => $this->request->getPost('prioridad'),
        'fecha_vencimiento' => $this->request->getPost('fecha_vencimiento'),
        'fecha_recordatorio' => $this->request->getPost('fecha_recordatorio'),
        'color' => $this->request->getPost('color'),
    ];

    if ($modelo->update($id, $datos)) {
        return redirect()->back()->with('mensaje', 'Subtarea actualizada correctamente.');
    } else {
        return redirect()->back()->with('error', 'Error al actualizar la subtarea.');
    }
}



    public function cambiarEstado()
    {
        $id = $this->request->getPost('subtarea_id');
        $estado = $this->request->getPost('estado');
        $tarea_id = $this->request->getPost('tarea_id');

        $modelo = new Subtarea();
        $modeloTarea = new Tarea();
        $modelo->cambiarEstado($id, $estado);
        $modeloTarea->actualizarEstadoPorSubtareas($tarea_id);

        $tareaCtrl = new \App\Controllers\ColaboracionController();
    session()->setFlashdata('tarea_id', $tarea_id);

    return $tareaCtrl->tareaColaborar();
    }

}





