<?php
class Facade
{

    public function __construct(
        protected ?Subsystem1 $subsystem1 = null,
        protected ?Subsystem2 $subsystem2 = null
    )
    {
        $this->subsystem1 = $subsystem1 ?? new Subsystem1();
        $this->subsystem2 = $subsystem2 ?? new Subsystem2();
    }
    public function operation(): string
    {
        $result = $this->subsystem1->operationN();
        $result .= $this->subsystem2->operationZ();
        return $result;
    }
}

class Subsystem1
{
    public function operationN(): string
    {
        return "Subsystem1: Go!\n";
    }
}

class Subsystem2
{
    public function operationZ(): string
    {
        return "Subsystem2: Fire!\n";
    }
}

$subsystem1 = new Subsystem1();
$subsystem2 = new Subsystem2();
$facade = new Facade($subsystem1, $subsystem2);
var_dump($facade->operation());
