<?php

namespace App\Services;

class ConfigManager extends ArrayLike
{
    /** @var array */
    private $configs;

    public function count()
    {
        return count($this->configs);
    }

    public function processConfigs()
    {
        $scheduleJson = $this->getConfigJson();

        foreach ($scheduleJson['configs'] as $each) {
            $this->configs[] = new Config($each);
        }

        $this->resetSchedules();
    }

    private function resetSchedules()
    {
        $this->setContainer($this->configs);
    }

    /**
     * 還不清楚 schedule.json 是由 construct 傳入還是讀取固定路徑的檔案
     * 先寫死假資料
     * @return array
     */
    private function getConfigJson()
    {
        return json_decode('{"configs":[{"ext":"cs","location":"c:\\\\Projects","subDirectory":true,"unit":"file","remove":false,"handler":"zip","destination":"directory","dir":"c:\\\\MyArchieves","connectionString":""},{"ext":"DOCX","location":"c:\\\\Documents","subDirectory":true,"unit":"file","remove":false,"handler":"encode","destination":"db","dir":"","connectionString":"MyConnectionString"},{"ext":"jpg","location":"c:\\\\Pictures","subDirectory":true,"unit":"file","remove":false,"handler":"","destination":"directory","dir":"c:\\\\MyArchieves","connectionString":""}]}', true);
    }
}
