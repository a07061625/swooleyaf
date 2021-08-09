<?php
namespace AliOpen\DmsEnterprise;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of RegisterUser
 * @method string getRoleNames()
 * @method string getUid()
 * @method string getUserNick()
 * @method string getMobile()
 * @method string getTid()
 */
class RegisterUserRequest extends RpcAcsRequest
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
        parent::__construct('dms-enterprise', '2018-11-01', 'RegisterUser');
    }

    /**
     * @param string $roleNames
     * @return $this
     */
    public function setRoleNames($roleNames)
    {
        $this->requestParameters['RoleNames'] = $roleNames;
        $this->queryParameters['RoleNames'] = $roleNames;

        return $this;
    }

    /**
     * @param string $uid
     * @return $this
     */
    public function setUid($uid)
    {
        $this->requestParameters['Uid'] = $uid;
        $this->queryParameters['Uid'] = $uid;

        return $this;
    }

    /**
     * @param string $userNick
     * @return $this
     */
    public function setUserNick($userNick)
    {
        $this->requestParameters['UserNick'] = $userNick;
        $this->queryParameters['UserNick'] = $userNick;

        return $this;
    }

    /**
     * @param string $mobile
     * @return $this
     */
    public function setMobile($mobile)
    {
        $this->requestParameters['Mobile'] = $mobile;
        $this->queryParameters['Mobile'] = $mobile;

        return $this;
    }

    /**
     * @param string $tid
     * @return $this
     */
    public function setTid($tid)
    {
        $this->requestParameters['Tid'] = $tid;
        $this->queryParameters['Tid'] = $tid;

        return $this;
    }
}
