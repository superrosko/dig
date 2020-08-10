<?php

namespace unit;

use Codeception\Test\Unit;
use ReflectionException;
use Superrosko\Dig\ResourceRecords\AbstractResourceRecord;
use UnitTester;

class AbstractResourceRecordConstructTest extends Unit
{
    /**
     * @var UnitTester
     */
    protected $tester;

    /**
     * Testing construct params
     * @throws ReflectionException
     */
    public function testAbstractResourceRecordConstructParams()
    {
        $name = 'example.com';
        $type = DNS_A;
        $server = '127.0.0.1';
        $opt = ['test_data'];
        $stub = $this->getMockForAbstractClass(AbstractResourceRecord::class, [$name, $type, $server, $opt]);
        $this->tester->assertPrivatePropertyValue($name, AbstractResourceRecord::class, 'name', $stub);
        $this->tester->assertPrivatePropertyValue($type, AbstractResourceRecord::class, 'type', $stub);
        $this->tester->assertPrivatePropertyValue($server, AbstractResourceRecord::class, 'server', $stub);
        $this->tester->assertPrivatePropertyValue($opt, AbstractResourceRecord::class, 'opt', $stub);
    }
}
