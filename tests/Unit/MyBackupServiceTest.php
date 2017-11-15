<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Services\MyBackupService;

/**
 * Class MyBackupServiceTest
 * @package Tests\Unit
 */
class MyBackupServiceTest extends TestCase
{
    public function test_可以執行ProcessJsonConfig和DoBackup()
    {
        $myBackupService = new MyBackupService;
        $myBackupService->simpleBackup();

        // 尚未實作備份 故還沒有東西可以 assert
        // 以此 test 當作使用端來測試
        $this->assertTrue(true);
    }

    public function test_使用myBackupService後每個manager的count應正確()
    {
        Storage::fake('local');
        Storage::disk('local')->put('config.json', '{"configs":[{"ext":"cs","location":"c:\\\\Projects","subDirectory":true,"unit":"file","remove":false,"handlers":["zip"],"destination":"directory","dir":"c:\\\\MyArchieves","connectionString":""}]}');
        Storage::disk('local')->put('schedule.json', '{"schedules":[{"ext":"cs","time":"12:00","interval":"Everyday"},{"ext":"docx","time":"20:00","interval":"Everyday"}]}');

        $myBackupService = new MyBackupService;

        // 透過 bindTo 讓測試可以存取到 managers
        $that = $this;
        $assertPropertyClosure = function () use ($that) {
            $that->assertEquals(1, $this->managers[0]->count());
            $that->assertEquals(2, $this->managers[1]->count());
        };
        $doAssertPropertyClosure = $assertPropertyClosure->bindTo($myBackupService, $myBackupService);

        // act
        // assert
        $doAssertPropertyClosure();
    }
}
