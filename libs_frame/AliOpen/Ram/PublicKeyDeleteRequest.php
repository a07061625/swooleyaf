<?php
namespace AliOpen\Ram;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DeletePublicKey
 * @method string getUserPublicKeyId()
 * @method string getUserName()
 */
class PublicKeyDeleteRequest extends RpcAcsRequest
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
        parent::__construct('Ram', '2015-05-01', 'DeletePublicKey', 'ram');
    }

    /**
     * @param string $userPublicKeyId
     * @return $this
     */
    public function setUserPublicKeyId($userPublicKeyId)
    {
        $this->requestParameters['UserPublicKeyId'] = $userPublicKeyId;
        $this->queryParameters['UserPublicKeyId'] = $userPublicKeyId;

        return $this;
    }

    /**
     * @param string $userName
     * @return $this
     */
    public function setUserName($userName)
    {
        $this->requestParameters['UserName'] = $userName;
        $this->queryParameters['UserName'] = $userName;

        return $this;
    }
}
