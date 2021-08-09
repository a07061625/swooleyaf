<?php

namespace AliOpen\Cr;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DeleteInstanceVpcEndpointLinkedVpc
 *
 * @method string getVswitchId()
 * @method string getInstanceId()
 * @method string getVpcId()
 * @method string getModuleName()
 */
class DeleteInstanceVpcEndpointLinkedVpcRequest extends RpcAcsRequest
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
            'cr',
            '2018-12-01',
            'DeleteInstanceVpcEndpointLinkedVpc',
            'acr'
        );
    }

    /**
     * @param string $vswitchId
     *
     * @return $this
     */
    public function setVswitchId($vswitchId)
    {
        $this->requestParameters['VswitchId'] = $vswitchId;
        $this->queryParameters['VswitchId'] = $vswitchId;

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
     * @param string $vpcId
     *
     * @return $this
     */
    public function setVpcId($vpcId)
    {
        $this->requestParameters['VpcId'] = $vpcId;
        $this->queryParameters['VpcId'] = $vpcId;

        return $this;
    }

    /**
     * @param string $moduleName
     *
     * @return $this
     */
    public function setModuleName($moduleName)
    {
        $this->requestParameters['ModuleName'] = $moduleName;
        $this->queryParameters['ModuleName'] = $moduleName;

        return $this;
    }
}
