<?php

class A
{
    public function __construct()
    {
    }
}

class B
{
    private $a;

    public function __construct(A $a)
    {
        $this->a = $a;
    }
}

class C
{
    private $b;

    public function __construct(B $b)
    {
        $this->b = $b;
    }

}
//это лишнее есть пак от psr в симфони по дэфолту установлен
interface ContainerInterface
{
    public function get($id);
    public function has($id);
}
class Psr11Container implements ContainerInterface
{
    private $container = [];

    public function set($id, $value)
    {
        $this->container[$id] = $value;
    }

    public function has($id)
    {
        return isset($this->container[$id]);
    }

    public function get($id)
    {
        if ($this->has($id)) {
            $value = $this->container[$id];
            if ($value instanceof \Closure) {
                return $value($this);
            }

            return $value;
        }

        throw new \Exception("error");
    }
}
$container = new Psr11Container();

$container->set('A', function($container) {
    return new A;
});

$container->set('B', function($container) {
    return new B($container->get['A']);
});

$container->set('C', function ($container){
    return new C($container->get['B']);
});