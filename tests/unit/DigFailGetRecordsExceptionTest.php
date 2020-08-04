<?php

namespace unit;

use Codeception\Test\Unit;
use Superrosko\Dig\Exception\DigFailGetRecordsException;

class DigFailGetRecordsExceptionTest extends Unit
{
    /**
     * Testing DigFailGetRecordsException Construct
     */
    public function testDigFailGetRecordsExceptionConstruct()
    {
        $testCode = 1;
        $testRequest = 'test_request';
        $testResponse = 'test_response';
        try {
            throw new DigFailGetRecordsException($testRequest, $testResponse, $testCode);
        } catch (DigFailGetRecordsException $exception) {
            $this->assertEquals($testCode, $exception->getCode());
            $this->assertEquals($testRequest, $exception->getRequest());
            $this->assertEquals($testResponse, $exception->getResponse());
            $this->assertEquals('Fail when try get records', $exception->getMessage());
        }
    }
}
