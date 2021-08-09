<?php
namespace AliOpen\CS;

use AliOpen\Core\RoaAcsRequest;

/**
 * 
 *
 * Request of DescribeClusterCerts
 *
 * @method string getClusterId()
 */
class DescribeClusterCertsRequest extends RoaAcsRequest
{

    /**
     * @var string
     */
    protected $uriPattern = '/clusters/[ClusterId]/certs';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct(
            'CS',
            '2015-12-15',
            'DescribeClusterCerts'
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
