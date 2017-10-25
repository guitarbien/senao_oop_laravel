<?php

namespace App\Services;

/**
 * Class MyBackupService
 * @package App\Services
 */
class MyBackupService
{
    /** @var JsonManager[] 存放各種 Manager 的陣列 */
    private $managers = [];

    /**
     * MyBackupService constructor.
     */
    public function __construct()
    {
        $this->managers[] = new ConfigManager;
        $this->managers[] = new ScheduleManager;
    }

    /**
     * 執行所有 manager 各自的 processJsonConfig()
     */
    public function processJsonConfigs(): void
    {
        foreach ($this->managers as $manager) {
            $manager->processJsonConfig();
        }
    }
}
