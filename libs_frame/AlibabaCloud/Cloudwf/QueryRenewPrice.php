<?php

namespace AlibabaCloud\Cloudwf;

/**
 * @method string getTimeCycleNum()
 * @method $this withTimeCycleNum($value)
 * @method array getApList()
 */
class QueryRenewPrice extends Rpc
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
