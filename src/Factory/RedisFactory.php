<?php
/**
 * @copyright 2018 Internalsystemerror Limited
 */
declare(strict_types=1);

namespace Ise\Application\Factory;

use Interop\Container\ContainerInterface;
use Redis;
use Zend\ServiceManager\Factory\FactoryInterface;

class RedisFactory implements FactoryInterface
{

    /**
     * @inheritDoc
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        // Fetch config
        $config      = $container->get('Config');
        $redisConfig = $config['redis'];

        $redis = new Redis;
        $redis->pconnect($redisConfig['host'], $redisConfig['port'], $redisConfig['timeout'], 'default');

        return $redis;
    }
}
