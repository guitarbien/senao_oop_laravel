<?php

namespace App\Services\Handlers;

use App\Services\Candidate;

class DBAdapter extends AbstractHandler
{
    /** @var DBBackupHandler */
    private $backupHandler;

    /** @var DBLogHandler */
    private $logHandler;

    /**
     * DBAdapter constructor.
     * @param DBBackupHandler $backupHandler
     * @param DBLogHandler $logHandler
     */
    public function __construct(DBBackupHandler $backupHandler, DBLogHandler $logHandler)
    {
        $this->backupHandler = $backupHandler;
        $this->logHandler    = $logHandler;
    }

    /**
     * @param Candidate $candidate
     * @param array $target
     * @return array|null
     */
    public function perform(Candidate $candidate, array $target): ?array
    {
        $this->backupHandler->perform($candidate, $target);
        $this->logHandler->perform($candidate, $target);
    }
}