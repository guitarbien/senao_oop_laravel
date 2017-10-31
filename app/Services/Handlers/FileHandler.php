<?php

namespace App\Services\Handlers;

use App\Services\Candidate;

class FileHandler extends AbstractHandler
{
    /**
     * @param Candidate $candidate
     * @param array $target
     * @return array
     */
    public function perform(Candidate $candidate, array $target): array
    {
        $target = parent::perform($candidate, $target);

        if (empty($target)) {
            return $this->convertFileToByteArray($candidate);
        }

        $this->convertByteArrayToFile($candidate, $target);
    }

    private function convertFileToByteArray(Candidate $candidate): array
    {
    }

    private function convertByteArrayToFile(Candidate $candidate, array $target): void
    {
    }
}