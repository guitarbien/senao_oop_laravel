<?php

namespace App\Services\Handlers;

use App\Services\Candidate;

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

        if (empty($target)) {
            return $this->copyToDirectory($candidate, $target);
        }
    }

    private function copyToDirectory($candidate, $target): array
    {
    }
}