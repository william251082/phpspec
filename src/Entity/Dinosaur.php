<?php

namespace App\Entity;

class Dinosaur
{
    private  $length = 0;

    public function getLength()
    {
        return $this->length;
    }

    public function setLength(int $length)
    {
        return $this->length = $length;
    }
}
