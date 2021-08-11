<?php

namespace AlibabaCloud\Ddoscoo;

/**
 * @method array getDomains()
 * @method string getSourceIp()
 * @method $this withSourceIp($value)
 */
class DescribeWebAccessMode extends Rpc
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
