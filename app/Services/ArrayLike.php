<?php

namespace App\Services;

use ArrayAccess;

class ArrayLike implements ArrayAccess
{
    /** @var array */
    private $container;

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
     * interface 實作
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset): bool
    {
        return isset($this->container[$offset]);
    }

    /**
     * interface 實作
     * @param mixed $offset
     * @return mixed|null
     */
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * interface 實作
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * interface 實作
     * @param mixed $offset
     */
    public function offsetUnset($offset): void
    {
        unset($this->container[$offset]);
    }
}
