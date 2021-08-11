<?php

namespace AlibabaCloud\Retailcloud;

/**
 * @method string getDeployPacketUrl()
 * @method $this withDeployPacketUrl($value)
 * @method string getTotalPartitions()
 * @method $this withTotalPartitions($value)
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method string getEnvId()
 * @method $this withEnvId($value)
 * @method string getUpdateStrategyType()
 * @method $this withUpdateStrategyType($value)
 * @method string getPauseType()
 * @method $this withPauseType($value)
 * @method string getDeployPacketId()
 * @method $this withDeployPacketId($value)
 * @method array getContainerImageList()
 * @method string getName()
 * @method $this withName($value)
 * @method array getInitContainerImageList()
 * @method string getDefaultPacketOfAppGroup()
 * @method $this withDefaultPacketOfAppGroup($value)
 * @method string getArmsFlag()
 * @method $this withArmsFlag($value)
 */
class DeployApp extends Rpc
{
    /**
     * @return $this
     */
    public function withContainerImageList(array $containerImageList)
    {
        $this->data['ContainerImageList'] = $containerImageList;
        foreach ($containerImageList as $i => $iValue) {
            $this->options['query']['ContainerImageList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withInitContainerImageList(array $initContainerImageList)
    {
        $this->data['InitContainerImageList'] = $initContainerImageList;
        foreach ($initContainerImageList as $i => $iValue) {
            $this->options['query']['InitContainerImageList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
