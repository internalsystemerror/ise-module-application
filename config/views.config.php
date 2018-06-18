<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

namespace Ise\Application;

return [
    'display_not_found_reason' => false,
    'display_exceptions'       => false,
    'doctype'                  => 'HTML5',
    'not_found_template'       => 'error/404',
    'exception_template'       => 'error/index',
    'template_map'             => [
        'error/404'   => __DIR__ . '/../view/error/404.phtml',
        'error/index' => __DIR__ . '/../view/error/index.phtml',
    ],
];
