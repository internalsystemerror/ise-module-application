<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

namespace Ise\Application\Cache;

class FormCache extends AbstractCache
{

    /**
     * @inheritDoc
     */
    public function getCache(string $class): ?Result\AbstractCacheResult
    {
        $data = $this->storage->getItem($this->getCacheKey($class));
        if ($data === null) {
            return null;
        }

        return new Result\FormCacheResult($data);
    }

    /**
     * @inheritDoc
     */
    public function setCache(string $class, $formSpecification): void
    {
        if (!is_iterable($formSpecification)) {
            return;
        }

        $this->storage->setItem($this->getCacheKey($class), [
            'requires-object-manager' => $this->checkForObjectManager($formSpecification),
            'form-specification'      => $formSpecification,
        ]);
    }

    /**
     * @inheritDoc
     */
    public function getCacheKey(string $class): string
    {
        return 'form-' . md5($class);
    }

    /**
     * Checks for object manager
     *
     * @param iterable $specificationArray
     *
     * @return bool
     */
    protected function checkForObjectManager(iterable &$specificationArray): bool
    {
        if (!$specificationArray['elements']) {
            return false;
        }

        $objectManagerDetected = false;
        foreach ($specificationArray['elements'] as $key => &$element) {
            // Cast element to array
            if (!$element['spec']['options']['object_manager']) {
                continue;
            }

            // Detected object manager
            $objectManagerDetected = true;

            // Remove object manager in specification
            $element['spec']['options']['object_manager'] = true;
        }

        return $objectManagerDetected;
    }
}
