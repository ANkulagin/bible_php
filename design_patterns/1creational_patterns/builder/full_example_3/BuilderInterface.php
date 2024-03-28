<?php

namespace full_example;

interface BuilderInterface
{
    public function createVehicle(): void;

    public function addDoors(): void;

    public function addEngine(): void;

    public function addWheel(): void;

    public function getVehicle(): Vehicle;
}