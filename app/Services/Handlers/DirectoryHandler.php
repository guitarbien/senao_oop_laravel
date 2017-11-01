<?php

namespace App\Services\Handlers;

use App\Services\Candidate;
use Illuminate\Support\Facades\File;

class DirectoryHandler extends AbstractHandler
{
    /**
     * @param Candidate $candidate
     * @param array $target
     * @return array
     */
    public function perform(Candidate $candidate, array $target): ?array
    {
        $target = parent::perform($candidate, $target);

        if (!empty($target)) {
            return $this->copyToDirectory($candidate, $target);
        }

        return $target;
    }

    /**
     * 將 byte[] 還原成檔案，並複製到其他目錄
     * @param $candidate
     * @param $target
     * @return array
     */
    private function copyToDirectory($candidate, $target): array
    {
        // 還原成檔案
        HandlerFactory::create('file')->perform($candidate, $target);

        // 複製
        $backupPath = $this->getBackupFilePath($candidate);
        $newPath = $this->getNewFilePath($candidate, $backupPath);
        File::copy($backupPath, $newPath);

        return $target;
    }

    /**
     * 檔案要複製到的目標路徑
     * @param Candidate $candidate
     * @return string
     */
    private function getNewFilePath(Candidate $candidate, string $oldPath): string
    {
        return $candidate->getConfig()->getDir() . DIRECTORY_SEPARATOR . File::basename($oldPath);
    }
}