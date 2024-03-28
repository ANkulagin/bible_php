<?php
// Интерфейс абстрактной фабрики
interface FurnitureFactory
{
    public function createChair(): Chair;

    public function createTable(): Table;
}

// Интерфейс стула
interface Chair
{
    public function sitOn(): string;
}

// Интерфейс стола
interface Table
{
    public function placeOn(): string;
}

// Конкретная фабрика для создания деревянной мебели
class WoodenFurnitureFactory implements FurnitureFactory
{
    public function createChair(): Chair
    {
        return new WoodenChair();
    }

    public function createTable(): Table
    {
        return new WoodenTable();
    }
}

// Конкретная фабрика для создания металлической мебели
class MetalFurnitureFactory implements FurnitureFactory
{
    public function createChair(): Chair
    {
        return new MetalChair();
    }

    public function createTable(): Table
    {
        return new MetalTable();
    }
}

// Конкретная реализация деревянного стула
class WoodenChair implements Chair
{
    public function sitOn(): string
    {
        return "Sitting on a wooden chair.";
    }
}

// Конкретная реализация деревянного стола
class WoodenTable implements Table
{
    public function placeOn(): string
    {
        return "Placing on a wooden table.";
    }
}

// Конкретная реализация металлического стула
class MetalChair implements Chair
{
    public function sitOn(): string
    {
        return "Sitting on a metal chair.";
    }
}

// Конкретная реализация металлического стола
class MetalTable implements Table
{
    public function placeOn(): string
    {
        return "Placing on a metal table.";
    }
}

// Пример использования

// Создание фабрики для производства деревянной мебели
$woodenFactory = new WoodenFurnitureFactory();
$woodenChair = $woodenFactory->createChair();
$woodenTable = $woodenFactory->createTable();

echo $woodenChair->sitOn() . PHP_EOL;
echo $woodenTable->placeOn() . PHP_EOL;

// Создание фабрики для производства металлической мебели
$metalFactory = new MetalFurnitureFactory();
$metalChair = $metalFactory->createChair();
$metalTable = $metalFactory->createTable();

echo $metalChair->sitOn() . PHP_EOL;
echo $metalTable->placeOn() . PHP_EOL;
