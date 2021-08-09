<?php
namespace AliOpen\Emr;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of GetSupportedOpsCommand
 * @method string getResourceOwnerId()
 */
class GetSupportedOpsCommandRequest extends RpcAcsRequest
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
        parent::__construct('Emr', '2016-04-08', 'GetSupportedOpsCommand', 'emr');
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
}
