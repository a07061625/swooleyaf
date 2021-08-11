<?php

namespace AlibabaCloud\Xtrace;

/**
 * @method string getAppType()
 * @method $this withAppType($value)
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
 * @method string getOperationName()
 * @method $this withOperationName($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getServiceName()
 * @method $this withServiceName($value)
 * @method array getTag()
 */
class SearchTraces extends Rpc
{
    /**
     * @return $this
     */
    public function withTag(array $tag)
    {
        $this->data['Tag'] = $tag;
        foreach ($tag as $depth1 => $depth1Value) {
            if (isset($depth1Value['Value'])) {
                $this->options['query']['Tag.' . ($depth1 + 1) . '.Value'] = $depth1Value['Value'];
            }
            if (isset($depth1Value['Key'])) {
                $this->options['query']['Tag.' . ($depth1 + 1) . '.Key'] = $depth1Value['Key'];
            }
        }

        return $this;
    }
}
