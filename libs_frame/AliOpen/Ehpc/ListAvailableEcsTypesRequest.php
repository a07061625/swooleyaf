<?php
namespace AliOpen\Ehpc;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ListAvailableEcsTypes
 * @method string getSpotStrategy()
 * @method string getZoneId()
 * @method string getInstanceChargeType()
 */
class ListAvailableEcsTypesRequest extends RpcAcsRequest
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('EHPC', '2018-04-12', 'ListAvailableEcsTypes', 'ehs');
    }

    /**
     * @param string $spotStrategy
     * @return $this
     */
    public function setSpotStrategy($spotStrategy)
    {
        $this->requestParameters['SpotStrategy'] = $spotStrategy;
        $this->queryParameters['SpotStrategy'] = $spotStrategy;

        return $this;
    }

    /**
     * @param string $zoneId
     * @return $this
     */
    public function setZoneId($zoneId)
    {
        $this->requestParameters['ZoneId'] = $zoneId;
        $this->queryParameters['ZoneId'] = $zoneId;

        return $this;
    }

    /**
     * @param string $instanceChargeType
     * @return $this
     */
    public function setInstanceChargeType($instanceChargeType)
    {
        $this->requestParameters['InstanceChargeType'] = $instanceChargeType;
        $this->queryParameters['InstanceChargeType'] = $instanceChargeType;

        return $this;
    }
}
