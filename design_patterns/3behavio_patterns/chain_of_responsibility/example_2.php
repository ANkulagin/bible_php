<?php


// Интерфейс обработчика запроса
interface Handler
{
    public function setNext(Handler $handler): Handler;

    public function handle(string $request): ?string;
}

// Базовый класс обработчика
abstract class AbstractHandler implements Handler
{
    protected ?Handler $nextHandler = null;

    public function setNext(Handler $handler): Handler
    {
        $this->nextHandler = $handler;
        return $handler;
    }

    public function handle(string $request): ?string
    {
        if ($this->nextHandler) {
            return $this->nextHandler->handle($request);
        }

        return PHP_EOL.'отсутствие говорит об отсутствии следующего обработчика.'.PHP_EOL;
    }
}

// Обработчик запроса, проверяющий наличие определенного ключевого слова
class KeywordHandler extends AbstractHandler
{
    public function handle(string $request): ?string
    {
        if (str_contains($request, 'важный')) {
            return "Запрос содержит важное слово.\n";
        } else {
            return parent::handle($request);
        }
    }
}

// Обработчик запроса, проверяющий наличие цифр в запросе
class NumberHandler extends AbstractHandler
{
    public function handle(string $request): ?string
    {
        if (preg_match('/\d/', $request)) {
            return "Запрос содержит цифры.\n";
        } else {
            return parent::handle($request);
        }
    }
}

// Создание цепочки обработчиков
$keywordHandler = new KeywordHandler();
$numberHandler = new NumberHandler();

$keywordHandler->setNext($numberHandler);

// Тестирование
$request1 = "Это важный запрос без цифр.";
$request2 = "Это запрос без ключевых слов.";
$request3 = "Это  запрос с 123.";

echo $keywordHandler->handle($request1);
echo $keywordHandler->handle($request2);
echo $keywordHandler->handle($request3);


