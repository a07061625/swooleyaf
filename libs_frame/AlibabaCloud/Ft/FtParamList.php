<?php

namespace AlibabaCloud\Ft;

/**
 * @method array getDisk()
 * @method string getName()
 * @method $this withName($value)
 */
class FtParamList extends Rpc
{
    /**
     * @return $this
     */
    public function withDisk(array $disk)
    {
        $this->data['Disk'] = $disk;
        foreach ($disk as $depth1 => $depth1Value) {
            foreach ($depth1Value['Size'] as $i => $iValue) {
                $this->options['query']['Disk.' . ($depth1 + 1) . '.Size.' . ($i + 1)] = $iValue;
            }
            foreach ($depth1Value['Type'] as $i => $iValue) {
                $this->options['query']['Disk.' . ($depth1 + 1) . '.Type.' . ($i + 1)] = $iValue;
            }
        }

        return $this;
    }
}
