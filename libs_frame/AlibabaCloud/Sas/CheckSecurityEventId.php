<?php

namespace AlibabaCloud\Sas;

/**
 * @method array getSecurityEventIds()
 * @method string getUuid()
 * @method $this withUuid($value)
 * @method string getSourceIp()
 * @method $this withSourceIp($value)
 */
class CheckSecurityEventId extends Rpc
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
