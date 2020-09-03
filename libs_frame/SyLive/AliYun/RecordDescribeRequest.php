<?php
namespace SyLive\AliYun;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeRecord
 * @method string getOwnerId()
 * @method string getRecordId()
 * @method string getAppId()
 */
class RecordDescribeRequest extends RpcAcsRequest
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
        parent::__construct('live', '2016-11-01', 'DescribeRecord', 'live');
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
     * @param string $recordId
     * @return $this
     */
    public function setRecordId($recordId)
    {
        $this->requestParameters['RecordId'] = $recordId;
        $this->queryParameters['RecordId'] = $recordId;

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
