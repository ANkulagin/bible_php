<?php

class FileLogger
{
    public $f;

    public $name;
    public $lines = [];
    public $t;

    public function __construct($name, $fname)
    {
        $this->name = $name;
        $this->f = fopen($fname, 'a+');
    }

    public function __destruct()
    {
        fwrite($this->f, implode('', $this->lines));
        fclose($this->f);
    }


    public function log($str)
    {
        $prefix = '[' . date('Y-m-d h:i:s ') . "{$this->name}] ";
        $str = preg_replace('/^/m', $prefix, rtrim($str));
        $this->lines[] = $str . PHP_EOL;
    }
}

class FileLoggerDebug extends FileLogger
{
    // Конструктор нового класса. Просто переадресует вызов
    // конструктору базового класса, передавая немного другие
    // параметры.
    public function __construct($fname)
    {
        // Такой синтаксис используется для вызова
        // методов базового класса.
        // Обратите внимание, что ссылки $this нет! Она подразумевается.
        parent::__construct(basename($fname), $fname);
        // Здесь можно проинициализировать другие свойства текущего
        // класса, если они будут
    }
}


$logger = new FileLoggerDebug('test.log');;
// FileLoggerDebug подходит вместо базового класса FileLogger
croak($logger, 'Hasta la vista.');
// Функция принимает параметр типа FileLogger
function croak(FileLogger $l, $msg)
{
    $l->log($msg);
    exit();
}