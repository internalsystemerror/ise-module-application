<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

namespace Ise\Application\Listener;

use Ise\Application\Cache\AbstractCache;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\ListenerAggregateTrait;

abstract class AbstractCacheListener implements ListenerAggregateInterface
{
    use ListenerAggregateTrait;

    /**
     * @var AbstractCache
     */
    protected $cacheService;

    /**
     * Constructor
     *
     * @param AbstractCache $cacheService
     */
    public function __construct(AbstractCache $cacheService)
    {
        $this->cacheService = $cacheService;
    }
}
