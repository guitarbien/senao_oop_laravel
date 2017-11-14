<?php

namespace App\Services;

/**
 * Class Task
 * @package App\Services
 */
interface Task
{
    /**
     * @param Config $config
     * @param Schedule $schedule
     */
    public function execute(Config $config, Schedule $schedule): void;
}