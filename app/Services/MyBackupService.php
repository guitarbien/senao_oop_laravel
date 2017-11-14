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

    /** @var TaskDispatcher $taskDispatcher */
    private $taskDispatcher;

    /**
     * MyBackupService constructor.
     */
    public function __construct()
    {
        $this->managers[]     = new ConfigManager;
        $this->managers[]     = new ScheduleManager;
        $this->taskDispatcher = new TaskDispatcher;

        $this->init();
    }

    private function init(): void
    {
        $this->processJsonConfigs();
    }

    /**
     * 執行所有 manager 各自的 processJsonConfig()
     */
    private function processJsonConfigs(): void
    {
        foreach ($this->managers as $manager) {
            $manager->processJsonConfig();
        }
    }

    public function simpleBackup(): void
    {
        $this->taskDispatcher->simpleTask($this->managers);
    }

    public function scheduleBackup(): void
    {
        $this->taskDispatcher->scheduledTask($this->managers);
    }
}
