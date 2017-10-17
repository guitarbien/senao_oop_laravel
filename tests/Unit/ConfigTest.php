<?php

namespace Tests\Unit;

use App\Services\Config;
use Tests\TestCase;

class ConfigTest extends TestCase
{
    public function test_Config_class基本屬性()
    {
        $config = new Config;

        // assert for the fields
        $this->assertObjectHasAttribute('ext', $config);
        $this->assertObjectHasAttribute('location', $config);
        $this->assertObjectHasAttribute('subDirectory', $config);
        $this->assertObjectHasAttribute('unit', $config);
        $this->assertObjectHasAttribute('remove', $config);
        $this->assertObjectHasAttribute('handler', $config);
        $this->assertObjectHasAttribute('destination', $config);
        $this->assertObjectHasAttribute('dir', $config);
        $this->assertObjectHasAttribute('connectionString', $config);
    }
}
