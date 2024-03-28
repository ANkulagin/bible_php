<?php

namespace full_example;

class Truck extends Vehicle
{
    public function getInfo(): string
    {
        return "Truck with " . count($this->getParts()) . " parts.\n" . print_r($this->getParts(), true);
    }
}