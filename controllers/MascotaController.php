<?php

namespace Controllers;

use Model\Mascota;
use Model\TipoMascota;
use Model\Usuario;
use MVC\Router;

class MascotaController
{
    public static function admin_mascota(Router $router)
    {
        session_start();
        isAuth();
        isAdmin();

        if (empty($_GET)) {
            $eliminado = 0;
        } else {
            $eliminado = $_GET['aux'];
            $eliminado = filter_var($eliminado, FILTER_VALIDATE_INT);
        }

        $alertas = [];
        $mascotas = Mascota::all();
        if (!$mascotas) {
            Mascota::setAlerta('error', 'Actualmente no hay mascotas, pruebe creando una');
            $mascotas = [];
        }
        $tipos = TipoMascota::all();
        $consulta = "SELECT * FROM usuario WHERE tipousuarioId = 2";
        $propietarios = Usuario::SQL($consulta);
        if (!$propietarios) {
            $propietarios = [];
        }

        $alertas = Mascota::getAlertas();
        $router->render('mascotas/admin', [
            'titulo' => 'Administración',
            'alertas' => $alertas,
            'mascotas' => $mascotas,
            'propietarios' => $propietarios,
            'tipos' => $tipos,
            'eliminado' => $eliminado
        ]);
    }

    public static function crear(Router $router)
    {
        session_start();
        isAuth();
        isAdmin();

        $alertas = [];
        $actualizar = false;
        $mascota = new Mascota();
        $tipos = TipoMascota::all();
        $consulta = "SELECT * FROM usuario WHERE tipousuarioId = 2";
        $propietarios = Usuario::SQL($consulta);
        if (!$propietarios) {
            Mascota::setAlerta('error', 'No existen propietarios, pruebe creando uno');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $mascota->sincronizar($_POST);
            $alertas = $mascota->validarNuevaMascota();
            if (empty($alertas)) {
                $resultado = $mascota->guardar();
                if ($resultado) {
                    Mascota::setAlerta('exito', 'Mascota registrada');
                }
            }
        }

        $alertas = Mascota::getAlertas();

        $router->render('mascotas/crear', [
            'titulo' => 'Crear Mascota',
            'alertas' => $alertas,
            'mascota' => $mascota,
            'tipos' => $tipos,
            'propietarios' => $propietarios,
            'actualizar' => $actualizar
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
        if (!$id) header('Location: /admin-mascotas');
        $mascota = Mascota::find($id);
        if (!$mascota) {
            header('Location: /admin-mascotas');
        }


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $mascota->sincronizar($_POST);
            $alertas = $mascota->validarActualizar();

            if (empty($alertas)) {
                $resultado = $mascota->guardar();
                if ($resultado) {
                    Mascota::setAlerta('exito', 'Actualizada correctamente');
                }
            }
        }

        $alertas = Mascota::getAlertas();

        $router->render('mascotas/actualizar', [
            'titulo' => 'Actualizar Mascota',
            'alertas' => $alertas,
            'mascota' => $mascota,
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
                $mascota = Mascota::find($id);
                $resultado = $mascota->eliminar();
                if ($resultado) {
                    header('Location: /admin-mascotas?aux=1');
                }
            }
        }
    }
}
