<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

namespace Ise\Application;

use Zend\Serializer\Adapter\PhpSerialize;

return [
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
];
