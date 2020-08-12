<?php

namespace unit;

use Codeception\Test\Unit;
use Superrosko\Dig\Exception\DigException;
use Superrosko\Dig\Executor\AbstractExecutor;

class AbstractExecutorSetDefaultResolverTest extends Unit
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
     * Testing Exception Throwing
     * @throws DigException
     */
    public function testSetDefaultResolverCheckException()
    {
        $this->expectException(DigException::class);
        $this->stub->setDefaultResolver('');
    }
}
