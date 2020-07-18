<?php

namespace unit;

use ArgumentCountError;
use Codeception\Test\Unit;
use StdClass;
use Superrosko\Dig\Exception\DigException;
use Superrosko\Dig\Executor\AbstractExecutor;
use TypeError;

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

    protected function _after()
    {
    }

    /**
     * Testing ArgumentCountError
     * @throws DigException
     */
    public function testSetDefaultResolverCheckArgumentCount()
    {
        $this->expectException(ArgumentCountError::class);
        $this->stub->setDefaultResolver();
    }

    /**
     * Testing TypeError
     * @throws DigException
     */
    public function testSetDefaultResolverCheckParameterTypeArray()
    {
        $this->expectException(TypeError::class);
        $this->stub->setDefaultResolver([]);
    }

    /**
     * Testing TypeError
     * @throws DigException
     */
    public function testSetDefaultResolverCheckParameterTypeNull()
    {
        $this->expectException(TypeError::class);
        $this->stub->setDefaultResolver(null);
    }

    /**
     * Testing TypeError
     * @throws DigException
     */
    public function testSetDefaultResolverCheckParameterTypeObject()
    {
        $this->expectException(TypeError::class);
        $this->stub->setDefaultResolver(new StdClass());
    }

    /**
     * Testing TypeError
     * @throws DigException
     */
    public function testSetDefaultResolverCheckParameterTypeClosure()
    {
        $this->expectException(TypeError::class);
        $this->stub->setDefaultResolver(function () {
        });
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
