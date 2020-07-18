<?php

namespace unit;

use ArgumentCountError;
use Codeception\Test\Unit;
use StdClass;
use Superrosko\Dig\Executor\AbstractExecutor;
use TypeError;

class AbstractExecutorChunkNameByZonesTest extends Unit
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
    public function testChunkNameByZonesCheckArgumentCount()
    {
        $this->expectException(ArgumentCountError::class);
        $this->stub->chunkNameByZones();
    }

    /**
     * Testing TypeError
     */
    public function testChunkNameByZonesCheckParameterTypeArray()
    {
        $this->expectException(TypeError::class);
        $this->stub->chunkNameByZones([]);
    }

    /**
     * Testing TypeError
     */
    public function testChunkNameByZonesCheckParameterTypeNull()
    {
        $this->expectException(TypeError::class);
        $this->stub->chunkNameByZones(null);
    }

    /**
     * Testing TypeError
     */
    public function testChunkNameByZonesCheckParameterTypeObject()
    {
        $this->expectException(TypeError::class);
        $this->stub->chunkNameByZones(new StdClass());
    }

    /**
     * Testing TypeError
     */
    public function testChunkNameByZonesCheckParameterTypeClosure()
    {
        $this->expectException(TypeError::class);
        $this->stub->chunkNameByZones(function () {
        });
    }

    /**
     * Testing TypeError
     */
    public function testChunkNameByZonesWithEmptyStringInParameter()
    {
        $this->assertEquals(['.'], $this->stub->chunkNameByZones(''));
    }

    /**
     * Testing TypeError
     */
    public function testChunkNameByZonesWithStringWithoutDotsInParameter()
    {
        $this->assertEquals(['.', 'example.'], $this->stub->chunkNameByZones('example'));
    }

    /**
     * Testing TypeError
     */
    public function testChunkNameByZonesWithStringWithDotsInParameter()
    {
        $this->assertEquals(['.', 'com.', 'example.com.'], $this->stub->chunkNameByZones('example.com'));
    }
}
