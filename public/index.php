<?php

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\LoginController;
use Controllers\CitaController;
use Controllers\MascotaController;
use Controllers\PropietarioController;
use Controllers\ApiController;

$router = new Router();

//Iniciar sesión
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

//Crear usuario
$router->get('/crear', [LoginController::class, 'crear']);
$router->post('/crear', [LoginController::class, 'crear']);

//Confirmación de cuenta
$router->get('/mensaje', [LoginController::class, 'mensaje']);
$router->get('/confirmar', [LoginController::class, 'confirmar']);

//Formulario 'olvidé mi password'
$router->get('/olvide', [LoginController::class, 'olvide']);
$router->post('/olvide', [LoginController::class, 'olvide']);

//Formulario restablecer
$router->get('/restablecer', [LoginController::class, 'restablecer']);
$router->post('/restablecer', [LoginController::class, 'restablecer']);

//Administración citas
$router->get('/admin-citas', [CitaController::class, 'admin_citas']);
$router->get('/admin-citas/crear', [CitaController::class, 'crear']);
$router->post('/admin-citas/crear', [CitaController::class, 'crear']);
$router->post('/admin-citas/buscar-usuario', [CitaController::class, 'buscar_usuario']);
$router->get('/admin-citas/actualizar', [CitaController::class, 'actualizar']);
$router->post('/admin-citas/actualizar', [CitaController::class, 'actualizar']);
$router->post('/admin-citas/eliminar', [CitaController::class, 'eliminar']);
$router->get('/admin-citas/buscar', [CitaController::class, 'buscar_citas']);
$router->post('/admin-citas/buscar', [CitaController::class, 'buscar_citas']);
$router->get('/admin-citas/calendario', [CitaController::class, 'calendario']);

//Api events
$router->get('/api/events', [ApiController::class, 'index']);

//Administración propietarios
$router->get('/admin-propietarios', [PropietarioController::class, 'admin_propietarios']);
$router->get('/admin-propietarios/crear', [PropietarioController::class, 'crear']);
$router->post('/admin-propietarios/crear', [PropietarioController::class, 'crear']);
$router->get('/admin-propietarios/actualizar', [PropietarioController::class, 'actualizar']);
$router->post('/admin-propietarios/actualizar', [PropietarioController::class, 'actualizar']);
$router->post('/admin-propietarios/eliminar', [PropietarioController::class, 'eliminar']);


//Administración mascotas
$router->get('/admin-mascotas', [MascotaController::class, 'admin_mascota']);
$router->get('/admin-mascotas/crear', [MascotaController::class, 'crear']);
$router->post('/admin-mascotas/crear', [MascotaController::class, 'crear']);
$router->get('/admin-mascotas/actualizar', [MascotaController::class, 'actualizar']);
$router->post('/admin-mascotas/actualizar', [MascotaController::class, 'actualizar']);
$router->post('/admin-mascotas/eliminar', [MascotaController::class, 'eliminar']);

$router->comprobarRutas();
