<?php

namespace AliOpen\Emr;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of MigrateClusterHostGroupHost
 *
 * @method array getHostInstanceIdLists()
 * @method string getResourceOwnerId()
 * @method string getHostGroupId()
 * @method string getClusterId()
 */
class MigrateClusterHostGroupHostRequest extends RpcAcsRequest
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
        parent::__construct('Emr', '2016-04-08', 'MigrateClusterHostGroupHost', 'emr');
    }

    /**
     * @return $this
     */
    public function setHostInstanceIdLists(array $hostInstanceIdLists)
    {
        $this->requestParameters['HostInstanceIdLists'] = $hostInstanceIdLists;
        foreach ($hostInstanceIdLists as $i => $iValue) {
            $this->queryParameters['HostInstanceIdList.' . ($i + 1)] = $iValue;
        }

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
     * @param string $hostGroupId
     *
     * @return $this
     */
    public function setHostGroupId($hostGroupId)
    {
        $this->requestParameters['HostGroupId'] = $hostGroupId;
        $this->queryParameters['HostGroupId'] = $hostGroupId;

        return $this;
    }

    /**
     * @param string $clusterId
     *
     * @return $this
     */
    public function setClusterId($clusterId)
    {
        $this->requestParameters['ClusterId'] = $clusterId;
        $this->queryParameters['ClusterId'] = $clusterId;

        return $this;
    }
}
