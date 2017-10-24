<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\MyBackupService;

class MyBackupServiceTest extends TestCase
{
    public function test_可以執行ProcessJsonConfig和DoBackup()
    {
        $myBackupService = new MyBackupService;
        $myBackupService->processJsonConfigs();

        // 尚未實作備份 故還沒有東西可以 assert
        // 以此 test 當作使用端來測試
        $this->assertTrue(true);
    }
}
