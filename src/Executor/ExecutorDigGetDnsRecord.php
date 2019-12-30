<?php

namespace Superrosko\Dig\Executor;

use Superrosko\Dig\CacheEntities\CacheEntitiesInterface;
use Superrosko\Dig\Exception\DigFailGetRecordsException;
use Superrosko\Dig\ResourceRecords\ResourceRecordDigGetDnsRecord as ResourceRecord;

/**
 * Class ExecutorDigGetDnsRecord
 * @package Superrosko\Dig\Executor
 */
class ExecutorDigGetDnsRecord extends AbstractExecutor implements ExecutorInterface
{
    /**
     * @inheritDoc
     */
    public function getRecords(string $name, int $type, string $server = null, array $opt = [], bool $resolve = false): array
    {
        $rr = new ResourceRecord($name, $type, $server, $opt);
        $request = $rr->getRequest();
        $response = $this->execute($request);

        return $rr->parseResponse($response, $resolve);
    }

    /**
     * @inheritDoc
     */
    public function execute($request)
    {
        $response = @dns_get_record($request['name'], $request['type'], $authns, $addtl, $request['raw']);

        if ($response === false) {
            throw new DigFailGetRecordsException($request, $response);
        } else {
            return $response;
        }
    }

    /**
     * @inheritDoc
     */
    public function setCache(CacheEntitiesInterface $cache = null)
    {
        $this->cache = $cache;
    }
}