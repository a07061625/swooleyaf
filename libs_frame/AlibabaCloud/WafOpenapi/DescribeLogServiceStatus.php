<?php

namespace AlibabaCloud\WafOpenapi;

/**
 * @method array getDomainNames()
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getSourceIp()
 * @method $this withSourceIp($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getRegion()
 * @method $this withRegion($value)
 */
class DescribeLogServiceStatus extends Rpc
{
    /**
     * @return $this
     */
    public function withDomainNames(array $domainNames)
    {
        $this->data['DomainNames'] = $domainNames;
        foreach ($domainNames as $i => $iValue) {
            $this->options['query']['DomainNames.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
