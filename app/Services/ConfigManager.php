<?php

namespace App\Services;

/**
 * Class ConfigManager
 * @package App\Services
 */
class ConfigManager extends JsonManager
{
    /** @var Config[] */
    private $configs;

    /** config file name */
    const SETTING_FILE = 'config.json';

    /**
     * 將 config.json 轉成 $config，每個元素都是 Config
     */
    public function processJsonConfig(): void
    {
        $configJson = $this->getJsonObject();

        foreach ($configJson['configs'] as $each) {
            $this->configs[] = new Config($each);
        }

        $this->resetConfigs($this->configs);
    }
}
