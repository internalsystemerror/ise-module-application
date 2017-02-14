<?php

namespace Ise\Application\Listener;

use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\ListenerAggregateTrait;
use Ise\Application\Cache\AbstractCache;

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
