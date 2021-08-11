<?php

namespace AlibabaCloud\Cloudwf;

/**
 * @method string getOperation()
 * @method $this withOperation($value)
 * @method array getMacList()
 */
class SetScanMode extends Rpc
{
    /**
     * @return $this
     */
    public function withMacList(array $macList)
    {
        $this->data['MacList'] = $macList;
        foreach ($macList as $i => $iValue) {
            $this->options['query']['MacList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
