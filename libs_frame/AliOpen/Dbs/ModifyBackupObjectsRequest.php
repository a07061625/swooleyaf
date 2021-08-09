<?php

namespace AliOpen\Dbs;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ModifyBackupObjects
 *
 * @method string getClientToken()
 * @method string getBackupPlanId()
 * @method string getBackupObjects()
 * @method string getOwnerId()
 */
class ModifyBackupObjectsRequest extends RpcAcsRequest
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
        parent::__construct('Dbs', '2019-03-06', 'ModifyBackupObjects', 'cbs');
    }

    /**
     * @param string $clientToken
     *
     * @return $this
     */
    public function setClientToken($clientToken)
    {
        $this->requestParameters['ClientToken'] = $clientToken;
        $this->queryParameters['ClientToken'] = $clientToken;

        return $this;
    }

    /**
     * @param string $backupPlanId
     *
     * @return $this
     */
    public function setBackupPlanId($backupPlanId)
    {
        $this->requestParameters['BackupPlanId'] = $backupPlanId;
        $this->queryParameters['BackupPlanId'] = $backupPlanId;

        return $this;
    }

    /**
     * @param string $backupObjects
     *
     * @return $this
     */
    public function setBackupObjects($backupObjects)
    {
        $this->requestParameters['BackupObjects'] = $backupObjects;
        $this->queryParameters['BackupObjects'] = $backupObjects;

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
