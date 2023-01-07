<?php

namespace App\apps\Util\AbstractMVC;

use ArrayAccess;

abstract class AbstractModel implements ArrayAccess
{

    public function offsetExists($offset): bool
    {
        return isset($this->$offset);
    }


    public function offsetGet($offset)
    {
        return $this->$offset;
    }


    public function offsetSet( $offset,  $value): void
    {
        $this->$offset = $value;
    }

    public function offsetUnset( $offset): void
    {
        unset($this->$offset);
    }
}