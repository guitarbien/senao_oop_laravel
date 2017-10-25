<?php

namespace App\Services;

/**
 * Class Schedule
 * @package App\Services
 */
class Schedule
{
    /** @var string 此排程所處理的檔案格式 */
    private $ext;

    /** @var string 此排程執行的間隔 */
    private $interval;

    /** @var string 此排程所處理的時間 */
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
