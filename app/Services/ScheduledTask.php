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

        while (true) {
            // 檢查頻率時間
            if (date("l") === $schedule->getInterval() && date("H:i") === $schedule->getTime()) {

                foreach ($this->fileFinder as $candidate) {
                    $this->broadcastToHandlers($candidate);
                }

                break;
            }
        }
    }
}