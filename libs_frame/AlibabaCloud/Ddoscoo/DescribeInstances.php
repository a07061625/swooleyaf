<?php

namespace AlibabaCloud\Ddoscoo;

/**
 * @method string getEdition()
 * @method $this withEdition($value)
 * @method string getRemark()
 * @method $this withRemark($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getEnabled()
 * @method $this withEnabled($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getSourceIp()
 * @method $this withSourceIp($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method array getTag()
 * @method string getExpireStartTime()
 * @method $this withExpireStartTime($value)
 * @method string getExpireEndTime()
 * @method $this withExpireEndTime($value)
 * @method string getIp()
 * @method $this withIp($value)
 * @method array getInstanceIds()
 * @method array getStatus()
 */
class DescribeInstances extends Rpc
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

    /**
     * @return $this
     */
    public function withInstanceIds(array $instanceIds)
    {
        $this->data['InstanceIds'] = $instanceIds;
        foreach ($instanceIds as $i => $iValue) {
            $this->options['query']['InstanceIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withStatus(array $status)
    {
        $this->data['Status'] = $status;
        foreach ($status as $i => $iValue) {
            $this->options['query']['Status.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
