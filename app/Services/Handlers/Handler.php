<?php

namespace App\Services\Handlers;

use App\Services\Candidate;

interface Handler
{
    public function perform(Candidate $candidate, array $target): array;
}