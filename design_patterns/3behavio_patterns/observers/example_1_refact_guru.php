<?php
/**
 * Вот как выглядит интерфейс Издателя:
 *
 * @link http://php.net/manual/ru/class.splsubject.php
 *
 *     interface SplSubject
 *     {
 *         // Присоединяет наблюдателя к издателю.
 *         public function attach(SplObserver $observer);
 *
 *         // Отсоединяет наблюдателя от издателя.
 *         public function detach(SplObserver $observer);
 *
 *         // Уведомляет всех наблюдателей о событии.
 *         public function notify();
 *     }
 *
 * Также имеется встроенный интерфейс для Наблюдателей:
 *
 * @link http://php.net/manual/ru/class.splobserver.php
 *
 *     interface SplObserver
 *     {
 *         public function update(SplSubject $subject);
 *     }
 */

/**
 * Издатель владеет некоторым важным состоянием и оповещает наблюдателей о его
 * изменениях.
 */
class Subject implements \SplSubject
{
    /**
     * @var int Для удобства в этой переменной хранится состояние Издателя,
     * необходимое всем подписчикам.
     */
    public $state;

    /**
     * @var \SplObjectStorage Список подписчиков. В реальной жизни список
     * подписчиков может храниться в более подробном виде (классифицируется по
     * типу события и т.д.)
     */
    private $observers;

    public function __construct()
    {
        $this->observers = new SplObjectStorage();
    }

    /**
     * Методы управления подпиской.
     */
    public function attach(\SplObserver $observer): void
    {
        echo "Издатель: Присоединил наблюдателя.\n";
        $this->observers->attach($observer);
    }

    public function detach(\SplObserver $observer): void
    {
        $this->observers->detach($observer);
        echo "Издатель: Отсоединил наблюдателя.\n";
    }

    /**
     * Запуск обновления в каждом подписчике.
     */
    public function notify(): void
    {
        echo "Издатель: Уведомляю наблюдателей...\n";
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    /**
     * Обычно логика подписки – только часть того, что делает Издатель. Издатели
     * часто содержат некоторую важную бизнес-логику, которая запускает метод
     * уведомления всякий раз, когда должно произойти что-то важное (или после
     * этого).
     */
    public function someBusinessLogic(): void
    {
        echo "\nИздатель: Я выполняю важные действия.\n";
        $this->state = rand(0, 10);

        echo "Издатель: Мое состояние изменилось на: {$this->state}\n";
        $this->notify();
    }
}

/**
 * Конкретные Наблюдатели реагируют на обновления, выпущенные Издателем, к
 * которому они прикреплены.
 */
class ConcreteObserverA implements \SplObserver
{
    public function update(\SplSubject $subject): void
    {
        if ($subject->state < 3) {
            echo "Конкретный Наблюдатель A: Реагирую на событие.\n";
        }
    }
}

class ConcreteObserverB implements \SplObserver
{
    public function update(\SplSubject $subject): void
    {
        if ($subject->state == 0 || $subject->state >= 2) {
            echo "Конкретный Наблюдатель B: Реагирую на событие.\n";
        }
    }
}

/**
 * Клиентский код.
 */

$subject = new Subject();

$o1 = new ConcreteObserverA();
$subject->attach($o1);

$o2 = new ConcreteObserverB();
$subject->attach($o2);

$subject->someBusinessLogic();
$subject->someBusinessLogic();

$subject->detach($o2);

$subject->someBusinessLogic();
