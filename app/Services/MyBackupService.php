<?php

namespace App\Services;

class MyBackupService
{
    /** @var ConfigManager[] 存放各種 Manager 的陣列 */
    private $managers = [];

    /**
     * MyBackupService constructor.
     * @param ConfigManager   $configManager
     * @param ScheduleManager $scheduleManager
     */
    public function __construct(ConfigManager $configManager, ScheduleManager $scheduleManager)
    {
        $this->managers[] = $configManager;
        $this->managers[] = $scheduleManager;
    }

    public function processJSONConfigs()
    {
        foreach ($this->managers as $manager) {
            $manager->processJsonConfig();
        }
    }

    public function doBackup()
    {
    }
}
