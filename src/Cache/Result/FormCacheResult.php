<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

namespace Ise\Application\Cache\Result;

use Doctrine\Common\Persistence\ObjectManager;

class FormCacheResult extends AbstractCacheResult
{

    /**
     * Is the object manager required
     *
     * @return bool
     */
    public function requiresObjectManager(): bool
    {
        return $this->data['requires-object-manager'];
    }

    /**
     * Get options
     *
     * @return array
     */
    public function getSpecification(): array
    {
        return $this->data['form-specification'];
    }

    /**
     * Inject object manager
     *
     * @param ObjectManager $objectManager
     *
     * @return void
     */
    public function injectObjectManager(ObjectManager $objectManager): void
    {
        if (!$this->data['form-specification']['elements']) {
            return;
        }

        foreach ($this->data['form-specification']['elements'] as $key => $element) {
            // Cast element to array
            if (!$element['spec']['options']['object_manager']) {
                continue;
            }

            // Add object manager in specification
            $element['spec']['options']['object_manager'] = $objectManager;

            // Override element specification
            $this->data['form-specification']['elements'][$key] = $element;
        }
    }
}
