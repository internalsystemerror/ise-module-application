<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

namespace Ise\Application;

return [
    'cache' => [
        'redis' => [
            'namespace' => __NAMESPACE__ . '\Doctrine',
            'instance'  => __NAMESPACE__ . '\Service\Redis',
        ],
    ],
];
