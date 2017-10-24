<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class ConfigManager extends JsonManager
{
    /** @var array */
    private $configs;

    const SETTING_FILE = 'config.json';

    /**
     * 將 schedule.json 轉成 $schedules，每個元素都是 Schedule
     */
    public function processConfig(): void
    {
        $scheduleJson = json_decode(Storage::get(static::SETTING_FILE), true);

        foreach ($scheduleJson['configs'] as $each) {
            $this->configs[] = new Config($each);
        }

        $this->resetSchedules();
    }
}
