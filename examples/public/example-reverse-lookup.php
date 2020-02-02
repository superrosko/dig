<?php

use Superrosko\Dig\DigClient;
use Superrosko\Dig\Executor\ExecutorInterface;

include __DIR__ . '/../vendor/autoload.php';

/**
 * @var ExecutorInterface $executor
 */

$ip = '35.204.110.18';
$type = DNS_PTR;

$time = microtime(true);
try {
    $executor = DigClient::getExecutor(DigClient::EXECUTOR_COMMAND);
    $records = $executor->getRecords($ip, $type, null, [
        'q-opt' => ['-x'],
        'd-opt' => ['+nocomments', '+noquestion', '+noauthority', '+noadditional', '+nostats']
    ], false);
    var_dump($records);
} catch (Exception $exception) {
    echo $exception->getMessage() . PHP_EOL;
}
echo 'Time: ' . (microtime(true) - $time) . PHP_EOL;

$time = microtime(true);
try {
    $executor = DigClient::getExecutor(DigClient::EXECUTOR_GET_DNS_RECORD);
    $records = $executor->getRecords($ip, $type, null, [], true);
    $record = $executor::getRandomRecord($records);
    var_dump($record);
} catch (Exception $exception) {
    echo $exception->getMessage() . PHP_EOL;
}
echo 'Time: ' . (microtime(true) - $time) . PHP_EOL;
