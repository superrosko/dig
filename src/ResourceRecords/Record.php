<?php

namespace Superrosko\Dig\ResourceRecords;

/**
 * Class Record
 * @package Superrosko\Dig\ResourceRecords
 */
final class Record
{
    const DNS_STR_NS = 'NS';
    const DNS_STR_A = 'A';
    const DNS_STR_AAAA = 'AAAA';
    const DNS_STR_CNAME = 'CNAME';
    const DNS_STR_TXT = 'TXT';
    const DNS_STR_PTR = 'PTR';

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
        DNS_NS => self::DNS_STR_NS,
        DNS_A => self::DNS_STR_A,
        DNS_AAAA => self::DNS_STR_AAAA,
        DNS_CNAME => self::DNS_STR_CNAME,
        DNS_TXT => self::DNS_STR_TXT,
        DNS_PTR => self::DNS_STR_PTR,
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
