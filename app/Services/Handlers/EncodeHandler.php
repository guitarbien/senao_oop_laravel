<?php

namespace App\Services\Handlers;

use App\Services\Candidate;

class EncodeHandler extends AbstractHandler
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
            return $this->encodeData($candidate, $target);
        }
    }

    private function encodeData($candidate, $target): array
    {
    }
}