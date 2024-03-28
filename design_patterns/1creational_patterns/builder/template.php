<?php
class Car
{
    public bool $rul;
    public array $circles; // колеса
}

interface CarBuilderInterface
{
    public function setRul(bool $rul);
    public function addCircle(string $circle);
    public function getCar(): Car;
}

class CarBuilderSidan implements CarBuilderInterface
{
    private Car $car;

    public function __construct()
    {
        $this->reset();
    }

    public function reset()
    {
        $this->car = new Car();
    }

    public function setRul(bool $rul)
    {
        $this->car->rul = $rul;
        return $this;
    }
    public function addCircle(string $circle)
    {
        $this->car->circles[] = $circle;
        return $this;
    }

    public function getCar(): Car
    {
        $result = $this->car;
        $this->reset();
        return $result;
    }
}

$builder = new CarBuilderSidan();
$builder->setRul(true)
    ->addCircle('1')
    ->addCircle('2')
    ->addCircle('3')
    ->addCircle('4');

$car = $builder->getCar();

var_dump($car);