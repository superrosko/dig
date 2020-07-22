<?php

namespace unit;

use Codeception\Test\Unit;
use Superrosko\Dig\ResourceRecords\AbstractResourceRecord;
use Superrosko\Dig\ResourceRecords\Record;
use TypeError;

class AbstractResourceRecordGetServerTest extends Unit
{

    protected function _before()
    {
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
     * Testing TypeError
     */
    public function testGetServerCheckParameterTypeArray()
    {
        $name = 'example.com';
        $type = DNS_A;
        $server = '127.0.0.1';
        $opt = ['test_data'];
        $stub = $this->getStubClass($name, $type, $server, $opt);
        $this->expectException(TypeError::class);
        $stub->getServer([]);
    }

    /**
     * Testing TypeError
     */
    public function testGetServerCheckParameterTypeClosure()
    {
        $name = 'example.com';
        $type = DNS_A;
        $server = '127.0.0.1';
        $opt = ['test_data'];
        $stub = $this->getStubClass($name, $type, $server, $opt);
        $this->expectException(TypeError::class);
        $stub->getServer(function () {
        });
    }

    /**
     * Testing TypeError
     */
    public function testGetRandomRecordCheckParameterTypeString()
    {
        $name = 'example.com';
        $type = DNS_A;
        $server = '127.0.0.1';
        $opt = ['test_data'];
        $stub = $this->getStubClass($name, $type, $server, $opt);
        $this->expectException(TypeError::class);
        $stub->getServer('');
    }

    /**
     * Testing for null by parameter
     */
    public function testGetRandomRecordCheckParameterTypeNull()
    {
        $name = 'example.com';
        $type = DNS_A;
        $server = '127.0.0.1';
        $opt = ['test_data'];
        $stub = $this->getStubClass($name, $type, $server, $opt);
        $this->assertNull($stub->getServer(null));
    }

    /**
     * Testing for Record with target_ip by parameter
     */
    public function testGetRandomRecordCheckParameterTypeRecordWithOutTargetIp()
    {
        $name = 'example.com';
        $type = DNS_A;
        $server = '127.0.0.1';
        $opt = ['test_data'];
        $record = new Record('example.com', 'IN', 0, Record::DNS_STR_NS, ['test data']);
        $stub = $this->getStubClass($name, $type, $server, $opt);
        $this->assertEquals($record->data, $stub->getServer($record));
    }

    /**
     * Testing for Record with target_ip by parameter
     */
    public function testGetRandomRecordCheckParameterTypeRecordWithTargetIp()
    {
        $name = 'example.com';
        $type = DNS_A;
        $server = '127.0.0.1';
        $opt = ['test_data'];
        $record = new Record('example.com', 'IN', 0, Record::DNS_STR_NS, [], [
            'target_ip' => '127.0.0.1',
        ]);
        $stub = $this->getStubClass($name, $type, $server, $opt);
        $this->assertEquals($record->opt['target_ip'], $stub->getServer($record));
    }
}
