<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

namespace Ise\Application\Cache\Result;

class RouteCacheResult extends AbstractCacheResult
{

    /**
     * Get route name
     *
     * @return string
     */
    public function getRouteName(): string
    {
        return $this->data['route-name'];
    }

    /**
     * Get options
     *
     * @return array
     */
    public function getOptions(): array
    {
        return [
            'route'    => $this->data['uri'],
            'defaults' => $this->data['route-params'],
        ];
    }
}
