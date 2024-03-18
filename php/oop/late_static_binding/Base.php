<?php

namespace late_static_binding;

class A
{
    public static function who()
    {
        echo __CLASS__ . PHP_EOL;
    }

    public static function test()
    {
        static::who(); // Здесь действует позднее статическое связывание
    }
}

class B extends A
{
    public static function who()
    {
        echo __CLASS__ . PHP_EOL;
    }
}

class C extends B
{
    public static function who()
    {
        echo __CLASS__ . PHP_EOL;
    }
}

B::test();
C::test();