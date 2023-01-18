<?php

namespace Model;

class Usuario extends ActiveRecord
{
    protected static $tabla = 'usuario';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'docIdentidad', 'correo', 'password', 'tipousuarioId', 'token', 'confirmado', 'celular'];

    public $id;
    public $nombre;
    public $apellido;
    public $docIdentidad;
    public $correo;
    public $password;
    public $tipousuarioId;
    public $token;
    public $confirmado;
    public $celular;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->docIdentidad = $args['docIdentidad'] ?? '';
        $this->correo = $args['correo'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->tipousuarioId = $args['tipousuarioId'] ?? 2;
        $this->token = $args['token'] ?? '';
        $this->confirmado = $args['confirmado'] ?? 0;
        $this->celular = $args['celular'] ?? '';
    }

    public function validarNuevaCuenta()
    {
        if (!$this->nombre) {
            self::$alertas['error'][] = 'El nombre es obligatorio';
        }
        if (!$this->apellido) {
            self::$alertas['error'][] = 'El apellido es obligatorio';
        }
        if (!$this->docIdentidad) {
            self::$alertas['error'][] = 'El documento de identidad es obligatorio';
        }
        if (!$this->celular) {
            self::$alertas['error'][] = 'El celular es obligatorio';
        }
        if (!$this->correo) {
            self::$alertas['error'][] = 'El correo es obligatorio';
        }
        if (!$this->password) {
            self::$alertas['error'][] = 'La contraseña es obligatoria';
        }
        if (strlen($this->password) < 6) {
            self::$alertas['error'][] = 'La contraseña debe tener más de 6 caracteres';
        }

        return self::$alertas;
    }

    public function hashPassword()
    {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function token()
    {
        $this->token = md5(uniqid());
    }

    public function formularioOlvide()
    {
        if (!$this->correo) {
            self::$alertas['error'][] = 'El correo es obligatorio';
        }

        return self::$alertas;
    }

    public function formularioRestablecer()
    {
        if (!$this->password) {
            self::$alertas['error'][] = 'La contraseña es obligatoria';
        }
        if (strlen($this->password) < 6) {
            self::$alertas['error'][] = 'La contraseña debe tener más de 6 caracteres';
        }

        return self::$alertas;
    }

    public function validarLogin()
    {
        if (!$this->correo) {
            self::$alertas['error'][] = 'El correo es obligatorio';
        }
        if (!$this->password) {
            self::$alertas['error'][] = 'La contraseña es obligatoria';
        }
        if (strlen($this->password) < 6) {
            self::$alertas['error'][] = 'La contraseña debe tener más de 6 caracteres';
        }

        return self::$alertas;
    }

    public function validarActualizar()
    {
        if (!$this->nombre) {
            self::$alertas['error'][] = 'El nombre es obligatorio';
        }
        if (!$this->apellido) {
            self::$alertas['error'][] = 'El apellido es obligatorio';
        }
        if (!$this->docIdentidad) {
            self::$alertas['error'][] = 'El documento de identidad es obligatorio';
        }
        if (!$this->celular) {
            self::$alertas['error'][] = 'El celular es obligatorio';
        }
        if (!$this->correo) {
            self::$alertas['error'][] = 'El correo es obligatorio';
        }

        return self::$alertas;
    }
}
