<?php

namespace Tests\Unit;

use App\Services\Schedule;
use Tests\TestCase;

class ScheduleTest extends TestCase
{
    public function test_Schedule_class基本屬性()
    {
        $schedule = new Schedule;

        // assert for the fields
        $this->assertObjectHasAttribute('ext', $schedule);
        $this->assertObjectHasAttribute('interval', $schedule);
        $this->assertObjectHasAttribute('time', $schedule);
    }
}
