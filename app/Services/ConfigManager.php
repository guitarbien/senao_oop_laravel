<?php

namespace App\Services;

class ConfigManager extends JsonManager
{
    /** @var Config[] */
    private $configs;

    /** config file name */
    const SETTING_FILE = 'config.json';

    /**
     * ConfigManager constructor.
     * 將此 instance 指派給 parent
     */
    public function __construct()
    {
        parent::__construct($this);
    }

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
