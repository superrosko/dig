<?php

namespace Superrosko\Dig\Executor;

use Superrosko\Dig\CacheEntities\CacheEntitiesInterface;
use Superrosko\Dig\Exception\DigException;
use Superrosko\Dig\ResourceRecords\ResourceRecordDigCommand as ResourceRecord;

/**
 * Class ExecutorDigCommand
 * @package Superrosko\Dig\Executor
 */
class ExecutorDigCommand extends AbstractExecutor
{

    /**
     * @inheritDoc
     */
    public function getRecords(string $name, int $type, string $server = null, array $opt = [], bool $resolve = false): array
    {
        $server = $server ?? $this->resolver;
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
        exec($request, $output, $code);

        if ($code > 0) {
            throw DigException::failGetRecords();
        } else {
            return $output;
        }
    }

    /**
     * @inheritDoc
     */
    public function setCache(CacheEntitiesInterface $cache = null)
    {
        $this->cache = $cache;
    }

    /**
     * @inheritDoc
     */
    public function setDefaultResolver(string $resolver)
    {
        $this->resolver = $resolver;
    }
}