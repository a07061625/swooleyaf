<?php

namespace AlibabaCloud\Actiontrail;

/**
 * @method string getEndTime()
 * @method $this withEndTime($value)
 * @method string getStartTime()
 * @method $this withStartTime($value)
 * @method string getNextToken()
 * @method $this withNextToken($value)
 * @method array getLookupAttribute()
 * @method string getMaxResults()
 * @method $this withMaxResults($value)
 * @method string getDirection()
 * @method $this withDirection($value)
 */
class LookupEvents extends Rpc
{
    /**
     * @return $this
     */
    public function withLookupAttribute(array $lookupAttribute)
    {
        $this->data['LookupAttribute'] = $lookupAttribute;
        foreach ($lookupAttribute as $depth1 => $depth1Value) {
            if (isset($depth1Value['Value'])) {
                $this->options['query']['LookupAttribute.' . ($depth1 + 1) . '.Value'] = $depth1Value['Value'];
            }
            if (isset($depth1Value['Key'])) {
                $this->options['query']['LookupAttribute.' . ($depth1 + 1) . '.Key'] = $depth1Value['Key'];
            }
        }

        return $this;
    }
}
