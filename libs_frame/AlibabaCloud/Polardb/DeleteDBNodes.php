<?php

namespace AlibabaCloud\Polardb;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method array getDBNodeId()
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
 */
class DeleteDBNodes extends Rpc
{
    /**
     * @return $this
     */
    public function withDBNodeId(array $dBNodeId)
    {
        $this->data['DBNodeId'] = $dBNodeId;
        foreach ($dBNodeId as $i => $iValue) {
            $this->options['query']['DBNodeId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
