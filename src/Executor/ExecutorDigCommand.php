<?php

namespace Superrosko\Dig\Executor;

use \Exception;
use Psr\SimpleCache\CacheInterface;
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
     * @param CacheInterface|null $cache
     * @throws Exception
     */
    public function __construct(CacheInterface $cache = null)
    {
        if (!function_exists('exec')) {
            throw new Exception('Function exec not exists');
        }

        $disabled = explode(',', ini_get('disable_functions'));
        if (in_array('exec', $disabled)) {
            throw new Exception('Function exec disabled in php.ini');
        }

        parent::__construct($cache);
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
    public function setDefaultResolver(string $resolver)
    {
        $this->resolver = $resolver;
    }
}
