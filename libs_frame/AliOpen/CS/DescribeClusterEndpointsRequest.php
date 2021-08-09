<?php

namespace AliOpen\CS;

use AliOpen\Core\RoaAcsRequest;

/**
 * Request of DescribeClusterEndpoints
 *
 * @method string getClusterId()
 */
class DescribeClusterEndpointsRequest extends RoaAcsRequest
{
    /**
     * @var string
     */
    protected $uriPattern = '/clusters/[ClusterId]/endpoints';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct(
            'CS',
            '2015-12-15',
            'DescribeClusterEndpoints'
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
