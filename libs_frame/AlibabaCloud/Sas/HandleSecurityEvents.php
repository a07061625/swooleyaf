<?php

namespace AlibabaCloud\Sas;

/**
 * @method string getMarkMissParam()
 * @method $this withMarkMissParam($value)
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method array getSecurityEventIds()
 * @method string getSourceIp()
 * @method $this withSourceIp($value)
 * @method string getOperationCode()
 * @method $this withOperationCode($value)
 * @method string getOperationParams()
 * @method $this withOperationParams($value)
 * @method string getMarkBatch()
 * @method $this withMarkBatch($value)
 */
class HandleSecurityEvents extends Rpc
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
