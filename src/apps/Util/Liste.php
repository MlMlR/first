<?php

namespace Util;

class Liste implements \Iterator
{
    private array $items =[];
    private int $position = 0;



    private function addItem($item): void
    {
        $this->items[] = $item;
    }

    public function current(): mixed
    {
        return $this->items[$this->position];
    }

    public function next(): void
    {
        $this->position ++;
    }

    public function key(): mixed
    {
        return $this->position;
    }

    public function valid(): bool
    {
        if($this->position < count($this->items)){
            return true;
        }
        return false;
    }

    public function rewind(): void
    {
        $this->position = 0;
    }
}