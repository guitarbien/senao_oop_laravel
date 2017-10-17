<?php

namespace App\Services;

class ScheduleManager extends ArrayLike
{
    /** @var array */
    private $schedules;

    public function count()
    {
        return count($this->schedules);
    }

    public function processSchedules()
    {
        $scheduleJson = $this->getScheduleJson();

        foreach ($scheduleJson['schedules'] as $each) {
            $this->schedules[] = new Schedule($each);
        }

        $this->resetSchedules();
    }

    private function resetSchedules()
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
