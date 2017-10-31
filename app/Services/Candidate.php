<?php

namespace App\Services;

class Candidate
{
    /** @var Config 所根據的 CONFIG 物件，由 constructor 傳入 */
    private $config;

    /** @var string 檔案的日期與時間 */
    private $fileDateTime;

    /** @var string 檔案名稱 */
    private $name;

    /** @var string 處理檔案的 process */
    private $processName;

    /** @var int 檔案大小 */
    private $size;

    /**
     * Candidate constructor.
     * @param array $info
     */
    public function __construct(array $info)
    {
        $this->config       = $info['config'];
        $this->fileDateTime = $info['fileDateTime'];
        $this->name         = $info['name'];
        $this->processName  = $info['processName'];
        $this->size         = $info['size'];
    }

    /**
     * @return Config
     */
    public function getConfig(): Config
    {
        return $this->config;
    }

    /**
     * @return string
     */
    public function getFileDateTime(): string
    {
        return $this->fileDateTime;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getProcessName(): string
    {
        return $this->processName;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }
}