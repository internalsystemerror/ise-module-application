<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

namespace Ise\Application\Cache;

interface CacheInterface
{
    /**
     * Get cache
     *
     * @param string $key
     *
     * @return Result\AbstractCacheResult|null
     */
    public function getCache(string $key): ?Result\AbstractCacheResult;

    /**
     * Set cache
     *
     * @param string $key
     * @param mixed  $data
     *
     * @return void
     */
    public function setCache(string $key, $data): void;

    /**
     * Get cache key
     *
     * @param string $string
     *
     * @return string
     */
    public function getCacheKey(string $string): string;
}
