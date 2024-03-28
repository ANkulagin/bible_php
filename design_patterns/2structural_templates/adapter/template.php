<?php
interface Shape {public function draw(): void;}
class Rectangle implements Shape {
    public function draw(): void {echo "Рисуем прямоугольник\n";}
}
interface GeometricShape {public function drawShape(): void;}
class LegacyRectangle implements GeometricShape {
    public function drawShape(): void {echo "Рисуем фигуру из старой библиотеки\n";}
}
class GeometricShapeAdapter implements Shape {//1 интерфейс базового класса
    public function __construct(private GeometricShape $geometricShape) {}

    public function draw(): void {
        $this->geometricShape->drawShape();
    }
}

// Пример использования
$rectangle = new Rectangle();
$rectangle->draw();

$legacyRectangle = new LegacyRectangle();
$adapter = new GeometricShapeAdapter($legacyRectangle);
$adapter->draw();
