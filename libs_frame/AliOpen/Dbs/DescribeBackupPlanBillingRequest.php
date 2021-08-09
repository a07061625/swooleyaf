<?php
namespace AliOpen\Dbs;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeBackupPlanBilling
 * @method string getClientToken()
 * @method string getBackupPlanId()
 * @method string getOwnerId()
 * @method string getShowStorageType()
 */
class DescribeBackupPlanBillingRequest extends RpcAcsRequest
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
        parent::__construct('Dbs', '2019-03-06', 'DescribeBackupPlanBilling', 'cbs');
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
     * @param string $showStorageType
     * @return $this
     */
    public function setShowStorageType($showStorageType)
    {
        $this->requestParameters['ShowStorageType'] = $showStorageType;
        $this->queryParameters['ShowStorageType'] = $showStorageType;

        return $this;
    }
}