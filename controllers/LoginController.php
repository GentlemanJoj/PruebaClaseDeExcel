<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController
{
    public static function login(Router $router)
    {
        $alertas = [];
        $usuario = new Usuario();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarLogin();

            if (empty($alertas)) {
                $consulta = "SELECT * FROM usuario WHERE correo = '" . s($usuario->correo) . "'";
                $resultados = Usuario::SQL($consulta);
                if (!$resultados) {
                    Usuario::setAlerta('error', 'Correo no registrado');
                } else {
                    $auth = false;
                    $cont = sizeof($resultados);
                    $aux = 0;
                    $credenciales = '';

                    while ($cont > 0 && $auth === false) {
                        $auth = password_verify($usuario->password, $resultados[$aux]->password);
                        if ($auth) {
                            $credenciales = $resultados[$aux];
                        }
                        $cont--;
                        $aux++;
                    }

                    if (!$auth) {
                        Usuario::setAlerta('error', 'Contraseña incorrecta');
                    } else {
                        session_start();
                        $_SESSION['id'] = $credenciales->id;
                        $_SESSION['nombre'] = $credenciales->nombre;
                        $_SESSION['correo'] = $credenciales->correo;
                        $_SESSION['login'] = true;
                        $_SESSION['tipousuarioId'] = $credenciales->tipousuarioId;

                        if ($credenciales->tipousuarioId === '1') {
                            header('Location: /admin-citas');
                        } else {
                            header('Location: /main');
                        }
                    }
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/login', [
            'titulo' => 'Iniciar Sesión',
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function logout()
    {
        session_start();
        $_SESSION = [];
        header('Location: /');
    }

    public static function crear(Router $router)
    {
        $usuario = new Usuario();
        $alertas = [];
        $actualizar = false;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();

            if (empty($alertas)) {
                $existeUsuario = Usuario::where('correo', $usuario->correo);

                //verificar que existe con tipousuario #2 / alerta de error
                if ($existeUsuario && $existeUsuario->tipousuarioId === '2') {
                    Usuario::setAlerta('error', 'Correo ya registrado');
                    //verificar que existe con tipousuario #1 / admin -> usuario / crear 
                    //verificar que no existe / crear 
                } else if (($existeUsuario && $existeUsuario->tipousuarioId === '1') || (!$existeUsuario)) {
                    $usuario->hashPassword();
                    $usuario->token();

                    $resultado = $usuario->guardar();

                    if ($resultado) {
                        $email = new Email($usuario->correo, $usuario->nombre, $usuario->token);
                        $email->enviarConfirmacion();

                        header('Location: /mensaje');
                    }
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/crear', [
            'alertas' => $alertas,
            'usuario' => $usuario,
            'titulo' => 'Crear Cuenta',
            'actualizar' => $actualizar
        ]);
    }

    public static function mensaje(Router $router)
    {
        $router->render('auth/mensaje', [
            'titulo' => 'Confirmación'
        ]);
    }

    public static function confirmar(Router $router)
    {
        //Comprobar que sea un token válido
        $token = s($_GET['token']);
        if (!$token) header('Location: /');

        //Buscar el token en la base de datos
        $resultado = Usuario::where('token', $token);
        if (!$resultado) {
            Usuario::setAlerta('error', 'Token Inváido');
        } else {
            $resultado->token = '';
            $resultado->confirmado = 1;
            $resultado->guardar();
            Usuario::setAlerta('exito', 'Usuario confirmado');
        }

        //Mostrar alerta dependiendo del caso 
        $alertas = Usuario::getAlertas();

        $router->render('auth/confirmar', [
            'alertas' => $alertas,
            'titulo' => 'Confirmación'
        ]);
    }

    public static function olvide(Router $router)
    {
        $alertas = [];
        $usuario = new Usuario();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->formularioOlvide();
            if (empty($alertas)) {
                $consulta = "SELECT * FROM usuario WHERE correo = '" . s($usuario->correo) . "' AND tipousuarioId = 2 LIMIT 1";
                $resultado = Usuario::SQL($consulta);
                if (!$resultado || $resultado[0]->confirmado === '0') {
                    Usuario::setAlerta('error', 'Correo no registrado o no confirmado');
                } else {
                    $resultado[0]->token();
                    $resultado[0]->guardar();
                    $email = new Email($resultado[0]->correo, $resultado[0]->nombre, $resultado[0]->token);
                    $email->enviarRecuperar();
                    Usuario::setAlerta('exito', 'instrucciones enviadas a tu email');
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/olvide', [
            'titulo' => 'Olvide Password',
            'alertas' => $alertas,
            'usuario' => $usuario
        ]);
    }

    public static function restablecer(Router $router)
    {
        $alertas = [];
        $vista = true;
        $token = $_GET['token'];
        if (!$token) header('Location: /');

        $usuario = Usuario::where('token', $token);
        if (!$usuario) {
            Usuario::setAlerta('error', 'Token no válido');
            $vista = false;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->password = s($_POST['password']);
            $alertas = $usuario->formularioRestablecer();

            if (empty($alertas)) {
                $usuario->hashPassword();
                $usuario->token = '';
                $resultado = $usuario->guardar();
                if ($resultado) {
                    header('Location: /');
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/restablecer', [
            'titulo' => 'Restablecer Contraseña',
            'alertas' => $alertas,
            'vista' => $vista,
            'token' => $token
        ]);
    }
}
