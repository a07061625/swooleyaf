<?php

namespace AliOpen\CS;

use AliOpen\Core\RoaAcsRequest;

/**
 * Request of DeleteCluster
 *
 * @method string getClusterId()
 */
class DeleteClusterRequest extends RoaAcsRequest
{
    /**
     * @var string
     */
    protected $uriPattern = '/clusters/[ClusterId]';

    /**
     * @var string
     */
    protected $method = 'DELETE';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct(
            'CS',
            '2015-12-15',
            'DeleteCluster'
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
