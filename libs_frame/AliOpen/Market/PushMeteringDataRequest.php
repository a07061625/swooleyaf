<?php

namespace AliOpen\Market;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of PushMeteringData
 * @method string getMetering()
 */
class PushMeteringDataRequest extends RpcAcsRequest
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
        parent::__construct('Market', '2015-11-01', 'PushMeteringData', 'yunmarket');
    }

    /**
     * @param string $metering
     * @return $this
     */
    public function setMetering($metering)
    {
        $this->requestParameters['Metering'] = $metering;
        $this->queryParameters['Metering'] = $metering;

        return $this;
    }
}
