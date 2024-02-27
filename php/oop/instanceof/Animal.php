<?php

namespace instanceof;

class Animal {
    public function makeSound() {
        return 'random  sound';
    }
}

class Dog extends Animal {
    public function makeSound() {
        return 'gav';
    }

    public function bark() {
        return 'Barking!';
    }
}

class Cat extends Animal {
    public function makeSound() {
        return 'Mau!';
    }

    public function purr() {
        return 'Purring!';
    }
}

// Создаем объекты
$dog = new Dog();
$cat = new Cat();

// Проверяем, являются ли объекты экземплярами определенных классов
if ($dog instanceof Dog) {
    echo 'The $dog is an instance of Dog.' . '<br>';
}

if ($cat instanceof Cat) {
    echo 'The $cat is an instance of Cat.' . '<br>';
}

// Проверяем, являются ли объекты экземплярами родительского класса
if ($dog instanceof Animal) {
    echo 'The $dog is an instance of Animal.' . '<br>';
}

if ($cat instanceof Animal) {
    echo 'The $cat is an instance of Animal.' . '<br>';
}

// Проверяем, является ли объект экземпляром другого класса
if ($cat instanceof Dog) {
    echo 'The $cat is an instance of Dog.' . '<br>';
} else {
    echo 'The $cat is NOT an instance of Dog.' . '<br>';
}