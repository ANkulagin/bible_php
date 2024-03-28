<?php
interface Product {
    public function getName(): string;
    public function getPrice(): float;
}

class ElectronicProduct implements Product {
    public function getName(): string {
        return "Electronic Product";
    }

    public function getPrice(): float {
        return 1000.0;
    }
}

class ClothingProduct implements Product {
    public function getName(): string {
        return "Clothing Product";
    }

    public function getPrice(): float {
        return 50.0;
    }
}

class BookProduct implements Product {
    public function getName(): string {
        return "Book Product";
    }

    public function getPrice(): float {
        return 20.0;
    }
}
interface ProductFactoryInterface {
    public function createProduct(string $type): Product;
}

class ProductFactory implements ProductFactoryInterface {
    public function createProduct(string $type): Product {
        switch ($type) {
            case 'electronic':
                return new ElectronicProduct();
            case 'clothing':
                return new ClothingProduct();
            case 'book':
                return new BookProduct();
            default:
                throw new InvalidArgumentException("Invalid product type");
        }
    }
}
// Создаем экземпляр фабрики
$productFactory = new ProductFactory();

// Создаем продукт с типом "electronic"
$electronicProduct = $productFactory->createProduct('electronic');
echo $electronicProduct->getName() . ": $" . $electronicProduct->getPrice() . PHP_EOL;

// Создаем продукт с типом "clothing"
$clothingProduct = $productFactory->createProduct('clothing');
echo $clothingProduct->getName() . ": $" . $clothingProduct->getPrice() . PHP_EOL;

// Создаем продукт с типом "book"
$bookProduct = $productFactory->createProduct('book');
echo $bookProduct->getName() . ": $" . $bookProduct->getPrice() . PHP_EOL;
