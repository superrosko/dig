<?php

use Superrosko\Dig\DigClient;
use Superrosko\Dig\Executor\ExecutorInterface;

include __DIR__ . '/../vendor/autoload.php';

/**
 * @var ExecutorInterface $executor
 */

$ip = '35.204.110.18';

$time = microtime(true);
try {
    $executor = DigClient::getExecutor(DigClient::EXECUTOR_COMMAND);
    $records = $executor->getRecords($ip, DNS_PTR, '', [
        'q-opt' => ['-x'],
        'd-opt' => ['+nocomments', '+noquestion', '+noauthority', '+noadditional', '+nostats']
    ], false);
    var_dump($records);
} catch (Exception $exception) {
    echo $exception->getMessage() . PHP_EOL;
}
echo 'Time: ' . (microtime(true) - $time) . PHP_EOL;
