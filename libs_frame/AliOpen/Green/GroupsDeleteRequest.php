<?php

namespace AliOpen\Green;

use AliOpen\Core\RoaAcsRequest;

/**
 * Request of DeleteGroups
 *
 * @method string getClientInfo()
 */
class GroupsDeleteRequest extends RoaAcsRequest
{
    /**
     * @var string
     */
    protected $uriPattern = '/green/sface/person/groups/delete';
    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('Green', '2018-05-09', 'DeleteGroups', 'green');
    }

    /**
     * @param string $clientInfo
     *
     * @return $this
     */
    public function setClientInfo($clientInfo)
    {
        $this->requestParameters['ClientInfo'] = $clientInfo;
        $this->queryParameters['ClientInfo'] = $clientInfo;

        return $this;
    }
}
