<?php

namespace AliOpen\Rds;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ModifyDBInstanceSpec
 *
 * @method string getResourceOwnerId()
 * @method string getDBInstanceStorage()
 * @method string getClientToken()
 * @method string getEngineVersion()
 * @method string getEffectiveTime()
 * @method string getDBInstanceId()
 * @method string getDBInstanceStorageType()
 * @method string getDirection()
 * @method string getResourceOwnerAccount()
 * @method string getOwnerAccount()
 * @method string getOwnerId()
 * @method string getDBInstanceClass()
 * @method string getPayType()
 */
class DBInstanceSpecModifyRequest extends RpcAcsRequest
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
        parent::__construct('Rds', '2014-08-15', 'ModifyDBInstanceSpec', 'rds');
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
     * @param string $dBInstanceStorage
     *
     * @return $this
     */
    public function setDBInstanceStorage($dBInstanceStorage)
    {
        $this->requestParameters['DBInstanceStorage'] = $dBInstanceStorage;
        $this->queryParameters['DBInstanceStorage'] = $dBInstanceStorage;

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
     * @param string $engineVersion
     *
     * @return $this
     */
    public function setEngineVersion($engineVersion)
    {
        $this->requestParameters['EngineVersion'] = $engineVersion;
        $this->queryParameters['EngineVersion'] = $engineVersion;

        return $this;
    }

    /**
     * @param string $effectiveTime
     *
     * @return $this
     */
    public function setEffectiveTime($effectiveTime)
    {
        $this->requestParameters['EffectiveTime'] = $effectiveTime;
        $this->queryParameters['EffectiveTime'] = $effectiveTime;

        return $this;
    }

    /**
     * @param string $dBInstanceId
     *
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
     *
     * @return $this
     */
    public function setDBInstanceStorageType($dBInstanceStorageType)
    {
        $this->requestParameters['DBInstanceStorageType'] = $dBInstanceStorageType;
        $this->queryParameters['DBInstanceStorageType'] = $dBInstanceStorageType;

        return $this;
    }

    /**
     * @param string $direction
     *
     * @return $this
     */
    public function setDirection($direction)
    {
        $this->requestParameters['Direction'] = $direction;
        $this->queryParameters['Direction'] = $direction;

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
     * @param string $dBInstanceClass
     *
     * @return $this
     */
    public function setDBInstanceClass($dBInstanceClass)
    {
        $this->requestParameters['DBInstanceClass'] = $dBInstanceClass;
        $this->queryParameters['DBInstanceClass'] = $dBInstanceClass;

        return $this;
    }

    /**
     * @param string $payType
     *
     * @return $this
     */
    public function setPayType($payType)
    {
        $this->requestParameters['PayType'] = $payType;
        $this->queryParameters['PayType'] = $payType;

        return $this;
    }
}
