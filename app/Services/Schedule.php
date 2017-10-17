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
     * Schedule constructor.
     * @param array $schedule
     */
    public function __construct(array $schedule)
    {
        $this->ext      = $schedule['ext'];
        $this->interval = $schedule['interval'];
        $this->time     = $schedule['time'];
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
