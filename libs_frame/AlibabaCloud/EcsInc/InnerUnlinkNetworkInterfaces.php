<?php

namespace AlibabaCloud\EcsInc;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method array getSrcNetworkInterfaceId()
 * @method string getDestNetworkInterfaceId()
 * @method $this withDestNetworkInterfaceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class InnerUnlinkNetworkInterfaces extends Rpc
{
    /**
     * @return $this
     */
    public function withSrcNetworkInterfaceId(array $srcNetworkInterfaceId)
    {
        $this->data['SrcNetworkInterfaceId'] = $srcNetworkInterfaceId;
        foreach ($srcNetworkInterfaceId as $i => $iValue) {
            $this->options['query']['SrcNetworkInterfaceId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
