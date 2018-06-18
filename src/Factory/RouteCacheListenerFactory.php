<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

namespace Ise\Application\Factory;

use Interop\Container\ContainerInterface;
use Ise\Application\Cache\RouteCache;
use Zend\ServiceManager\Factory\FactoryInterface;

class RouteCacheListenerFactory implements FactoryInterface
{

    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $routeCache = $container->get(RouteCache::class);
        return new $requestedName($routeCache);
    }
}
