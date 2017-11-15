<?php

namespace App\Services;

use function get_class;

/**
 * Class TaskDispatcher
 * @package App\Services
 */
class TaskDispatcher
{
    /** @var Task $task */
    private $task;

    /**
     * @param JsonManager[] $managers
     */
    public function simpleTask(array $managers): void
    {
        $configManager = $this->findManager($managers, ConfigManager::class);

        $this->task = TaskFactory::create("simple");

        // configManager 可以 iterate 當 configs 用
        foreach ($configManager as $config) {
            $this->task->execute($config, null);
        }
    }

    /**
     * @param JsonManager[] $managers
     */
    public function scheduledTask(array $managers): void
    {
        $configManager   = $this->findManager($managers, ConfigManager::class);
        $scheduleManager = $this->findManager($managers,ScheduleManager::class);

        $this->task = TaskFactory::create("scheduled");

        // configManager 可以 iterate 當 configs 用
        foreach ($configManager as $config) {
            // 找出現在這個 config 所屬檔案類型所對應的 schedule
            $schedule = null;
            foreach ($scheduleManager as $eachSchedule) {
                /** @var Schedule $eachSchedule */
                /** @var Config $config */
                if ($eachSchedule->getExt() === $config->getExt()) {
                    $schedule = $eachSchedule;
                    break;
                }
            }

            $this->task->execute($config, $schedule);
        }
    }

    /**
     * 由 managers 中找出 ConfigManager/ScheduleManager
     * @return JsonManager
     */
    private function findManager(array $managers, string $type): ?JsonManager
    {
        foreach ($managers as $manager) {
            if (get_class($manager) == $type) {
                return $manager;
            }
        }

        return null;
    }

}