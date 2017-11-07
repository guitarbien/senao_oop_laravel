<?php

namespace App\Services;

use App\Services\Handlers\FileFinderFactory;
use App\Services\Handlers\Handler;
use App\Services\Handlers\HandlerFactory;
use Illuminate\Support\Facades\File;
use Symfony\Component\Finder\SplFileInfo;

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

    /**
     * 執行備份
     */
    public function doBackup(): void
    {
        foreach ($this->getConfigManager() as $config) {
            // 目前先實作本機
            // (之後也許根據 location 來切換 local s3 ftp ?)
            $fileFinder = FileFinderFactory::create('file', $config);

            // iterate 到 current 時回傳 candidate
            foreach ($fileFinder as $candidate) {
                $this->broadcastToHandlers($candidate);
            }
        }
    }

    /**
     * 由 list managers 中找出 ConfigManager
     * @return ConfigManager
     */
    private function getConfigManager(): ?ConfigManager
    {
        foreach ($this->managers as $manager) {
            /** @var JsonManager $manager */
            if ($manager instanceof ConfigManager) {
                /** @var ConfigManager $manager */
                return $manager;
            }
        }

        return null;
    }

    /**
     * 每個 candidate 依照設定讓對應的 handler 做處理
     * @param Candidate $candidate
     */
    private function broadcastToHandlers(Candidate $candidate): void
    {
        $handlers = $this->findHandlers($candidate);

        $target = [];
        foreach ($handlers as $handler) {
            $target = $handler->perform($candidate, $target);
        }
    }

    /**
     * 使用 HandlerFactory 依序產生 handler
     * @param Candidate $candidate
     * @return Handler[]
     */
    private function findHandlers(Candidate $candidate): array
    {
        /** @var Handler[] $handlers */
        $handlers[] = HandlerFactory::create('file');

        // 讀取 config 的 handlers
        foreach ($candidate->getConfig()->getHandlers() as $handler) {
            $handlers[] = HandlerFactory::create($handler);
        }

        // 目前只有 directory
        $handlers[] = HandlerFactory::create($candidate->getConfig()->getDestination());

        return $handlers;
    }
}
