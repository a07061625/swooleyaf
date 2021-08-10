<?php

namespace AlibabaCloud\Ess;

/**
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getScalingGroupId()
 * @method $this withScalingGroupId($value)
 * @method string getForceAttach()
 * @method $this withForceAttach($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method array getDBInstance()
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class AttachDBInstances extends Rpc
{
    /**
     * @return $this
     */
    public function withDBInstance(array $dBInstance)
    {
        $this->data['DBInstance'] = $dBInstance;
        foreach ($dBInstance as $i => $iValue) {
            $this->options['query']['DBInstance.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
