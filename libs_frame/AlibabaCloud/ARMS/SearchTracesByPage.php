<?php

namespace AlibabaCloud\ARMS;

/**
 * @method string getEndTime()
 * @method $this withEndTime($value)
 * @method string getStartTime()
 * @method $this withStartTime($value)
 * @method string getReverse()
 * @method $this withReverse($value)
 * @method string getMinDuration()
 * @method $this withMinDuration($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getServiceIp()
 * @method $this withServiceIp($value)
 * @method array getExclusionFilters()
 * @method string getOperationName()
 * @method $this withOperationName($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getServiceName()
 * @method $this withServiceName($value)
 */
class SearchTracesByPage extends Rpc
{
    /**
     * @return $this
     */
    public function withExclusionFilters(array $exclusionFilters)
    {
        $this->data['ExclusionFilters'] = $exclusionFilters;
        foreach ($exclusionFilters as $depth1 => $depth1Value) {
            if (isset($depth1Value['Value'])) {
                $this->options['query']['ExclusionFilters.' . ($depth1 + 1) . '.Value'] = $depth1Value['Value'];
            }
            if (isset($depth1Value['Key'])) {
                $this->options['query']['ExclusionFilters.' . ($depth1 + 1) . '.Key'] = $depth1Value['Key'];
            }
        }

        return $this;
    }
}
