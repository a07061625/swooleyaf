<?php
namespace AliOpen\Ecs;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of StopInstance
 * @method string getResourceOwnerId()
 * @method string getStoppedMode()
 * @method string getHibernate()
 * @method string getForceStop()
 * @method string getConfirmStop()
 * @method string getDryRun()
 * @method string getResourceOwnerAccount()
 * @method string getOwnerAccount()
 * @method string getOwnerId()
 * @method string getInstanceId()
 */
class InstanceStopRequest extends RpcAcsRequest
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
        parent::__construct('Ecs', '2014-05-26', 'StopInstance', 'ecs');
    }

    /**
     * @param string $resourceOwnerId
     * @return $this
     */
    public function setResourceOwnerId($resourceOwnerId)
    {
        $this->requestParameters['ResourceOwnerId'] = $resourceOwnerId;
        $this->queryParameters['ResourceOwnerId'] = $resourceOwnerId;

        return $this;
    }

    /**
     * @param string $stoppedMode
     * @return $this
     */
    public function setStoppedMode($stoppedMode)
    {
        $this->requestParameters['StoppedMode'] = $stoppedMode;
        $this->queryParameters['StoppedMode'] = $stoppedMode;

        return $this;
    }

    /**
     * @param string $hibernate
     * @return $this
     */
    public function setHibernate($hibernate)
    {
        $this->requestParameters['Hibernate'] = $hibernate;
        $this->queryParameters['Hibernate'] = $hibernate;

        return $this;
    }

    /**
     * @param string $forceStop
     * @return $this
     */
    public function setForceStop($forceStop)
    {
        $this->requestParameters['ForceStop'] = $forceStop;
        $this->queryParameters['ForceStop'] = $forceStop;

        return $this;
    }

    /**
     * @param string $confirmStop
     * @return $this
     */
    public function setConfirmStop($confirmStop)
    {
        $this->requestParameters['ConfirmStop'] = $confirmStop;
        $this->queryParameters['ConfirmStop'] = $confirmStop;

        return $this;
    }

    /**
     * @param string $dryRun
     * @return $this
     */
    public function setDryRun($dryRun)
    {
        $this->requestParameters['DryRun'] = $dryRun;
        $this->queryParameters['DryRun'] = $dryRun;

        return $this;
    }

    /**
     * @param string $resourceOwnerAccount
     * @return $this
     */
    public function setResourceOwnerAccount($resourceOwnerAccount)
    {
        $this->requestParameters['ResourceOwnerAccount'] = $resourceOwnerAccount;
        $this->queryParameters['ResourceOwnerAccount'] = $resourceOwnerAccount;

        return $this;
    }

    /**
     * @param string $ownerAccount
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
     * @return $this
     */
    public function setOwnerId($ownerId)
    {
        $this->requestParameters['OwnerId'] = $ownerId;
        $this->queryParameters['OwnerId'] = $ownerId;

        return $this;
    }

    /**
     * @param string $instanceId
     * @return $this
     */
    public function setInstanceId($instanceId)
    {
        $this->requestParameters['InstanceId'] = $instanceId;
        $this->queryParameters['InstanceId'] = $instanceId;

        return $this;
    }
}
