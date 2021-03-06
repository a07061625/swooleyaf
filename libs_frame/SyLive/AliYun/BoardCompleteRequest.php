<?php
namespace SyLive\AliYun;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of CompleteBoard
 * @method string getOwnerId()
 * @method string getAppId()
 * @method string getBoardId()
 */
class BoardCompleteRequest extends RpcAcsRequest
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
        parent::__construct('live', '2016-11-01', 'CompleteBoard', 'live');
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

    /**
     * @param string $boardId
     * @return $this
     */
    public function setBoardId($boardId)
    {
        $this->requestParameters['BoardId'] = $boardId;
        $this->queryParameters['BoardId'] = $boardId;

        return $this;
    }
}
