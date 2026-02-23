<?php

namespace App\Controllers;

use App\Models\Usuario;

class UsuarioController extends BaseController
{
    public function login()
    {
        helper(['form']);
        return view('iniciarSesionView');
    }

    public function editarView()
    {
        $session = session();
        $usuarioId = $session->get('id_usuario');

        try {
            $modelo = new Usuario();
            $usuario = $modelo->find($usuarioId);

            if (!$usuario) {
                return redirect()->to('/')->with('error', 'Usuario no encontrado.');
            }

            return view('editar', ['usuario' => $usuario]);

        } catch (\Exception $e) {
            return redirect()->to('/')->with('error', 'Ocurrió un error al cargar el perfil.');
        }
    }

    public function editarGuardar()
    {
        $session = session();
        $usuarioId = $session->get('id_usuario');

        try {
            $modelo = new Usuario();
            $datos = [
                'nombre' => $this->request->getPost('nombre'),
                'correo' => $this->request->getPost('correo'),
                'contrasenia' => hash('sha256', $this->request->getPost('contrasenia')),
            ];

            $modelo->update($usuarioId, $datos);
            return redirect()->to('/')->with('mensaje', 'Perfil actualizado con éxito.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al actualizar el perfil.');
        }
    }

    public function autenticar()
    {
        $correo = $this->request->getPost('correo');
        $clave = $this->request->getPost('clave');

        try {
            $model = new Usuario();
            $usuario = $model->where('correo', $correo)->first();

            if ($usuario && $clave === $usuario['contrasenia']) {
                session()->set([
                    'id_usuario' => $usuario['id'],
                    'nombre'     => $usuario['nombre'],
                    'correo'     => $usuario['correo'],
                    'isLoggedIn' => true
                ]);
                return redirect()->to('/');
            } else {
                return redirect()->back()->with('error', 'Correo o contraseña incorrectos.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocurrió un error al intentar iniciar sesión.');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('mensaje', 'Sesión cerrada con éxito.');
    }

    public function registrarse()
    {
        helper(['form']);
        return view('iniciarSesionView', ['showRegister' => true]);
    }

    public function guardarRegistro()
{
    helper(['form']);

    $nombre = $this->request->getPost('nombre');
    $correo = $this->request->getPost('correo');
    $clave  = $this->request->getPost('clave');

    if (empty($nombre) || empty($correo) || empty($clave)) {
        return redirect()->back()->withInput()->with('error', 'Todos los campos son obligatorios.');
    }

    $model = new Usuario();
    
    if ($model->where('correo', $correo)->first()) {
        return redirect()->back()->withInput()->with('error', 'El correo ya está registrado.');
    }

    $data = [
        'nombre'      => $nombre,
        'correo'      => $correo,
        'contrasenia' => $clave  // Sin hasheo (ALMACENAMIENTO EN TEXTO PLANO - SOLO PARA PRUEBAS)
    ];

    try {
        $model->insert($data);
        return redirect()->to('/login')->with('success', 'Registro exitoso. Ahora puedes iniciar sesión.');
    } catch (\Exception $e) {
        return redirect()->back()->withInput()->with('error', 'Error al registrar el usuario: '.$e->getMessage());
    }
}
}
