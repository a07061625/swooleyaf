<?php
namespace AliOpen\Rds;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ResetAccountForPG
 * @method string getResourceOwnerId()
 * @method string getAccountName()
 * @method string getDBInstanceId()
 * @method string getResourceOwnerAccount()
 * @method string getOwnerAccount()
 * @method string getOwnerId()
 * @method string getAccountPassword()
 */
class PGAccountResetRequest extends RpcAcsRequest
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
        parent::__construct('Rds', '2014-08-15', 'ResetAccountForPG', 'rds');
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
     * @param string $accountName
     * @return $this
     */
    public function setAccountName($accountName)
    {
        $this->requestParameters['AccountName'] = $accountName;
        $this->queryParameters['AccountName'] = $accountName;

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
     * @param string $accountPassword
     * @return $this
     */
    public function setAccountPassword($accountPassword)
    {
        $this->requestParameters['AccountPassword'] = $accountPassword;
        $this->queryParameters['AccountPassword'] = $accountPassword;

        return $this;
    }
}
