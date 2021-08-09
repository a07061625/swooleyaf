<?php

namespace AliOpen\IndustryBrain;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of GetAlgorithmList
 *
 * @method string getServiceId()
 */
class GetAlgorithmListRequest extends RpcAcsRequest
{
    /**
     * @var string
     */
    protected $requestScheme = 'https';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('industry-brain', '2018-07-12', 'GetAlgorithmList');
    }

    /**
     * @param string $serviceId
     *
     * @return $this
     */
    public function setServiceId($serviceId)
    {
        $this->requestParameters['ServiceId'] = $serviceId;
        $this->queryParameters['ServiceId'] = $serviceId;

        return $this;
    }
}
