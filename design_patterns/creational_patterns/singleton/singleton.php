<?php

final class Connection
{
    private static ?self $instance = null;
    private static string $name;
    public static function getName(): string
    {
        return self::$name;
    }
    public static function setName(string $name): void
    {
        self::$name = $name;
    }

    public static function getInstance(): self
    {
        // Проверяем, создан ли уже экземпляр, и создаем новый, если не создан.
        if (self::$instance === null) {
            self::$instance = new self();
        }

        // Возвращаем единственный экземпляр.
        return self::$instance;
    }

    /**
     * Предотвращаем клонирование экземпляра.
     */
    public function __clone(): void
    {
        // TODO: Реализовать метод __clone()
        // Этот метод пуст, чтобы предотвратить клонирование единственного экземпляра.
    }

    /**
     * Предотвращаем десериализацию экземпляра.
     */
    public function __wakeup(): void
    {
        // TODO: Реализовать метод __wakeup()
        // Этот метод пуст, чтобы предотвратить десериализацию единственного экземпляра.
    }
}

// Получаем единственный экземпляр класса Connection.
$connection = Connection::getInstance();

// Устанавливаем имя подключения на "User".
$connection::setName("User");

// Получаем еще одну ссылку на тот же самый единственный экземпляр.
$connection2 = Connection::getInstance();

// Выводим на экран имя подключения.
var_dump($connection::getName());
