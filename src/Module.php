<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

namespace Ise\Application;

use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Mvc\Application;

class Module implements BootstrapListenerInterface, ConfigProviderInterface
{

    /**
     * @inheritDoc
     */
    public function onBootstrap(EventInterface $event)
    {
        // Get event manager
        $application = $event->getTarget();
        if (!$application instanceof Application) {
            return;
        }

        // Attach route cache listener
        $routeCacheListener = $application->getServiceManager()->get(Listener\RouteCacheListener::class);
        $routeCacheListener->attach($application->getEventManager());
    }

    /**
     * @inheritDoc
     */
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}
