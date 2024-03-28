<?php

namespace full_example;

class Car extends Vehicle
{
    public function getInfo(): string
    {
        return "Car with " . count($this->getParts()) . " parts.\n" . print_r($this->getParts(), true);
    }
}