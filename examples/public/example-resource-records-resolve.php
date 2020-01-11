<?php

use Superrosko\Dig\DigClient;
use Superrosko\Dig\Executor\AbstractExecutor;
use Superrosko\Dig\Executor\ExecutorInterface;
use Superrosko\Dig\ResourceRecords\AbstractResourceRecord;
use Superrosko\Dig\ResourceRecords\ResourceRecordsInterface;

include __DIR__ . '/../vendor/autoload.php';

$name = 'rdevelab.ru';

/**
 * @var ExecutorInterface $executor
 * @var ResourceRecordsInterface[] $records
 */

$time = microtime(true);
try {
    $executor = DigClient::getExecutor(DigClient::EXECUTOR_COMMAND);
    $servers = $executor->getRootServers($name, null, [], true);
    $ns = AbstractExecutor::getRandomResolvedRecord($servers);

    $server = AbstractResourceRecord::getServer($ns);
    echo 'NS server: ' . PHP_EOL;
    var_dump($server);

    $records = $executor->getRecords($name, DNS_A, $server, [], false);
    echo 'Records A: ' . PHP_EOL;
    var_dump($records);

    $records = $executor->getRecords($name, DNS_AAAA, $server, [], false);
    echo 'Records AAAA: ' . PHP_EOL;
    var_dump($records);

    $records = $executor->getRecords($name, DNS_TXT, $server, [], false);
    echo 'Records TXT: ' . PHP_EOL;
    var_dump($records);

    $records = $executor->getRecords($name, DNS_CNAME, $server, [], false);
    echo 'Records CNAME: ' . PHP_EOL;
    var_dump($records);

} catch (Exception $exception) {
    echo $exception->getMessage() . PHP_EOL;
}
echo 'Time: ' . (microtime(true) - $time) . PHP_EOL;


$time = microtime(true);
try {
    $executor = DigClient::getExecutor(DigClient::EXECUTOR_GET_DNS_RECORD);
    $servers = $executor->getRootServers($name, null, [], true);
    $ns = AbstractExecutor::getRandomResolvedRecord($servers);

    $server = AbstractResourceRecord::getServer($ns);
    echo 'NS server: ' . PHP_EOL;
    var_dump($server);

    $records = $executor->getRecords($name, DNS_A, null, [], false);
    echo 'Records A: ' . PHP_EOL;
    var_dump($records);

    $records = $executor->getRecords($name, DNS_AAAA, null, [], false);
    echo 'Records AAAA: ' . PHP_EOL;
    var_dump($records);

    $records = $executor->getRecords($name, DNS_TXT, null, [], false);
    echo 'Records TXT: ' . PHP_EOL;
    var_dump($records);

    $records = $executor->getRecords($name, DNS_CNAME, null, [], false);
    echo 'Records CNAME: ' . PHP_EOL;
    var_dump($records);
    
} catch (Exception $exception) {
    echo $exception->getMessage() . PHP_EOL;
}
echo 'Time: ' . (microtime(true) - $time) . PHP_EOL;
