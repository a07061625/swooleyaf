<?php

namespace AliOpen\Ehpc;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DeleteNodes
 *
 * @method string getReleaseInstance()
 * @method array getInstances()
 * @method string getClusterId()
 */
class DeleteNodesRequest extends RpcAcsRequest
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('EHPC', '2018-04-12', 'DeleteNodes', 'ehs');
    }

    /**
     * @param string $releaseInstance
     *
     * @return $this
     */
    public function setReleaseInstance($releaseInstance)
    {
        $this->requestParameters['ReleaseInstance'] = $releaseInstance;
        $this->queryParameters['ReleaseInstance'] = $releaseInstance;

        return $this;
    }

    /**
     * @return $this
     */
    public function setInstances(array $instance)
    {
        $this->requestParameters['Instances'] = $instance;
        foreach ($instance as $depth1 => $depth1Value) {
            $this->queryParameters['Instance.' . ($depth1 + 1) . '.Id'] = $depth1Value['Id'];
        }

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
