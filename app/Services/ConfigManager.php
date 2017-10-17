<?php

namespace App\Services;

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
     * 還不清楚 schedule.json 是由 construct 傳入還是讀取固定路徑的檔案
     * 先寫死假資料
     * @return array
     */
    private function getConfigJson(): array
    {
        return json_decode('{"configs":[{"ext":"cs","location":"c:\\\\Projects","subDirectory":true,"unit":"file","remove":false,"handler":"zip","destination":"directory","dir":"c:\\\\MyArchieves","connectionString":""},{"ext":"DOCX","location":"c:\\\\Documents","subDirectory":true,"unit":"file","remove":false,"handler":"encode","destination":"db","dir":"","connectionString":"MyConnectionString"},{"ext":"jpg","location":"c:\\\\Pictures","subDirectory":true,"unit":"file","remove":false,"handler":"","destination":"directory","dir":"c:\\\\MyArchieves","connectionString":""}]}', true);
    }
}
