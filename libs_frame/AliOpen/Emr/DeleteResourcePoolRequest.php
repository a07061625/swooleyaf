<?php
namespace AliOpen\Emr;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DeleteResourcePool
 * @method string getResourceOwnerId()
 * @method string getResourcePoolId()
 * @method string getClusterId()
 */
class DeleteResourcePoolRequest extends RpcAcsRequest
{
    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('Emr', '2016-04-08', 'DeleteResourcePool', 'emr');
    }

    /**
     * @param string $resourceOwnerId
     * @return $this
     */
    public function setResourceOwnerId($resourceOwnerId)
    {
        $this->requestParameters['ResourceOwnerId'] = $resourceOwnerId;
        $this->queryParameters['ResourceOwnerId'] = $resourceOwnerId;

        return $this;
    }

    /**
     * @param string $resourcePoolId
     * @return $this
     */
    public function setResourcePoolId($resourcePoolId)
    {
        $this->requestParameters['ResourcePoolId'] = $resourcePoolId;
        $this->queryParameters['ResourcePoolId'] = $resourcePoolId;

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
