<?php

namespace Tests\Unit;

use App\Services\ConfigManager;
use App\Services\ScheduleManager;
use Mockery;
use ReflectionClass;
use Tests\TestCase;
use App\Services\MyBackupService;

class MyBackupServiceTest extends TestCase
{
    public function test_可以執行ProcessJsonConfig和DoBackup()
    {
        $myBackupService = $this->app->make(MyBackupService::class);
        $myBackupService->processJsonConfigs();

        // 尚未實作備份 故還沒有東西可以 assert
        // 以此 test 當作使用端來測試
        $this->assertTrue(true);
    }

    public function test_使用myBackupService後每個manager的count應正確()
    {
        // arrange

        // 使用 ReflectionClass 讓 protected 屬性能透過 getValue() 被測試存取
        $classConfig = new ReflectionClass(ConfigManager::class);
        $propertyConfig = $classConfig->getProperty("configs");
        $propertyConfig->setAccessible(true);

        /** @var ConfigManager $mockConfig */
        $mockConfig = Mockery::mock(ConfigManager::class)->makePartial()->shouldAllowMockingProtectedMethods();
        $mockConfig->shouldReceive('getJsonObject')
             ->andReturn(
                 // 3 rows config
                 json_decode('{"configs":[{"ext":"cs","location":"c:\\\\Projects","subDirectory":true,"unit":"file","remove":false,"handler":"zip","destination":"directory","dir":"c:\\\\MyArchieves","connectionString":""},{"ext":"DOCX","location":"c:\\\\Documents","subDirectory":true,"unit":"file","remove":false,"handler":"encode","destination":"db","dir":"","connectionString":"MyConnectionString"},{"ext":"jpg","location":"c:\\\\Pictures","subDirectory":true,"unit":"file","remove":false,"handler":"","destination":"directory","dir":"c:\\\\MyArchieves","connectionString":""}]}', true)
             );

        $this->app->instance(ConfigManager::class, $mockConfig);

        // 使用 ReflectionClass 讓 protected 屬性能透過 getValue() 被測試存取
        $classSchedule = new ReflectionClass(ScheduleManager::class);
        $propertySchedule = $classSchedule->getProperty("configs");
        $propertySchedule->setAccessible(true);

        /** @var ScheduleManager $mockSchedule */
        $mockSchedule = Mockery::mock(ScheduleManager::class)->makePartial()->shouldAllowMockingProtectedMethods();
        $mockSchedule->shouldReceive('getJsonObject')
             ->andReturn(
                 //  2 rows schedule
                 json_decode('{"schedules":[{"ext":"cs","time":"12:00","interval":"Everyday"},{"ext":"docx","time":"20:00","interval":"Everyday"}]}', true)
             );

        $this->app->instance(ScheduleManager::class, $mockSchedule);

        $myBackupService = $this->app->make(MyBackupService::class);

        // 透過 bindTo 讓測試可以存取到 managers
        $that = $this;
        $assertPropertyClosure = function () use ($that, $propertyConfig, $propertySchedule) {
            $that->assertCount(3, $propertyConfig->getValue($this->managers[0]));
            $that->assertCount(2, $propertySchedule->getValue($this->managers[1]));
        };
        $doAssertPropertyClosure = $assertPropertyClosure->bindTo($myBackupService, get_class($myBackupService));

        // act
        $myBackupService->processJsonConfigs();

        // assert
        $doAssertPropertyClosure();

    }
}
