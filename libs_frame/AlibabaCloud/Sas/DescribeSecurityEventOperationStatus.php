<?php

namespace AlibabaCloud\Sas;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method array getSecurityEventIds()
 * @method string getSourceIp()
 * @method $this withSourceIp($value)
 * @method string getTaskId()
 * @method $this withTaskId($value)
 */
class DescribeSecurityEventOperationStatus extends Rpc
{
    /**
     * @return $this
     */
    public function withSecurityEventIds(array $securityEventIds)
    {
        $this->data['SecurityEventIds'] = $securityEventIds;
        foreach ($securityEventIds as $i => $iValue) {
            $this->options['query']['SecurityEventIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
