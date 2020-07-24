<?php

namespace unit;

use ArgumentCountError;
use Codeception\Test\Unit;
use StdClass;
use Superrosko\Dig\ResourceRecords\AbstractResourceRecord;
use TypeError;

class AbstractResourceRecordResolveIpTest extends Unit
{
    /**
     * @var $stub AbstractResourceRecord
     * @method mockGetParamName
     * @method mockGetParamType
     * @method mockGetParamServer
     * @method mockGetParamOpt
     */
    protected $stub;

    protected function _before()
    {
        $name = 'example.com';
        $type = DNS_A;
        $server = '127.0.0.1';
        $opt = ['test_data'];
        $this->stub = $this->getStubClass($name, $type, $server, $opt);
    }

    protected function _after()
    {
    }

    private function getStubClass($name, $type, $server, $opt)
    {
        return new class($name, $type, $server, $opt) extends AbstractResourceRecord {

            public function mockGetParamName()
            {
                return $this->name;
            }

            public function mockGetParamType()
            {
                return $this->type;
            }

            public function mockGetParamServer()
            {
                return $this->server;
            }

            public function mockGetParamOpt()
            {
                return $this->opt;
            }

            public function getRequest()
            {
            }

            public function parseResponse(array $response, bool $resolve = false)
            {
            }

            public function convertType()
            {
            }

            public function parseRecord($record)
            {
            }

            public function getRecordProps($record)
            {
            }

            public function getNS($record, bool $resolve = false)
            {
            }

            public function getA($record, bool $resolve = false)
            {
            }

            public function getAAAA($record, bool $resolve = false)
            {
            }

            public function getTXT($record, bool $resolve = false)
            {
            }

            public function getCNAME($record, bool $resolve = false)
            {
            }

            public function getPTR($record, bool $resolve = false)
            {
            }
        };
    }

    /**
     * Testing ArgumentCountError
     */
    public function testResolveIpCheckArgumentCount()
    {

        $this->expectException(ArgumentCountError::class);
        $this->stub->resolveIp();
    }

    /**
     * Testing TypeError
     */
    public function testResolveIpCheckCheckParameterTypeArray()
    {
        $this->expectException(TypeError::class);
        $this->stub->resolveIp([], []);
    }

    /**
     * Testing TypeError
     */
    public function testResolveIpCheckCheckParameterTypeNull()
    {
        $this->expectException(TypeError::class);
        $this->stub->resolveIp(null, null);
    }

    /**
     * Testing TypeError
     */
    public function testResolveIpCheckCheckParameterTypeObject()
    {
        $this->expectException(TypeError::class);
        $this->stub->resolveIp(new StdClass(), new StdClass());
    }

    /**
     * Testing TypeError
     */
    public function testResolveIpCheckCheckParameterTypeClosure()
    {
        $this->expectException(TypeError::class);
        $this->stub->resolveIp(function () {
        }, function () {
        });
    }

    /**
     * Testing resolve ip with wrong host name
     */
    public function testResolveIpWithWrongData()
    {
        $this->stub->resolveIp('wrong_data_for_host', true);
        $targetIp = $this->stub->mockGetParamOpt();
        $this->assertTrue(isset($targetIp['target_ip']));
        $this->assertTrue(filter_var($targetIp['target_ip'], FILTER_VALIDATE_IP) === false);
        $this->assertEquals('wrong_data_for_host', $targetIp['target_ip']);
    }

    /**
     * Testing resolve ip with real host
     */
    public function testResolveIpWithRealHost()
    {
        $this->stub->resolveIp('example.com', true);
        $targetIp = $this->stub->mockGetParamOpt();
        $this->assertTrue(isset($targetIp['target_ip']));
        $this->assertTrue(filter_var($targetIp['target_ip'], FILTER_VALIDATE_IP) !== false);
    }

    /**
     * Testing resolve ip with real host and not resolve flag
     */
    public function testResolveIpWithRealHostAndNotResolveFlag()
    {
        $this->stub->resolveIp('example.com', false);
        $targetIp = $this->stub->mockGetParamOpt();
        $this->assertTrue(!isset($targetIp['target_ip']));
    }
}
