<?php

namespace Ise\Application\Cache;

use Zend\Cache\Storage\StorageInterface;

abstract class AbstractCache
{

    /**
     * @var StorageInterface
     */
    protected $storage;

    /**
     * {@inheritDoc}
     */
    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
    }
}
