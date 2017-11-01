<?php

namespace App\Services\Handlers;

use App\Services\Candidate;
use Illuminate\Support\Facades\File;

class FileHandler extends AbstractHandler
{
    /**
     * 讀寫檔案
     * @param Candidate $candidate
     * @param array $target
     * @return array
     */
    public function perform(Candidate $candidate, array $target): ?array
    {
        $target = parent::perform($candidate, $target);

        if (empty($target)) {
            return $this->convertFileToByteArray($candidate);
        }

        return $this->convertByteArrayToFile($candidate, $target);
    }

    /**
     * 讀取檔案成陣列
     * @param Candidate $candidate
     * @return array
     */
    private function convertFileToByteArray(Candidate $candidate): array
    {
        return file($candidate->getName());
    }

    /**
     * 回存檔案(和原檔相同路徑)
     * @param Candidate $candidate
     * @param array $target
     */
    private function convertByteArrayToFile(Candidate $candidate, array $target)
    {
        File::put($this->getBackupFilePath($candidate), implode('', $target));
    }
}