<?php

namespace AliOpen\Ecs;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of AllocateDedicatedHosts
 *
 * @method string getResourceOwnerId()
 * @method string getClientToken()
 * @method string getDescription()
 * @method string getResourceGroupId()
 * @method string getActionOnMaintenance()
 * @method array getTags()
 * @method string getDedicatedHostType()
 * @method string getAutoRenewPeriod()
 * @method string getPeriod()
 * @method string getQuantity()
 * @method string getDedicatedHostName()
 * @method string getResourceOwnerAccount()
 * @method string getOwnerAccount()
 * @method string getAutoReleaseTime()
 * @method string getOwnerId()
 * @method string getPeriodUnit()
 * @method string getAutoRenew()
 * @method string getNetworkAttributesSlbUdpTimeout()
 * @method string getZoneId()
 * @method string getAutoPlacement()
 * @method string getChargeType()
 * @method string getNetworkAttributesUdpTimeout()
 */
class DedicatedHostsAllocateRequest extends RpcAcsRequest
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
        parent::__construct('Ecs', '2014-05-26', 'AllocateDedicatedHosts', 'ecs');
    }

    /**
     * @param string $resourceOwnerId
     *
     * @return $this
     */
    public function setResourceOwnerId($resourceOwnerId)
    {
        $this->requestParameters['ResourceOwnerId'] = $resourceOwnerId;
        $this->queryParameters['ResourceOwnerId'] = $resourceOwnerId;

        return $this;
    }

    /**
     * @param string $clientToken
     *
     * @return $this
     */
    public function setClientToken($clientToken)
    {
        $this->requestParameters['ClientToken'] = $clientToken;
        $this->queryParameters['ClientToken'] = $clientToken;

        return $this;
    }

    /**
     * @param string $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->requestParameters['Description'] = $description;
        $this->queryParameters['Description'] = $description;

        return $this;
    }

    /**
     * @param string $resourceGroupId
     *
     * @return $this
     */
    public function setResourceGroupId($resourceGroupId)
    {
        $this->requestParameters['ResourceGroupId'] = $resourceGroupId;
        $this->queryParameters['ResourceGroupId'] = $resourceGroupId;

        return $this;
    }

    /**
     * @param string $actionOnMaintenance
     *
     * @return $this
     */
    public function setActionOnMaintenance($actionOnMaintenance)
    {
        $this->requestParameters['ActionOnMaintenance'] = $actionOnMaintenance;
        $this->queryParameters['ActionOnMaintenance'] = $actionOnMaintenance;

        return $this;
    }

    /**
     * @return $this
     */
    public function setTags(array $tag)
    {
        $this->requestParameters['Tags'] = $tag;
        foreach ($tag as $depth1 => $depth1Value) {
            $this->queryParameters['Tag.' . ($depth1 + 1) . '.Key'] = $depth1Value['Key'];
            $this->queryParameters['Tag.' . ($depth1 + 1) . '.Value'] = $depth1Value['Value'];
        }

        return $this;
    }

    /**
     * @param string $dedicatedHostType
     *
     * @return $this
     */
    public function setDedicatedHostType($dedicatedHostType)
    {
        $this->requestParameters['DedicatedHostType'] = $dedicatedHostType;
        $this->queryParameters['DedicatedHostType'] = $dedicatedHostType;

        return $this;
    }

    /**
     * @param string $autoRenewPeriod
     *
     * @return $this
     */
    public function setAutoRenewPeriod($autoRenewPeriod)
    {
        $this->requestParameters['AutoRenewPeriod'] = $autoRenewPeriod;
        $this->queryParameters['AutoRenewPeriod'] = $autoRenewPeriod;

        return $this;
    }

    /**
     * @param string $period
     *
     * @return $this
     */
    public function setPeriod($period)
    {
        $this->requestParameters['Period'] = $period;
        $this->queryParameters['Period'] = $period;

        return $this;
    }

    /**
     * @param string $quantity
     *
     * @return $this
     */
    public function setQuantity($quantity)
    {
        $this->requestParameters['Quantity'] = $quantity;
        $this->queryParameters['Quantity'] = $quantity;

        return $this;
    }

    /**
     * @param string $dedicatedHostName
     *
     * @return $this
     */
    public function setDedicatedHostName($dedicatedHostName)
    {
        $this->requestParameters['DedicatedHostName'] = $dedicatedHostName;
        $this->queryParameters['DedicatedHostName'] = $dedicatedHostName;

        return $this;
    }

    /**
     * @param string $resourceOwnerAccount
     *
     * @return $this
     */
    public function setResourceOwnerAccount($resourceOwnerAccount)
    {
        $this->requestParameters['ResourceOwnerAccount'] = $resourceOwnerAccount;
        $this->queryParameters['ResourceOwnerAccount'] = $resourceOwnerAccount;

        return $this;
    }

    /**
     * @param string $ownerAccount
     *
     * @return $this
     */
    public function setOwnerAccount($ownerAccount)
    {
        $this->requestParameters['OwnerAccount'] = $ownerAccount;
        $this->queryParameters['OwnerAccount'] = $ownerAccount;

        return $this;
    }

    /**
     * @param string $autoReleaseTime
     *
     * @return $this
     */
    public function setAutoReleaseTime($autoReleaseTime)
    {
        $this->requestParameters['AutoReleaseTime'] = $autoReleaseTime;
        $this->queryParameters['AutoReleaseTime'] = $autoReleaseTime;

        return $this;
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

    /**
     * @param string $periodUnit
     *
     * @return $this
     */
    public function setPeriodUnit($periodUnit)
    {
        $this->requestParameters['PeriodUnit'] = $periodUnit;
        $this->queryParameters['PeriodUnit'] = $periodUnit;

        return $this;
    }

    /**
     * @param string $autoRenew
     *
     * @return $this
     */
    public function setAutoRenew($autoRenew)
    {
        $this->requestParameters['AutoRenew'] = $autoRenew;
        $this->queryParameters['AutoRenew'] = $autoRenew;

        return $this;
    }

    /**
     * @param string $networkAttributesSlbUdpTimeout
     *
     * @return $this
     */
    public function setNetworkAttributesSlbUdpTimeout($networkAttributesSlbUdpTimeout)
    {
        $this->requestParameters['NetworkAttributesSlbUdpTimeout'] = $networkAttributesSlbUdpTimeout;
        $this->queryParameters['NetworkAttributes.SlbUdpTimeout'] = $networkAttributesSlbUdpTimeout;

        return $this;
    }

    /**
     * @param string $zoneId
     *
     * @return $this
     */
    public function setZoneId($zoneId)
    {
        $this->requestParameters['ZoneId'] = $zoneId;
        $this->queryParameters['ZoneId'] = $zoneId;

        return $this;
    }

    /**
     * @param string $autoPlacement
     *
     * @return $this
     */
    public function setAutoPlacement($autoPlacement)
    {
        $this->requestParameters['AutoPlacement'] = $autoPlacement;
        $this->queryParameters['AutoPlacement'] = $autoPlacement;

        return $this;
    }

    /**
     * @param string $chargeType
     *
     * @return $this
     */
    public function setChargeType($chargeType)
    {
        $this->requestParameters['ChargeType'] = $chargeType;
        $this->queryParameters['ChargeType'] = $chargeType;

        return $this;
    }

    /**
     * @param string $networkAttributesUdpTimeout
     *
     * @return $this
     */
    public function setNetworkAttributesUdpTimeout($networkAttributesUdpTimeout)
    {
        $this->requestParameters['NetworkAttributesUdpTimeout'] = $networkAttributesUdpTimeout;
        $this->queryParameters['NetworkAttributes.UdpTimeout'] = $networkAttributesUdpTimeout;

        return $this;
    }
}
