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
        $this->task = TaskFactory::create("simple");

        // configManager 可以 iterate 當 configs 用
        $configManager = $this->findManager($managers, ConfigManager::class);
        $this->task->execute($configManager, null);
    }

    /**
     * @param JsonManager[] $managers
     */
    public function scheduledTask(array $managers): void
    {
        $this->task = TaskFactory::create("scheduled");

        // configManager 可以 iterate 當 configs 用
        $configManager = $this->findManager($managers, ConfigManager::class);
        $scheduleManager = $this->findManager($managers,ScheduleManager::class);
        $this->task->execute($configManager, $scheduleManager);
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