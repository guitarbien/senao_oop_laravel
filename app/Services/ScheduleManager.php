<?php

namespace App\Services;

/**
 * Class ScheduleManager
 * @package App\Services
 */
class ScheduleManager extends JsonManager
{
    /** @var Schedule[] */
    private $schedules;

    /** config file name */
    const SETTING_FILE = 'schedule.json';

    /**
     * 將 schedule.json 轉成 $schedules，每個元素都是 Schedule
     */
    public function processJsonConfig(): void
    {
        $scheduleJson = $this->getJsonObject();

        foreach ($scheduleJson['schedules'] as $each) {
            $this->schedules[] = new Schedule($each);
        }

        $this->resetConfigs($this->schedules);
    }
}
