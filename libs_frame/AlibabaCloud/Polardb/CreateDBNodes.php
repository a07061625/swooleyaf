<?php

namespace AlibabaCloud\Polardb;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getDBClusterId()
 * @method $this withDBClusterId($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method array getDBNode()
 */
class CreateDBNodes extends Rpc
{
    /**
     * @return $this
     */
    public function withDBNode(array $dBNode)
    {
        $this->data['DBNode'] = $dBNode;
        foreach ($dBNode as $depth1 => $depth1Value) {
            if (isset($depth1Value['TargetClass'])) {
                $this->options['query']['DBNode.' . ($depth1 + 1) . '.TargetClass'] = $depth1Value['TargetClass'];
            }
            if (isset($depth1Value['ZoneId'])) {
                $this->options['query']['DBNode.' . ($depth1 + 1) . '.ZoneId'] = $depth1Value['ZoneId'];
            }
        }

        return $this;
    }
}
