<?php

class Car
{
    public bool $rul;
    public array $sidenie;
    public string $krisha;
    public string $dvigatel;
    public int $kpp; // передача
    public array $circles; // колеса
}

interface CarBuilderInterface
{
    public function setRul(bool $rul);

    public function setSidenie(array $sidenie);

    public function setKrisha(string $krisha);

    public function setDvigatel(string $dvigatel);

    public function setKpp(int $kpp);

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

    public function setSidenie(array $sidenie)
    {
        $this->car->sidenie = $sidenie;
        return $this;
    }

    public function setKrisha(string $krisha)
    {
        $this->car->krisha = $krisha;
        return $this;
    }

    public function setDvigatel(string $dvigatel)
    {
        $this->car->dvigatel = $dvigatel;
        return $this;
    }

    public function setKpp(int $kpp)
    {
        $this->car->kpp = $kpp;
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
    ->setSidenie(['front', 'back'])
    ->setKrisha('1')
    ->setDvigatel('2.0')
    ->setKpp(9)
    ->addCircle('1')
    ->addCircle('2')
    ->addCircle('3')
    ->addCircle('4');

$car = $builder->getCar();

var_dump($car);
