<?php

namespace Tests\Unit;

use App\Services\Schedule;
use App\Services\ScheduleManager;
use Tests\TestCase;

class ScheduleManagerTest extends TestCase
{
    public function test_ScheduleManager可以像array操作()
    {
        $scheduleManager = new ScheduleManager;

        $scheduleManager[] = 'cool';
        $scheduleManager['x'] = 'not cool';

        $this->assertEquals('cool', $scheduleManager[0]);
        $this->assertEquals('not cool', $scheduleManager['x']);
    }

    public function test_ScheduleManager基本屬性()
    {
        $scheduleManager = new ScheduleManager;

        $this->assertObjectHasAttribute('schedules', $scheduleManager);
    }

    public function test_ScheduleManager可以用count取得目前存有幾個schedules()
    {
        $scheduleManager = new ScheduleManager;

        $this->assertEquals(0, $scheduleManager->count());
    }

}
