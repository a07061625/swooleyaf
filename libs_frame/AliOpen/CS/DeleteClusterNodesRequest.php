<?php
namespace AliOpen\CS;

use AliOpen\Core\RoaAcsRequest;

/**
 * 
 *
 * Request of DeleteClusterNodes
 *
 * @method string getClusterId()
 */
class DeleteClusterNodesRequest extends RoaAcsRequest
{

    /**
     * @var string
     */
    protected $uriPattern = '/clusters/[ClusterId]/nodes';

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
            'DeleteClusterNodes'
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
