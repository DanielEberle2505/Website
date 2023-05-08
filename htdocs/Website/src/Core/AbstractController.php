<?php

namespace App\Core;
//Abstrakte Klasse, die, die Datensätze von der Datenbank verwaltet ("kontrolliert")
abstract class AbstractController
{
    //Funktion zum rendern von den view Seiten
    public function render($view, $params)
    {
        extract($params);
        include __DIR__ . "/../../views/{$view}.php";

    }
}
