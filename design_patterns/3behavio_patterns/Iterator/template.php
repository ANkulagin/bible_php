<?php
class NumberCollection implements \IteratorAggregate
{
    public array $items = [];
    public function addItem($key,$value = null): void
    {
        if ($value === null) {
            $value = $key;
            $this->items[]= $value;
        }else{
            $this->items[$key] = $value;
        }

    }

    public function getIterator(): Iterator
    {
        return new IteratorNumber($this->items);
    }

    public function getReverseIterator(): Iterator
    {
        return new IteratorNumber($this->items, true);
    }
}

class IteratorNumber implements \Iterator
{


    public function __construct(private array $items, private readonly bool $reverse = false)
    {
        $this->items = $reverse ? array_reverse($items) : $items;
    }

    public function rewind(): void
    {
        reset($this->items);
    }

    public function current(): mixed
    {
        return current($this->items);
    }

    public function key(): mixed
    {
        return key($this->items);
    }

    public function next(): void
    {
        next($this->items);
    }

    public function valid(): bool
    {
        return key($this->items)!== null;
    }
}

// Использование:
$collectionNumber = new NumberCollection();
$collectionNumber->addItem(1);
$collectionNumber->addItem(2);
$collectionNumber->addItem(3);
echo "Обычный порядок\n";
foreach ($collectionNumber->getIterator() as $key => $item) {
    if (is_array($item)) {
        foreach ($item as $k => $value) {
            echo "$k => $value\n";
        }
    } else {
        echo $key. ' => ' . $item . "\n";
    }
}
echo "\n";
echo "Обратный порядок\n";
foreach ($collectionNumber->getReverseIterator() as $key => $item) {
    if (is_array($item)) {
        foreach ($item as $k => $value) {
            echo "$k => $value\n";
        }
    } else {
        echo $item . "\n";
    }
}
