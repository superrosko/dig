<?php

namespace Superrosko\Dig\ResourceRecords;

class ResourceRecordDigGetDnsRecord extends AbstractResourceRecord
{
    use TraitResourceRecord;

    /**
     * @inheritDoc
     */
    public function getRequest()
    {
        return [
            'name' => idn_to_ascii($this->name) ?: $this->name,
            'type' => $this->type,
            'raw' => $this->opt['raw'] ?? false,
        ];
    }

    /**
     * @inheritDoc
     */
    public function getNS($record, bool $resolve = false)
    {
        $recordProps = $record;
        if (($recordProps['type'] ?? '') != $this->convertType()) {
            return null;
        }
        $opt = [];
        if ($resolve) {
            $opt['target_ip'] = gethostbyname($recordProps['target'] ?? '');
        }
        return new Record(
            $record['host'],
            $record['class'],
            $record['ttl'],
            $record['type'],
            $record['target'],
            $opt
        );
    }
}