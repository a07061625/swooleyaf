<?php
namespace AliOpen\CS;

use AliOpen\Core\RoaAcsRequest;

/**
 * 
 *
 * Request of ScaleOutCluster
 *
 * @method string getClusterId()
 */
class ScaleOutClusterRequest extends RoaAcsRequest
{

    /**
     * @var string
     */
    protected $uriPattern = '/api/v2/clusters/[ClusterId]';

    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct(
            'CS',
            '2015-12-15',
            'ScaleOutCluster'
        );
    }

    /**
     * @param string $clusterId
     *
     * @return $this
     */
    public function setClusterId($clusterId)
    {
        $this->requestParameters['ClusterId'] = $clusterId;
        $this->pathParameters['ClusterId'] = $clusterId;

        return $this;
    }
}
