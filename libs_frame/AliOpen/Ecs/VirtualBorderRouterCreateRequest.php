<?php

namespace AliOpen\Ecs;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of CreateVirtualBorderRouter
 *
 * @method string getResourceOwnerId()
 * @method string getCircuitCode()
 * @method string getVlanId()
 * @method string getClientToken()
 * @method string getDescription()
 * @method string getPeerGatewayIp()
 * @method string getPeeringSubnetMask()
 * @method string getLocalGatewayIp()
 * @method string getUserCidr()
 * @method string getResourceOwnerAccount()
 * @method string getOwnerAccount()
 * @method string getOwnerId()
 * @method string getPhysicalConnectionId()
 * @method string getName()
 * @method string getVbrOwnerId()
 */
class VirtualBorderRouterCreateRequest extends RpcAcsRequest
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
        parent::__construct('Ecs', '2014-05-26', 'CreateVirtualBorderRouter', 'ecs');
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
     * @param string $circuitCode
     *
     * @return $this
     */
    public function setCircuitCode($circuitCode)
    {
        $this->requestParameters['CircuitCode'] = $circuitCode;
        $this->queryParameters['CircuitCode'] = $circuitCode;

        return $this;
    }

    /**
     * @param string $vlanId
     *
     * @return $this
     */
    public function setVlanId($vlanId)
    {
        $this->requestParameters['VlanId'] = $vlanId;
        $this->queryParameters['VlanId'] = $vlanId;

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
     * @param string $peerGatewayIp
     *
     * @return $this
     */
    public function setPeerGatewayIp($peerGatewayIp)
    {
        $this->requestParameters['PeerGatewayIp'] = $peerGatewayIp;
        $this->queryParameters['PeerGatewayIp'] = $peerGatewayIp;

        return $this;
    }

    /**
     * @param string $peeringSubnetMask
     *
     * @return $this
     */
    public function setPeeringSubnetMask($peeringSubnetMask)
    {
        $this->requestParameters['PeeringSubnetMask'] = $peeringSubnetMask;
        $this->queryParameters['PeeringSubnetMask'] = $peeringSubnetMask;

        return $this;
    }

    /**
     * @param string $localGatewayIp
     *
     * @return $this
     */
    public function setLocalGatewayIp($localGatewayIp)
    {
        $this->requestParameters['LocalGatewayIp'] = $localGatewayIp;
        $this->queryParameters['LocalGatewayIp'] = $localGatewayIp;

        return $this;
    }

    /**
     * @param string $userCidr
     *
     * @return $this
     */
    public function setUserCidr($userCidr)
    {
        $this->requestParameters['UserCidr'] = $userCidr;
        $this->queryParameters['UserCidr'] = $userCidr;

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
     * @param string $physicalConnectionId
     *
     * @return $this
     */
    public function setPhysicalConnectionId($physicalConnectionId)
    {
        $this->requestParameters['PhysicalConnectionId'] = $physicalConnectionId;
        $this->queryParameters['PhysicalConnectionId'] = $physicalConnectionId;

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
     * @param string $vbrOwnerId
     *
     * @return $this
     */
    public function setVbrOwnerId($vbrOwnerId)
    {
        $this->requestParameters['VbrOwnerId'] = $vbrOwnerId;
        $this->queryParameters['VbrOwnerId'] = $vbrOwnerId;

        return $this;
    }
}
