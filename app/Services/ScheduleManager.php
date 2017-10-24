<?php

namespace App\Services;

class ScheduleManager extends JsonManager
{
    /** @var Schedule[] */
    private $configs;

    /** config file name */
    const SETTING_FILE = 'schedule.json';

    /**
     * ScheduleManager constructor.
     * 將此 instance 指派給 parent
     */
    public function __construct()
    {
        parent::__construct($this);
    }

    /**
     * 將 schedule.json 轉成 $schedules，每個元素都是 Schedule
     */
    public function processJsonConfig(): void
    {
        $scheduleJson = $this->getJsonObject();

        foreach ($scheduleJson['schedules'] as $each) {
            $this->configs[] = new Schedule($each);
        }

        $this->resetConfigs($this->configs);
    }
}
