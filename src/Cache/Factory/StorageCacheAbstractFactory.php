<?php

namespace Ise\Application\Cache\Factory;

use Interop\Container\ContainerInterface;
use Zend\Cache\Service\StorageCacheAbstractServiceFactory;
use Zend\Cache\Service\PluginManagerLookupTrait;
use Zend\Cache\StorageFactory;

class StorageCacheAbstractFactory extends StorageCacheAbstractServiceFactory
{
    use PluginManagerLookupTrait;
    
    /**
     * {@inheritDoc}
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $this->prepareStorageFactory($container);
        
        $cacheConfig  = $this->getConfig($container);
        $entityConfig = $cacheConfig[$requestedName];
        if ($entityConfig['adapter'] === 'redis') {
            // Get redis config
            $config      = $container->get('Config');
            $redisConfig = $config['redis'];
            
            // Remove default config
            $server = $entityConfig['options']['server'];
            unset($entityConfig['options']['server']);
            
            // Insert new config (must be at the beginning due to ZF bug)
            $entityConfig = ['server' => $redisConfig] + $entityConfig['options'];
        }
        return StorageFactory::factory($entityConfig);
    }
}
