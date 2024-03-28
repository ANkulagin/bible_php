<?php

class App
{
    public function run(): void
    {
        $this->send('Message', [], ['sms', 'email', 'stream']);
    }

    public function send(string $message, array $context, array $transports): void
    {
        $smsTransport = $this->createTransport('SmsTransport');
        $emailTransport = $this->createTransport('EmailTransport');
        $streamTransport = $this->createTransport('StreamTransport');
        $videoTransport = $this->createTransport('VideoTransport');
        $golubTransport = $this->createTransport('GolubTransport');

        // Установка цепочки обработчиков
        $smsTransport->setNext($emailTransport)
            ->setNext($streamTransport)
            ->setNext($videoTransport)
            ->setNext($golubTransport);

        // Обработка сообщения
        $smsTransport->handle($message, $context, $transports);
    }

    private function createTransport(string $transportClass): TransportInterface
    {
        return new $transportClass();
    }
}

interface TransportInterface
{
    public function handle(string $message, array $context, array $transports): void;

    public function setNext(TransportInterface $next): TransportInterface;
}

abstract class AbstractTransport implements TransportInterface
{
    protected $next;

    public function setNext(TransportInterface $transport): TransportInterface
    {
        $this->next = $transport;
        return $transport;
    }

    protected function callNext(string $message, array $context, array $transports): void
    {
        if ($this->next !== null) {
            $this->next->handle($message, $context, $transports);
        }
    }
}

class SmsTransport extends AbstractTransport
{
    public function handle(string $message, array $context, array $transports): void
    {
        if (in_array('sms', $transports)) {
            var_dump(get_class($this));
            return;
        }
        $this->callNext($message, $context, $transports);
    }
}

class EmailTransport extends AbstractTransport
{
    public function handle(string $message, array $context, array $transports): void
    {
        if (in_array('email', $transports)) {
            var_dump(get_class($this));
            return;
        }
        $this->callNext($message, $context, $transports);
    }
}

class StreamTransport extends AbstractTransport
{
    public function handle(string $message, array $context, array $transports): void
    {
        if (in_array('stream', $transports)) {
            var_dump(get_class($this));
            return;
        }
        $this->callNext($message, $context, $transports);
    }
}

class VideoTransport extends AbstractTransport
{
    public function handle(string $message, array $context, array $transports): void
    {
        if (in_array('video', $transports)) {
            var_dump(get_class($this));
            return;
        }
        $this->callNext($message, $context, $transports);
    }
}

class GolubTransport extends AbstractTransport
{
    public function handle(string $message, array $context, array $transports): void
    {
        if (in_array('golub', $transports)) {
            var_dump(get_class($this));
            return;
        }
        $this->callNext($message, $context, $transports);
    }
}

$app = new App();
$app->run();
