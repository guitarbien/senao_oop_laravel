<?php

namespace App\Services;

use DateTime;

/**
 * Class CandidateFactory
 * @package App\Services
 */
class CandidateFactory
{
    /**
     * @param Config $config
     * @param string $name
     * @param DateTime $fileDateTime
     * @param int $size
     * @return Candidate
     */
    public static function create(Config $config, string $name, DateTime $fileDateTime, int $size): Candidate
    {
        return new Candidate([
            'config'       => $config,
            'fileDateTime' => $fileDateTime,
            'name'         => $name,
            'processName'  => '',
            'size'         => $size,
        ]);
    }
}