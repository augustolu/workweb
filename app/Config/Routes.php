<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
/// Página principal
$routes->get('/', 'Home::inicio');

/// Autenticación y usuarios
$routes->get('/login', 'UsuarioController::login');
$routes->get('/logout', 'UsuarioController::logout');
$routes->get('/registro', 'UsuarioController::registrarse');
$routes->post('usuario/guardarRegistro', 'UsuarioController::guardarRegistro');
$routes->post('usuario/autenticar', 'UsuarioController::autenticar');
$routes->get('usuario/editar', 'UsuarioController::editarView');
$routes->post('usuario/editarguardar', 'UsuarioController::editarGuardar');

/// Tareas
$routes->get('tareas/crear', 'TareaController::crear');
$routes->post('tareas/guardar', 'TareaController::guardar');
$routes->post('tarea/editar', 'TareaController::editar');
$routes->post('tarea/actualizar', 'TareaController::actualizar');
$routes->post('tarea/baja', 'TareaController::baja');
$routes->get('tareas/historial', 'TareaController::historial');
$routes->get('tarea/archivar/(:num)', 'TareaController::archivar/$1');
$routes->get('/redirigirATarea', 'TareaController::redirigirATarea');
$routes->get('tarea/mostrarDetalles', 'TareaController::mostrarDetalles');
$routes->match(['get', 'post'], '/tarea', 'TareaController::mostrarDetalles');

/// Subtareas
$routes->post('subtarea/guardar', 'SubTareaController::guardar'); // Para formularios normales
$routes->post('subtarea/crear', 'SubTareaController::crear');     // Solo AJAX
$routes->post('subtarea/eliminar/(:num)', 'SubTareaController::eliminar/$1');
$routes->post('subtarea/editar/(:num)', 'SubTareaController::editar/$1');
$routes->post('subtarea/agregarResponsable', 'SubTareaController::agregarResponsable');
$routes->post('subtarea/quitarResponsable', 'SubTareaController::quitarResponsable');
$routes->post('/subtareas/cambiarEstado', 'SubTareaController::cambiarEstado');

/// Colaboraciones
$routes->get('/colaboradores', 'ColaboracionController::mostrarDetalles');
$routes->get('tareas/colaborar', 'ColaboracionController::ColaborarEnTarea');
$routes->post('tarea/colaborar', 'ColaboracionController::tareaColaborar');

/// Invitaciones
$routes->post('tarea/enviarCorreo', 'InvitacionController::enviarCorreo');
$routes->post('invitacion/verificar', 'InvitacionController::IniciarColaboracion');
