<?php
interface Handler
{
    public function handle(string $message):void;
    public function setNext(Handler $handler):Handler;
}
abstract class TransportAbstract implements Handler
{
    protected $next;
    public function setNext(Handler $handler): Handler
    {
        $this->next=$handler;
        return $handler;
    }
    public function callNext(string $message):void
    {
        if ($this->next !== null){
            $this->next->handle($message);
        }
    }
}
class Car extends TransportAbstract
{

    public function handle(string $message): void
    {
        if ($message === 'car'){
            var_dump(get_class($this));
            return;
        }
        $this->callNext($message);

    }
}
class Bus extends TransportAbstract
{

    public function handle(string $message): void
    {
        if ($message === 'bus'){
            var_dump(get_class($this));
            return;
        }
        $this->callNext($message);

    }
}
$car = new Car();
$bus = new Bus();
$car->setNext($bus);
$car->handle('bus');