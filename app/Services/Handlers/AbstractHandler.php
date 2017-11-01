<?php

namespace App\Services\Handlers;

use App\Services\Candidate;
use Illuminate\Support\Facades\File;

abstract class AbstractHandler implements Handler
{
    /** @const string 備份出新檔案的副檔名 */
    const FILENAME_SUFFIX = '.backupServiceBak';

    public function perform(Candidate $candidate, array $target): ?array
    {
        return $target;
    }

    /**
     * 舊檔名串上固定文字成新檔名
     * @param Candidate $candidate
     * @return string
     */
    protected function getBackupFilePath(Candidate $candidate): string
    {
        return File::dirname($candidate->getName()) . DIRECTORY_SEPARATOR . File::basename($candidate->getName()) . self::FILENAME_SUFFIX;
    }
}