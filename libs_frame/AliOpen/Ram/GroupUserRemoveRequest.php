<?php
namespace AliOpen\Ram;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of RemoveUserFromGroup
 * @method string getGroupName()
 * @method string getUserName()
 */
class GroupUserRemoveRequest extends RpcAcsRequest
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
        parent::__construct('Ram', '2015-05-01', 'RemoveUserFromGroup', 'ram');
    }

    /**
     * @param string $groupName
     * @return $this
     */
    public function setGroupName($groupName)
    {
        $this->requestParameters['GroupName'] = $groupName;
        $this->queryParameters['GroupName'] = $groupName;

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
