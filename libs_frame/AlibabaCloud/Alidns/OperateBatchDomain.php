<?php

namespace AlibabaCloud\Alidns;

/**
 * @method array getDomainRecordInfo()
 * @method string getType()
 * @method $this withType($value)
 * @method string getUserClientIp()
 * @method $this withUserClientIp($value)
 * @method string getLang()
 * @method $this withLang($value)
 */
class OperateBatchDomain extends Rpc
{
    /**
     * @return $this
     */
    public function withDomainRecordInfo(array $domainRecordInfo)
    {
        $this->data['DomainRecordInfo'] = $domainRecordInfo;
        foreach ($domainRecordInfo as $depth1 => $depth1Value) {
            if (isset($depth1Value['Rr'])) {
                $this->options['query']['DomainRecordInfo.' . ($depth1 + 1) . '.Rr'] = $depth1Value['Rr'];
            }
            if (isset($depth1Value['NewType'])) {
                $this->options['query']['DomainRecordInfo.' . ($depth1 + 1) . '.NewType'] = $depth1Value['NewType'];
            }
            if (isset($depth1Value['NewValue'])) {
                $this->options['query']['DomainRecordInfo.' . ($depth1 + 1) . '.NewValue'] = $depth1Value['NewValue'];
            }
            if (isset($depth1Value['Line'])) {
                $this->options['query']['DomainRecordInfo.' . ($depth1 + 1) . '.Line'] = $depth1Value['Line'];
            }
            if (isset($depth1Value['Domain'])) {
                $this->options['query']['DomainRecordInfo.' . ($depth1 + 1) . '.Domain'] = $depth1Value['Domain'];
            }
            if (isset($depth1Value['Type'])) {
                $this->options['query']['DomainRecordInfo.' . ($depth1 + 1) . '.Type'] = $depth1Value['Type'];
            }
            if (isset($depth1Value['Priority'])) {
                $this->options['query']['DomainRecordInfo.' . ($depth1 + 1) . '.Priority'] = $depth1Value['Priority'];
            }
            if (isset($depth1Value['Value'])) {
                $this->options['query']['DomainRecordInfo.' . ($depth1 + 1) . '.Value'] = $depth1Value['Value'];
            }
            if (isset($depth1Value['Ttl'])) {
                $this->options['query']['DomainRecordInfo.' . ($depth1 + 1) . '.Ttl'] = $depth1Value['Ttl'];
            }
            if (isset($depth1Value['NewRr'])) {
                $this->options['query']['DomainRecordInfo.' . ($depth1 + 1) . '.NewRr'] = $depth1Value['NewRr'];
            }
        }

        return $this;
    }
}
