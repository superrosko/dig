<?php

namespace unit;

use Codeception\Test\Unit;
use PHPUnit\Framework\MockObject\MockObject;
use Superrosko\Dig\ResourceRecords\AbstractResourceRecord;
use Superrosko\Dig\ResourceRecords\Record;
use UnitTester;

class AbstractResourceRecordCheckRecordTypeTest extends Unit
{
    /**
     * @var UnitTester
     */
    protected $tester;

    /**
     * @param $name
     * @param $type
     * @param $server
     * @param $opt
     * @return MockObject|AbstractResourceRecord
     */
    private function getStubClass($name, $type, $server, $opt)
    {
        $stub = $this->getMockForAbstractClass(AbstractResourceRecord::class, [$name, $type, $server, $opt]);
        $stub->expects($this->any())
            ->method('convertType')
            ->will($this->returnCallback(
                function () use ($stub) {
                    $type = $this->tester->getPrivatePropertyValue(AbstractResourceRecord::class, 'type', $stub);
                    return Record::$types[$type];
                }
            ));
        return $stub;
    }

    /**
     * Testing check record type with correct data
     */
    public function testCheckRecordTypeWithCorrectData()
    {
        $name = 'example.com';
        $server = '127.0.0.1';
        $opt = ['test_data'];
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
