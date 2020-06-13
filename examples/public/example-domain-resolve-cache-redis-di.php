<?php

use Dotenv\Dotenv;
use Symfony\Component\Cache\Adapter\RedisAdapter;
use Symfony\Component\Cache\Psr16Cache;
use Superrosko\Dig\Executor\ExecutorDigCommand;
use Superrosko\Dig\Executor\ExecutorInterface;

include __DIR__ . '/../vendor/autoload.php';

$name = 'rdevelab.ru';
$type = DNS_NS;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../..');
$dotenv->load();

$redis = new Redis();
$redis->connect($_ENV['REDIS_HOST'], $_ENV['REDIS_PORT']);
$redis->select(1);

$psr6Cache = new RedisAdapter($redis);
$psr16Cache = new Psr16Cache($psr6Cache);

/**
 * @var ExecutorInterface $executor
 * @var CacheRedis $cache
 */

$time = microtime(true);
try {
    $executor = new ExecutorDigCommand($cache);
    $servers = $executor->getRootServers($name, null, [], true);
    var_dump($servers);
} catch (Exception $exception) {
    echo $exception->getMessage() . PHP_EOL;
}
echo 'Time: ' . (microtime(true) - $time) . PHP_EOL;
