<?php

namespace App\Services;

class Config
{
    /** @var string 檔案格式 */
    private $ext;

    /** @var string 要備份檔案的目錄 */
    private $location;

    /** @var bool 是否處理子目錄 */
    private $subDirectory;

    /** @var string 備份單位 fiel:以單一檔案為處理單位、directory：以整個目錄為處理單位 */
    private $unit;

    /** @var bool 處理為是否刪除檔案 */
    private $remove;

    /** @var string 處理方式 zip:壓縮、encode:加密 */
    private $handler;

    /** @var string 處理後要儲存到什麼地方 directory:目錄、db:資料庫 */
    private $destination;

    /** @var string 處理後的目錄 */
    private $dir;

    /** @var string 資料庫連接字串 */
    private $connectionString;

    /**
     * Config constructor.
     * @param array $config
     */
    public function __construct(array $config) {
        $this->ext              = $config['ext'];
        $this->location         = $config['location'];
        $this->subDirectory     = $config['subDirectory'];
        $this->unit             = $config['unit'];
        $this->remove           = $config['remove'];
        $this->handler          = $config['handler'];
        $this->destination      = $config['destination'];
        $this->dir              = $config['dir'];
        $this->connectionString = $config['connectionString'];
    }


    /**
     * @return string
     */
    public function getExt(): string
    {
        return $this->ext;
    }

    /**
     * @return string
     */
    public function getLocation(): string
    {
        return $this->location;
    }

    /**
     * @return bool
     */
    public function isSubDirectory(): bool
    {
        return $this->subDirectory;
    }

    /**
     * @return string
     */
    public function getUnit(): string
    {
        return $this->unit;
    }

    /**
     * @return bool
     */
    public function isRemove(): bool
    {
        return $this->remove;
    }

    /**
     * @return string
     */
    public function getHandler(): string
    {
        return $this->handler;
    }

    /**
     * @return string
     */
    public function getDestination(): string
    {
        return $this->destination;
    }

    /**
     * @return string
     */
    public function getDir(): string
    {
        return $this->dir;
    }

    /**
     * @return string
     */
    public function getConnectionString(): string
    {
        return $this->connectionString;
    }
}
