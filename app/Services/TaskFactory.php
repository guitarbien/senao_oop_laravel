<?php

namespace App\Services;

/**
 * Class TaskFactory
 * @package App\Services
 */
class TaskFactory
{
    /**
     * @param string $task
     * @return Task|null
     */
    public static function create(string $task): ?Task
    {
        if ($task == "simple") {
            return new SimpleTask();
        } else if ($task == "scheduled") {
            return new ScheduledTask();
        }

        return null;

    }
}