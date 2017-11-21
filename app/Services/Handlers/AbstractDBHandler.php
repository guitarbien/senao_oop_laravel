<?php

namespace App\Services\Handlers;

use App\Services\Candidate;

/**
 * Class AbstractDBHandler
 * @package App\Services\Handlers
 */
class AbstractDBHandler implements DBHandler
{
    /**
     * @param Candidate $candidate
     * @param array $target
     * @return array|null
     */
    public function perform(Candidate $candidate, array $target): ?array
    {
        // 沒有需要共用的程式 ...
        return $target;
    }
}