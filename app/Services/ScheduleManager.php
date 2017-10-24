<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class ScheduleManager extends ArrayLike
{
    const SETING_FILE = 'schedule.json';

    /** @var array */
    private $schedules;

    /**
     * 取得 $schedules 的數量
     * @return int
     */
    public function count(): int
    {
        return count($this->schedules);
    }

    /**
     * 將 schedule.json 轉成 $schedules，每個元素都是 Schedule
     */
    public function processSchedules(): void
    {
        $scheduleJson = json_decode(Storage::get(static::SETING_FILE), true);

        foreach ($scheduleJson['schedules'] as $each) {
            $this->schedules[] = new Schedule($each);
        }

        $this->resetSchedules();
    }

    /**
     * 實作 ArrayAccess，將整理好的 $schedules 放入上層的 container
     */
    private function resetSchedules(): void
    {
        $this->setContainer($this->schedules);
    }
}
