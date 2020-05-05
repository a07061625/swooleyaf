<?php
namespace AliOpen\Ram;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ListPoliciesForGroup
 * @method string getGroupName()
 */
class GroupPoliciesListRequest extends RpcAcsRequest
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
        parent::__construct('Ram', '2015-05-01', 'ListPoliciesForGroup', 'ram');
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
}
