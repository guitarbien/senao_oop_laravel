<?php

namespace App\Services;

class Schedule
{
    /** @var  string */
    private $ext;

    /** @var  string */
    private $interval;

    /** @var  string */
    private $time;

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
    public function getInterval(): string
    {
        return $this->interval;
    }

    /**
     * @return string
     */
    public function getTime(): string
    {
        return $this->time;
    }
}
