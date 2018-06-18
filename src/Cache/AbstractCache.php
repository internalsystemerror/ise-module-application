<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

namespace Ise\Application\Cache;

use Zend\Cache\Storage\StorageInterface;

abstract class AbstractCache implements CacheInterface
{

    /**
     * @var StorageInterface
     */
    protected $storage;

    /**
     * @inheritDoc
     */
    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
    }
}
