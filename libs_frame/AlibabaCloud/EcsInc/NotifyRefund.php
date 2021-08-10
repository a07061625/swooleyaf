<?php

namespace AlibabaCloud\EcsInc;

/**
 * @method string getRefundExtendParams()
 * @method $this withRefundExtendParams($value)
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getRefundType()
 * @method $this withRefundType($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOrderId()
 * @method $this withOrderId($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method array getOrderIds()
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getResourceType()
 * @method $this withResourceType($value)
 */
class NotifyRefund extends Rpc
{
    /**
     * @return $this
     */
    public function withOrderIds(array $orderIds)
    {
        $this->data['OrderIds'] = $orderIds;
        foreach ($orderIds as $i => $iValue) {
            $this->options['query']['OrderIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
