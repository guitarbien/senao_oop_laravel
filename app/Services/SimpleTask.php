<?php

namespace App\Services;

/**
 * Class SimpleTask
 * @package App\Services
 */
class SimpleTask extends AbstractTask
{
    /**
     * @param Config $config
     * @param Schedule $schedule
     */
    public function execute(Config $config, Schedule $schedule = null): void
    {
        parent::execute($config, $schedule);

        foreach ($this->fileFinder as $candidate) {
            $this->broadcastToHandlers($candidate);
        }
    }
}