<?php

namespace App\Services;

use App\Services\Handlers\Handler;
use App\Services\Handlers\HandlerFactory;

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

    private function findFiles(): array
    {
        $fakeFileList = [""];

        $candidates[] = new Candidate();
        return $candidates;
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
        $configHandlers = [];
        foreach ($configHandlers as $handler) {
            $handlers[] = $handler;
        }

        $configDestination = 'directory';
        $handlers[] = HandlerFactory::create($configDestination);
    }


}
