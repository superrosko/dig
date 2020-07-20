<?php

namespace unit;

use ArgumentCountError;
use Codeception\Test\Unit;
use ReflectionException;
use StdClass;
use Superrosko\Dig\DigClient;
use Superrosko\Dig\Executor\ExecutorInterface;
use TypeError;

class DigClientGetExecutorTest extends Unit
{

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    /**
     * Testing ArgumentCountError
     * @throws ReflectionException
     */
    public function testGetExecutorCheckArgumentCount()
    {
        $this->expectException(ArgumentCountError::class);
        DigClient::getExecutor();
    }

    /**
     * Testing TypeError
     * @throws ReflectionException
     */
    public function testGetExecutorCheckParameterTypeArray()
    {
        $this->expectException(TypeError::class);
        DigClient::getExecutor([], []);
    }

    /**
     * Testing TypeError
     * @throws ReflectionException
     */
    public function testGetExecutorCheckParameterTypeNull()
    {
        $this->expectException(TypeError::class);
        DigClient::getExecutor(null, null);
    }

    /**
     * Testing TypeError
     * @throws ReflectionException
     */
    public function testGetExecutorCheckParameterTypeObject()
    {
        $this->expectException(TypeError::class);
        DigClient::getExecutor(new StdClass(), new StdClass());
    }

    /**
     * Testing TypeError
     * @throws ReflectionException
     */
    public function testGetExecutorCheckParameterTypeClosure()
    {
        $this->expectException(TypeError::class);
        DigClient::getExecutor(function () {
        }, function () {
        });
    }

    /**
     * Testing wrong execution class
     * @throws ReflectionException
     */
    public function testGetExecutorWrongClass()
    {
        $this->expectException(ReflectionException::class);
        DigClient::getExecutor('test');
    }

    /**
     * Testing Command execution class
     * @throws ReflectionException
     */
    public function testGetExecutorByCommandClass()
    {
        $executor = DigClient::getExecutor(DigClient::EXECUTOR_COMMAND);
        $this->assertInstanceOf(ExecutorInterface::class, $executor);
    }

    /**
     * Testing GetDnsRecord execution class
     * @throws ReflectionException
     */
    public function testGetExecutorByGetDnsRecordClass()
    {
        $executor = DigClient::getExecutor(DigClient::EXECUTOR_GET_DNS_RECORD);
        $this->assertInstanceOf(ExecutorInterface::class, $executor);
    }
}
