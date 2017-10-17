<?php

namespace App\Services;

class ScheduleManager extends ArrayLike
{
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
        $scheduleJson = $this->getScheduleJson();

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

    /**
     * 還不清楚 schedule.json 是由 construct 傳入還是讀取固定路徑的檔案
     * 先寫死假資料
     * @return array
     */
    private function getScheduleJson(): array
    {
        return json_decode('{"schedules": [{"ext": "cs","time": "12:00","interval": "Everyday"},{"ext": "docx","time": "20:00","interval": "Everyday"},{"ext": "jpg","time": "7:00","interval": "Monday"}]}', true);
    }
}
