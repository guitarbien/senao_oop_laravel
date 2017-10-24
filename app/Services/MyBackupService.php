<?php

namespace App\Services;

class MyBackupService
{
    /** @var ConfigManager */
    private $configManager;

    /** @var ScheduleManager */
    private $scheduleManager;

    /**
     * MyBackupService constructor.
     * @param ConfigManager   $configManager
     * @param ScheduleManager $scheduleManager
     */
    public function __construct(ConfigManager $configManager, ScheduleManager $scheduleManager)
    {
        $this->configManager   = $configManager;
        $this->scheduleManager = $scheduleManager;
    }

    public function processJSONConfig()
    {
        $this->configManager->processConfigs();
        $this->scheduleManager->processSchedules();
    }

    public function doBackup()
    {
    }
}
