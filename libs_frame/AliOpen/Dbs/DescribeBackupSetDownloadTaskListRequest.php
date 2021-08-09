<?php

namespace AliOpen\Dbs;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeBackupSetDownloadTaskList
 *
 * @method string getClientToken()
 * @method string getBackupSetDownloadTaskId()
 * @method string getBackupPlanId()
 * @method string getPageNum()
 * @method string getOwnerId()
 * @method string getPageSize()
 */
class DescribeBackupSetDownloadTaskListRequest extends RpcAcsRequest
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
        parent::__construct('Dbs', '2019-03-06', 'DescribeBackupSetDownloadTaskList', 'cbs');
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
     * @param string $backupSetDownloadTaskId
     *
     * @return $this
     */
    public function setBackupSetDownloadTaskId($backupSetDownloadTaskId)
    {
        $this->requestParameters['BackupSetDownloadTaskId'] = $backupSetDownloadTaskId;
        $this->queryParameters['BackupSetDownloadTaskId'] = $backupSetDownloadTaskId;

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
