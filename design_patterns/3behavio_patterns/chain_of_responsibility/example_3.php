<?php

abstract class Handler
{
    private ?Handler $successor = null;

    public function setSuccessor(Handler $handler): void
    {
        $this->successor = $handler;
    }

    final public function handle(string $request): ?string
    {
        $processed = $this->processing($request);

        if ($processed === null && $this->successor !== null) {
            $processed = $this->successor->handle($request);
        }

        return $processed;
    }

    abstract protected function processing(string $request): ?string;
}

class HttpInMemoryCacheHandler extends Handler
{
    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    protected function processing(string $request): ?string
    {
        // Формируем ключ запроса для проверки наличия ответа в кэше
        $key = $request;

        // Если запрос находится в кэше, возвращаем его
        if (isset($this->data[$key])) {
            return $this->data[$key];
        }

        return null;
    }
}

class SlowDatabaseHandler extends Handler
{
    protected function processing(string $request): ?string
    {
        // Это заглушка. В реальном приложении можно было бы обратиться к медленной БД для получения результатов
        return 'Hello World!';
    }
}

// Пример использования:

// Массив данных для кэша в памяти
$data = [
    'example' => 'Cached response for example'
];

$cacheHandler = new HttpInMemoryCacheHandler($data);
$dbHandler = new SlowDatabaseHandler();

// Устанавливаем следующий обработчик
$cacheHandler->setSuccessor($dbHandler);

// Запрос
$request = 'example';

// Обработка запроса через цепочку обработчиков
$response = $cacheHandler->handle($request);

echo $response ?? 'Ответ не найден.';
