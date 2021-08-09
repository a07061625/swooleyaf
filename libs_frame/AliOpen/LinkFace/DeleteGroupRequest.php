<?php

namespace AliOpen\LinkFace;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DeleteGroup
 * @method string getGroupId()
 */
class DeleteGroupRequest extends RpcAcsRequest
{
    /**
     * @var string
     */
    protected $requestScheme = 'https';
    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('LinkFace', '2018-07-20', 'DeleteGroup');
    }

    /**
     * @param string $groupId
     * @return $this
     */
    public function setGroupId($groupId)
    {
        $this->requestParameters['GroupId'] = $groupId;
        $this->queryParameters['GroupId'] = $groupId;

        return $this;
    }
}
