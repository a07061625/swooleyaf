<?php

namespace AliOpen\Ess;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DetachDBInstances
 *
 * @method string getResourceOwnerAccount()
 * @method string getScalingGroupId()
 * @method array getDBInstances()
 * @method string getForceDetach()
 * @method string getOwnerId()
 */
class DetachDBInstancesRequest extends RpcAcsRequest
{
    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('Ess', '2014-08-28', 'DetachDBInstances', 'ess');
    }

    /**
     * @param string $resourceOwnerAccount
     *
     * @return $this
     */
    public function setResourceOwnerAccount($resourceOwnerAccount)
    {
        $this->requestParameters['ResourceOwnerAccount'] = $resourceOwnerAccount;
        $this->queryParameters['ResourceOwnerAccount'] = $resourceOwnerAccount;

        return $this;
    }

    /**
     * @param string $scalingGroupId
     *
     * @return $this
     */
    public function setScalingGroupId($scalingGroupId)
    {
        $this->requestParameters['ScalingGroupId'] = $scalingGroupId;
        $this->queryParameters['ScalingGroupId'] = $scalingGroupId;

        return $this;
    }

    /**
     * @return $this
     */
    public function setDBInstances(array $dBInstance)
    {
        $this->requestParameters['DBInstances'] = $dBInstance;
        foreach ($dBInstance as $i => $iValue) {
            $this->queryParameters['DBInstance.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @param string $forceDetach
     *
     * @return $this
     */
    public function setForceDetach($forceDetach)
    {
        $this->requestParameters['ForceDetach'] = $forceDetach;
        $this->queryParameters['ForceDetach'] = $forceDetach;

        return $this;
    }

    /**
     * @param string $ownerId
     *
     * @return $this
     */
    public function setOwnerId($ownerId)
    {
        $this->requestParameters['OwnerId'] = $ownerId;
        $this->queryParameters['OwnerId'] = $ownerId;

        return $this;
    }
}
