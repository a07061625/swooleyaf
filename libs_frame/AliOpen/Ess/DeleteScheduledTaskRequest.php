<?php

namespace AliOpen\Ess;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DeleteScheduledTask
 *
 * @method string getResourceOwnerAccount()
 * @method string getOwnerAccount()
 * @method string getOwnerId()
 * @method string getScheduledTaskId()
 */
class DeleteScheduledTaskRequest extends RpcAcsRequest
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
        parent::__construct('Ess', '2014-08-28', 'DeleteScheduledTask', 'ess');
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
     * @param string $scheduledTaskId
     *
     * @return $this
     */
    public function setScheduledTaskId($scheduledTaskId)
    {
        $this->requestParameters['ScheduledTaskId'] = $scheduledTaskId;
        $this->queryParameters['ScheduledTaskId'] = $scheduledTaskId;

        return $this;
    }
}
