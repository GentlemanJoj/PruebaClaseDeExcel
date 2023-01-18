<?php

function debuguear($variable): string
{
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

function s($html): string
{
    $s = htmlspecialchars($html);
    return $s;
}

function isAuth(): void
{
    if (!isset($_SESSION['login'])) {
        header('Location: /');
    }
}

function isAdmin(): void
{
    if ($_SESSION['login'] = true && $_SESSION['tipousuarioId'] != '1') {
        header('Location: /');
    }
}

function convertirHora($hora): string
{
    $hora_aux = date_create($hora);
    $hora_convertida = date_format($hora_aux, 'G');
    return $hora_convertida;
}
