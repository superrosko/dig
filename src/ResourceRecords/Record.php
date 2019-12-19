<?php

namespace Superrosko\Dig\ResourceRecords;

/**
 * Class Record
 * @package Superrosko\Dig\ResourceRecords
 */
final class Record
{
    /**
     * @var string hostname
     */
    public $host;

    /**
     * @var string class
     */
    public $class;

    /**
     * @var string ttl
     */
    public $ttl;

    /**
     * @var string type
     */
    public $type;

    /**
     * @var mixed data
     */
    public $data;

    /**
     * @var array options
     */
    public $opt;

    /**
     * @var array 
     */
    public static $types = [
        DNS_NS => 'NS',
        DNS_A => 'A',
        DNS_AAAA => 'AAAA',
        DNS_CNAME => 'CNAME',
        DNS_TXT => 'TXT',
    ];

    /**
     * Record constructor.
     * @param $host
     * @param $class
     * @param $ttl
     * @param $type
     * @param $data
     * @param array $opt
     */
    public function __construct($host, $class, $ttl, $type, $data, $opt = [])
    {
        $this->host = $host;
        $this->class = $class;
        $this->ttl = $ttl;
        $this->type = $type;
        $this->data = $data;
        $this->opt = $opt;
    }
}