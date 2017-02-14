<?php

namespace Ise\Application\Cache\Result;

class FormCacheResult extends AbstractCacheResult
{
    
    /**
     * Get route name
     *
     * @return string
     */
    public function requiresObjectManager()
    {
        return $this->data['requires-object-manager'];
    }
    
    /**
     * Get options
     *
     * @return array
     */
    public function getSpecification()
    {
        return $this->data['form-specification'];
    }
    
    public function injectObjectManager($objectManager)
    {
        if (!isset($this->data['form-specification']['elements'])) {
            return;
        }
        
        foreach ($this->data['form-specification']['elements'] as $key => $element) {
            // Cast element to array
            if (!isset($element['spec']['options']['object_manager'])) {
                continue;
            }
            
            // Add object manager in specification
            $element['spec']['options']['object_manager'] = $objectManager;
            
            // Override element specification
            $this->data['form-specification']['elements'][$key] = $element;
        }
    }
}
