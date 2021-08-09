<?php

namespace AliOpen\CS;

use AliOpen\Core\RoaAcsRequest;

/**
 * Request of AttachInstances
 *
 * @method string getClusterId()
 */
class AttachInstancesRequest extends RoaAcsRequest
{
    /**
     * @var string
     */
    protected $uriPattern = '/clusters/[ClusterId]/attach';

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
            'AttachInstances'
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
