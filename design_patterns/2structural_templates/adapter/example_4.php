<?php

// Имеющийся интерфейс
interface Shape {
    public function draw(): void;
}

// Конкретная реализация геометрической фигуры
class Rectangle implements Shape {
    public function draw(): void {
        echo "Рисуем прямоугольник\n";
    }
}

// Интерфейс, который необходимо адаптировать
interface GeometricShape {
    public function drawShape(): void;
}

// Конкретная реализация геометрической фигуры в другой библиотеке
class LegacyRectangle implements GeometricShape {
    public function drawShape(): void {
        echo "Рисуем фигуру из старой библиотеки\n";
    }
}

// Адаптер для преобразования интерфейса GeometricShape в Shape
class GeometricShapeAdapter implements Shape {
    private GeometricShape $geometricShape;

    public function __construct(GeometricShape $geometricShape) {
        $this->geometricShape = $geometricShape;
    }

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
