<?php

namespace Ise\Application;

return [
    'cache' => [
        'redis' => [
            'namespace' => __NAMESPACE__ . '\Doctrine',
            'instance'  => __NAMESPACE__ . '\Service\Redis',
        ],
    ],
];
