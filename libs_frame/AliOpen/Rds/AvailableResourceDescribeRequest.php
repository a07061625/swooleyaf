<?php
namespace AliOpen\Rds;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeAvailableResource
 * @method string getDBInstanceName()
 * @method string getResourceOwnerId()
 * @method string getEngineVersion()
 * @method string getEngine()
 * @method string getDBInstanceId()
 * @method string getDBInstanceStorageType()
 * @method string getInstanceChargeType()
 * @method string getResourceOwnerAccount()
 * @method string getOwnerAccount()
 * @method string getCommodityCode()
 * @method string getOwnerId()
 * @method string getDBInstanceClass()
 * @method string getZoneId()
 * @method string getOrderType()
 */
class AvailableResourceDescribeRequest extends RpcAcsRequest
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
        parent::__construct('Rds', '2014-08-15', 'DescribeAvailableResource', 'rds');
    }

    /**
     * @param string $dBInstanceName
     * @return $this
     */
    public function setDBInstanceName($dBInstanceName)
    {
        $this->requestParameters['DBInstanceName'] = $dBInstanceName;
        $this->queryParameters['DBInstanceName'] = $dBInstanceName;

        return $this;
    }

    /**
     * @param string $resourceOwnerId
     * @return $this
     */
    public function setResourceOwnerId($resourceOwnerId)
    {
        $this->requestParameters['ResourceOwnerId'] = $resourceOwnerId;
        $this->queryParameters['ResourceOwnerId'] = $resourceOwnerId;

        return $this;
    }

    /**
     * @param string $engineVersion
     * @return $this
     */
    public function setEngineVersion($engineVersion)
    {
        $this->requestParameters['EngineVersion'] = $engineVersion;
        $this->queryParameters['EngineVersion'] = $engineVersion;

        return $this;
    }

    /**
     * @param string $engine
     * @return $this
     */
    public function setEngine($engine)
    {
        $this->requestParameters['Engine'] = $engine;
        $this->queryParameters['Engine'] = $engine;

        return $this;
    }

    /**
     * @param string $dBInstanceId
     * @return $this
     */
    public function setDBInstanceId($dBInstanceId)
    {
        $this->requestParameters['DBInstanceId'] = $dBInstanceId;
        $this->queryParameters['DBInstanceId'] = $dBInstanceId;

        return $this;
    }

    /**
     * @param string $dBInstanceStorageType
     * @return $this
     */
    public function setDBInstanceStorageType($dBInstanceStorageType)
    {
        $this->requestParameters['DBInstanceStorageType'] = $dBInstanceStorageType;
        $this->queryParameters['DBInstanceStorageType'] = $dBInstanceStorageType;

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

    /**
     * @param string $resourceOwnerAccount
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
     * @return $this
     */
    public function setOwnerAccount($ownerAccount)
    {
        $this->requestParameters['OwnerAccount'] = $ownerAccount;
        $this->queryParameters['OwnerAccount'] = $ownerAccount;

        return $this;
    }

    /**
     * @param string $commodityCode
     * @return $this
     */
    public function setCommodityCode($commodityCode)
    {
        $this->requestParameters['CommodityCode'] = $commodityCode;
        $this->queryParameters['CommodityCode'] = $commodityCode;

        return $this;
    }

    /**
     * @param string $ownerId
     * @return $this
     */
    public function setOwnerId($ownerId)
    {
        $this->requestParameters['OwnerId'] = $ownerId;
        $this->queryParameters['OwnerId'] = $ownerId;

        return $this;
    }

    /**
     * @param string $dBInstanceClass
     * @return $this
     */
    public function setDBInstanceClass($dBInstanceClass)
    {
        $this->requestParameters['DBInstanceClass'] = $dBInstanceClass;
        $this->queryParameters['DBInstanceClass'] = $dBInstanceClass;

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
     * @param string $orderType
     * @return $this
     */
    public function setOrderType($orderType)
    {
        $this->requestParameters['OrderType'] = $orderType;
        $this->queryParameters['OrderType'] = $orderType;

        return $this;
    }
}
