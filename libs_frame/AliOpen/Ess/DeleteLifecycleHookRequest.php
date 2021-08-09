<?php

namespace AliOpen\Ess;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DeleteLifecycleHook
 *
 * @method string getLifecycleHookName()
 * @method string getResourceOwnerAccount()
 * @method string getLifecycleHookId()
 * @method string getScalingGroupId()
 * @method string getOwnerAccount()
 * @method string getOwnerId()
 */
class DeleteLifecycleHookRequest extends RpcAcsRequest
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
        parent::__construct('Ess', '2014-08-28', 'DeleteLifecycleHook', 'ess');
    }

    /**
     * @param string $lifecycleHookName
     *
     * @return $this
     */
    public function setLifecycleHookName($lifecycleHookName)
    {
        $this->requestParameters['LifecycleHookName'] = $lifecycleHookName;
        $this->queryParameters['LifecycleHookName'] = $lifecycleHookName;

        return $this;
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
     * @param string $lifecycleHookId
     *
     * @return $this
     */
    public function setLifecycleHookId($lifecycleHookId)
    {
        $this->requestParameters['LifecycleHookId'] = $lifecycleHookId;
        $this->queryParameters['LifecycleHookId'] = $lifecycleHookId;

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
     * @param string $ownerAccount
     *
     * @return $this
     */
    public function setOwnerAccount($ownerAccount)
    {
        $this->requestParameters['OwnerAccount'] = $ownerAccount;
        $this->queryParameters['OwnerAccount'] = $ownerAccount;

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
