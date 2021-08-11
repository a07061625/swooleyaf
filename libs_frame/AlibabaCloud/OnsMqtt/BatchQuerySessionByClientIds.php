<?php

namespace AlibabaCloud\OnsMqtt;

/**
 * @method array getClientIdList()
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 */
class BatchQuerySessionByClientIds extends Rpc
{
    /**
     * @return $this
     */
    public function withClientIdList(array $clientIdList)
    {
        $this->data['ClientIdList'] = $clientIdList;
        foreach ($clientIdList as $i => $iValue) {
            $this->options['query']['ClientIdList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
