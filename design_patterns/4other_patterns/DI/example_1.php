<?php
class EmailSender {
    private $smtpServer;

    public function __construct(SMTPServer $smtpServer) {
        $this->smtpServer = $smtpServer;
    }
    public function sendEmail($to, $subject, $message) {
        $this->smtpServer-> sendEmail($to, $subject, $message);
    }
}

class SMTPServer {
    public function sendEmail($to, $subject, $message) {
        echo "Электронное письмо отправлено на $to с темой '$subject' и сообщением: $message" . PHP_EOL;
    }
}
class Psr11Container  {
    private $bindings = [];

    // Метод для привязки класса к его зависимостям
    public function set($id, $value) {
        $this->bindings[$id] = $value;
    }

    // Метод для проверки наличия класса в контейнере
    public function has($id) {
        return isset($this->bindings[$id]);
    }
    public function get($id) {
        if ($this->has($id)) {
            $value = $this->bindings[$id];
            //если значение имеет замыкание, выполняем его
            if ($value instanceof \Closure) {
                return $value($this);
            }

            return $value;
        }

        throw new \Exception("Класс $id не найден в привязках контейнера.");
    }
}

$container = new Psr11Container();

$container->set('EmailSender', function($container) {
    return new EmailSender($container->get('SMTPServer'));
});

$container->set('SMTPServer', function() {
    return new SMTPServer();
});

$emailSender = $container->get('EmailSender');


$emailSender->sendEmail('recipient@example.com', 'Test Email', 'Это тестовое электронное письмо.');
