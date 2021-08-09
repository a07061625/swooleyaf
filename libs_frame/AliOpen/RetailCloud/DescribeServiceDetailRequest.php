<?php

namespace AliOpen\RetailCloud;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeServiceDetail
 *
 * @method string getServiceId()
 */
class DescribeServiceDetailRequest extends RpcAcsRequest
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
        parent::__construct('retailcloud', '2018-03-13', 'DescribeServiceDetail', 'retailcloud');
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
