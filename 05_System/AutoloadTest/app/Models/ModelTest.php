<?php

namespace App\Models;

class ModelTest
{
    private $text = 'Hello World';
    public function getHello()
    {
        return $this->text;
    }
}
