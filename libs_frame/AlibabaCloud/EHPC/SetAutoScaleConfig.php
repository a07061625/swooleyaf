<?php

namespace AlibabaCloud\EHPC;

/**
 * @method string getImageId()
 * @method $this withImageId($value)
 * @method string getSpotPriceLimit()
 * @method $this withSpotPriceLimit($value)
 * @method string getExcludeNodes()
 * @method $this withExcludeNodes($value)
 * @method string getExtraNodesGrowRatio()
 * @method $this withExtraNodesGrowRatio($value)
 * @method string getShrinkIdleTimes()
 * @method $this withShrinkIdleTimes($value)
 * @method string getGrowTimeoutInMinutes()
 * @method $this withGrowTimeoutInMinutes($value)
 * @method string getClusterId()
 * @method $this withClusterId($value)
 * @method string getEnableAutoGrow()
 * @method $this withEnableAutoGrow($value)
 * @method string getEnableAutoShrink()
 * @method $this withEnableAutoShrink($value)
 * @method string getSpotStrategy()
 * @method $this withSpotStrategy($value)
 * @method string getMaxNodesInCluster()
 * @method $this withMaxNodesInCluster($value)
 * @method string getShrinkIntervalInMinutes()
 * @method $this withShrinkIntervalInMinutes($value)
 * @method array getQueues()
 * @method string getGrowIntervalInMinutes()
 * @method $this withGrowIntervalInMinutes($value)
 * @method string getGrowRatio()
 * @method $this withGrowRatio($value)
 */
class SetAutoScaleConfig extends Rpc
{
    /**
     * @return $this
     */
    public function withQueues(array $queues)
    {
        $this->data['Queues'] = $queues;
        foreach ($queues as $depth1 => $depth1Value) {
            if (isset($depth1Value['SpotStrategy'])) {
                $this->options['query']['Queues.' . ($depth1 + 1) . '.SpotStrategy'] = $depth1Value['SpotStrategy'];
            }
            if (isset($depth1Value['QueueName'])) {
                $this->options['query']['Queues.' . ($depth1 + 1) . '.QueueName'] = $depth1Value['QueueName'];
            }
            if (isset($depth1Value['MinNodesInQueue'])) {
                $this->options['query']['Queues.' . ($depth1 + 1) . '.MinNodesInQueue'] = $depth1Value['MinNodesInQueue'];
            }
            foreach ($depth1Value['InstanceTypes'] as $depth2 => $depth2Value) {
                if (isset($depth2Value['SpotStrategy'])) {
                    $this->options['query']['Queues.' . ($depth1 + 1) . '.InstanceTypes.' . ($depth2 + 1) . '.SpotStrategy'] = $depth2Value['SpotStrategy'];
                }
                if (isset($depth2Value['VSwitchId'])) {
                    $this->options['query']['Queues.' . ($depth1 + 1) . '.InstanceTypes.' . ($depth2 + 1) . '.VSwitchId'] = $depth2Value['VSwitchId'];
                }
                if (isset($depth2Value['InstanceType'])) {
                    $this->options['query']['Queues.' . ($depth1 + 1) . '.InstanceTypes.' . ($depth2 + 1) . '.InstanceType'] = $depth2Value['InstanceType'];
                }
                if (isset($depth2Value['ZoneId'])) {
                    $this->options['query']['Queues.' . ($depth1 + 1) . '.InstanceTypes.' . ($depth2 + 1) . '.ZoneId'] = $depth2Value['ZoneId'];
                }
                if (isset($depth2Value['HostNamePrefix'])) {
                    $this->options['query']['Queues.' . ($depth1 + 1) . '.InstanceTypes.' . ($depth2 + 1) . '.HostNamePrefix'] = $depth2Value['HostNamePrefix'];
                }
                if (isset($depth2Value['SpotPriceLimit'])) {
                    $this->options['query']['Queues.' . ($depth1 + 1) . '.InstanceTypes.' . ($depth2 + 1) . '.SpotPriceLimit'] = $depth2Value['SpotPriceLimit'];
                }
            }
            if (isset($depth1Value['MaxNodesInQueue'])) {
                $this->options['query']['Queues.' . ($depth1 + 1) . '.MaxNodesInQueue'] = $depth1Value['MaxNodesInQueue'];
            }
            if (isset($depth1Value['InstanceType'])) {
                $this->options['query']['Queues.' . ($depth1 + 1) . '.InstanceType'] = $depth1Value['InstanceType'];
            }
            if (isset($depth1Value['QueueImageId'])) {
                $this->options['query']['Queues.' . ($depth1 + 1) . '.QueueImageId'] = $depth1Value['QueueImageId'];
            }
            if (isset($depth1Value['EnableAutoGrow'])) {
                $this->options['query']['Queues.' . ($depth1 + 1) . '.EnableAutoGrow'] = $depth1Value['EnableAutoGrow'];
            }
            if (isset($depth1Value['SpotPriceLimit'])) {
                $this->options['query']['Queues.' . ($depth1 + 1) . '.SpotPriceLimit'] = $depth1Value['SpotPriceLimit'];
            }
            if (isset($depth1Value['EnableAutoShrink'])) {
                $this->options['query']['Queues.' . ($depth1 + 1) . '.EnableAutoShrink'] = $depth1Value['EnableAutoShrink'];
            }
        }

        return $this;
    }
}
