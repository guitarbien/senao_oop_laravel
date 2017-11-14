<?php

namespace App\Services\Handlers;

use App\Services\Candidate;
use App\Services\CandidateFactory;
use App\Services\Config;
use DateTime;
use Illuminate\Support\Facades\File;

/**
 * Class LocalFileFinder
 * @package App\Services\Handlers
 */
class LocalFileFinder extends AbstractFileFinder
{
    /**
     * LocalFileFinder constructor.
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        parent::__construct($config);

        $this->findFiles();
    }

    private function findFiles()
    {
        if ($this->config->isSubDirectory()) {
            $fileList = File::allFiles($this->config->getLocation());
        } else {
            $fileList = File::files($this->config->getLocation());
        }

        // 讀取每個設定檔的 location 下的檔案清單
        // 只處理符合 extension 的 file
        foreach ($fileList as $file) {
            if ($this->config->getExt() !== $file->getExtension()) {
                continue;
            }
        }

        $this->files = $fileList;
    }

    /**
     * @param string $filename
     * @return Candidate
     */
    protected function createCandidate(string $filename): Candidate
    {
        $pathName = $this->config->getLocation() . $filename;

        return CandidateFactory::create(
            $this->config,
            $filename,
            (new DateTime())->setTimestamp(File::lastModified($pathName)),
            File::size($pathName)
        );
    }
}