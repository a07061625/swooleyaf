<?php

namespace AlibabaCloud\ROS;

/**
 * @method string getStackId()
 * @method $this withStackId($value)
 * @method array getRecreatingResources()
 */
class ContinueCreateStack extends Rpc
{
    /**
     * @return $this
     */
    public function withRecreatingResources(array $recreatingResources)
    {
        $this->data['RecreatingResources'] = $recreatingResources;
        foreach ($recreatingResources as $i => $iValue) {
            $this->options['query']['RecreatingResources.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
