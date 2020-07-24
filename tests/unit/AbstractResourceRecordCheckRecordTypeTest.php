<?php

namespace unit;

use ArgumentCountError;
use Codeception\Test\Unit;
use Superrosko\Dig\ResourceRecords\AbstractResourceRecord;
use Superrosko\Dig\ResourceRecords\Record;
use Superrosko\Dig\ResourceRecords\TraitResourceRecord;

class AbstractResourceRecordCheckRecordTypeTest extends Unit
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

            use TraitResourceRecord;

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
    public function testCheckRecordTypeCheckArgumentCount()
    {
        $name = 'example.com';
        $server = '127.0.0.1';
        $opt = ['test_data'];
        $this->expectException(ArgumentCountError::class);
        $this->getStubClass($name, DNS_NS, $server, $opt)->checkRecordType();
    }

    /**
     * Testing check record type with correct data
     */
    public function testCheckRecordTypeWithCorrectData()
    {
        $name = 'example.com';
        $server = '127.0.0.1';
        $opt = ['test_data'];
        $this->assertTrue($this->getStubClass($name, DNS_NS, $server, $opt)->checkRecordType(Record::$types[DNS_NS]));
        $this->assertTrue($this->getStubClass($name, DNS_A, $server, $opt)->checkRecordType(Record::$types[DNS_A]));
        $this->assertTrue($this->getStubClass($name, DNS_AAAA, $server, $opt)->checkRecordType(Record::$types[DNS_AAAA]));
        $this->assertTrue($this->getStubClass($name, DNS_CNAME, $server, $opt)->checkRecordType(Record::$types[DNS_CNAME]));
        $this->assertTrue($this->getStubClass($name, DNS_TXT, $server, $opt)->checkRecordType(Record::$types[DNS_TXT]));
        $this->assertTrue($this->getStubClass($name, DNS_PTR, $server, $opt)->checkRecordType(Record::$types[DNS_PTR]));
    }

    /**
     * Testing check record type with wrong data
     */
    public function testCheckRecordTypeWithWrongData()
    {
        $name = 'example.com';
        $server = '127.0.0.1';
        $opt = ['test_data'];
        $this->assertFalse($this->getStubClass($name, DNS_A, $server, $opt)->checkRecordType(Record::$types[DNS_NS]));
    }
}
