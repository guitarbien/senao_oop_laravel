<?php

namespace App\Services\Handlers;

use App\Services\Candidate;
use Illuminate\Support\Facades\File;

class FileHandler extends AbstractHandler
{
    /**
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

    private function convertByteArrayToFile(Candidate $candidate, array $target)
    {
        File::put($candidate->getConfig()->getDir(), implode('', $target));
    }
}