<?php

namespace full_example;

class CarBuilder implements BuilderInterface
{
    private Car $car;

    public function createVehicle(): void
    {
        $this->car = new Car();
    }

    public function addDoors(): void
    {
        $this->car->setPart('right_door', new Door());
        $this->car->setPart('left_door', new Door());
    }

    public function addEngine(): void
    {
        $this->car->setPart('engine', new Engine());
    }
    public function addWheel(): void
    {
        $this->car->setPart('wheel1', new Wheel());
        $this->car->setPart('wheel2', new Wheel());
        $this->car->setPart('wheel3', new Wheel());
        $this->car->setPart('wheel4', new Wheel());
    }
    public function getVehicle(): Vehicle
    {
        return $this->car;
    }
}