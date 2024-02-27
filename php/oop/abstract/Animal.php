<?php

namespace abstract;


abstract class Animal  extends PrintObj{
    protected string $name;

    public function __construct($name)
    {
        $this->name = $name;
        echo $this->printTest() . '<br>';
    }

    public function getName():string
    {
        return $this->name;
    }

    abstract public function makeSound();
}

abstract class Mammal extends Animal {
    protected int $numLegs;

    public function __construct($name, $numLegs)
    {
        parent::__construct($name);
        $this->numLegs = $numLegs;
    }

    public function getNumLegs(): int
    {
        return $this->numLegs;
    }
}

class Dog extends Mammal {
    public function makeSound():string
    {
        return "ГАВ";
    }
}

class Cat extends Mammal {
    public function makeSound():string
    {
        return "МЯУ";
    }
}
class PrintObj  {

    public function printTest()
    {
        echo 'test';
    }

}

// Использование классов
$dog = new Dog("Kasper", 4);
$cat = new Cat("Kisa", 4);

echo $dog->getName() . " говорит: " . $dog->makeSound() . " имеет " . $dog->getNumLegs() . " лапы\ноги." . "<br>";
echo $cat->getName() . " говорит: " . $cat->makeSound() . " имеет " . $cat->getNumLegs() . " лапы\ноги." . "<br>";