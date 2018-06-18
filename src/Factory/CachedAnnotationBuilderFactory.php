<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

namespace Ise\Application\Factory;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use Ise\Application\Cache\FormCache;
use Ise\Application\Form\Annotation\CachedAnnotationBuilder;
use Zend\ServiceManager\Factory\FactoryInterface;

class CachedAnnotationBuilderFactory implements FactoryInterface
{

    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get(EntityManager::class);
        $formCache     = $container->get(FormCache::class);
        return new CachedAnnotationBuilder($entityManager, $formCache);
    }
}
