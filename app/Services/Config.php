<?php

namespace App\Services;

class Config
{
    /** @var  string */
    private $ext;

    /** @var  string */
    private $location;

    /** @var  bool */
    private $subDirectory;

    /** @var  string */
    private $unit;

    /** @var  bool */
    private $remove;

    /** @var  string */
    private $handler;

    /** @var  string */
    private $destination;

    /** @var  string */
    private $dir;

    /** @var  string */
    private $connectionString;

    /**
     * Config constructor.
     * @param array $config
     */
    public function __construct(array $config) {
        $this->ext              = $config['ext'];
        $this->location         = $config['location'];
        $this->subDirectory     = $config['subDirectory'];
        $this->unit             = $config['unit'];
        $this->remove           = $config['remove'];
        $this->handler          = $config['handler'];
        $this->destination      = $config['destination'];
        $this->dir              = $config['dir'];
        $this->connectionString = $config['connectionString'];
    }


    /**
     * @return string
     */
    public function getExt(): string
    {
        return $this->ext;
    }

    /**
     * @return string
     */
    public function getLocation(): string
    {
        return $this->location;
    }

    /**
     * @return bool
     */
    public function isSubDirectory(): bool
    {
        return $this->subDirectory;
    }

    /**
     * @return string
     */
    public function getUnit(): string
    {
        return $this->unit;
    }

    /**
     * @return bool
     */
    public function isRemove(): bool
    {
        return $this->remove;
    }

    /**
     * @return string
     */
    public function getHandler(): string
    {
        return $this->handler;
    }

    /**
     * @return string
     */
    public function getDestination(): string
    {
        return $this->destination;
    }

    /**
     * @return string
     */
    public function getDir(): string
    {
        return $this->dir;
    }

    /**
     * @return string
     */
    public function getConnectionString(): string
    {
        return $this->connectionString;
    }
}
