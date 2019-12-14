<?php

namespace Superrosko\Dig\ResourceRecords;

/**
 * Class AbstractResourceRecord
 * @package Superrosko\Dig\ResourceRecords
 */
abstract class AbstractResourceRecord implements ResourceRecordsInterface, ResourceRecordsTypesInterface
{
    /**
     * @var string - domain name
     */
    protected $name;

    /**
     * @var int - resource record type from https://php.net/manual/en/network.constants.php
     */
    protected $type;

    /**
     * @var string - resolve server
     */
    protected $server;

    /**
     * @var array - options
     */
    protected $opt;

    /**
     * AbstractResourceRecord constructor.
     * @param string $name
     * @param int $type
     * @param string|null $server
     * @param array $opt
     */
    public function __construct(string $name, int $type, string $server = null, array $opt = [])
    {
        $this->name = $name;
        $this->type = $type;
        $this->server = $server;
        $this->opt = $opt;
    }

    /**
     * @inheritDoc
     */
    public static function getServer(Record $record)
    {
        return $record->opt['target_ip'] ?? $record->data;
    }
}