<?php
namespace AliOpen\Ehpc;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DeleteCluster
 * @method string getReleaseInstance()
 * @method string getClusterId()
 */
class DeleteClusterRequest extends RpcAcsRequest
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('EHPC', '2018-04-12', 'DeleteCluster', 'ehs');
    }

    /**
     * @param string $releaseInstance
     * @return $this
     */
    public function setReleaseInstance($releaseInstance)
    {
        $this->requestParameters['ReleaseInstance'] = $releaseInstance;
        $this->queryParameters['ReleaseInstance'] = $releaseInstance;

        return $this;
    }

    /**
     * @param string $clusterId
     * @return $this
     */
    public function setClusterId($clusterId)
    {
        $this->requestParameters['ClusterId'] = $clusterId;
        $this->queryParameters['ClusterId'] = $clusterId;

        return $this;
    }
}
