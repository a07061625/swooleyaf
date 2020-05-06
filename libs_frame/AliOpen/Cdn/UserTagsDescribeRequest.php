<?php
namespace AliOpen\Cdn;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeUserTags
 * @method string getOwnerId()
 */
class UserTagsDescribeRequest extends RpcAcsRequest
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
        parent::__construct('Cdn', '2018-05-10', 'DescribeUserTags');
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
}
