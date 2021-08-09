<?php
namespace AliOpen\Cr;

use AliOpen\Core\RpcAcsRequest;

/**
 * 
 *
 * Request of GetAuthorizationToken
 *
 * @method string getInstanceId()
 */
class GetAuthorizationTokenRequest extends RpcAcsRequest
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
            'cr',
            '2018-12-01',
            'GetAuthorizationToken',
            'acr'
        );
    }

    /**
     * @param string $instanceId
     *
     * @return $this
     */
    public function setInstanceId($instanceId)
    {
        $this->requestParameters['InstanceId'] = $instanceId;
        $this->queryParameters['InstanceId'] = $instanceId;

        return $this;
    }
}
