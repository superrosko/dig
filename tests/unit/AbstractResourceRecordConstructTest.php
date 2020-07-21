<?php

namespace unit;

use ArgumentCountError;
use Codeception\Test\Unit;
use Superrosko\Dig\ResourceRecords\AbstractResourceRecord;

class AbstractResourceRecordConstructTest extends Unit
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
     * Testing ArgumentCountError
     */
    public function testAbstractResourceRecordConstructCheckArgumentCount()
    {
        $this->expectException(ArgumentCountError::class);
        new class() extends AbstractResourceRecord {

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
     * Testing construct params
     */
    public function testAbstractResourceRecordConstructParams()
    {
        $name = 'example.com';
        $type = DNS_A;
        $server = '127.0.0.1';
        $opt = ['test_data'];
        $stub = $this->getStubClass($name, $type, $server, $opt);
        $this->assertEquals($name, $stub->mockGetParamName());
        $this->assertEquals($type, $stub->mockGetParamType());
        $this->assertEquals($server, $stub->mockGetParamServer());
        $this->assertEquals($opt, $stub->mockGetParamOpt());
    }
}
