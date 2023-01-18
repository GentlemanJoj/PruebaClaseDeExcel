<?php

namespace Controllers;

use Model\Cita;
use Model\Events;

class ApiController
{
    public static function index()
    {
        $events = Events::all();
        echo json_encode($events);
    }
}
