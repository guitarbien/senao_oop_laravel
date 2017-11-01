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
    public function perform(Candidate $candidate, array $target): ?array
    {
        $target = parent::perform($candidate, $target);

        return $this->encodeData($candidate, $target);
    }

    /**
     * 對每段 binary string 做 base64
     * @param $candidate
     * @param $target
     * @return array
     */
    private function encodeData($candidate, $target): array
    {
        $result = [];

        foreach ($target as $line) {
            $result[] = base64_encode($line);
        }

        return $result;
    }
}