<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class ConfigManager extends ArrayLike
{
    /** @var array */
    private $configs;

    /**
     * 取得 $schedules 的數量
     * @return int
     */
    public function count(): int
    {
        return count($this->configs);
    }

    /**
     * 將 schedule.json 轉成 $schedules，每個元素都是 Schedule
     */
    public function processConfigs(): void
    {
        $scheduleJson = $this->getConfigJson();

        foreach ($scheduleJson['configs'] as $each) {
            $this->configs[] = new Config($each);
        }

        $this->resetSchedules();
    }

    /**
     * 實作 ArrayAccess，將整理好的 $schedules 放入上層的 container
     */
    private function resetSchedules(): void
    {
        $this->setContainer($this->configs);
    }

    /**
     * 讀取 config.json
     * @return array
     */
    private function getConfigJson(): array
    {
        $contents = Storage::get('config.json');
        return json_decode($contents, true);
    }
}
