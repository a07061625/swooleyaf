<?php

namespace AlibabaCloud\Ecs;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getRecyclable()
 * @method $this withRecyclable($value)
 * @method string getNetworkInterfaceQueueNumber()
 * @method $this withNetworkInterfaceQueueNumber($value)
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method string getDeletionProtection()
 * @method $this withDeletionProtection($value)
 * @method string getUserData()
 * @method $this withUserData($value)
 * @method string getPassword()
 * @method $this withPassword($value)
 * @method string getHostName()
 * @method $this withHostName($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getCreditSpecification()
 * @method $this withCreditSpecification($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method array getSecurityGroupIds()
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getInstanceName()
 * @method $this withInstanceName($value)
 */
class ModifyInstanceAttribute extends Rpc
{
    /**
     * @return $this
     */
    public function withSecurityGroupIds(array $securityGroupIds)
    {
        $this->data['SecurityGroupIds'] = $securityGroupIds;
        foreach ($securityGroupIds as $i => $iValue) {
            $this->options['query']['SecurityGroupIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
