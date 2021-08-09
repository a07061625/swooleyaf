<?php

namespace AliOpen\Rds;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ModifyHASwitchConfig
 *
 * @method string getResourceOwnerId()
 * @method string getHAConfig()
 * @method string getManualHATime()
 * @method string getDBInstanceId()
 * @method string getResourceOwnerAccount()
 * @method string getOwnerId()
 */
class HASwitchConfigModifyRequest extends RpcAcsRequest
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
        parent::__construct('Rds', '2014-08-15', 'ModifyHASwitchConfig', 'rds');
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
     * @param string $hAConfig
     *
     * @return $this
     */
    public function setHAConfig($hAConfig)
    {
        $this->requestParameters['HAConfig'] = $hAConfig;
        $this->queryParameters['HAConfig'] = $hAConfig;

        return $this;
    }

    /**
     * @param string $manualHATime
     *
     * @return $this
     */
    public function setManualHATime($manualHATime)
    {
        $this->requestParameters['ManualHATime'] = $manualHATime;
        $this->queryParameters['ManualHATime'] = $manualHATime;

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
