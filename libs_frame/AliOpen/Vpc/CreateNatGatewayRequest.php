<?php

namespace AliOpen\Vpc;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of CreateNatGateway
 *
 * @method string getResourceOwnerId()
 * @method string getAutoPay()
 * @method string getResourceOwnerAccount()
 * @method string getClientToken()
 * @method string getOwnerAccount()
 * @method string getDescription()
 * @method string getOwnerId()
 * @method string getSpec()
 * @method string getDuration()
 * @method string getVpcId()
 * @method string getName()
 * @method array getBandwidthPackages()
 * @method string getInstanceChargeType()
 * @method string getPricingCycle()
 */
class CreateNatGatewayRequest extends RpcAcsRequest
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
        parent::__construct('Vpc', '2016-04-28', 'CreateNatGateway', 'vpc');
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
     * @param string $autoPay
     *
     * @return $this
     */
    public function setAutoPay($autoPay)
    {
        $this->requestParameters['AutoPay'] = $autoPay;
        $this->queryParameters['AutoPay'] = $autoPay;

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
     * @param string $spec
     *
     * @return $this
     */
    public function setSpec($spec)
    {
        $this->requestParameters['Spec'] = $spec;
        $this->queryParameters['Spec'] = $spec;

        return $this;
    }

    /**
     * @param string $duration
     *
     * @return $this
     */
    public function setDuration($duration)
    {
        $this->requestParameters['Duration'] = $duration;
        $this->queryParameters['Duration'] = $duration;

        return $this;
    }

    /**
     * @param string $vpcId
     *
     * @return $this
     */
    public function setVpcId($vpcId)
    {
        $this->requestParameters['VpcId'] = $vpcId;
        $this->queryParameters['VpcId'] = $vpcId;

        return $this;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->requestParameters['Name'] = $name;
        $this->queryParameters['Name'] = $name;

        return $this;
    }

    /**
     * @return $this
     */
    public function setBandwidthPackages(array $bandwidthPackages)
    {
        $this->requestParameters['BandwidthPackages'] = $bandwidthPackages;
        foreach ($bandwidthPackages as $i => $iValue) {
            $this->queryParameters['BandwidthPackage.' . ($i + 1) . '.Bandwidth'] = $bandwidthPackages[$i]['Bandwidth'];
            $this->queryParameters['BandwidthPackage.' . ($i + 1) . '.Zone'] = $bandwidthPackages[$i]['Zone'];
            $this->queryParameters['BandwidthPackage.' . ($i + 1) . '.InternetChargeType'] = $bandwidthPackages[$i]['InternetChargeType'];
            $this->queryParameters['BandwidthPackage.' . ($i + 1) . '.ISP'] = $bandwidthPackages[$i]['ISP'];
            $this->queryParameters['BandwidthPackage.' . ($i + 1) . '.IpCount'] = $bandwidthPackages[$i]['IpCount'];
        }

        return $this;
    }

    /**
     * @param string $instanceChargeType
     *
     * @return $this
     */
    public function setInstanceChargeType($instanceChargeType)
    {
        $this->requestParameters['InstanceChargeType'] = $instanceChargeType;
        $this->queryParameters['InstanceChargeType'] = $instanceChargeType;

        return $this;
    }

    /**
     * @param string $pricingCycle
     *
     * @return $this
     */
    public function setPricingCycle($pricingCycle)
    {
        $this->requestParameters['PricingCycle'] = $pricingCycle;
        $this->queryParameters['PricingCycle'] = $pricingCycle;

        return $this;
    }
}
