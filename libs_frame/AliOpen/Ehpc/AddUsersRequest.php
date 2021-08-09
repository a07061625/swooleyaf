<?php

namespace AliOpen\Ehpc;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of AddUsers
 *
 * @method string getClusterId()
 * @method array getUsers()
 */
class AddUsersRequest extends RpcAcsRequest
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('EHPC', '2018-04-12', 'AddUsers', 'ehs');
    }

    /**
     * @param string $clusterId
     *
     * @return $this
     */
    public function setClusterId($clusterId)
    {
        $this->requestParameters['ClusterId'] = $clusterId;
        $this->queryParameters['ClusterId'] = $clusterId;

        return $this;
    }

    /**
     * @return $this
     */
    public function setUsers(array $user)
    {
        $this->requestParameters['Users'] = $user;
        foreach ($user as $depth1 => $depth1Value) {
            $this->queryParameters['User.' . ($depth1 + 1) . '.Password'] = $depth1Value['Password'];
            $this->queryParameters['User.' . ($depth1 + 1) . '.Name'] = $depth1Value['Name'];
            $this->queryParameters['User.' . ($depth1 + 1) . '.Group'] = $depth1Value['Group'];
        }

        return $this;
    }
}
