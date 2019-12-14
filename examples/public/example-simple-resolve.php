<?php

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

$time = microtime(true);
try {
    $executor = DigClient::getExecutor(DigClient::EXECUTOR_COMMAND);
    $records = $executor->getRecords($name, $type, null, [], true);
    $record = $executor::getRandomRecord($records);
    var_dump($record);
} catch (Exception $exception) {
    echo $exception->getMessage() . PHP_EOL;
}
echo 'Time: ' . (microtime(true) - $time) . PHP_EOL;


$time = microtime(true);
try {
    $executor = DigClient::getExecutor(DigClient::EXECUTOR_GET_DNS_RECORD);
    $records = $executor->getRecords($name, $type, null, [], true);
    $record = $executor::getRandomRecord($records);
    var_dump($record);
} catch (Exception $exception) {
    echo $exception->getMessage() . PHP_EOL;
}
echo 'Time: ' . (microtime(true) - $time) . PHP_EOL;
