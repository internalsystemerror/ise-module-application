<?php

namespace Ise\Application\Cache\Result;

abstract class AbstractCacheResult
{
    /**
     * @var array
     */
    protected $data;
    
    /**
     * Constructor
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }
}
