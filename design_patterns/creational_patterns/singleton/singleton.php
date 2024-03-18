<?php

declare(strict_types=1);

class Singleton
{
    private static ?self $instance = null;
    private function __construct(){}

    public static function getInstance(): static
    {
         return  static::$instance ??= new static();
    }
}
/*
$connected1 = Singleton::getInstance();
$connected2 = Singleton::getInstance();
var_dump($connected1 === $connected2);
*/