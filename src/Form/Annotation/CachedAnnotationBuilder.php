<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

namespace Ise\Application\Form\Annotation;

use Doctrine\ORM\EntityManager;
use Ise\Application\Cache\FormCache;
use Ise\Application\Cache\Result\FormCacheResult;
use Ise\Bread\Form\Annotation\AnnotationBuilder as AnnotationBuilder;

class CachedAnnotationBuilder extends AnnotationBuilder
{

    /**
     * @var FormCache
     */
    protected $cacheService;

    /**
     * Constructor
     *
     * @param EntityManager $entityManager
     * @param FormCache     $cacheService
     */
    public function __construct(EntityManager $entityManager, FormCache $cacheService)
    {
        parent::__construct($entityManager);
        $this->cacheService = $cacheService;
    }

    /**
     * @inheritDoc
     */
    public function getFormSpecification($entity)
    {
        $entityClass = get_class($entity);
        $cachedData  = $this->cacheService->getCache($entityClass);
        if ($cachedData instanceof FormCacheResult) {
            if ($cachedData->requiresObjectManager()) {
                $cachedData->injectObjectManager($this->objectManager);
            }
            $formSpecification = $cachedData->getSpecification();
        } else {
            $formSpecification = parent::getFormSpecification($entity);
            $this->cacheService->setCache($entityClass, $formSpecification);
        }

        return $formSpecification;
    }
}
