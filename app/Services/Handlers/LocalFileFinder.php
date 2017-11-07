<?php

namespace App\Services\Handlers;

use App\Services\Candidate;
use App\Services\Config;
use Illuminate\Support\Facades\File;
use Symfony\Component\Finder\SplFileInfo;

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

    // private function getSubDirectoryFiles(): array
    // {
    //     // 直接使用 framework 提供的 filesystem
    // }

    /**
     * @param string $filename
     * @return Candidate
     */
    protected function createCandidate(string $filename): Candidate
    {
        $pathName = $this->config->getLocation() . $filename;

        $info['config']       = $this->config;
        $info['fileDateTime'] = File::lastModified($pathName);
        $info['name']         = $filename;
        $info['processName']  = '???';
        $info['size']         = File::size($pathName);

        return new Candidate($info);
    }
}