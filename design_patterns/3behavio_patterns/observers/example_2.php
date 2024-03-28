<?php

class Task implements \SplSubject
{
    private \SplObjectStorage $observers;
    private bool $completed = false;

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
    }

    public function markCompleted(): void
    {
        $this->completed = true;

    }

    public function isCompleted(): bool
    {
        return $this->completed;
    }
}

class Manager1 implements \SplObserver
{
    public function update(\SplSubject $subject): void
    {
        if ($subject->isCompleted()) {
            echo "Менеджер 1 задача выполнена, отписываемся." . PHP_EOL;
            $subject->detach($this);
        } else {
            echo "Менеджер 1 получена задача." . PHP_EOL;
        }
    }
}

class Manager2 implements \SplObserver
{
    public function update(\SplSubject $subject): void
    {
        if ($subject->isCompleted()) {
            echo "Менеджер 2 задача выполнена, отписываемся." . PHP_EOL;
            $subject->detach($this);
        } else {
            echo "Менеджер 2 получена задача." . PHP_EOL;
        }
    }
}

class Manager3 implements \SplObserver
{
    public function update(\SplSubject $subject): void
    {
        if ($subject->isCompleted()) {
            echo "Менеджер 3 задача выполнена, отписываемся." . PHP_EOL;
            $subject->detach($this);
        } else {
            echo "Менеджер 3 получена задача." . PHP_EOL;
        }
    }
}

$task = new Task();
$manager1 = new Manager1();
$manager2 = new Manager2();
$manager3 = new Manager3();

$task->attach($manager1);
$task->attach($manager2);
$task->attach($manager3);

$task->markCompleted();
$task->notify();

