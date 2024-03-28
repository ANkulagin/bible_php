<?php

abstract class BookPrototype
{
    public string $title;
    public string $category;

    abstract public function __clone();

    final public function getTitle(): string
    {
        return $this->title;
    }

    final public function setTitle(string $title): void
    {
        $this->title = $title;
    }
}

class BarBookPrototype extends BookPrototype
{
    public function __construct()
    {
        $this->category = 'Bar';
    }

    public function __clone()
    {
        // Если есть необходимость в специфической логике при клонировании,
        // это можно определить здесь.
        // Например, если у нас есть связанные объекты, которые также нужно клонировать глубоко,
        // можно обработать это здесь.
        // В данном примере не требуется специфической логики, поэтому метод оставлен пустым.
    }
}

class FooBookPrototype extends BookPrototype
{
    public function __construct()
    {
        $this->category = 'Foo';
    }

    public function __clone()
    {
        // Аналогично BarBookPrototype, здесь можно добавить специфическую логику клонирования.
    }
}

// Пример использования:

// Создаем прототип книги "Bar"
$barBookPrototype = new BarBookPrototype();
$barBookPrototype->setTitle("Bar Book Title");

// Клонируем книгу "Bar"
$barBookClone = clone $barBookPrototype;
$barBookClone->setTitle("Cloned Bar Book Title");

// Создаем прототип книги "Foo"
$fooBookPrototype = new FooBookPrototype();
$fooBookPrototype->setTitle("Foo Book Title");

// Клонируем книгу "Foo"
$fooBookClone = clone $fooBookPrototype;
$fooBookClone->setTitle("Cloned Foo Book Title");

// Вывод информации о книгах
echo "Bar Book: Title - " . $barBookPrototype->getTitle() . ", Category - " . $barBookPrototype->category . "\n";
echo "Cloned Bar Book: Title - " . $barBookClone->getTitle() . ", Category - " . $barBookClone->category . "\n";

echo "Foo Book: Title - " . $fooBookPrototype->getTitle() . ", Category - " . $fooBookPrototype->category . "\n";
echo "Cloned Foo Book: Title - " . $fooBookClone->getTitle() . ", Category - " . $fooBookClone->category . "\n";
