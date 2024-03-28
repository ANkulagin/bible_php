<?php
abstract class Creator
{
    abstract public function create(): Product;
}

class ConcreteCreator1 extends Creator
{
    public function create(): Product
    {
        return new ConcreteProduct1();
    }
}

interface Product
{
    public function operation(): string;
}

class ConcreteProduct1 implements Product
{
    public function operation(): string
    {
        return "{Result of the ConcreteProduct1}";
    }
}

