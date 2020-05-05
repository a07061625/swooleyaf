<?php
namespace AliOpen\Green;

use AliOpen\Core\RoaAcsRequest;

/**
 * Request of AddGroups
 * @method string getClientInfo()
 */
class GroupsAddRequest extends RoaAcsRequest
{
    /**
     * @var string
     */
    protected $uriPattern = '/green/sface/person/groups/add';
    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('Green', '2018-05-09', 'AddGroups', 'green');
    }

    /**
     * @param string $clientInfo
     * @return $this
     */
    public function setClientInfo($clientInfo)
    {
        $this->requestParameters['ClientInfo'] = $clientInfo;
        $this->queryParameters['ClientInfo'] = $clientInfo;

        return $this;
    }
}
