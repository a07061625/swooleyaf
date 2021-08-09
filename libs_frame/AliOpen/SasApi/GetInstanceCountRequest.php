<?php

namespace AliOpen\SasApi;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of GetInstanceCount
 *
 * @method string getOwnerId()
 */
class GetInstanceCountRequest extends RpcAcsRequest
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
        parent::__construct('Sas-api', '2017-07-05', 'GetInstanceCount', 'sas-api');
    }

    /**
     * @param string $ownerId
     *
     * @return $this
     */
    public function setOwnerId($ownerId)
    {
        $this->requestParameters['OwnerId'] = $ownerId;
        $this->queryParameters['OwnerId'] = $ownerId;

        return $this;
    }
}
