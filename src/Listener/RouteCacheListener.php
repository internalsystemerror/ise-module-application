<?php

namespace Ise\Application\Listener;

use Zend\EventManager\EventManagerInterface;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\Http\Literal;
use Ise\Application\Cache\Result\RouteCacheResult;

class RouteCacheListener extends AbstractCacheListener
{
    
    /**
     * {@inheritDoc}
     */
    public function attach(EventManagerInterface $events)
    {
        $this->listeners[] = $events->attach(
            MvcEvent::EVENT_ROUTE,
            [$this, 'onRoute'],
            1000000
        );
        $this->listeners[] = $events->attach(
            MvcEvent::EVENT_FINISH,
            [$this, 'onFinish'],
            -1000000
        );
    }

    /**
     * On route method
     *
     * @param MvcEvent $event
     */
    public function onRoute(MvcEvent $event)
    {
        // Get uri path
        $request = $event->getApplication()->getRequest();
        if (!$request instanceof Request || $request->getMethod() !== Request::METHOD_GET || $request->getQuery()->count() > 0) {
            return;
        }
        $event->setParam(self::ROUTE_CACHEABLE, true);
        
        // Get result cache via Adapter factory
        $uriPath     = $request->getUri()->getPath();
        $resultCache = $this->cacheService->getCache($uriPath);
        if ($resultCache instanceof RouteCacheResult) {
            $event->setParam(self::ROUTE_CACHED, true);
            
            // Add new router to Tree router ZF2
            $this->addNewRouter($event, $resultCache);
        }
    }

    /**
     * On finish method
     *
     * @param MvcEvent $event
     */
    public function onFinish(MvcEvent $event)
    {
        $application = $event->getApplication();

        // Get status code (only cache a route with a status code of 200)
        if ($application->getResponse()->getStatusCode() == 200) {
            // Get uri path
            $uriPath = $application->getRequest()->getUri()->getPath();

            // Get route matched
            $routeMatched = $event->getRouteMatch();

            // Set cache
            $this->cacheService->setCache($uriPath, $routeMatched);
        }
    }

    /**
     * Add new router to Tree Router ZF2 with high priority
     * Base on result cache to create route literal
     *
     * @param MvcEvent $event
     * @param RouteCacheResult $resultCache
     */
    protected function addNewRouter(MvcEvent &$event, RouteCacheResult $resultCache)
    {
        // Create route literal
        $route = Literal::factory($resultCache->getOptions());
        
        // Add router
        $router = $event->getRouter();
        $router->addRoute($resultCache->getRouteName(), $route, 1000000);
        
        // Set router to event object
        $event->setRouter($router);
    }
}
