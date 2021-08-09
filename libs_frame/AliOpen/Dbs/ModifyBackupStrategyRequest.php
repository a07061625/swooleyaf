<?php
namespace AliOpen\Dbs;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ModifyBackupStrategy
 * @method string getBackupLogIntervalSeconds()
 * @method string getClientToken()
 * @method string getBackupPlanId()
 * @method string getOwnerId()
 * @method string getBackupPeriod()
 * @method string getBackupStartTime()
 * @method string getBackupStrategyType()
 */
class ModifyBackupStrategyRequest extends RpcAcsRequest
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
        parent::__construct('Dbs', '2019-03-06', 'ModifyBackupStrategy', 'cbs');
    }

    /**
     * @param string $backupLogIntervalSeconds
     * @return $this
     */
    public function setBackupLogIntervalSeconds($backupLogIntervalSeconds)
    {
        $this->requestParameters['BackupLogIntervalSeconds'] = $backupLogIntervalSeconds;
        $this->queryParameters['BackupLogIntervalSeconds'] = $backupLogIntervalSeconds;

        return $this;
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
     * @param string $backupPeriod
     * @return $this
     */
    public function setBackupPeriod($backupPeriod)
    {
        $this->requestParameters['BackupPeriod'] = $backupPeriod;
        $this->queryParameters['BackupPeriod'] = $backupPeriod;

        return $this;
    }

    /**
     * @param string $backupStartTime
     * @return $this
     */
    public function setBackupStartTime($backupStartTime)
    {
        $this->requestParameters['BackupStartTime'] = $backupStartTime;
        $this->queryParameters['BackupStartTime'] = $backupStartTime;

        return $this;
    }

    /**
     * @param string $backupStrategyType
     * @return $this
     */
    public function setBackupStrategyType($backupStrategyType)
    {
        $this->requestParameters['BackupStrategyType'] = $backupStrategyType;
        $this->queryParameters['BackupStrategyType'] = $backupStrategyType;

        return $this;
    }
}
