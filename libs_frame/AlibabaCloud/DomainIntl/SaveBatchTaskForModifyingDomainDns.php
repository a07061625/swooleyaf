<?php

namespace AlibabaCloud\DomainIntl;

/**
 * @method string getUserClientIp()
 * @method $this withUserClientIp($value)
 * @method array getDomainName()
 * @method array getDomainNameServer()
 * @method string getLang()
 * @method $this withLang($value)
 * @method string getAliyunDns()
 * @method $this withAliyunDns($value)
 */
class SaveBatchTaskForModifyingDomainDns extends Rpc
{
    /**
     * @return $this
     */
    public function withDomainName(array $domainName)
    {
        $this->data['DomainName'] = $domainName;
        foreach ($domainName as $i => $iValue) {
            $this->options['query']['DomainName.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withDomainNameServer(array $domainNameServer)
    {
        $this->data['DomainNameServer'] = $domainNameServer;
        foreach ($domainNameServer as $i => $iValue) {
            $this->options['query']['DomainNameServer.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
