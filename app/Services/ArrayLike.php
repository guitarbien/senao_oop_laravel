<?php

namespace App\Services;

use ArrayAccess;
use Iterator;

/**
 * 實作 ArrayAccess 讓 object 能像 array 般被操作
 * @package App\Services
 */
class ArrayLike implements ArrayAccess, Iterator
{
    /** @var array */
    private $container;

    /** @var int */
    private $position = 0;

    /**
     * 將下層 manager 的資料放到 container
     * 設定 ArrayAccess 之後讓物件可像 array 存取
     * @param array $container
     */
    public function setContainer(array $container)
    {
        $this->container = $container;
    }

    /**
     * interface ArrayAccess 實作
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset): bool
    {
        return isset($this->container[$offset]);
    }

    /**
     * interface ArrayAccess 實作
     * @param mixed $offset
     * @return mixed|null
     */
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * interface ArrayAccess 實作
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
            $this->container[] = $value;
            return;
        }

        $this->container[$offset] = $value;
    }

    /**
     * interface ArrayAccess 實作
     * @param mixed $offset
     */
    public function offsetUnset($offset): void
    {
        unset($this->container[$offset]);
    }

    /**
     * interface Iterator 實作
     * Return the current element
     */
    public function current()
    {
        return $this->offsetGet($this->position);
    }

    /**
     * interface Iterator 實作
     * Move forward to next element
     */
    public function next(): void
    {
        ++$this->position;
    }

    /**
     * interface Iterator 實作
     * Return the key of the current element
     */
    public function key(): int
    {
        return $this->position;
    }

    /**
     * interface Iterator 實作
     * Checks if current position is valid
     */
    public function valid(): bool
    {
        return $this->offsetExists($this->position);
    }

    /**
     * interface Iterator 實作
     * Rewind the Iterator to the first element
     */
    public function rewind():  void
    {
        $this->position = 0;
    }
}
