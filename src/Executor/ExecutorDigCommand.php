<?php

namespace Superrosko\Dig\Executor;

use \Exception;
use Superrosko\Dig\CacheEntities\CacheEntitiesInterface;
use Superrosko\Dig\Exception\DigFailGetRecordsException;
use Superrosko\Dig\ResourceRecords\ResourceRecordDigCommand as ResourceRecord;

/**
 * Class ExecutorDigCommand
 * @package Superrosko\Dig\Executor
 */
class ExecutorDigCommand extends AbstractExecutor
{
    /**
     * ExecutorDigCommand constructor.
     * @throws Exception
     */
    public function __construct()
    {
        if (!function_exists('exec')) {
            throw new Exception('Function exec not exists');
        }

        $disabled = explode(',', ini_get('disable_functions'));
        if (in_array('exec', $disabled)) {
            throw new Exception('Function exec disabled in php.ini');
        }
    }

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
        exec($request, $response, $code);

        if ($code > 0) {
            throw new DigFailGetRecordsException($request, $response, $code);
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

    /**
     * @inheritDoc
     */
    public function setDefaultResolver(string $resolver)
    {
        $this->resolver = $resolver;
    }
}