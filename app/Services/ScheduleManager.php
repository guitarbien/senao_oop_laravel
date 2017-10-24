<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class ScheduleManager extends JsonManager
{
    /** @var array */
    private $schedules;

    const SETING_FILE = 'schedule.json';

    /**
     * 將 schedule.json 轉成 $schedules，每個元素都是 Schedule
     */
    public function processConfig(): void
    {
        $scheduleJson = json_decode(Storage::get(static::SETING_FILE), true);

        foreach ($scheduleJson['schedules'] as $each) {
            $this->schedules[] = new Schedule($each);
        }

        $this->resetSchedules();
    }
}
