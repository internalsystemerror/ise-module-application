<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

namespace Ise\Application\Cache;

use Zend\Router\Http\RouteMatch;

class RouteCache extends AbstractCache
{

    const ROUTE_CACHEABLE = 'route-cacheable';
    const ROUTE_CACHED    = 'route-cached';

    /**
     * @inheritDoc
     */
    public function getCache(string $uri): ?Result\AbstractCacheResult
    {
        $data = $this->storage->getItem($this->getCacheKey($uri));
        if ($data === null) {
            return null;
        }

        return new Result\RouteCacheResult($data);
    }

    /**
     * @inheritDoc
     */
    public function setCache(string $uri, $routeMatch): void
    {
        if (!$routeMatch instanceof RouteMatch) {
            return;
        }

        $data = [
            'uri'          => $uri,
            'route-name'   => $routeMatch->getMatchedRouteName(),
            'route-params' => $routeMatch->getParams(),
        ];
        $this->storage->setItem($this->getCacheKey($uri), $data);
    }

    /**
     * @inheritDoc
     */
    public function getCacheKey(string $string): string
    {
        return 'route-' . md5($string);
    }
}
