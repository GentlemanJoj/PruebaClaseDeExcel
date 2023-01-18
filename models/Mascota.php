<?php

namespace Model;

class Mascota extends ActiveRecord
{
    protected static $tabla = 'mascota';
    protected static $columnasDB = ['id', 'nombre', 'fechaIngreso', 'tipomascotaId', 'usuarioId'];

    public $id;
    public $nombre;
    public $fechaIngreso;
    public $tipomascotaId;
    public $usuarioId;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->fechaIngreso = $args['fechaIngreso'] ?? date('Y-m-d H:i:s');
        $this->tipomascotaId ?? 0;
        $this->usuarioId ?? '';
    }

    public function validarNuevaMascota()
    {
        if (!$this->usuarioId) {
            self::$alertas['error'][] = 'El propietario es obligatorio';
        }
        if (!$this->nombre) {
            self::$alertas['error'][] = 'El nombre es obligatorio';
        }
        if (!$this->tipomascotaId) {
            self::$alertas['error'][] = 'El tipo de mascota es obligatorio';
        }

        return self::$alertas;
    }

    public function validarActualizar()
    {
        if (!$this->nombre) {
            self::$alertas['error'][] = 'El nombre es obligatorio';
        }

        return self::$alertas;
    }
}
