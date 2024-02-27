<?php

namespace anonim_class;

class Dumper
{
    public static function print($obj)
    {
        print_r($obj);
    }
}
Dumper::print(new class
{
    public $a = 1;
    public $b = 2;
    public function __construct()
    {
        echo "a: {$this->a} <br> b: {$this->b}<br>";
    }
});