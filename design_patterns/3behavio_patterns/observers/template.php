<?php

class Издатель implements \SplSubject
{
    private \SplObjectStorage $observers;

    public function __construct()
    {
        $this->observers = new SplObjectStorage();
    }
     public function attach(SplObserver $observer): void
    {
        $this->observers->attach($observer);
    }

     public function detach(SplObserver $observer): void
    {
        $this->observers->detach($observer);
    }

    public function notify(): void
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
        //todo  update($this);
    }
}

class Слушатель  implements \SplObserver
{
    public function update(\SplSubject $subject): void
    {}
}

$издатель = new Издатель();
$слушаешь = new Слушатель();
