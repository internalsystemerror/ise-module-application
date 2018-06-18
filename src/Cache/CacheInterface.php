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
     */
    public function getCache($key);

    /**
     * Set cache
     *
     * @param string $key
     * @param mixed  $data
     */
    public function setCache($key, $data);

    /**
     * Get cache key
     *
     * @param string $string
     *
     * @return string
     */
    public function getCacheKey($string);
}
