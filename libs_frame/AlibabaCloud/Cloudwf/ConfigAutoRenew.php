<?php

namespace AlibabaCloud\Cloudwf;

/**
 * @method string getOffsetDays()
 * @method $this withOffsetDays($value)
 * @method string getMonths()
 * @method $this withMonths($value)
 * @method string getAutoRenew()
 * @method $this withAutoRenew($value)
 * @method array getApList()
 */
class ConfigAutoRenew extends Rpc
{
    /**
     * @return $this
     */
    public function withApList(array $apList)
    {
        $this->data['ApList'] = $apList;
        foreach ($apList as $i => $iValue) {
            $this->options['query']['ApList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
