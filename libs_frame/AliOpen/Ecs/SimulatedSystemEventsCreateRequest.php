<?php

namespace AliOpen\Ecs;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of CreateSimulatedSystemEvents
 *
 * @method string getResourceOwnerId()
 * @method string getNotBefore()
 * @method string getResourceOwnerAccount()
 * @method string getOwnerAccount()
 * @method string getOwnerId()
 * @method array getInstanceIds()
 * @method string getEventType()
 */
class SimulatedSystemEventsCreateRequest extends RpcAcsRequest
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
        parent::__construct('Ecs', '2014-05-26', 'CreateSimulatedSystemEvents', 'ecs');
    }

    /**
     * @param string $resourceOwnerId
     *
     * @return $this
     */
    public function setResourceOwnerId($resourceOwnerId)
    {
        $this->requestParameters['ResourceOwnerId'] = $resourceOwnerId;
        $this->queryParameters['ResourceOwnerId'] = $resourceOwnerId;

        return $this;
    }

    /**
     * @param string $notBefore
     *
     * @return $this
     */
    public function setNotBefore($notBefore)
    {
        $this->requestParameters['NotBefore'] = $notBefore;
        $this->queryParameters['NotBefore'] = $notBefore;

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

    /**
     * @return $this
     */
    public function setInstanceIds(array $instanceId)
    {
        $this->requestParameters['InstanceIds'] = $instanceId;
        foreach ($instanceId as $i => $iValue) {
            $this->queryParameters['InstanceId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @param string $eventType
     *
     * @return $this
     */
    public function setEventType($eventType)
    {
        $this->requestParameters['EventType'] = $eventType;
        $this->queryParameters['EventType'] = $eventType;

        return $this;
    }
}
