<?php


// Интерфейс, описывающий фабричный метод
interface LoggerFactory
{
    public function createLogger(): Logger;
}

// Интерфейс логгера
interface Logger
{
    public function log(string $message): void;
}

// Конкретная реализация фабрики для создания файлового логгера
class FileLoggerFactory implements LoggerFactory
{
    public function createLogger(): Logger
    {
        return new FileLogger();
    }
}

// Конкретная реализация фабрики для создания логгера в базу данных
class DatabaseLoggerFactory implements LoggerFactory
{
    public function createLogger(): Logger
    {
        return new DatabaseLogger();
    }
}

// Конкретная реализация логгера для записи в файл
class FileLogger implements Logger
{
    public function log(string $message): void
    {
        echo "Log to file: $message\n";
    }
}

// Конкретная реализация логгера для записи в базу данных
class DatabaseLogger implements Logger
{
    public function log(string $message): void
    {
        echo "Log to database: $message\n";
    }
}

// Пример использования

// Создание фабрики для файлового логгера
$fileLoggerFactory = new FileLoggerFactory();
$fileLogger = $fileLoggerFactory->createLogger();
$fileLogger->log("Message for file logger");

// Создание фабрики для логгера в базу данных
$databaseLoggerFactory = new DatabaseLoggerFactory();
$databaseLogger = $databaseLoggerFactory->createLogger();
$databaseLogger->log("Message for database logger");
