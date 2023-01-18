<?php

namespace Controllers;

use Model\Usuario;
use MVC\Router;

class PropietarioController
{
    public static function admin_propietarios(Router $router)
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

        $consulta = "SELECT * FROM usuario WHERE usuario.tipousuarioId = 2";
        $propietarios = Usuario::SQL($consulta);
        if (!$propietarios) {
            Usuario::setAlerta('error', 'Actualmente no hay propietarios, pruebe creando uno');
            $propietarios = [];
        }

        $alertas = Usuario::getAlertas();

        $router->render('propietarios/admin', [
            'titulo' => 'Administración',
            'propietarios' => $propietarios,
            'alertas' => $alertas,
            'eliminado' => $eliminado
        ]);
    }

    public static function crear(Router $router)
    {
        session_start();
        isAuth();
        isAdmin();

        $alertas = [];
        $usuario = new Usuario();
        $actualizar = false;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();

            if (empty($alertas)) {
                $consulta = "SELECT * FROM usuario WHERE correo = '" . s($usuario->correo) . "' AND tipousuarioId = 2 LIMIT 1";
                $existeUsuario = Usuario::SQL($consulta);

                //verificar que existe con tipousuario #2 / alerta de error
                if ($existeUsuario && $existeUsuario[0]->tipousuarioId === '2') {
                    Usuario::setAlerta('error', 'Correo ya registrado');
                } else {
                    $usuario->hashPassword();
                    $usuario->confirmado = 1;
                    $resultado = $usuario->guardar();

                    if ($resultado) {
                        Usuario::setAlerta('exito', 'Propietario registrado');
                    }
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render('propietarios/crear', [
            'titulo' => 'Crear Usuario',
            'alertas' => $alertas,
            'usuario' => $usuario,
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
        if (!$id) header('Location: /admin-propietarios');
        $usuario = Usuario::find($id);
        if (!$usuario) {
            header('Location: /admin-propietarios');
        }


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarActualizar();

            if (empty($alertas)) {
                $resultado = $usuario->guardar();
                if ($resultado) {
                    $alertas = Usuario::setAlerta('exito', 'Actualizado correctamente');
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render('propietarios/actualizar', [
            'titulo' => 'Actualizar Usuario',
            'alertas' => $alertas,
            'usuario' => $usuario,
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
                $usuario = Usuario::find($id);
                $resultado = $usuario->eliminar();
                if ($resultado) {
                    header('Location: /admin-propietarios?aux=1');
                }
            }
        }
    }
}
