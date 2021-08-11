<?php

namespace AlibabaCloud\OutboundBot;

/**
 * @method array getBriefTypes()
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getJobGroupId()
 * @method $this withJobGroupId($value)
 */
class DescribeJobGroup extends Rpc
{
    /**
     * @return $this
     */
    public function withBriefTypes(array $briefTypes)
    {
        $this->data['BriefTypes'] = $briefTypes;
        foreach ($briefTypes as $i => $iValue) {
            $this->options['query']['BriefTypes.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
