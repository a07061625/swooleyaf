<?php

namespace AliOpen\CCC;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of CheckNumberAvaliable
 *
 * @method string getCaller()
 * @method string getInstanceId()
 * @method string getCallee()
 */
class CheckNumberAvaliableRequest extends RpcAcsRequest
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
            'CheckNumberAvaliable',
            'CCC'
        );
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
}
