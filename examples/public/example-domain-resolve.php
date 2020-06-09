<?php

use Superrosko\Dig\DigClient;
use Psr\SimpleCache\InvalidArgumentException;
use Superrosko\Dig\Executor\ExecutorInterface;
use Superrosko\Dig\ResourceRecords\ResourceRecordsInterface;

include __DIR__ . '/../vendor/autoload.php';

$name = 'rdevelab.ru';
$type = DNS_NS;

/**
 * @var ExecutorInterface $executor
 * @var ResourceRecordsInterface[] $records
 */

$time = microtime(true);
try {
    $executor = DigClient::getExecutor(DigClient::EXECUTOR_COMMAND);
    $servers = $executor->getRootServers($name, null, [], true);
    $server = $executor::getRandomRecord($servers);
    var_dump($server);
} catch (Exception $exception) {
    echo $exception->getMessage() . PHP_EOL;
} catch (InvalidArgumentException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}
echo 'Time: ' . (microtime(true) - $time) . PHP_EOL;

$time = microtime(true);
try {
    $executor = DigClient::getExecutor(DigClient::EXECUTOR_GET_DNS_RECORD);
    $servers = $executor->getRootServers($name, null, [], true);
    $server = $executor::getRandomRecord($servers);
    var_dump($server);
} catch (Exception $exception) {
    echo $exception->getMessage() . PHP_EOL;
} catch (InvalidArgumentException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}
echo 'Time: ' . (microtime(true) - $time) . PHP_EOL;
