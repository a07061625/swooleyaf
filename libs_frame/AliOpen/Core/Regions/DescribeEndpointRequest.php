<?php
namespace AliOpen\Core\Regions;

use AliOpen\Core\RpcAcsRequest;

/**
 * Class DescribeEndpointRequest
 * @package AliOpen\Core\Regions
 */
class DescribeEndpointRequest extends RpcAcsRequest
{
    /**
     * DescribeEndpointRequest constructor.
     * @param $id
     * @param $serviceCode
     * @param $endPointType
     */
    public function __construct($id, $serviceCode, $endPointType)
    {
        parent::__construct(ALIOPEN_LOCATION_SERVICE_PRODUCT_NAME, ALIOPEN_LOCATION_SERVICE_VERSION, ALIOPEN_LOCATION_SERVICE_DESCRIBE_ENDPOINT_ACTION);

        $this->queryParameters['Id'] = $id;
        $this->queryParameters['ServiceCode'] = $serviceCode;
        $this->queryParameters['Type'] = $endPointType;
        $this->setRegionId(ALIOPEN_LOCATION_SERVICE_REGION);

        $this->setAcceptFormat('JSON');
    }
}
