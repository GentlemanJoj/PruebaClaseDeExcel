<?php

namespace Controllers;

use Model\Cita;
use MVC\Router;
use Model\Events;
use Model\Mascota;
use Model\Usuario;

date_default_timezone_set('America/Bogota');

class CitaController
{
    public static function admin_citas(Router $router)
    {
        session_start();
        isAuth();
        isAdmin();
        $alertas = [];

        if (empty($_GET)) {
            $eliminado = 0;
        } else {
            $eliminado = $_GET['aux'];
            $eliminado = filter_var($eliminado, FILTER_VALIDATE_INT);
        }


        $reservas = Cita::all();
        if (!$reservas) {
            Usuario::setAlerta('error', 'Actualmente no hay reservas, pruebe creando una');
            $reservas = [];
            $propietarios = [];
            $mascotas = [];
        } else {
            $propietarios = Usuario::all();
            $mascotas = Mascota::all();
        }


        $alertas = Cita::getAlertas();

        $router->render('citas/admin', [
            'titulo' => 'Administración',
            'eliminado' => $eliminado,
            'alertas' => $alertas,
            'reservas' => $reservas,
            'propietarios' => $propietarios,
            'mascotas' => $mascotas
        ]);
    }

    public static function crear(Router $router)
    {
        session_start();
        isAuth();
        isAdmin();

        $alertas = [];
        $consulta = "SELECT * FROM usuario WHERE usuario.tipousuarioId = 2";
        $propietarios = Usuario::SQL($consulta);
        $cita = new Cita();
        $actualizar = false;

        if (empty($_GET)) {
            $usuario = new Usuario();
            $mascotas = [];
        } else {
            $id = $_GET['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if (!$id) header('Location: /admin-citas');
            $usuario = Usuario::find($id);
            if (!$usuario) header('Location: /admin-citas');
            $consulta = " SELECT * FROM mascota WHERE mascota.usuarioId = " . $id . "; ";
            $mascotas = Mascota::SQL($consulta);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cita = new Cita($_POST);
            $alertas = $cita->comprobarFormularioReserva();
            if (empty($alertas)) {
                $alertas = $cita->comprobarDia();
                if (empty($alertas)) {
                    $alertas = $cita->comprobarHora();
                    if (empty($alertas)) {
                        $consulta = "SELECT * FROM cita WHERE fecha = '" . s($cita->fecha) . "';";
                        $reservas = Cita::SQL($consulta);
                        if (!$reservas) {
                            $resultado = $cita->guardar();
                            if ($resultado) {
                                Usuario::setAlerta('exito', 'Cita reservada con exito');
                            }
                        } else {
                            $aux = true;
                            $hora_cita = convertirHora($cita->hora);
                            foreach ($reservas as $reserva) {
                                $hora_reserva = convertirHora($reserva->hora);
                                if ($hora_cita === $hora_reserva) {
                                    $aux = false;
                                }
                            }

                            if ($aux) {
                                $resultado = $cita->guardar();
                                if ($resultado) {
                                    Usuario::setAlerta('exito', 'Cita reservada con exito');
                                }
                            } else {
                                Usuario::setAlerta('error', 'Ya existe cita para esa fecha y hora');
                            }
                        }
                    }
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render('citas/crear', [
            'titulo' => 'Reservar Citas',
            'alertas' => $alertas,
            'propietarios' => $propietarios,
            'usuario' => $usuario,
            'mascotas' => $mascotas,
            'cita' => $cita,
            'actualizar' => $actualizar
        ]);
    }

    public static function buscar_usuario()
    {
        session_start();
        isAuth();
        isAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            header('Location: /admin-citas/crear?id=' . $id);
        }
    }

    public static function buscar_citas(Router $router)
    {
        session_start();
        isAuth();
        isAdmin();

        $alertas = [];
        $cita = new Cita();
        $reservas = [];
        $propietarios = [];
        $mascotas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cita->sincronizar($_POST);
            $alertas = $cita->formularioBuscar();

            if (empty($alertas)) {
                $consulta = "SELECT * FROM cita WHERE fecha = '" . s($cita->fecha) . "';";
                $reservas = Cita::SQL($consulta);
                if (!$reservas) {
                    Usuario::setAlerta('error', 'No existen reservas para esa fecha');
                } else {
                    Usuario::setAlerta('exito', 'Citas encontradas');
                    $propietarios = Usuario::all();
                    $mascotas = Mascota::all();
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render('citas/buscar', [
            'titulo' => 'Buscar Citas',
            'alertas' => $alertas,
            'cita' => $cita,
            'reservas' => $reservas,
            'propietarios' => $propietarios,
            'mascotas' => $mascotas
        ]);
    }

    public static function actualizar(Router $router)
    {
        session_start();
        isAuth();
        isAdmin();

        $alertas = [];
        $actualizar = true;

        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if (!$id) header('Location: /admin-citas');
        $cita = Cita::find($id);
        if (!$cita) header('Location: /admin-citas');

        $consulta = " SELECT * FROM mascota WHERE mascota.usuarioId = " . $cita->usuarioId . "; ";
        $mascotas = Mascota::SQL($consulta);
        $usuario = Usuario::where('id', $cita->usuarioId);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cita->sincronizar($_POST);
            $alertas = $cita->comprobarFormularioActualizar();
            if (empty($alertas)) {
                $alertas = $cita->comprobarDia();
                if (empty($alertas)) {
                    $alertas = $cita->comprobarHora();
                    if (empty($alertas)) {
                        $consulta = "SELECT * FROM cita WHERE fecha = '" . s($cita->fecha) . "';";
                        $reservas = Cita::SQL($consulta);
                        if (!$reservas) {
                            $resultado = $cita->guardar();
                            if ($resultado) {
                                Usuario::setAlerta('exito', 'Cita actualizada con exito');
                            }
                        } else {
                            $aux = true;
                            $hora_cita = convertirHora($cita->hora);
                            foreach ($reservas as $reserva) {
                                $hora_reserva = convertirHora($reserva->hora);
                                if ($cita->id === $reserva->id && $hora_cita === $hora_reserva) {
                                    $aux = true;
                                } else if ($hora_cita === $hora_reserva) {
                                    $aux = false;
                                }
                            }

                            if ($aux) {
                                $resultado = $cita->guardar();
                                if ($resultado) {
                                    Usuario::setAlerta('exito', 'Cita actualizada con exito');
                                }
                            } else {
                                Usuario::setAlerta('error', 'Ya existe cita para esa fecha y hora');
                            }
                        }
                    }
                }
            }
        }

        $alertas = Cita::getAlertas();

        $router->render('citas/actualizar', [
            'titulo' => 'Actualizar Citas',
            'alertas' => $alertas,
            'usuario' => $usuario,
            'mascotas' => $mascotas,
            'cita' => $cita,
            'actualizar' => $actualizar
        ]);
    }

    public static function eliminar()
    {
        session_start();
        isAuth();
        isAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if ($id) {
                $cita = Cita::find($id);
                $resultado = $cita->eliminar($id);
                if ($resultado) {
                    header('Location: /admin-citas?aux=1');
                }
            }
        }
    }

    public static function calendario(Router $router)
    {
        session_start();
        isAuth();
        isAdmin();

        $alertas = [];
        $citas = Cita::all();
        if (!$citas) {
            Cita::setAlerta('error', 'Actualmente no hay reservas, pruebe creando una');
        }

        foreach ($citas as $cita) {
            $resultado = Events::find($cita->id);
            if (!$resultado) {
                $horaInicial = convertirHora($cita->hora);
                $fecha_inicial = $cita->fecha . ' ' . $horaInicial . ':00:00';
                $horaFinal = $horaInicial + 1;
                $fecha_final = $cita->fecha . ' ' . $horaFinal . ':00:00';
                // Insertar en la base de datos
                $query = " INSERT INTO Events (id, title, " . 'start, ' . 'end' . ") VALUES (" . $cita->id . ', ' . "'" . 'Cita' . "'" . ', ' . "'" . $fecha_inicial . "'" . ', ' . "'" . $fecha_final . "'" . ");";
                Events::SQL_especial($query);
            }
        }

        $alertas = Cita::getAlertas();

        $router->render('citas/calendario', [
            'titulo' => 'Calendario de Citas',
            'alertas' => $alertas
        ]);
    }
}
