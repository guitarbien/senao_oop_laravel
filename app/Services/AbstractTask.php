<?php

namespace App\Services;

use App\Services\Handlers\FileFinder;
use App\Services\Handlers\FileFinderFactory;
use App\Services\Handlers\Handler;
use App\Services\Handlers\HandlerFactory;

/**
 * Class AbstractTask
 * @package App\Services
 */
class AbstractTask implements Task
{
    /** @var FileFinder $fileFinder */
    protected $fileFinder;

    /**
     * 讓所有 Task 共用 execute()
     * @param Config $config
     * @param Schedule $schedule
     */
    public function execute(Config $config, Schedule $schedule): void
    {
        $this->fileFinder = FileFinderFactory::create("file", $config);
    }

    /**
     * 每個 candidate 依照設定讓對應的 handler 做處理
     * @param Candidate $candidate
     */
    protected function broadcastToHandlers(Candidate $candidate): void
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