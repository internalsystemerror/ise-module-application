<?php

namespace Ise\Application;

use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;

class Module implements BootstrapListenerInterface, ConfigProviderInterface, ServiceProviderInterface
{

    /**
     * {@inheritDoc}
     */
    public function onBootstrap(EventInterface $event)
    {
        // Get event manager
        $target         = $event->getTarget();
        $eventManager   = $target->getEventManager();
        $serviceManager = $target->getServiceManager();
        
        // Attach route cache listener
        $routeCacheListener = $serviceManager->get(Listener\RouteCacheListener::class);
        $routeCacheListener->attach($eventManager);
    }
    
    /**
     * {@inheritDoc}
     */
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    /**
     * {@inheritDoc}
     */
    public function getServiceConfig()
    {
        return include __DIR__ . '/../config/services.config.php';
    }
}
