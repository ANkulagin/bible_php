<?php

namespace full_example;

abstract class Vehicle
{
    protected array $parts = [];

    final public function setPart(string $key, object $value): void
    {
        $this->parts[$key] = $value;
    }

    public function getPart(string $key): ?object
    {
        return $this->parts[$key] ?? null;
    }

    public function removePart(string $key): void
    {
        unset($this->parts[$key]);
    }

    public function getParts(): array
    {
        return $this->parts;
    }
}