<?php

namespace AliOpen\TeslaMaxCompute;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of QueryCustomerSaleInfo
 * @method string getRegionName()
 */
class QueryCustomerSaleInfoRequest extends RpcAcsRequest
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('TeslaMaxCompute', '2018-01-04', 'QueryCustomerSaleInfo', 'teslamaxcompute');
    }

    /**
     * @param string $regionName
     * @return $this
     */
    public function setRegionName($regionName)
    {
        $this->requestParameters['RegionName'] = $regionName;
        $this->queryParameters['RegionName'] = $regionName;

        return $this;
    }
}
