<?php

namespace App\Controllers;

use App\Models\Invitacion;

class InvitacionController extends BaseController
{
    public function enviarCorreo()
{
    $correo = $this->request->getPost('correo');
    $tarea_id = $this->request->getPost('tarea_id');
    $usuarioId = session()->get('id_usuario');
    $modeloInvitacion = new Invitacion();
    $codigo = $modeloInvitacion->obtenerCodigo($correo, $tarea_id);
    $tareaCtrl = new \App\Controllers\tareaController();
    session()->setFlashdata('tarea_id', $tarea_id);

    $email = \Config\Services::email();

    $email->setTo($correo);
    $email->setSubject('Invitación a colaborar en una tarea');
        $email->setMessage("¡Hola! Has sido invitado a participar en una tarea. Usa este código para aceptar la invitación: <b>$codigo</b>");

    if ($email->send()) {
            echo "<script>alert('Correo enviado correctamente');</script>";
        } else {
            echo "<script>alert('Error al enviar el correo');</script>";
        }
        return $tareaCtrl->mostrarDetalles();
}

public function IniciarColaboracion()
{
    $codigo = $this->request->getPost('codigo');

    if (!$codigo) {
        return redirect()->back()->with('error', 'Código no enviado.');
    }

    $modeloInvitacion = new \App\Models\Invitacion();
    $modeloColaboracion = new \App\Models\Colaboracion();

    $invitacion = $modeloInvitacion->obtenerPorCodigo($codigo);

    if (!$invitacion) {
        return redirect()->back()->with('error', 'Código inválido.');
    }

    if ($invitacion['estado'] !== 'pendiente') {
        return redirect()->back()->with('error', 'Esta invitación ya fue usada o cancelada.');
    }

    // Verifica sesión activa
    $usuarioId = session()->get('id_usuario');
    $correoSesion = session()->get('correo');

    if (!$usuarioId || !$correoSesion) {
        return redirect()->to('/login')->with('error', 'Debes iniciar sesión para colaborar.');
    }

    // Validar que el correo coincida con el de la invitación
    if (strtolower($correoSesion) !== strtolower($invitacion['correo'])) {
        return redirect()->back()->with('error', 'Este código no corresponde a tu correo.');
    }

    // Verificar si el usuario ya es colaborador en la tarea
    $esColaborador = $modeloColaboracion->where('tarea_id', $invitacion['tarea_id'])
                                        ->where('usuario_id', $usuarioId)
                                        ->first();
    
    if ($esColaborador) {
        // Redirigir a la vista de la tarea si ya es colaborador
        session()->setFlashdata('tarea_id', $invitacion['tarea_id']);
        return redirect()->to('/')->with('error', 'Ya eres colaborador en esta tarea.');
    }

    // Crear colaboración
    $modeloColaboracion->agregarColaboracion($invitacion['tarea_id'], $usuarioId);

    // Marcar invitación como aceptada
    $modeloInvitacion->marcarComoAceptada($codigo);

    // Redirigir a la vista de la tarea
    session()->setFlashdata('tarea_id', $invitacion['tarea_id']);
    return redirect()->to('/')->with('success', '¡Te uniste correctamente a la tarea!');
}

}





