<?php

namespace unit;

use Codeception\Test\Unit;
use Superrosko\Dig\Executor\AbstractExecutor;

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

    /**
     * Testing for empty string by parameter
     */
    public function testChunkNameByZonesWithEmptyStringInParameter()
    {
        $this->assertEquals(['.'], $this->stub->chunkNameByZones(''));
    }

    /**
     * Testing for string without dots by parameter
     */
    public function testChunkNameByZonesWithStringWithoutDotsInParameter()
    {
        $this->assertEquals(['.', 'example.'], $this->stub->chunkNameByZones('example'));
    }

    /**
     * Testing for string with dots by parameter
     */
    public function testChunkNameByZonesWithStringWithDotsInParameter()
    {
        $this->assertEquals(['.', 'com.', 'example.com.'], $this->stub->chunkNameByZones('example.com'));
    }
}
