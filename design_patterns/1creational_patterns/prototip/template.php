<?php

class Prototype
{
    public $primitive;
    public $circularReference;

    public function __clone()
    {
        $this->circularReference = clone $this->circularReference; //глубокое клонирование
    }
}

$p1 = new Prototype();
$p1->primitive = 245;
$p1->circularReference = new DateTime();

$p2 = clone $p1;
if ($p1->primitive === $p2->primitive) {
    echo "Primitive field values have been carried over to a clone. Yay!\n";
} else {
    echo "Primitive field values have not been copied. Booo!\n";
}
