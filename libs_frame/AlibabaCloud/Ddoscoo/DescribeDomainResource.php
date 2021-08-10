<?php

namespace AlibabaCloud\Ddoscoo;

/**
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getSourceIp()
 * @method $this withSourceIp($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method array getInstanceIds()
 * @method string getQueryDomainPattern()
 * @method $this withQueryDomainPattern($value)
 * @method string getDomain()
 * @method $this withDomain($value)
 */
class DescribeDomainResource extends Rpc
{
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
}
