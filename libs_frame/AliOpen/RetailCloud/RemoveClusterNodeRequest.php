<?php

namespace AliOpen\RetailCloud;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of RemoveClusterNode
 *
 * @method array getEcsInstanceIdLists()
 * @method string getClusterInstanceId()
 */
class RemoveClusterNodeRequest extends RpcAcsRequest
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
        parent::__construct('retailcloud', '2018-03-13', 'RemoveClusterNode', 'retailcloud');
    }

    /**
     * @return $this
     */
    public function setEcsInstanceIdLists(array $ecsInstanceIdList)
    {
        $this->requestParameters['EcsInstanceIdLists'] = $ecsInstanceIdList;
        foreach ($ecsInstanceIdList as $i => $iValue) {
            $this->queryParameters['EcsInstanceIdList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @param string $clusterInstanceId
     *
     * @return $this
     */
    public function setClusterInstanceId($clusterInstanceId)
    {
        $this->requestParameters['ClusterInstanceId'] = $clusterInstanceId;
        $this->queryParameters['ClusterInstanceId'] = $clusterInstanceId;

        return $this;
    }
}
