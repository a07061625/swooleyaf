<?php

namespace AliOpen\Smartag;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of CreateCloudConnectNetwork
 *
 * @method string getResourceOwnerId()
 * @method string getResourceOwnerAccount()
 * @method string getOwnerAccount()
 * @method string getName()
 * @method string getCidrBlock()
 * @method string getDescription()
 * @method string getSnatCidrBlock()
 * @method string getIsDefault()
 * @method string getOwnerId()
 */
class CreateCloudConnectNetworkRequest extends RpcAcsRequest
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
        parent::__construct('Smartag', '2018-03-13', 'CreateCloudConnectNetwork', 'smartag');
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
     * @param string $cidrBlock
     *
     * @return $this
     */
    public function setCidrBlock($cidrBlock)
    {
        $this->requestParameters['CidrBlock'] = $cidrBlock;
        $this->queryParameters['CidrBlock'] = $cidrBlock;

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
     * @param string $snatCidrBlock
     *
     * @return $this
     */
    public function setSnatCidrBlock($snatCidrBlock)
    {
        $this->requestParameters['SnatCidrBlock'] = $snatCidrBlock;
        $this->queryParameters['SnatCidrBlock'] = $snatCidrBlock;

        return $this;
    }

    /**
     * @param string $isDefault
     *
     * @return $this
     */
    public function setIsDefault($isDefault)
    {
        $this->requestParameters['IsDefault'] = $isDefault;
        $this->queryParameters['IsDefault'] = $isDefault;

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
