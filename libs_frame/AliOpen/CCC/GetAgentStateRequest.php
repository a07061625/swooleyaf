<?php
namespace AliOpen\CCC;

use AliOpen\Core\RpcAcsRequest;

/**
 * 
 *
 * Request of GetAgentState
 *
 * @method string getAgentId()
 * @method string getDn()
 * @method string getInstanceId()
 */
class GetAgentStateRequest extends RpcAcsRequest
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
            'GetAgentState'
        );
    }

    /**
     * @param string $agentId
     *
     * @return $this
     */
    public function setAgentId($agentId)
    {
        $this->requestParameters['AgentId'] = $agentId;
        $this->queryParameters['AgentId'] = $agentId;

        return $this;
    }

    /**
     * @param string $dn
     *
     * @return $this
     */
    public function setDn($dn)
    {
        $this->requestParameters['Dn'] = $dn;
        $this->queryParameters['Dn'] = $dn;

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
