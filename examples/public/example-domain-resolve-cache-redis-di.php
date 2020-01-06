<?php

use DigExamples\CacheEntities\CacheRedis;
use DigExamples\CacheEntities\CacheRedisDI;
use Superrosko\Dig\Executor\ExecutorDigCommand;
use Superrosko\Dig\Executor\ExecutorInterface;

include __DIR__ . '/../vendor/autoload.php';

$name = 'rdevelab.ru';
$type = DNS_NS;

$redis = new Redis();
$redis->connect('127.0.0.1', 6379);
$redis->select(6);

/**
 * @var ExecutorInterface $executor
 * @var CacheRedis $cache
 */

$time = microtime(true);
try {
    $cache = new CacheRedisDI($redis);
    $executor = new ExecutorDigCommand($cache);
    $servers = $executor->getRootServers($name, null, [], true);
    var_dump($servers);
} catch (Exception $exception) {
    echo $exception->getMessage() . PHP_EOL;
}
echo 'Time: ' . (microtime(true) - $time) . PHP_EOL;
