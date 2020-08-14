<?php

namespace unit;

use Codeception\Test\Unit;
use Superrosko\Dig\Executor\AbstractExecutor;
use Superrosko\Dig\ResourceRecords\Record;

class AbstractExecutorGetRandomResolvedRecordTest extends Unit
{
    /**
     * @var $stub AbstractExecutor
     */
    protected $stub;

    protected function _before()
    {
        $this->stub = $this->getMockForAbstractClass(AbstractExecutor::class);
        $this->stub->expects($this->any())
            ->method('getRecords')
            ->will($this->returnValue([]));
        $this->stub->expects($this->any())
            ->method('execute')
            ->will($this->returnValue([]));
    }

    /**
     * Testing for empty array by parameter
     */
    public function testGetRandomResolvedRecordWithEmptyArrayInParameter()
    {
        $this->assertNull($this->stub::getRandomResolvedRecord([]));
    }

    /**
     * Testing for array of Record by parameter
     */
    public function testGetRandomResolvedRecordWithArrayOfRecordInParam()
    {
        $this->assertNull($this->stub::getRandomResolvedRecord([
            new Record('127.0.0.1', 'IN', 0, Record::DNS_STR_NS, null),
            new Record('127.0.0.1', 'IN', 0, Record::DNS_STR_TXT, null),
        ]));
    }

    /**
     * Testing for array of Record by parameter
     */
    public function testGetRandomResolvedRecordWithArrayOfRecordWithOptTargetIpInParam()
    {
        $this->assertInstanceOf(Record::class, $this->stub::getRandomResolvedRecord([
            new Record('127.0.0.1', 'IN', 0, Record::DNS_STR_NS, [], [
                'target_ip' => '127.0.0.1',
            ]),
            new Record('127.0.0.1', 'IN', 0, Record::DNS_STR_TXT, null),
        ]));
    }
}
