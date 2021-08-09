<?php

namespace AliOpen\CCC;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of GetRoutePoint
 *
 * @method string getContactFlowId()
 * @method string getInstanceId()
 */
class GetRoutePointRequest extends RpcAcsRequest
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
            'CCC',
            '2017-07-05',
            'GetRoutePoint',
            'CCC'
        );
    }

    /**
     * @param string $contactFlowId
     *
     * @return $this
     */
    public function setContactFlowId($contactFlowId)
    {
        $this->requestParameters['ContactFlowId'] = $contactFlowId;
        $this->queryParameters['ContactFlowId'] = $contactFlowId;

        return $this;
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
