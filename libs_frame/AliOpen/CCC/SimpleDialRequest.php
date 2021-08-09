<?php

namespace AliOpen\CCC;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of SimpleDial
 *
 * @method string getCallee()
 * @method string getCaller()
 * @method string getInstanceId()
 * @method string getContractFlowId()
 */
class SimpleDialRequest extends RpcAcsRequest
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
        parent::__construct(
            'CCC',
            '2017-07-05',
            'SimpleDial'
        );
    }

    /**
     * @param string $callee
     *
     * @return $this
     */
    public function setCallee($callee)
    {
        $this->requestParameters['Callee'] = $callee;
        $this->queryParameters['Callee'] = $callee;

        return $this;
    }

    /**
     * @param string $caller
     *
     * @return $this
     */
    public function setCaller($caller)
    {
        $this->requestParameters['Caller'] = $caller;
        $this->queryParameters['Caller'] = $caller;

        return $this;
    }

    /**
     * @param string $instanceId
     *
     * @return $this
     */
    public function setInstanceId($instanceId)
    {
        $this->requestParameters['InstanceId'] = $instanceId;
        $this->queryParameters['InstanceId'] = $instanceId;

        return $this;
    }

    /**
     * @param string $contractFlowId
     *
     * @return $this
     */
    public function setContractFlowId($contractFlowId)
    {
        $this->requestParameters['ContractFlowId'] = $contractFlowId;
        $this->queryParameters['ContractFlowId'] = $contractFlowId;

        return $this;
    }
}
