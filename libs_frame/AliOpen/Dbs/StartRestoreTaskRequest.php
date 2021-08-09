<?php
namespace AliOpen\Dbs;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of StartRestoreTask
 * @method string getClientToken()
 * @method string getOwnerId()
 * @method string getRestoreTaskId()
 */
class StartRestoreTaskRequest extends RpcAcsRequest
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
        parent::__construct('Dbs', '2019-03-06', 'StartRestoreTask', 'cbs');
    }

    /**
     * @param string $clientToken
     * @return $this
     */
    public function setClientToken($clientToken)
    {
        $this->requestParameters['ClientToken'] = $clientToken;
        $this->queryParameters['ClientToken'] = $clientToken;

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
     * @param string $restoreTaskId
     * @return $this
     */
    public function setRestoreTaskId($restoreTaskId)
    {
        $this->requestParameters['RestoreTaskId'] = $restoreTaskId;
        $this->queryParameters['RestoreTaskId'] = $restoreTaskId;

        return $this;
    }
}
