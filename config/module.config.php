<?php

namespace Ise\Application;

use Zend\Serializer\Adapter\PhpSerialize;

return [
    'redis'              => [
        'host'    => 'localhost',
        'port'    => 6379,
        'timeout' => 5,
    ],
    'caches'             => [
        __NAMESPACE__ . '\Cache\Form'  => [
            'adapter' => [
                'name' => 'memory',
            ],
            'plugins' => [
                'exception_handler' => [
                    'throw_exceptions' => true,
                ],
                'serializer'        => [
                    'serializer' => PhpSerialize::class,
                ],
            ],
        ],
        __NAMESPACE__ . '\Cache\Route' => [
            'adapter' => [
                'name' => 'memory',
            ],
            'plugins' => [
                'exception_handler' => [
                    'throw_exceptions' => true,
                ],
                'serializer'        => [
                    'serializer' => PhpSerialize::class,
                ],
            ],
        ],
    ],
    'doctrine'           => [
        'cache' => [
            'redis' => [
                'namespace' => __NAMESPACE__ . '\Doctrine',
                'instance'  => __NAMESPACE__ . '\Service\Redis',
            ],
        ],
    ],
    'doctrine_factories' => [
        'formannotationbuilder' => Factory\CachedAnnotationBuilderFactory::class,
    ],
    'view_manager'       => [
        'display_not_found_reason' => false,
        'display_exceptions'       => false,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map'             => [
            'error/404'   => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack'      => [
            __DIR__ . '/../view',
        ],
    ],
];
