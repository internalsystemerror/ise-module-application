<?php

namespace Ise\Application\Factory;

use Interop\Container\ContainerInterface;
use Redis;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class RedisFactory implements FactoryInterface
{
    
    /**
     * {@inheritDoc}
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function __invoke(ContainerInterface $container, $requestedName)
    {
        // Fetch config
        $config      = $container->get('Config');
        $redisConfig = $config['redis'];
        
        $redis = new Redis();
        $redis->pconnect($redisConfig['host'], $redisConfig['port'], $redisConfig['timeout'], 'default');

        return $redis;
    }

    /**
     * {@inheritDoc}
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function createService(ServiceLocatorInterface $serviceLocator, $name = null, $requestedName = null)
    {
        return $this($serviceLocator, $requestedName);
    }
}
