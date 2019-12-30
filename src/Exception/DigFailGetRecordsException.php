<?php

namespace Superrosko\Dig\Exception;

use Throwable;

/**
 * Class DigFailGetRecordsException
 * @package Superrosko\Dig\Exception
 */
class DigFailGetRecordsException extends DigException
{

    private $request;
    private $response;

    /**
     * DigFailGetRecordsException constructor.
     * @param $request
     * @param $response
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($request, $response, $code = 0, Throwable $previous = null)
    {
        $this->request = $request;
        $this->response = $response;
        parent::__construct('Fail when try get records', $code, $previous);
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getResponse()
    {
        return $this->response;
    }
}