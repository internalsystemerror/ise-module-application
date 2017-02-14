<?php

namespace Ise\Application;

use Zend\Cache\Service\StorageCacheAbstractServiceFactory;
use Zend\Log\LoggerAbstractServiceFactory;

return [
    'abstract_factories' => [
        StorageCacheAbstractServiceFactory::class,
        LoggerAbstractServiceFactory::class,
    ],
    'factories'          => [
        Cache\FormCache::class             => Factory\FormCacheFactory::class,
        Cache\RouteCache::class            => Factory\RouteCacheFactory::class,
        __NAMESPACE__ . '\Service\Redis'   => Factory\RedisFactory::class,
        Listener\RouteCacheListener::class => Factory\RouteCacheListenerFactory::class,
    ],
];
