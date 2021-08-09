<?php

namespace AliOpen\Smartag;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DetachNetworkOptimizationSags
 *
 * @method string getResourceOwnerId()
 * @method string getResourceOwnerAccount()
 * @method string getNetworkOptId()
 * @method string getOwnerAccount()
 * @method array getSmartAGIdss()
 * @method string getOwnerId()
 */
class DetachNetworkOptimizationSagsRequest extends RpcAcsRequest
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
        parent::__construct('Smartag', '2018-03-13', 'DetachNetworkOptimizationSags', 'smartag');
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
     * @param string $networkOptId
     *
     * @return $this
     */
    public function setNetworkOptId($networkOptId)
    {
        $this->requestParameters['NetworkOptId'] = $networkOptId;
        $this->queryParameters['NetworkOptId'] = $networkOptId;

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
     * @return $this
     */
    public function setSmartAGIdss(array $smartAGIds)
    {
        $this->requestParameters['SmartAGIdss'] = $smartAGIds;
        foreach ($smartAGIds as $i => $iValue) {
            $this->queryParameters['SmartAGIds.' . ($i + 1)] = $iValue;
        }

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
