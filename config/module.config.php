<?php

namespace Ise\Application;

return [
    'doctrine_factories' => ['formannotationbuilder' => Factory\CachedAnnotationBuilderFactory::class,],
    'doctrine'           => include __DIR__ . '/doctrine.config.php',
    'redis'              => include __DIR__ . '/redis.config.php',
    'caches'             => include __DIR__ . '/caches.config.php',
    'log'                => include __DIR__ . '/log.config.php',
    'service_manager'    => include __DIR__ . '/services.config.php',
    'view_manager'       => include __DIR__ . '/views.config.php',
];
