<?php

// Пример класса продукта (заказа)
class Order
{
    public string $productId;
    public int $quantity;
    public float $totalPrice;

    public function __construct(string $productId, int $quantity, float $totalPrice)
    {
        $this->productId = $productId;
        $this->quantity = $quantity;
        $this->totalPrice = $totalPrice;
    }

    public function displayOrderDetails()
    {
        echo "Product ID: {$this->productId}, Quantity: {$this->quantity}, Total Price: {$this->totalPrice}\n";
    }
}

// Интерфейс строителя для заказа
interface OrderBuilderInterface
{
    public function reset(): void;
    public function setProductId(string $productId): void;
    public function setQuantity(int $quantity): void;
    public function setTotalPrice(float $totalPrice): void;
    public function build(): Order;
}

// Конкретный строитель для заказа
class ConcreteOrderBuilder implements OrderBuilderInterface
{
    private Order $order;

    public function __construct()
    {
        $this->reset();
    }

    public function reset(): void
    {
        $this->order = new Order('', 0, 0.0);
    }

    public function setProductId(string $productId): void
    {
        $this->order->productId = $productId;
    }

    public function setQuantity(int $quantity): void
    {
        $this->order->quantity = $quantity;
    }

    public function setTotalPrice(float $totalPrice): void
    {
        $this->order->totalPrice = $totalPrice;
    }

    public function build(): Order
    {
        $order = $this->order;
        $this->reset();
        return $order;
    }
}
// Дополнительный строитель для заказов с дополнительными свойствами
class SpecialOrderBuilder implements OrderBuilderInterface
{
    private Order $order;

    public function __construct()
    {
        $this->reset();
    }

    public function reset(): void
    {
        $this->order = new Order('', 0, 0.0);
    }

    public function setProductId(string $productId): void
    {
        $this->order->productId = $productId;
    }

    public function setQuantity(int $quantity): void
    {
        $this->order->quantity = $quantity;
    }

    public function setTotalPrice(float $totalPrice): void
    {
        // У специальных заказов добавим к итоговой цене некоторую дополнительную стоимость
        $this->order->totalPrice = $totalPrice + 10.0;
    }

    public function build(): Order
    {
        $order = $this->order;
        $this->reset();
        return $order;
    }
}


// Директор для построения заказов
class OrderDirector
{
    private OrderBuilderInterface $orderBuilder;

    public function __construct(OrderBuilderInterface $orderBuilder)
    {
        $this->orderBuilder = $orderBuilder;
    }

    public function buildSampleOrder(): Order
    {
        $this->orderBuilder->setProductId('12345');
        $this->orderBuilder->setQuantity(2);
        $this->orderBuilder->setTotalPrice(50.0);
        return $this->orderBuilder->build();
    }
}


// Использование строителей с директором
$orderBuilder = new ConcreteOrderBuilder();
$orderDirector = new OrderDirector($orderBuilder);

$order = $orderDirector->buildSampleOrder();
$order->displayOrderDetails();

// Создание специального заказа
$specialOrderBuilder = new SpecialOrderBuilder();
$orderDirector = new OrderDirector($specialOrderBuilder);

$specialOrder = $orderDirector->buildSampleOrder();
$specialOrder->displayOrderDetails();