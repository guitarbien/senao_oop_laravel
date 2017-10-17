<?php


namespace App\Services;

use function json_decode;

class ScheduleManager extends ArrayLike
{
    /** @var array */
    private $schedules;

    public function count()
    {
        return count($this->schedules);
    }
}
