<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

/**
 * Class JsonManager
 * @package App\Services
 */
abstract class JsonManager extends ArrayLike
{
    /**
     * @var Config[] | Schedule[]
     * 經 resetConfigs() 將讀取到的 Config 或 Schedule 的陣列存回此變數
     */
    private $generalConfigs;

    /** string 設定檔檔名 此處不設定值，由 child class 提供實際檔案名稱 */
    const SETTING_FILE = '';

    /**
     * 取得個別 manager 的數量
     * @return int
     */
    public abstract function count(): int;

    /**
     * 從設定檔讀取出 json config array
     * @return array
     */
    protected function getJsonObject(): array
    {
        return json_decode(Storage::get(static::SETTING_FILE), true);
    }

    /**
     * 將 config.json   轉成 $config，   每個元素都是 Config
     * 將 schedule.json 轉成 $schedules，每個元素都是 Schedule
     */
    public abstract function processJsonConfig(): void;

    /**
     * 實作 ArrayAccess，將整理好的 $schedules 放入上層的 container
     * @param array $config
     */
    protected function resetConfigs(array $config): void
    {
        $this->generalConfigs = $config;
        $this->setContainer($this->generalConfigs);
    }
}
