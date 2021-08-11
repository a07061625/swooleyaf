<?php

namespace AlibabaCloud\Cloudwf;

/**
 * @method string getApiUrl()
 * @method $this withApiUrl($value)
 * @method string getParamGenScript()
 * @method $this withParamGenScript($value)
 * @method string getName()
 * @method $this withName($value)
 * @method string getHttpMethod()
 * @method $this withHttpMethod($value)
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method string getId()
 * @method $this withId($value)
 * @method string getType()
 * @method $this withType($value)
 * @method array getResourceIds()
 */
class SaveProbeDataSubscriber extends Rpc
{
    /**
     * @return $this
     */
    public function withResourceIds(array $resourceIds)
    {
        $this->data['ResourceIds'] = $resourceIds;
        foreach ($resourceIds as $i => $iValue) {
            $this->options['query']['ResourceIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
