<?php

namespace unit;

use ArgumentCountError;
use Codeception\Test\Unit;
use StdClass;
use Superrosko\Dig\Executor\AbstractExecutor;
use Superrosko\Dig\ResourceRecords\Record;
use TypeError;

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

    protected function _after()
    {
    }

    /**
     * Testing ArgumentCountError
     */
    public function testGetRandomRecordCheckArgumentCount()
    {
        $this->expectException(ArgumentCountError::class);
        $this->stub->getRandomRecord();
    }

    /**
     * Testing TypeError
     */
    public function testGetRandomRecordCheckParameterTypeNull()
    {
        $this->expectException(TypeError::class);
        $this->stub->getRandomRecord(null);
    }

    /**
     * Testing TypeError
     */
    public function testGetRandomRecordCheckParameterTypeObject()
    {
        $this->expectException(TypeError::class);
        $this->stub->getRandomRecord(new StdClass());
    }

    /**
     * Testing TypeError
     */
    public function testGetRandomRecordCheckParameterTypeClosure()
    {
        $this->expectException(TypeError::class);
        $this->stub->getRandomRecord(function () {
        });
    }

    /**
     * Testing TypeError
     */
    public function testGetRandomRecordCheckParameterTypeString()
    {
        $this->expectException(TypeError::class);
        $this->stub->getRandomRecord('');
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
