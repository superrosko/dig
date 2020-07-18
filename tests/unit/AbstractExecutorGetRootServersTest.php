<?php

namespace unit;

use Codeception\Test\Unit;
use Psr\SimpleCache\InvalidArgumentException;
use ReflectionException;
use Superrosko\Dig\Exception\DigFailGetRecordsException;
use Superrosko\Dig\Executor\AbstractExecutor;
use Superrosko\Dig\ResourceRecords\Record;

class AbstractExecutorGetRootServersTest extends Unit
{
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    /**
     * @throws InvalidArgumentException
     * @throws ReflectionException
     * @throws DigFailGetRecordsException
     */
    public function testGetRootServersWithEmptyArrayResponse()
    {
        $stub = $this->getMockForAbstractClass(AbstractExecutor::class);
        $stub->expects($this->any())
            ->method('getRecords')
            ->will($this->returnValue([]));
        $stub->expects($this->any())
            ->method('execute')
            ->will($this->returnValue([]));

        $servers = $stub->getRootServers('google.com', null, [], true);
        $this->assertEquals([], $servers);
    }

    /**
     * @throws InvalidArgumentException
     * @throws ReflectionException
     * @throws DigFailGetRecordsException
     */
    public function testGetRootServersWithNotEmptyArrayResponse()
    {
        $response = [
            new Record('example.com', 'IN', 0, Record::DNS_STR_NS, [], [
                'target_ip' => '127.0.0.1',
            ]),
            new Record('example.com', 'IN', 0, Record::DNS_STR_NS, [], [
                'target_ip' => '127.0.0.1',
            ]),
            new Record('example.com', 'IN', 0, Record::DNS_STR_NS, [], [
                'target_ip' => '127.0.0.1',
            ]),
        ];
        $stub = $this->getMockForAbstractClass(AbstractExecutor::class);
        $stub->expects($this->any())
            ->method('getRecords')
            ->will($this->returnValue($response));
        $stub->expects($this->any())
            ->method('execute')
            ->will($this->returnValue([]));

        $servers = $stub->getRootServers('example.com', null, [], true);
        $this->assertEquals($response, $servers);
    }
}
