<?php

namespace AlibabaCloud\EcsInc;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getDestNetworkInterfaceId()
 * @method $this withDestNetworkInterfaceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method array getSrcNetworkInterface()
 */
class InnerLinkNetworkInterfaces extends Rpc
{
    /**
     * @return $this
     */
    public function withSrcNetworkInterface(array $srcNetworkInterface)
    {
        $this->data['SrcNetworkInterface'] = $srcNetworkInterface;
        foreach ($srcNetworkInterface as $depth1 => $depth1Value) {
            $this->options['query']['SrcNetworkInterface.' . ($depth1 + 1) . '.VlanId'] = $depth1Value['VlanId'];
            $this->options['query']['SrcNetworkInterface.' . ($depth1 + 1) . '.NetworkInterfaceId'] = $depth1Value['NetworkInterfaceId'];
        }

        return $this;
    }
}
