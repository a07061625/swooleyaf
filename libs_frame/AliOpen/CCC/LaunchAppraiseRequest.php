<?php

namespace AliOpen\CCC;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of LaunchAppraise
 *
 * @method string getAcid()
 * @method string getInstanceId()
 */
class LaunchAppraiseRequest extends RpcAcsRequest
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
            'LaunchAppraise',
            'CCC'
        );
    }

    /**
     * @param string $acid
     *
     * @return $this
     */
    public function setAcid($acid)
    {
        $this->requestParameters['Acid'] = $acid;
        $this->queryParameters['Acid'] = $acid;

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
}
