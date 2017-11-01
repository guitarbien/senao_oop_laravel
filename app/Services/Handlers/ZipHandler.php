<?php

namespace App\Services\Handlers;

use App\Services\Candidate;

class ZipHandler extends AbstractHandler
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
            return $this->zipData($candidate, $target);
        }
    }

    private function zipData($candidate, $target): array
    {
    }
}