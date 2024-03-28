<?php


class A{}

class B
{
    public function __construct(private A $a){}
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

$container->set('A', function ($container) {
    return new A;
});

$container->set('B', function ($container) {
    return new B($container->get['A']);
});

