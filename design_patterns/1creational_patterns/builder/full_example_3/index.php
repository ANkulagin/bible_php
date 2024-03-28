<?php

namespace full_example;

require_once 'Door.php';
require_once 'Engine.php';
require_once 'Wheel.php';
require_once 'Vehicle.php';
require_once 'Car.php';
require_once 'Truck.php';
require_once 'BuilderInterface.php';
require_once 'CarBuilder.php';
require_once 'TruckBuilder.php';
require_once 'Director.php';

$director = new Director();

// Создаем строителей
$carBuilder = new CarBuilder();
$truckBuilder = new TruckBuilder();

// Строим автомобиль
$car = $director->build($carBuilder);
echo "Car built: " . $car->getInfo() . PHP_EOL;

// Строим грузовик
$truck = $director->build($truckBuilder);
echo "Truck built: " . $truck->getInfo() . PHP_EOL;