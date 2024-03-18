<?php

declare(strict_types=1);

class Singleton
{
    private static ?self $instance = null;
    private function __construct(){}

    public static function getInstance(): self
    {
         return  self::$instance ??= new self();
    }
}
class SmsSender{
    public function send(){
       var_dump('srljksfgad');
    }
}
class Logger{
    public function log(){
        var_dump('srljksfgad');
    }
}

//$connected1 = Singleton::getInstance();
//$connected2 = Singleton::getInstance();
//var_dump($connected1 === $connected2); //true
