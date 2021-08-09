<?php

namespace AliOpen\CS;

use AliOpen\Core\RoaAcsRequest;

/**
 * Request of DescribeClusterDetail
 *
 * @method string getClusterId()
 */
class DescribeClusterDetailRequest extends RoaAcsRequest
{
    /**
     * @var string
     */
    protected $uriPattern = '/clusters/[ClusterId]';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct(
            'CS',
            '2015-12-15',
            'DescribeClusterDetail'
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
