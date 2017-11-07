<?php

namespace App\Services\Handlers;

use App\Services\Candidate;
use App\Services\Config;

/**
 * Class AbstractFileFinder
 * @package App\Services\Handlers
 */
abstract class AbstractFileFinder implements FileFinder
{
    /** @var Config */
    protected $config;

    /** @var string[] */
    protected $files;

    /** @var int */
    private $position = 0;

    /**
     * AbstractFileFinder constructor.
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * @param string $filename
     * @return Candidate
     */
    protected abstract function createCandidate(string $filename): Candidate;

    /**
     * interface ArrayAccess 實作
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset): bool
    {
        return isset($this->files[$offset]);
    }

    /**
     * interface ArrayAccess 實作
     * @param mixed $offset
     * @return mixed|null
     */
    public function offsetGet($offset)
    {
        return isset($this->files[$offset]) ? $this->files[$offset] : null;
    }

    /**
     * interface ArrayAccess 實作
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
            $this->files[] = $value;
            return;
        }

        $this->files[$offset] = $value;
    }

    /**
     * interface ArrayAccess 實作
     * @param mixed $offset
     */
    public function offsetUnset($offset): void
    {
        unset($this->files[$offset]);
    }

    /**
     * interface Iterator 實作
     * Return the current element
     */
    public function current(): Candidate
    {
        return $this->createCandidate($this->offsetGet($this->position));
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