<?php

namespace App\Services\Handlers;

use App\Backup;
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
        // insert target to backup
        $backup = new Backup();
        $backup->name = $candidate->getName();
        $backup->file_date_time = $candidate->getFileDateTime();
        $backup->size = $candidate->getSize();
        $backup->target = json_encode($target, JSON_UNESCAPED_UNICODE);
        $backup->save();

        return $target;
    }
}