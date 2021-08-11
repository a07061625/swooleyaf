<?php

namespace AlibabaCloud\Cloudwf;

/**
 * @method array getMacList()
 * @method string getCommand()
 * @method $this withCommand($value)
 */
class SendCommandByMac extends Rpc
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
