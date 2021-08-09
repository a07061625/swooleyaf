<?php
namespace AliOpen\Ehpc;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of GetClusterVolumes
 * @method string getClusterId()
 */
class GetClusterVolumesRequest extends RpcAcsRequest
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('EHPC', '2018-04-12', 'GetClusterVolumes', 'ehs');
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
