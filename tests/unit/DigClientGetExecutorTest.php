<?php

namespace unit;

use Codeception\Test\Unit;
use ReflectionException;
use Superrosko\Dig\DigClient;
use Superrosko\Dig\Executor\ExecutorInterface;

class DigClientGetExecutorTest extends Unit
{
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
