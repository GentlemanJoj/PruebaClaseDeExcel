<?php

namespace Model;

class Events extends ActiveRecord
{
    protected static $tabla = 'events';
    protected static $columnasDB = ['id', 'title', 'description', 'color', 'textColor', 'start', 'end'];

    public $id;
    public $title;
    public $description;
    public $color;
    public $textColor;
    public $start;
    public $end;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->title = $args['title'] ?? '';
        $this->description = $args['description'] ?? '';
        $this->color = $args['color'] ?? '';
        $this->textColor = $args['textColor'] ?? '';
        $this->start = $args['start'] ?? '';
        $this->end = $args['end'] ?? '';
    }
}
