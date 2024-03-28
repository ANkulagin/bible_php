<?php
/*
 * ПРАВИЛЬНО
 */
abstract class Transaction
{
    abstract protected function createBillingService(): BillingService;

    public function setPayment(int $hour, int $minute, int $second)
    {
        $billingService = $this->createBillingService();

        // создание транзакции в БД
        $id = $this->createInBd();

        // отправка запроса в платежный сервис
        $res = $billingService->sendPayments();

        // при успешности установим локальный статус успешности оплаты
        if ($res) {
            $this->setSuccess();
        }
    }

    private function createInBd()
    {
        // здесь должен быть код создания транзакции в базе данных
        return 1; // возвращаем просто для примера ID транзакции
    }

    private function setSuccess()
    {
        // здесь должен быть код установки статуса успешности оплаты
        echo "Payment successfully set.\n";
    }
}

interface BillingService
{
    public function sendPayments();
    public function getStatus();
}

class Billing1 implements BillingService
{

    public function __construct(private string $token){}

    public function sendPayments()
    {
        // реализация отправки платежей через Billing1
        echo "Sending payments via Billing1". $this->token  ."\n";
        return true; // для примера всегда возвращаем true
    }

    public function getStatus()
    {
        // реализация получения статуса через Billing1
        echo "Getting status via Billing1.\n";
    }
}

class Billing2 implements BillingService
{
    private $account;
    private $token;

    public function __construct(string $account, string $token)
    {
        $this->account = $account;
        $this->token = $token;
    }

    public function sendPayments()
    {
        // реализация отправки платежей через Billing2
        echo "Sending payments via Billing2. $this->account, $this->token> \n";
        return true; // для примера всегда возвращаем true
    }

    public function getStatus()
    {
        // реализация получения статуса через Billing2
        echo "Getting status via Billing2.\n";
    }
}

class Billing1Transaction extends Transaction
{
    public function __construct(private string $token){}

    protected function createBillingService(): BillingService
    {
        return new Billing1($this->token);
    }
}

class Billing2Transaction extends Transaction
{
    private $account;
    private $token;

    public function __construct(string $account, string $token)
    {
        $this->account = $account;
        $this->token = $token;
    }

    protected function createBillingService(): BillingService
    {
        return new Billing2($this->account, $this->token);
    }
}

// Пример использования

echo "Creating Billing1 transaction...\n";
$billing1Transaction = new Billing1Transaction('billing1_token');
$billing1Transaction->setPayment(12, 30, 0);

echo "\nCreating Billing2 transaction...\n";
$billing2Transaction = new Billing2Transaction('billing2_account', 'billing2_token');
$billing2Transaction->setPayment(13, 45, 0);





/*
 * БЕЗ ФАБРИКИ
 */

/*abstract class Transaction
{
    abstract public function sendPayment(int $hour, int $minute, int $second);
}

interface BillingService
{
    public function sendPayments();
}

class Billing1 implements BillingService
{
    private $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function sendPayments()
    {
        echo "Sending payments via Billing1.\n";
        return true;
    }
}

class Billing2 implements BillingService
{
    private $account;
    private $token;

    public function __construct(string $account, string $token)
    {
        $this->account = $account;
        $this->token = $token;
    }

    public function sendPayments()
    {
        echo "Sending payments via Billing2.\n";
        return true;
    }
}

class Billing1Transaction extends Transaction
{
    private $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function sendPayment(int $hour, int $minute, int $second)
    {
        $billingService = new Billing1($this->token);
        $this->createInBd();
        $res = $billingService->sendPayments();
        if ($res) {
            $this->setSuccess();
        }
    }

    private function createInBd()
    {
        echo "Creating transaction in database.\n";
    }

    private function setSuccess()
    {
        echo "Payment successfully set.\n";
    }
}

class Billing2Transaction extends Transaction
{
    private $account;
    private $token;

    public function __construct(string $account, string $token)
    {
        $this->account = $account;
        $this->token = $token;
    }

    public function sendPayment(int $hour, int $minute, int $second)
    {
        $billingService = new Billing2($this->account, $this->token);
        $this->createInBd();
        $res = $billingService->sendPayments();
        if ($res) {
            $this->setSuccess();
        }
    }

    private function createInBd()
    {
        echo "Creating transaction in database.\n";
    }

    private function setSuccess()
    {
        echo "Payment successfully set.\n";
    }
}

// Пример использования

echo "Creating Billing1 transaction...\n";
$billing1Transaction = new Billing1Transaction('billing1_token');
$billing1Transaction->sendPayment(12, 30, 0);

echo "\nCreating Billing2 transaction...\n";
$billing2Transaction = new Billing2Transaction('billing2_account', 'billing2_token');
$billing2Transaction->sendPayment(13, 45, 0);*/

/*
 * Жесткая связанность: Классы Billing1Transaction и Billing2Transaction привязаны к конкретным реализациям BillingService (Billing1 и Billing2). Если нам нужно изменить реализацию BillingService или добавить новую, нам придется изменять код этих классов.

Нарушение принципа единственной ответственности: Классы Billing1Transaction и Billing2Transaction занимаются не только своими основными обязанностями (например, отправкой платежей), но и созданием объектов BillingService и управлением жизненным циклом этих объектов.

Усложнение тестирования: Из-за того, что объекты BillingService создаются внутри конструкторов, тестирование этих классов становится сложнее, так как нам нужно учитывать создание и взаимодействие с внешними зависимостями.
 */