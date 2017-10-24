<?php

namespace Tests\Unit;

use App\Services\ConfigManager;
use App\Services\ScheduleManager;
use Tests\TestCase;
use App\Services\MyBackupService;

class MyBackupServiceTest extends TestCase
{
    public function test_可以執行ProcessJSONConfig和DoBackup()
    {
        $configManager   = new ConfigManager;
        $scheduleManager = new ScheduleManager;

        $myBackupService = new MyBackupService($configManager, $scheduleManager);
        $myBackupService->processJSONConfig();
        $myBackupService->doBackup();

        $this->assertTrue(true);
    }
}
