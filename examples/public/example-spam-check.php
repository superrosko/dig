<?php

use Superrosko\Dig\DigClient;
use Superrosko\Dig\Executor\ExecutorInterface;
use Superrosko\Dig\ResourceRecords\ResourceRecordsInterface;

include __DIR__ . '/../vendor/autoload.php';

/**
 * @var ExecutorInterface $executor
 * @var ResourceRecordsInterface[] $records
 */

$name = '2.0.0.127.zen.spamhaus.org';

$time = microtime(true);
try {
    $executor = DigClient::getExecutor(DigClient::EXECUTOR_COMMAND);
    $records = $executor->getRecords($name, DNS_A, '', [], false);
    var_dump($records);
} catch (Exception $exception) {
    echo $exception->getMessage() . PHP_EOL;
}
echo 'Time: ' . (microtime(true) - $time) . PHP_EOL;


$name = 'dbltest.com.dbl.spamhaus.org';

$time = microtime(true);
try {
    $executor = DigClient::getExecutor(DigClient::EXECUTOR_COMMAND);
    $records = $executor->getRecords($name, DNS_A, '', [], false);
    var_dump($records);
} catch (Exception $exception) {
    echo $exception->getMessage() . PHP_EOL;
}
echo 'Time: ' . (microtime(true) - $time) . PHP_EOL;
