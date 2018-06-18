<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

namespace Ise\Application\Cache;

use ArrayObject;

class FormCache extends AbstractCache
{

    /**
     * @inheritDoc
     */
    public function getCache($class)
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
    public function setCache($class, $formSpecification)
    {
        if (!$formSpecification instanceof ArrayObject) {
            return;
        }

        $specificationArray    = (array)$formSpecification;
        $objectManagerDetected = $this->checkForObjectManager($specificationArray);

        $data = [
            'requires-object-manager' => $objectManagerDetected,
            'form-specification'      => $specificationArray,
        ];

        $this->storage->setItem($this->getCacheKey($class), $data);
    }

    /**
     * @inheritDoc
     */
    public function getCacheKey($class)
    {
        return 'form-' . md5($class);
    }

    /**
     * Checks for object manager
     *
     * @param array $specificationArray
     *
     * @return boolean
     */
    protected function checkForObjectManager(array &$specificationArray)
    {
        if (!isset($specificationArray['elements'])) {
            return false;
        }

        $objectManagerDetected = false;
        foreach ($specificationArray['elements'] as $key => $element) {
            // Cast element to array
            $elementSpecification = (array)$element;
            if (!isset($elementSpecification['spec']['options']['object_manager'])) {
                continue;
            }

            // Detected object manager
            $objectManagerDetected = true;

            // Remove object manager in specification
            $elementSpecification['spec']['options']['object_manager'] = true;

            // Override element specification
            $specificationArray['elements'][$key] = $elementSpecification;
        }

        return $objectManagerDetected;
    }
}
