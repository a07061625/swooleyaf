<?php

namespace AlibabaCloud\Rtc;

/**
 * @method array getTerminalIds()
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getAppId()
 * @method $this withAppId($value)
 * @method string getChannelId()
 * @method $this withChannelId($value)
 */
class RemoveTerminals extends Rpc
{
    /**
     * @return $this
     */
    public function withTerminalIds(array $terminalIds)
    {
        $this->data['TerminalIds'] = $terminalIds;
        foreach ($terminalIds as $i => $iValue) {
            $this->options['query']['TerminalIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
