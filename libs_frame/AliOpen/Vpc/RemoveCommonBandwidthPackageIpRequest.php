<?php

namespace AliOpen\Vpc;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of RemoveCommonBandwidthPackageIp
 *
 * @method string getResourceOwnerId()
 * @method string getBandwidthPackageId()
 * @method string getResourceOwnerAccount()
 * @method string getOwnerAccount()
 * @method string getIpInstanceId()
 * @method string getOwnerId()
 */
class RemoveCommonBandwidthPackageIpRequest extends RpcAcsRequest
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
        parent::__construct('Vpc', '2016-04-28', 'RemoveCommonBandwidthPackageIp', 'vpc');
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
     * @param string $bandwidthPackageId
     *
     * @return $this
     */
    public function setBandwidthPackageId($bandwidthPackageId)
    {
        $this->requestParameters['BandwidthPackageId'] = $bandwidthPackageId;
        $this->queryParameters['BandwidthPackageId'] = $bandwidthPackageId;

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
     * @param string $ipInstanceId
     *
     * @return $this
     */
    public function setIpInstanceId($ipInstanceId)
    {
        $this->requestParameters['IpInstanceId'] = $ipInstanceId;
        $this->queryParameters['IpInstanceId'] = $ipInstanceId;

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
}
