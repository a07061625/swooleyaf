<?php

namespace AlibabaCloud\DomainIntl;

/**
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method array getIp()
 * @method string getDnsName()
 * @method $this withDnsName($value)
 * @method string getUserClientIp()
 * @method $this withUserClientIp($value)
 * @method string getLang()
 * @method $this withLang($value)
 */
class SaveSingleTaskForModifyingDnsHost extends Rpc
{
    /**
     * @return $this
     */
    public function withIp(array $ip)
    {
        $this->data['Ip'] = $ip;
        foreach ($ip as $i => $iValue) {
            $this->options['query']['Ip.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
