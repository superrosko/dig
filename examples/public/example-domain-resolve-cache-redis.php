<?php

use Superrosko\Dig\CacheEntities\CacheRedis;
use Superrosko\Dig\DigClient;
use Superrosko\Dig\Executor\ExecutorInterface;
use Superrosko\Dig\ResourceRecords\ResourceRecordsInterface;

include __DIR__ . '/../vendor/autoload.php';

$name = 'rdevelab.ru';
$type = DNS_NS;

$redis = new Redis();
$redis->connect('127.0.0.1', 6379);
$redis->select(1);

/**
 * @var ExecutorInterface $executor
 * @var ResourceRecordsInterface[] $records
 * @var CacheRedis $cache
 */

$cache = CacheRedis::getInstance();
$cache->setRedis($redis);

$time = microtime(true);
try {
    $executor = DigClient::getExecutor(DigClient::EXECUTOR_COMMAND);
    $executor->setCache($cache);
    $servers = $executor->getRootServers($name, null, [], true);
    $server = $executor::getRandomRecord($servers);
    var_dump($server);
} catch (Exception $exception) {
    echo $exception->getMessage() . PHP_EOL;
}
echo 'Time: ' . (microtime(true) - $time) . PHP_EOL;

$time = microtime(true);
try {
    $executor = DigClient::getExecutor(DigClient::EXECUTOR_GET_DNS_RECORD);
    $executor->setCache($cache);
    $servers = $executor->getRootServers($name, null, [], true);
    $server = $executor::getRandomRecord($servers);
    var_dump($server);
} catch (Exception $exception) {
    echo $exception->getMessage() . PHP_EOL;
}
echo 'Time: ' . (microtime(true) - $time) . PHP_EOL;


