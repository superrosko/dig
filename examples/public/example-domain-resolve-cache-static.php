<?php

use Superrosko\Dig\Executor\ExecutorDigCommand;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\Cache\Psr16Cache;
use Psr\SimpleCache\InvalidArgumentException;
use Superrosko\Dig\DigClient;
use Superrosko\Dig\Executor\ExecutorInterface;
use Superrosko\Dig\ResourceRecords\ResourceRecordsInterface;

include __DIR__ . '/../vendor/autoload.php';

$name = 'rdevelab.ru';
$type = DNS_NS;

/**
 * @var ExecutorInterface $executor
 * @var ResourceRecordsInterface[] $records
 */

$psr6Cache = new ArrayAdapter();
$psr16Cache = new Psr16Cache($psr6Cache);

$time = microtime(true);
try {
    $executor = new ExecutorDigCommand($psr16Cache);
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
    $executor = DigClient::getExecutor(DigClient::EXECUTOR_COMMAND, $psr16Cache);
    $servers = $executor->getRootServers($name, null, [], true);
    $server = $executor::getRandomRecord($servers);
    var_dump($server);
} catch (Exception $exception) {
    echo $exception->getMessage() . PHP_EOL;
} catch (InvalidArgumentException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}
echo 'Time: ' . (microtime(true) - $time) . PHP_EOL;
