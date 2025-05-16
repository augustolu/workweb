<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
/// Página principal
$routes->get('/', 'Home::inicio');

/// Autenticación y usuarios
$routes->get('/login', 'UsuarioController::login');
$routes->get('/logout', 'usuarioController::logout');
$routes->get('/registro', 'UsuarioController::registrarse');
$routes->post('usuario/guardarRegistro', 'usuarioController::guardarRegistro');
$routes->post('usuario/autenticar', 'usuarioController::autenticar');
$routes->get('usuario/editar', 'UsuarioController::editarView');
$routes->post('usuario/editarguardar', 'UsuarioController::editarGuardar');

/// Tareas
$routes->get('tareas/crear', 'tareaController::crear');
$routes->post('tareas/guardar', 'tareaController::guardar');
$routes->post('tarea/editar', 'TareaController::editar');
$routes->post('tarea/actualizar', 'TareaController::actualizar');
$routes->post('tarea/baja', 'TareaController::baja');
$routes->get('tareas/historial', 'tareaController::historial');
$routes->get('tarea/archivar/(:num)', 'tareaController::archivar/$1');
$routes->get('/redirigirATarea', 'TareaController::redirigirATarea');
$routes->get('tarea/mostrarDetalles', 'tareaController::mostrarDetalles');
$routes->post('/tarea', 'tareaController::mostrarDetalles');

/// Subtareas
$routes->post('subtarea/guardar', 'subTareaController::guardar'); // Para formularios normales
$routes->post('subtarea/crear', 'subTareaController::crear');     // Solo AJAX
$routes->post('subtarea/eliminar/(:num)', 'subTareaController::eliminar/$1');
$routes->post('subtarea/editar/(:num)', 'subTareaController::editar/$1');
$routes->post('subtarea/agregarResponsable', 'subTareaController::agregarResponsable');
$routes->post('subtarea/quitarResponsable', 'subTareaController::quitarResponsable');
$routes->post('/subtareas/cambiarEstado', 'subTareaController::cambiarEstado');

/// Colaboraciones
$routes->get('/colaboradores', 'colaboracionController::mostrarDetalles');
$routes->get('tareas/colaborar', 'colaboracionController::ColaborarEnTarea');
$routes->post('tarea/colaborar', 'colaboracionController::tareaColaborar');

/// Invitaciones
$routes->post('tarea/enviarCorreo', 'InvitacionController::enviarCorreo');
$routes->post('invitacion/verificar', 'InvitacionController::IniciarColaboracion');
