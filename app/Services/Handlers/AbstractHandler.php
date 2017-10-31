<?php

namespace App\Services\Handlers;

use App\Services\Candidate;

abstract class AbstractHandler implements Handler
{
    public function perform(Candidate $candidate, array $target): array
    {
    }
}