<?php

namespace App\Services\Handlers;

use App\Services\Candidate;

/**
 * Class DBBackupHandler
 * @package App\Services\Handlers
 */
class DBBackupHandler extends AbstractDBHandler
{
    /**
     * @param Candidate $candidate
     * @param array $target
     * @return array|null
     */
    public function perform(Candidate $candidate, array $target): ?array
    {
        // insert target

        return $target;
    }
}