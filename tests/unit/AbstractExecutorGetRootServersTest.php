<?php

namespace unit;

use Codeception\Test\Unit;
use Psr\SimpleCache\InvalidArgumentException;
use ReflectionException;
use Superrosko\Dig\Exception\DigFailGetRecordsException;
use Superrosko\Dig\Executor\AbstractExecutor;
use Superrosko\Dig\ResourceRecords\Record;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\Cache\Psr16Cache;

class AbstractExecutorGetRootServersTest extends Unit
{
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    /**
     * Testing with empty array response
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
     * Testing with not empty array response
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

    /**
     * Testing with not empty array and cache response
     * @throws InvalidArgumentException
     * @throws ReflectionException
     * @throws DigFailGetRecordsException
     */
    public function testGetRootServersWithNotEmptyArrayAndCacheResponse()
    {
        $response = [
            new Record('example.com', 'IN', 0, Record::DNS_STR_NS, [], [
                'target_ip' => '127.0.0.1',
            ]),
        ];

        $psr16Cache = new Psr16Cache(new ArrayAdapter());
        $stub = $this->getMockForAbstractClass(AbstractExecutor::class, [$psr16Cache]);
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
