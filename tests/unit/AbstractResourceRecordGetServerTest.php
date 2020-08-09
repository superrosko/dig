<?php

namespace unit;

use Codeception\Test\Unit;
use Superrosko\Dig\ResourceRecords\AbstractResourceRecord;
use Superrosko\Dig\ResourceRecords\Record;

class AbstractResourceRecordGetServerTest extends Unit
{
    /**
     * Testing for null by parameter
     */
    public function testGetRandomRecordCheckParameterTypeNull()
    {
        $name = 'example.com';
        $type = DNS_A;
        $server = '127.0.0.1';
        $opt = ['test_data'];
        $stub = $this->getMockForAbstractClass(AbstractResourceRecord::class, [$name, $type, $server, $opt]);
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
        $stub = $this->getMockForAbstractClass(AbstractResourceRecord::class, [$name, $type, $server, $opt]);
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
        $stub = $this->getMockForAbstractClass(AbstractResourceRecord::class, [$name, $type, $server, $opt]);
        $this->assertEquals($record->opt['target_ip'], $stub->getServer($record));
    }
}
