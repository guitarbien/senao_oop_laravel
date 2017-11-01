<?php

namespace Tests\Unit;

use App\Services\Config;
use App\Services\ConfigManager;
use Tests\TestCase;
use Traversable;

class ConfigManagerTest extends TestCase
{
    public function test_ConfigManager可以像array操作()
    {
        $configManager = new ConfigManager;

        $configManager[] = 'cool';
        $configManager['x'] = 'not cool';

        $this->assertEquals('cool', $configManager[0]);
        $this->assertEquals('not cool', $configManager['x']);
    }

    public function test_ConfigManager可以像array做loop()
    {
        $configManager = new ConfigManager;
        $this->assertInstanceOf(Traversable::class, $configManager);
    }

    public function test_ConfigManager基本屬性()
    {
        $configManager = new ConfigManager;

        $this->assertObjectHasAttribute('configs', $configManager);
    }

    public function test_ConfigManager可以用count取得目前存有幾個configs()
    {
        $configManager = new ConfigManager;

        $this->assertEquals(0, $configManager->count());
    }

    public function test_scheduleManager可將config_json資料組成多筆Config格式並存在field中()
    {
        $configManager = new ConfigManager;
        $configManager->processJsonConfig();

        $this->assertEquals(3, $configManager->count());
        $this->assertInstanceOf(Config::class, $configManager[0]);
    }
}
