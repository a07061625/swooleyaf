<?php
namespace AliOpen\Cvc;

use AliOpen\Core\RpcAcsRequest;

/**
 * 
 *
 * Request of CreateUser
 *
 * @method string getCount()
 * @method string getUserInfo()
 */
class CreateUserRequest extends RpcAcsRequest
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
        parent::__construct(
            'aliyuncvc',
            '2019-10-30',
            'CreateUser',
            'aliyuncvc'
        );
    }

    /**
     * @param string $count
     *
     * @return $this
     */
    public function setCount($count)
    {
        $this->requestParameters['Count'] = $count;
        $this->queryParameters['Count'] = $count;

        return $this;
    }

    /**
     * @param string $userInfo
     *
     * @return $this
     */
    public function setUserInfo($userInfo)
    {
        $this->requestParameters['UserInfo'] = $userInfo;
        $this->queryParameters['UserInfo'] = $userInfo;

        return $this;
    }
}