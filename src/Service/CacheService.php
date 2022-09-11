<?php
declare(strict_types=1);

namespace App\Service;

use App\Exception\CacheException;
use App\Software;

class CacheService
{

    public function writeToCache(string $filename, string|array $data, bool $isJson = true): void
    {
        $fileLocation = Software::CACHE_DIR . '/' . $filename . '.json';
        if ($isJson === FALSE) {
            $fileLocation = Software::CACHE_DIR . '/' . $filename;
        }

        if($isJson === true && is_array($data))
        {
            file_put_contents($fileLocation, json_encode($data));
            return;
        }

        file_put_contents($fileLocation, $data);
    }

    /**
     * @throws CacheException
     */
    public function loadFromCache(string $filename, bool $isJson = true): array
    {
        $fileLocation = Software::CACHE_DIR . '/' . $filename . '.json';
        if ($isJson === FALSE) {
            $fileLocation = Software::CACHE_DIR . '/' . $filename;
        }

        if (!file_exists($fileLocation)) {
            throw new CacheException('Could not load from cache: ' . $fileLocation);
        }

        $cacheContents = file_get_contents($fileLocation);
        return json_decode($cacheContents, true);
    }

    /**
     * @throws CacheException
     */
    public function deleteFromCache(string $filename, bool $isJson = true): void
    {
        $fileLocation = Software::CACHE_DIR . '/' . $filename . '.json';
        if ($isJson === FALSE) {
            $fileLocation = Software::CACHE_DIR . '/' . $filename;
        }

        if(!file_exists($fileLocation))
        {
            throw new CacheException('File not in Cache: ' . str_replace(Software::CACHE_DIR . '/', '', $fileLocation));
        }

        unlink($fileLocation);
    }

}
