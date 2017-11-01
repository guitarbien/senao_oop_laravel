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

        return $this->zipData($candidate, $target);
    }

    /**
     * @param $candidate
     * @param $target
     * @return array
     */
    private function zipData($candidate, $target): array
    {
        $result = [];

        foreach ($target as $line) {
            $result[] = gzencode($line, 9);
        }

        return $result;
    }
}