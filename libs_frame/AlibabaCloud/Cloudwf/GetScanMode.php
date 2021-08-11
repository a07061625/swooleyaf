<?php

namespace AlibabaCloud\Cloudwf;

/**
 * @method array getMacList()
 */
class GetScanMode extends Rpc
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
