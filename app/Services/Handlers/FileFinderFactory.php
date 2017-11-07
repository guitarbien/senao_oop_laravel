<?php

namespace App\Services\Handlers;

use App\Services\Config;

/**
 * Class FileFinderFactory
 * @package App\Services\Handlers
 */
class FileFinderFactory
{
    /**
     * @param string $finder
     * @param Config $config
     * @return FileFinder|null
     */
    public static function create(string $finder, Config $config): ?FileFinder
    {
        if ($finder == 'file') {
            return new LocalFileFinder($config);
        }

        return null;
    }
}