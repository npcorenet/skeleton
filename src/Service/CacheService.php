<?php
declare(strict_types=1);

namespace App\Service;

use App\Exception\CacheException;
use App\Software;

class CacheService
{

    /**
     * @throws CacheException
     */
    public function loadFromCache(string $filename, bool $isJson = true): array
    {
        $fileLocation = Software::CACHE_DIR . '/' . $filename . '.json';
        if (!$isJson) {
            $fileLocation = Software::CACHE_DIR . '/' . $filename;
        }

        if (!file_exists($fileLocation)) {
            throw new CacheException('Could not load from cache: ' . $fileLocation);
        }

        $cacheContents = file_get_contents($fileLocation);
        return json_decode($cacheContents, true);
    }

    public function writeToCache(string $filename)
    {
    }

}
