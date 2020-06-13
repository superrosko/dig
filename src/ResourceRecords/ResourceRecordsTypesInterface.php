<?php

namespace Superrosko\Dig\ResourceRecords;

/**
 * Interface ResourceRecordsTypesInterface
 * @package Superrosko\Dig\ResourceRecords
 */
interface ResourceRecordsTypesInterface
{
    /**
     * Parse NS resource records response
     *
     * @param $record
     * @param bool $resolve
     * @return Record|null
     */
    public function getNS($record, bool $resolve = false);

    /**
     * Parse A resource records response
     *
     * @param $record
     * @param bool $resolve
     * @return Record|null
     */
    public function getA($record, bool $resolve = false);

    /**
     * Parse AAAA resource records response
     *
     * @param $record
     * @param bool $resolve
     * @return Record|null
     */
    public function getAAAA($record, bool $resolve = false);

    /**
     * Parse TXT resource records response
     *
     * @param $record
     * @param bool $resolve
     * @return Record|null
     */
    public function getTXT($record, bool $resolve = false);

    /**
     * Parse CNAME resource records response
     *
     * @param $record
     * @param bool $resolve
     * @return Record|null
     */
    public function getCNAME($record, bool $resolve = false);

    /**
     * Parse PTR resource records response
     *
     * @param $record
     * @param bool $resolve
     * @return Record|null
     */
    public function getPTR($record, bool $resolve = false);
}
