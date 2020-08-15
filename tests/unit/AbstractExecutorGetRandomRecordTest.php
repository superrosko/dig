<?php

namespace unit;

use Codeception\Test\Unit;
use Superrosko\Dig\Executor\AbstractExecutor;
use Superrosko\Dig\ResourceRecords\Record;

class AbstractExecutorGetRandomRecordTest extends Unit
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
    public function testGetRandomRecordWithEmptyArrayInParameter()
    {
        $this->assertNull($this->stub::getRandomRecord([]));
    }

    /**
     * Testing for array of Record by parameter
     */
    public function testGetRandomRecordWithArrayOfRecordInParam()
    {
        $this->assertInstanceOf(Record::class, $this->stub::getRandomRecord([
            new Record('127.0.0.1', 'IN', 0, Record::DNS_STR_NS, null),
            new Record('127.0.0.1', 'IN', 0, Record::DNS_STR_TXT, null),
        ]));
    }
}
