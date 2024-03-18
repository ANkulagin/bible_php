<?php

class Example1
{
    public function test(): static
    {
        return new static();
    }
}

class SubExample1 extends Example1
{
}

$obj = new SubExample1();
echo get_class($obj->test()) . PHP_EOL; // Выведет: SubExample1

class Example2
{
    public function test(): self
    {
        return new self();
    }
}

class SubExample2 extends Example2
{
}

$obj = new SubExample2();
echo get_class($obj->test()) . PHP_EOL; // Выведет: Example2


class Example3
{
    public function test(): static
    {
        return new static();
    }
}

class SubExample3 extends Example3
{
    public function test(): static // переопределяем метод
    {
        return new static(); // возвращаем экземпляр текущего класса
    }
}

$obj = new SubExample3();
echo get_class($obj->test()) . PHP_EOL; // Выведет: SubExample3



