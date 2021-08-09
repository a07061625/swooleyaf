<?php
namespace AliOpen\Ehpc;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ListInvocationStatus
 * @method string getClusterId()
 * @method string getCommandId()
 */
class ListInvocationStatusRequest extends RpcAcsRequest
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('EHPC', '2018-04-12', 'ListInvocationStatus', 'ehs');
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

    /**
     * @param string $commandId
     * @return $this
     */
    public function setCommandId($commandId)
    {
        $this->requestParameters['CommandId'] = $commandId;
        $this->queryParameters['CommandId'] = $commandId;

        return $this;
    }
}
