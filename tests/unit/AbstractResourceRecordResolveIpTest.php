<?php

namespace unit;

use Codeception\Test\Unit;
use ReflectionException;
use Superrosko\Dig\ResourceRecords\AbstractResourceRecord;
use UnitTester;

class AbstractResourceRecordResolveIpTest extends Unit
{
    /**
     * @var UnitTester
     */
    protected $tester;

    /**
     * @var $stub AbstractResourceRecord
     */
    protected $stub;

    protected function _before()
    {
        $name = 'example.com';
        $type = DNS_A;
        $server = '127.0.0.1';
        $opt = ['test_data'];
        $this->stub = $this->getMockForAbstractClass(AbstractResourceRecord::class, [$name, $type, $server, $opt]);
    }

    /**
     * Testing resolve ip with wrong host name
     * @throws ReflectionException
     */
    public function testResolveIpWithWrongData()
    {
        $this->stub->resolveIp('wrong_data_for_host', true);
        $targetIp = $this->tester->getPrivatePropertyValue(AbstractResourceRecord::class, 'opt', $this->stub);
        $this->assertTrue(isset($targetIp['target_ip']));
        $this->assertTrue(filter_var($targetIp['target_ip'], FILTER_VALIDATE_IP) === false);
        $this->assertEquals('wrong_data_for_host', $targetIp['target_ip']);
    }

    /**
     * Testing resolve ip with real host
     * @throws ReflectionException
     */
    public function testResolveIpWithRealHost()
    {
        $this->stub->resolveIp('example.com', true);
        $targetIp = $this->tester->getPrivatePropertyValue(AbstractResourceRecord::class, 'opt', $this->stub);
        $this->assertTrue(isset($targetIp['target_ip']));
        $this->assertTrue(filter_var($targetIp['target_ip'], FILTER_VALIDATE_IP) !== false);
    }

    /**
     * Testing resolve ip with real host and not resolve flag
     * @throws ReflectionException
     */
    public function testResolveIpWithRealHostAndNotResolveFlag()
    {
        $this->stub->resolveIp('example.com', false);
        $targetIp = $this->tester->getPrivatePropertyValue(AbstractResourceRecord::class, 'opt', $this->stub);
        $this->assertTrue(!isset($targetIp['target_ip']));
    }
}
