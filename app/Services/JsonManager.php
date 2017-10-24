<?php

namespace App\Services;

abstract class JsonManager extends ArrayLike
{
    /**
     * 取得 $schedules 的數量
     * @return int
     */
    public function count(): int
    {
        return count($this->configs);
    }

    /**
     * 將 config.json 轉成 $config，每個元素都是 Config
     * 將 schedule.json 轉成 $schedules，每個元素都是 Schedule
     * ...
     */
    public abstract function processConfig(): void;

    /**
     * 實作 ArrayAccess，將整理好的 $schedules 放入上層的 container
     */
    protected function resetSchedules(): void
    {
        $this->setContainer($this->configs);
    }
}
