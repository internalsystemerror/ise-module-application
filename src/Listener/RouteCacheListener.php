<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

namespace Ise\Application\Listener;

use Ise\Application\Cache\Result\RouteCacheResult;
use Ise\Application\Cache\RouteCache;
use Zend\EventManager\EventManagerInterface;
use Zend\Http\Request;
use Zend\Http\Response;
use Zend\Mvc\MvcEvent;
use Zend\Router\Http\Literal;

class RouteCacheListener extends AbstractCacheListener
{

    /**
     * @inheritDoc
     */
    public function attach(EventManagerInterface $events, $priority = 1): void
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
     *
     * @return void
     */
    public function onRoute(MvcEvent $event): void
    {
        // Get uri path
        $request = $event->getApplication()->getRequest();
        if (!$request instanceof Request
            || $request->getMethod() !== Request::METHOD_GET
            || $request->getQuery()->count() > 0
        ) {
            return;
        }
        $event->setParam(RouteCache::ROUTE_CACHEABLE, true);

        $uriPath = $request->getUri()->getPath();
        if (!$uriPath) {
            return;
        }

        // Get result cache via Adapter factory
        $resultCache = $this->cacheService->getCache($uriPath);
        if (!$resultCache instanceof RouteCacheResult) {
            return;
        }

        $event->setParam(RouteCache::ROUTE_CACHED, true);
        $this->addNewRouter($event, $resultCache);
    }

    /**
     * On finish method
     *
     * @param MvcEvent $event
     *
     * @return void
     */
    public function onFinish(MvcEvent $event): void
    {
        $application = $event->getApplication();
        $response    = $application->getResponse();

        // Get status code (only cache a route with a status code of 200)
        if ($response instanceof Response && $response->getStatusCode() == 200) {
            $request = $application->getRequest();
            if (!$request instanceof Request) {
                return;
            }

            // Get uri path
            $uriPath = $request->getUri()->getPath();
            if (!$uriPath) {
                return;
            }

            // Set cache
            $this->cacheService->setCache($uriPath, $event->getRouteMatch());
        }
    }

    /**
     * Add new router to Tree Router ZF2 with high priority
     * Base on result cache to create route literal
     *
     * @param MvcEvent         $event
     * @param RouteCacheResult $resultCache
     *
     * @return void
     */
    protected function addNewRouter(MvcEvent &$event, RouteCacheResult $resultCache): void
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
