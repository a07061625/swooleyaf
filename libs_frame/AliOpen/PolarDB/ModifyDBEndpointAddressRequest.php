<?php

namespace AliOpen\PolarDB;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ModifyDBEndpointAddress
 *
 * @method string getResourceOwnerId()
 * @method string getConnectionStringPrefix()
 * @method string getDBEndpointId()
 * @method string getResourceOwnerAccount()
 * @method string getDBClusterId()
 * @method string getOwnerAccount()
 * @method string getOwnerId()
 * @method string getNetType()
 */
class ModifyDBEndpointAddressRequest extends RpcAcsRequest
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
        parent::__construct('polardb', '2017-08-01', 'ModifyDBEndpointAddress', 'polardb');
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
     * @param string $connectionStringPrefix
     *
     * @return $this
     */
    public function setConnectionStringPrefix($connectionStringPrefix)
    {
        $this->requestParameters['ConnectionStringPrefix'] = $connectionStringPrefix;
        $this->queryParameters['ConnectionStringPrefix'] = $connectionStringPrefix;

        return $this;
    }

    /**
     * @param string $dBEndpointId
     *
     * @return $this
     */
    public function setDBEndpointId($dBEndpointId)
    {
        $this->requestParameters['DBEndpointId'] = $dBEndpointId;
        $this->queryParameters['DBEndpointId'] = $dBEndpointId;

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
     * @param string $dBClusterId
     *
     * @return $this
     */
    public function setDBClusterId($dBClusterId)
    {
        $this->requestParameters['DBClusterId'] = $dBClusterId;
        $this->queryParameters['DBClusterId'] = $dBClusterId;

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
     * @param string $netType
     *
     * @return $this
     */
    public function setNetType($netType)
    {
        $this->requestParameters['NetType'] = $netType;
        $this->queryParameters['NetType'] = $netType;

        return $this;
    }
}
