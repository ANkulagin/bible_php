<?php
interface Component
{
    public function operation(): string;
}
class ConcreteComponent implements Component //базовая бизнес логика
{
    public function operation(): string
    {
        return "ConcreteComponent";
    }
}

class Decorator implements Component
{
    public function __construct(private Component $component){}

    public function operation(): string
    {
        return $this->component->operation();
    }
}
class ConcreteDecoratorA extends Decorator
{
    public function operation(): string
    {
        return "ConcreteDecoratorA(" . parent::operation() . ")";
    }
}
$decorator1 = new ConcreteDecoratorA(new ConcreteComponent());
var_dump($decorator1->operation());

