<?php
namespace AliOpen\Dbs;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ModifyBackupPlanName
 * @method string getClientToken()
 * @method string getBackupPlanId()
 * @method string getOwnerId()
 * @method string getBackupPlanName()
 */
class ModifyBackupPlanNameRequest extends RpcAcsRequest
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
        parent::__construct('Dbs', '2019-03-06', 'ModifyBackupPlanName', 'cbs');
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
     * @param string $backupPlanId
     * @return $this
     */
    public function setBackupPlanId($backupPlanId)
    {
        $this->requestParameters['BackupPlanId'] = $backupPlanId;
        $this->queryParameters['BackupPlanId'] = $backupPlanId;

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
     * @param string $backupPlanName
     * @return $this
     */
    public function setBackupPlanName($backupPlanName)
    {
        $this->requestParameters['BackupPlanName'] = $backupPlanName;
        $this->queryParameters['BackupPlanName'] = $backupPlanName;

        return $this;
    }
}