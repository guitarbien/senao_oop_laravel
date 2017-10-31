<?php

namespace App\Services;

use App\Services\Handlers\Handler;
use App\Services\Handlers\HandlerFactory;
use const DIRECTORY_SEPARATOR;
use function explode;
use function get_class;
use Storage;
use File;
use function strtolower;

/**
 * Class MyBackupService
 * @package App\Services
 */
class MyBackupService
{
    /** @var JsonManager[] 存放各種 Manager 的陣列 */
    private $managers = [];

    /**
     * MyBackupService constructor.
     */
    public function __construct()
    {
        $this->managers[] = new ConfigManager;
        $this->managers[] = new ScheduleManager;
    }

    /**
     * 執行所有 manager 各自的 processJsonConfig()
     */
    public function processJsonConfigs(): void
    {
        foreach ($this->managers as $manager) {
            $manager->processJsonConfig();
        }
    }

    public function doBackup()
    {
        /** @var Candidate[] $candidates */
        $candidates = $this->findFiles();

        foreach ($candidates as $candidate) {
            $this->broadcastToHandlers($candidate);
        }
    }

    /**
     * 先隨便寫
     * @return array
     */
    private function findFiles(): array
    {
        $fileList = ["xxxx.cs"];

        /** @var Candidate[] $candidates */
        $candidates = [];

        foreach ($fileList as $filename) {
            $info['config']       = $this->findMatchConfig($filename);
            $info['fileDateTime'] = Storage::lastModified($filename);
            $info['name']         = $this->getFileName($filename);
            $info['processName']  = '???';
            $info['size']         = Storage::size($filename);

            $candidates[] = new Candidate($info);
        }

        return $candidates;
    }

    /**
     * 找出此檔案應使用何種 Config
     * @param string $filename
     * @return Config
     */
    private function findMatchConfig(string $filename): Config
    {
        $configManager = $this->getConfigManager();

        /** @var Config $config */
        foreach ($configManager as $config) {
            if (strtolower($config['ext']) == strtolower(File::extension($filename))) {
                return $config;
            }
        }
    }

    /**
     * 由 list managers 中找出 ConfigManager
     * @return ConfigManager
     */
    private function getConfigManager(): ConfigManager
    {
        foreach ($this->managers as $manager) {
            if (get_class($manager) === 'ConfigManager') {
                /** @var ConfigManager $manager */
                return $manager;
            }
        }
    }

    /**
     * 從 path 取得檔名
     * @param string $filename
     * @return string
     */
    private function getFileName(string $filename): string
    {
        return collect(explode(DIRECTORY_SEPARATOR, $filename))->last();
    }

    private function broadcastToHandlers(Candidate $candidate): void
    {
        /** @var Handler[] $handlers */
        $handlers = $this->findHandlers($candidate);

        foreach ($handlers as $handler) {
            /** @var array $target */
            $target = $handler->perform($candidate, $target);
        }
    }

    private function findHandlers(Candidate $candidate): array
    {
        /** @var Handler[] $handlers */
        $handlers[] = HandlerFactory::create('file');

        // 讀取 config 的 handlers
        foreach ($candidate['handlers'] as $handler) {
            $handlers[] = $handler;
        }

        $handlers[] = HandlerFactory::create($candidate['destination']);
    }


}
