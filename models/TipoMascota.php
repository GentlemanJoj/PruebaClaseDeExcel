<?php

namespace Model;

class TipoMascota extends ActiveRecord
{
    protected static $tabla = 'tipomascota';
    protected static $columnasDB = ['id', 'tipomascota'];

    public $id;
    public $tipomascota;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->tipomascota = $args['tipomascota'] ?? '';
    }
}
