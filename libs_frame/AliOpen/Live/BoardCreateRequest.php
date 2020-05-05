<?php
namespace AliOpen\Live;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of CreateBoard
 * @method string getAppUid()
 * @method string getOwnerId()
 * @method string getAppId()
 */
class BoardCreateRequest extends RpcAcsRequest
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
        parent::__construct('live', '2016-11-01', 'CreateBoard', 'live');
    }

    /**
     * @param string $appUid
     * @return $this
     */
    public function setAppUid($appUid)
    {
        $this->requestParameters['AppUid'] = $appUid;
        $this->queryParameters['AppUid'] = $appUid;

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
