<?php

namespace interfaces;

interface Template
{
    public function setVariable($name, $var);
    public function A(int $name): int;

}

interface Template1 extends Template
{
    public function getHtml($template);

}

interface Template2
{
    public function getTest(): void;
    public function A(int $name): int;
}

class WorkingTemplate implements Template1, Template2
{
    private $vars = [];

    public function A(int $name): int
    {
        return $name;
    }
    public function getTest(): void
    {
        echo "test";
    }

    public function setVariable($name, $var)
    {
        $this->vars[$name] = $var;
    }

    public function getHtml($template)
    {
        foreach ($this->vars as $name => $value) {
            $template = str_replace('{' . $name . '}', $value, $template);
        }
        return $template;
    }

}


interface A

{
    public const NAME = 'test';
    public function foo(string $s): string;

    public function bar(int $i): int;
}

// Абстрактный класс может реализовывать только часть интерфейса.
// Классы, расширяющие абстрактный класс, должны реализовать все остальные.
abstract class B implements A
{
    public function foo(string $s): string
    {
        return $s . PHP_EOL;
    }
}

class C extends B
{
    public const NAME = 'test1';
    public function bar(int $i): int
    {
        return $i * 2;
    }
}