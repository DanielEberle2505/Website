<?php

namespace App\Core;

use ArrayAccess;
//Abstrakte Klasse, die den Datensatz, der aus der Datenbank extrahiert wird darstellen soll
abstract class AbstractModel implements ArrayAccess
{

    public function offsetExists($offset): bool
    {
        return isset($this->$offset);
    }

    public function offsetGet($offset): string
    {
        return $this->$offset;
    }

    public function offsetSet($offset, $value): void
    {
        $this->$offset = $value;
    }

    public function offsetUnset($offset): void
    {
        unset($this->$offset);
    }
}
