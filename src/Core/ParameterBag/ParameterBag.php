<?php

namespace App\Core\ParameterBag;

class ParameterBag implements \Countable, \IteratorAggregate{

    private $params;

    public function __construct(array $params = []){
        $this->params = $params;
    }

    public function get(string $param){
        return $this->has($param) ? $this->params[$param] : null;
    }

    public function all(): array
    {
        return $this->params;
    }

    public function erase(string $param): self
    {
        unset($this->params[$param]);
    }

    public function has(string $param): bool
    {
        return isset($this->params[$param]);
    }

    public function count(): int
    {
        return count($this->params);
    }

    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->params);
    }


}