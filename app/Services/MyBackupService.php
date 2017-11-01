<?php

namespace App\Services;

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

    /** @const string config unit 處理單位 檔案 */
    const UNIT_STRING_FILE = 'file';

    /** @const string config unit 處理單位 目錄 */
    const UNIT_STRING_DIRECTORY = 'directory';

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
        $candidates = $this->findFiles();

        foreach ($candidates as $candidate) {
            $this->broadcastToHandlers($candidate);
        }
    }

    /**
     * 先隨便寫
     * @return Candidate[]
     */
    private function findFiles(): array
    {
        /** @var Candidate[] $candidates */
        $candidates = [];

        // 讀 config.json 決定要去哪個路徑抓資料
        foreach ($this->getConfigManager() as $config) {
            /** @var Config $config */
            // 應對目錄或是檔案做處理
            if ($config->getUnit() === self::UNIT_STRING_FILE) {
                $fileList = File::get($config->getLocation());
            } else {
                $fileList = File::files($config->getLocation());
            }

            // 讀取每個設定檔的 location 下的檔案清單
            foreach ($fileList as $file) {
                /** @var SplFileInfo $file */
                // 只處理符合 extension 的 file
                if ($config->getExt() !== $file->getExtension()) {
                    continue;
                }

                $info['config']       = $config;
                $info['fileDateTime'] = $file->getMTime();
                $info['name']         = $file->getPathname();
                $info['processName']  = '???';
                $info['size']         = $file->getSize();

                $candidates[] = new Candidate($info);
            }
        }

        return $candidates;
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
