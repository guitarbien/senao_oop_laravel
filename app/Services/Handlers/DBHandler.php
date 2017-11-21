<?php

namespace App\Services\Handlers;

use App\Services\Candidate;

/**
 * Interface DBHandler
 * @package App\Services\Handlers
 */
interface DBHandler
{
    /**
     * @param Candidate $candidate
     * @param array $target
     * @return array|null
     */
    public function perform(Candidate $candidate, array $target): ?array;
}