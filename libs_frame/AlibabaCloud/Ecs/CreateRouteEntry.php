<?php

namespace AlibabaCloud\Ecs;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getNextHopId()
 * @method $this withNextHopId($value)
 * @method string getNextHopType()
 * @method $this withNextHopType($value)
 * @method string getRouteTableId()
 * @method $this withRouteTableId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getDestinationCidrBlock()
 * @method $this withDestinationCidrBlock($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method array getNextHopList()
 */
class CreateRouteEntry extends Rpc
{
    /**
     * @return $this
     */
    public function withNextHopList(array $nextHopList)
    {
        $this->data['NextHopList'] = $nextHopList;
        foreach ($nextHopList as $depth1 => $depth1Value) {
            if (isset($depth1Value['NextHopId'])) {
                $this->options['query']['NextHopList.' . ($depth1 + 1) . '.NextHopId'] = $depth1Value['NextHopId'];
            }
            if (isset($depth1Value['NextHopType'])) {
                $this->options['query']['NextHopList.' . ($depth1 + 1) . '.NextHopType'] = $depth1Value['NextHopType'];
            }
        }

        return $this;
    }
}
