<?php

namespace App\Services;

/**
 * Class ScheduledTask
 * @package App\Services
 */
class ScheduledTask extends AbstractTask
{
    /**
     * @param Config $config
     * @param Schedule $schedule
     */
    public function execute(Config $config, Schedule $schedule): void
    {
        parent::execute($config, $schedule);

        foreach ($this->fileFinder as $candidate) {
            $this->broadcastToHandlers($candidate);
        }
    }
}