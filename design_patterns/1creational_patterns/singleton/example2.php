<?php

declare(strict_types=1);

class Logger
{
    private static ?self $instance = null;
    private string $logFile;

    private function __construct(string $logFile)
    {
        $this->logFile = $logFile;
        echo "Logger initialized.: $this->logFile\n";
    }

    public static function getInstance(string $logFile): self
    {
        return self::$instance ??= new self($logFile);
    }

    public function log(string $message): void
    {
        file_put_contents($this->logFile, date('[m-d-Y H:i:s]') . ' ' . $message . PHP_EOL, FILE_APPEND);
    }
}
$logger = Logger::getInstance("app.log");

$logger->log("User logged in");
$logger->log("Error occurred: Database connection failed");

// Попытка создания нового экземпляра Logger
$newLogger = Logger::getInstance("error.log");
// Поскольку у нас используется Singleton, это все еще будет использоваться первый логгер,
// и новый логгер не будет создан.
$newLogger->log("Another error occurred");
// Все логи пишутся в один и тот же файл, указанный при инициализации логгера

