<?php
namespace AliOpen\Ram;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of CreateAccessKey
 * @method string getUserName()
 */
class AccessKeyCreateRequest extends RpcAcsRequest
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
        parent::__construct('Ram', '2015-05-01', 'CreateAccessKey', 'ram');
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
