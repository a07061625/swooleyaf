<?php
namespace AliOpen\Cdn;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ListUserCustomLogConfig
 * @method string getOwnerId()
 */
class UserCustomLogConfigListRequest extends RpcAcsRequest
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('Cdn', '2018-05-10', 'ListUserCustomLogConfig');
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
