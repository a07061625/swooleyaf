<?php

namespace AliOpen\Dbs;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeFullBackupList
 *
 * @method string getClientToken()
 * @method string getBackupPlanId()
 * @method string getBackupSetId()
 * @method string getPageNum()
 * @method string getOwnerId()
 * @method string getShowStorageType()
 * @method string getPageSize()
 */
class DescribeFullBackupListRequest extends RpcAcsRequest
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
        parent::__construct('Dbs', '2019-03-06', 'DescribeFullBackupList', 'cbs');
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
     * @param string $backupSetId
     *
     * @return $this
     */
    public function setBackupSetId($backupSetId)
    {
        $this->requestParameters['BackupSetId'] = $backupSetId;
        $this->queryParameters['BackupSetId'] = $backupSetId;

        return $this;
    }

    /**
     * @param string $pageNum
     *
     * @return $this
     */
    public function setPageNum($pageNum)
    {
        $this->requestParameters['PageNum'] = $pageNum;
        $this->queryParameters['PageNum'] = $pageNum;

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
     * @param string $showStorageType
     *
     * @return $this
     */
    public function setShowStorageType($showStorageType)
    {
        $this->requestParameters['ShowStorageType'] = $showStorageType;
        $this->queryParameters['ShowStorageType'] = $showStorageType;

        return $this;
    }

    /**
     * @param string $pageSize
     *
     * @return $this
     */
    public function setPageSize($pageSize)
    {
        $this->requestParameters['PageSize'] = $pageSize;
        $this->queryParameters['PageSize'] = $pageSize;

        return $this;
    }
}
