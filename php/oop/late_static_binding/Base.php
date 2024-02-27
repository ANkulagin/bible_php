<?php

namespace late_static_binding;

class Base
{
    public static function title():void
    {
        echo "1";
    }
    public static function test():void
    {
        self::title();
    }
}
class Child extends Base
{
    public static function title():void
    {
        echo "2";
    }
}
Child::title();
echo "<br>";
Child::test();


class A {
    public static function who() {
        echo __CLASS__;
    }
    public static function test() {
        static::who(); // Здесь действует позднее статическое связывание
    }
}

class B extends A {
    public static function who() {
        echo __CLASS__;
    }
}
class C extends B
{
    public static function who() {
        echo __CLASS__;
    }
}

B::test();
C::test();