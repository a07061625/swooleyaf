<?php

namespace AlibabaCloud\Alidns;

/**
 * @method string getSourceProtocol()
 * @method $this withSourceProtocol($value)
 * @method string getLang()
 * @method $this withLang($value)
 * @method string getDomainName()
 * @method $this withDomainName($value)
 * @method string getCacheTtlMax()
 * @method $this withCacheTtlMax($value)
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getSourceEdns()
 * @method $this withSourceEdns($value)
 * @method string getUserClientIp()
 * @method $this withUserClientIp($value)
 * @method string getCacheTtlMin()
 * @method $this withCacheTtlMin($value)
 * @method array getSourceDnsServer()
 */
class UpdateDnsCacheDomain extends Rpc
{
    /**
     * @return $this
     */
    public function withSourceDnsServer(array $sourceDnsServer)
    {
        $this->data['SourceDnsServer'] = $sourceDnsServer;
        foreach ($sourceDnsServer as $depth1 => $depth1Value) {
            if (isset($depth1Value['Port'])) {
                $this->options['query']['SourceDnsServer.' . ($depth1 + 1) . '.Port'] = $depth1Value['Port'];
            }
            if (isset($depth1Value['Host'])) {
                $this->options['query']['SourceDnsServer.' . ($depth1 + 1) . '.Host'] = $depth1Value['Host'];
            }
        }

        return $this;
    }
}
