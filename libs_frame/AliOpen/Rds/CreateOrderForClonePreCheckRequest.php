<?php
namespace AliOpen\Rds;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of PreCheckCreateOrderForClone
 * @method string getResourceOwnerId()
 * @method string getDBInstanceStorage()
 * @method string getCountryCode()
 * @method string getCurrencyCode()
 * @method string getResourceGroupId()
 * @method string getDBInstanceDescription()
 * @method string getBusinessInfo()
 * @method string getAgentId()
 * @method string getResource()
 * @method string getBackupId()
 * @method string getCommodityCode()
 * @method string getOwnerId()
 * @method string getDBInstanceClass()
 * @method string getVSwitchId()
 * @method string getPrivateIpAddress()
 * @method string getAutoRenew()
 * @method string getPromotionCode()
 * @method string getZoneId()
 * @method string getTimeType()
 * @method string getInstanceNetworkType()
 * @method string getNodeType()
 * @method string getClientToken()
 * @method string getTableMeta()
 * @method string getDBInstanceId()
 * @method string getDBInstanceStorageType()
 * @method string getRestoreTime()
 * @method string getQuantity()
 * @method string getAutoPay()
 * @method string getResourceOwnerAccount()
 * @method string getOwnerAccount()
 * @method string getRestoreTable()
 * @method string getUsedTime()
 * @method string getDBNames()
 * @method string getInstanceUsedType()
 * @method string getVPCId()
 * @method string getCloneInstanceDefaultValue()
 * @method string getPayType()
 */
class CreateOrderForClonePreCheckRequest extends RpcAcsRequest
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
        parent::__construct('Rds', '2014-08-15', 'PreCheckCreateOrderForClone', 'rds');
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
     * @param string $dBInstanceStorage
     * @return $this
     */
    public function setDBInstanceStorage($dBInstanceStorage)
    {
        $this->requestParameters['DBInstanceStorage'] = $dBInstanceStorage;
        $this->queryParameters['DBInstanceStorage'] = $dBInstanceStorage;

        return $this;
    }

    /**
     * @param string $countryCode
     * @return $this
     */
    public function setCountryCode($countryCode)
    {
        $this->requestParameters['CountryCode'] = $countryCode;
        $this->queryParameters['CountryCode'] = $countryCode;

        return $this;
    }

    /**
     * @param string $currencyCode
     * @return $this
     */
    public function setCurrencyCode($currencyCode)
    {
        $this->requestParameters['CurrencyCode'] = $currencyCode;
        $this->queryParameters['CurrencyCode'] = $currencyCode;

        return $this;
    }

    /**
     * @param string $resourceGroupId
     * @return $this
     */
    public function setResourceGroupId($resourceGroupId)
    {
        $this->requestParameters['ResourceGroupId'] = $resourceGroupId;
        $this->queryParameters['ResourceGroupId'] = $resourceGroupId;

        return $this;
    }

    /**
     * @param string $dBInstanceDescription
     * @return $this
     */
    public function setDBInstanceDescription($dBInstanceDescription)
    {
        $this->requestParameters['DBInstanceDescription'] = $dBInstanceDescription;
        $this->queryParameters['DBInstanceDescription'] = $dBInstanceDescription;

        return $this;
    }

    /**
     * @param string $businessInfo
     * @return $this
     */
    public function setBusinessInfo($businessInfo)
    {
        $this->requestParameters['BusinessInfo'] = $businessInfo;
        $this->queryParameters['BusinessInfo'] = $businessInfo;

        return $this;
    }

    /**
     * @param string $agentId
     * @return $this
     */
    public function setAgentId($agentId)
    {
        $this->requestParameters['AgentId'] = $agentId;
        $this->queryParameters['AgentId'] = $agentId;

        return $this;
    }

    /**
     * @param string $resource
     * @return $this
     */
    public function setResource($resource)
    {
        $this->requestParameters['Resource'] = $resource;
        $this->queryParameters['Resource'] = $resource;

        return $this;
    }

    /**
     * @param string $backupId
     * @return $this
     */
    public function setBackupId($backupId)
    {
        $this->requestParameters['BackupId'] = $backupId;
        $this->queryParameters['BackupId'] = $backupId;

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
     * @param string $vSwitchId
     * @return $this
     */
    public function setVSwitchId($vSwitchId)
    {
        $this->requestParameters['VSwitchId'] = $vSwitchId;
        $this->queryParameters['VSwitchId'] = $vSwitchId;

        return $this;
    }

    /**
     * @param string $privateIpAddress
     * @return $this
     */
    public function setPrivateIpAddress($privateIpAddress)
    {
        $this->requestParameters['PrivateIpAddress'] = $privateIpAddress;
        $this->queryParameters['PrivateIpAddress'] = $privateIpAddress;

        return $this;
    }

    /**
     * @param string $autoRenew
     * @return $this
     */
    public function setAutoRenew($autoRenew)
    {
        $this->requestParameters['AutoRenew'] = $autoRenew;
        $this->queryParameters['AutoRenew'] = $autoRenew;

        return $this;
    }

    /**
     * @param string $promotionCode
     * @return $this
     */
    public function setPromotionCode($promotionCode)
    {
        $this->requestParameters['PromotionCode'] = $promotionCode;
        $this->queryParameters['PromotionCode'] = $promotionCode;

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
     * @param string $timeType
     * @return $this
     */
    public function setTimeType($timeType)
    {
        $this->requestParameters['TimeType'] = $timeType;
        $this->queryParameters['TimeType'] = $timeType;

        return $this;
    }

    /**
     * @param string $instanceNetworkType
     * @return $this
     */
    public function setInstanceNetworkType($instanceNetworkType)
    {
        $this->requestParameters['InstanceNetworkType'] = $instanceNetworkType;
        $this->queryParameters['InstanceNetworkType'] = $instanceNetworkType;

        return $this;
    }

    /**
     * @param string $nodeType
     * @return $this
     */
    public function setNodeType($nodeType)
    {
        $this->requestParameters['NodeType'] = $nodeType;
        $this->queryParameters['NodeType'] = $nodeType;

        return $this;
    }

    /**
     * @param string $clientToken
     * @return $this
     */
    public function setClientToken($clientToken)
    {
        $this->requestParameters['ClientToken'] = $clientToken;
        $this->queryParameters['ClientToken'] = $clientToken;

        return $this;
    }

    /**
     * @param string $tableMeta
     * @return $this
     */
    public function setTableMeta($tableMeta)
    {
        $this->requestParameters['TableMeta'] = $tableMeta;
        $this->queryParameters['TableMeta'] = $tableMeta;

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
     * @param string $restoreTime
     * @return $this
     */
    public function setRestoreTime($restoreTime)
    {
        $this->requestParameters['RestoreTime'] = $restoreTime;
        $this->queryParameters['RestoreTime'] = $restoreTime;

        return $this;
    }

    /**
     * @param string $quantity
     * @return $this
     */
    public function setQuantity($quantity)
    {
        $this->requestParameters['Quantity'] = $quantity;
        $this->queryParameters['Quantity'] = $quantity;

        return $this;
    }

    /**
     * @param string $autoPay
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
     * @param string $restoreTable
     * @return $this
     */
    public function setRestoreTable($restoreTable)
    {
        $this->requestParameters['RestoreTable'] = $restoreTable;
        $this->queryParameters['RestoreTable'] = $restoreTable;

        return $this;
    }

    /**
     * @param string $usedTime
     * @return $this
     */
    public function setUsedTime($usedTime)
    {
        $this->requestParameters['UsedTime'] = $usedTime;
        $this->queryParameters['UsedTime'] = $usedTime;

        return $this;
    }

    /**
     * @param string $dBNames
     * @return $this
     */
    public function setDBNames($dBNames)
    {
        $this->requestParameters['DBNames'] = $dBNames;
        $this->queryParameters['DBNames'] = $dBNames;

        return $this;
    }

    /**
     * @param string $instanceUsedType
     * @return $this
     */
    public function setInstanceUsedType($instanceUsedType)
    {
        $this->requestParameters['InstanceUsedType'] = $instanceUsedType;
        $this->queryParameters['InstanceUsedType'] = $instanceUsedType;

        return $this;
    }

    /**
     * @param string $vPCId
     * @return $this
     */
    public function setVPCId($vPCId)
    {
        $this->requestParameters['VPCId'] = $vPCId;
        $this->queryParameters['VPCId'] = $vPCId;

        return $this;
    }

    /**
     * @param string $cloneInstanceDefaultValue
     * @return $this
     */
    public function setCloneInstanceDefaultValue($cloneInstanceDefaultValue)
    {
        $this->requestParameters['CloneInstanceDefaultValue'] = $cloneInstanceDefaultValue;
        $this->queryParameters['CloneInstanceDefaultValue'] = $cloneInstanceDefaultValue;

        return $this;
    }

    /**
     * @param string $payType
     * @return $this
     */
    public function setPayType($payType)
    {
        $this->requestParameters['PayType'] = $payType;
        $this->queryParameters['PayType'] = $payType;

        return $this;
    }
}
