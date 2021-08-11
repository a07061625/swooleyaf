<?php

namespace AlibabaCloud\Ddoscoo;

/**
 * @method array getDomains()
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getSourceIp()
 * @method $this withSourceIp($value)
 */
class DescribeWebInstanceRelations extends Rpc
{
    /**
     * @return $this
     */
    public function withDomains(array $domains)
    {
        $this->data['Domains'] = $domains;
        foreach ($domains as $i => $iValue) {
            $this->options['query']['Domains.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
