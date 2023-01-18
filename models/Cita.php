<?php

namespace  Model;

date_default_timezone_set('America/Bogota');

class Cita extends ActiveRecord
{
    protected static $tabla = 'cita';
    protected static $columnasDB = ['id', 'usuarioId', 'mascotaId', 'fecha', 'hora'];

    public $id;
    public $usuarioId;
    public $mascotaId;
    public $fecha;
    public $hora;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->usuarioId = $args['usuarioId'] ?? '';
        $this->mascotaId = $args['mascotaId'] ?? '';
        $this->fecha = $args['fecha'] ?? '';
        $this->hora = $args['hora'] ?? '';
    }

    public function comprobarFormularioReserva()
    {
        if (!$this->usuarioId) {
            self::$alertas['error'][] = 'Debe seleccionar un propietario';
        }
        if (!$this->mascotaId) {
            self::$alertas['error'][] = 'Debe seleccionar una mascota';
        }
        if (!$this->fecha) {
            self::$alertas['error'][] = 'La fecha es obligatoria';
        }
        if (!$this->hora) {
            self::$alertas['error'][] = 'La hora es obligatoria';
        }

        return self::$alertas;
    }

    public function comprobarFormularioActualizar()
    {
        if (!$this->mascotaId) {
            self::$alertas['error'][] = 'Debe seleccionar una mascota';
        }
        if (!$this->fecha) {
            self::$alertas['error'][] = 'La fecha es obligatoria';
        }
        if (!$this->hora) {
            self::$alertas['error'][] = 'La hora es obligatoria';
        }

        return self::$alertas;
    }

    public function comprobarDia()
    {
        $fecha_aux = explode('-', $this->fecha);
        if (!checkdate($fecha_aux[1], $fecha_aux[2], $fecha_aux[0])) {
            header('Location: /admin-citas');
        } else {
            $fecha_aux = date_create($this->fecha);
            $dia = date_format($fecha_aux, 'w');
            if ($dia === '0' || $dia === '6') {
                self::$alertas['error'][] = 'Los sábados y domingos están fuera del horario de trabajo';
            }
        }
        return self::$alertas;
    }

    public function comprobarHora()
    {
        $hora_actual = date('G');
        $hora = convertirHora($this->hora);
        $fecha_actual = date('Y-m-d');
        if ($hora < 8 || ($hora >= 12 && $hora < 13) || $hora >= 18) {
            self::$alertas['error'][] = 'La hora escogida está fuera del horario de trabajo';
        } else if ($this->fecha == $fecha_actual && $hora < $hora_actual) {
            self::$alertas['error'][] = 'La hora no puede ser anterior a la hora actual';
        }
        return self::$alertas;
    }

    public function formularioBuscar()
    {
        if (!$this->fecha) {
            self::$alertas['error'][] = 'La fecha es obligatoria';
        }

        return self::$alertas;
    }
}
