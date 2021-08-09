<?php

namespace AliOpen\Ots;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of UnbindInstance2Vpc
 *
 * @method string getaccess_key_id()
 * @method string getInstanceVpcName()
 * @method string getResourceOwnerId()
 * @method string getInstanceName()
 * @method string getRegionNo()
 */
class UnbindInstance2VpcRequest extends RpcAcsRequest
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
        parent::__construct('Ots', '2016-06-20', 'UnbindInstance2Vpc', 'ots');
    }

    /**
     * @param string $access_key_id
     *
     * @return $this
     */
    public function setaccess_key_id($access_key_id)
    {
        $this->requestParameters['access_key_id'] = $access_key_id;
        $this->queryParameters['access_key_id'] = $access_key_id;

        return $this;
    }

    /**
     * @param string $instanceVpcName
     *
     * @return $this
     */
    public function setInstanceVpcName($instanceVpcName)
    {
        $this->requestParameters['InstanceVpcName'] = $instanceVpcName;
        $this->queryParameters['InstanceVpcName'] = $instanceVpcName;

        return $this;
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
     * @param string $instanceName
     *
     * @return $this
     */
    public function setInstanceName($instanceName)
    {
        $this->requestParameters['InstanceName'] = $instanceName;
        $this->queryParameters['InstanceName'] = $instanceName;

        return $this;
    }

    /**
     * @param string $regionNo
     *
     * @return $this
     */
    public function setRegionNo($regionNo)
    {
        $this->requestParameters['RegionNo'] = $regionNo;
        $this->queryParameters['RegionNo'] = $regionNo;

        return $this;
    }
}
