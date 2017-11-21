<?php

namespace App\Services\Handlers;

use App\Services\Candidate;

/**
 * Class DBLogHandler
 * @package App\Services\Handlers
 */
class DBLogHandler extends AbstractDBHandler
{
    /**
     * @param Candidate $candidate
     * @param array $target
     * @return array|null
     */
    public function perform(Candidate $candidate, array $target): ?array
    {
        // insert db log

        return $target;
    }
}