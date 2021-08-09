<?php
namespace AliOpen\Ram;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of UpdateGroup
 * @method string getNewGroupName()
 * @method string getNewComments()
 * @method string getGroupName()
 */
class GroupUpdateRequest extends RpcAcsRequest
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
        parent::__construct('Ram', '2015-05-01', 'UpdateGroup', 'ram');
    }

    /**
     * @param string $newGroupName
     * @return $this
     */
    public function setNewGroupName($newGroupName)
    {
        $this->requestParameters['NewGroupName'] = $newGroupName;
        $this->queryParameters['NewGroupName'] = $newGroupName;

        return $this;
    }

    /**
     * @param string $newComments
     * @return $this
     */
    public function setNewComments($newComments)
    {
        $this->requestParameters['NewComments'] = $newComments;
        $this->queryParameters['NewComments'] = $newComments;

        return $this;
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
