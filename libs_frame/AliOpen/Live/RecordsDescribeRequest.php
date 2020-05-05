<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeRecords
 * @method string getRecordState()
 * @method string getPageNum()
 * @method string getPageSize()
 * @method string getOwnerId()
 * @method string getAppId()
 */
class RecordsDescribeRequest extends RpcAcsRequest
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
        parent::__construct('live', '2016-11-01', 'DescribeRecords', 'live');
    }

    /**
     * @param string $recordState
     * @return $this
     */
    public function setRecordState($recordState)
    {
        $this->requestParameters['RecordState'] = $recordState;
        $this->queryParameters['RecordState'] = $recordState;

        return $this;
    }

    /**
     * @param string $pageNum
     * @return $this
     */
    public function setPageNum($pageNum)
    {
        $this->requestParameters['PageNum'] = $pageNum;
        $this->queryParameters['PageNum'] = $pageNum;

        return $this;
    }

    /**
     * @param string $pageSize
     * @return $this
     */
    public function setPageSize($pageSize)
    {
        $this->requestParameters['PageSize'] = $pageSize;
        $this->queryParameters['PageSize'] = $pageSize;

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
     * @param string $appId
     * @return $this
     */
    public function setAppId($appId)
    {
        $this->requestParameters['AppId'] = $appId;
        $this->queryParameters['AppId'] = $appId;

        return $this;
    }
}
