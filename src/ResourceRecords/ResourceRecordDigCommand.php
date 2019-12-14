<?php

namespace Superrosko\Dig\ResourceRecords;

/**
 * Class ResourceRecordDigCommand
 * @package Superrosko\Dig\ResourceRecords
 */
class ResourceRecordDigCommand extends AbstractResourceRecord
{
    use TraitResourceRecord;

    /**
     * @inheritDoc
     */
    public function getRequest()
    {
        $type = $this->convertType();
        $name = idn_to_ascii($this->name) ?: $this->name;
        $opt = implode(' ', $this->opt) ?: '+noall +answer +authority +additional';

        return escapeshellcmd('dig ' . $type . ' ' . $opt . ' ' . $name . ' @' . $this->server);
    }

    /**
     * @inheritDoc
     */
    public function getNS($record, bool $resolve = false)
    {
        $recordProps = explode(' ', preg_replace('!\s+!', ' ', $record));
        if (($recordProps[3] ?? '') != $this->convertType()) {
            return null;
        }
        $opt = [];
        if ($resolve) {
            $opt['target_ip'] = gethostbyname($recordProps['4'] ?? '');
        }
        return new Record(
            trim($recordProps[0] ?? '', '\.'),
            $recordProps[2] ?? '',
            $recordProps[1] ?? '',
            $recordProps[3] ?? '',
            trim($recordProps[4] ?? '', '\.'),
            $opt
        );
    }
}